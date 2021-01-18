<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\ProductImage;
use App\Models\Slider;
use App\Models\Category_slider;
use App\Models\OrderItem;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Team;
use App\Models\GeneralSetting;
use App\Models\FooterSetting;
use App\Models\BackgroundAndColor;
use App\Models\SaleCampaign;
use Illuminate\Support\Facades\DB;
use App\Models\AboutAndContact;
use App\Models\OrderShipmentAndReturnPolicy;

class HomeController extends Controller
{

    public  function __construct(Request $request)
    {
        if(!$request->ajax()){
       //   return abort(404);
        }
    }
    public function  get_team_members(){
            $team = Team::where('status',1)->orderBy('position','ASC')->get();
            return response()->json([
                'status' => "OK",
                'team'  => $team ,
        ]);
    }
    public function productIdWise(Request $request,$id){
      $product=Product::where('id',$id)->with(['productImage','productAttribute.attribute','productVariant.variant'])->first();
        return response()->json([
            'product'=>$product
        ]);
    }
    public function products(Request $request)
    {
        $product_categories =Category::with(['subCategory','product.productImage'])->get();
        return response()->json($product_categories);
    }

     
    public function product(Request $request,$slug)
    {
         //this slug with encoding for any language 
       

      
        $product = Product::where('slug', $slug)->with(['productAttribute.attribute','productVariant.variant'])->first();
      
       if ($product) {
          return response()->json([
                'status' => "SUCCESS",
                'product' => $product,
              ]);
        }
    }

    public function productImage($slug){

      $product = Product::where('slug', $slug)->first();
    $product_images = ProductImage::where('product_id',$product->id)
                                      
                                        ->get();

       $data=[];
       foreach($product_images as $k=> $item){
        $data[$k]=[
             'id'=>$item->id,
             'url'=>"/../storage/".$item->product_image,
        ];
       }                                 
                              
    return response()->json([
        'normal_size'=>$data,
        'large_size'=>$data,
        'thumbs'=>$data
    ]);                                 
    }

    public function relatedProduct(Request $request){
     $product_find=Product::where('slug',$request->product_slug)->first();
     $products=Product::where('sub_sub_category_id',$product_find->sub_sub_category_id)->where('id','!=',$product_find->id)->with('productImage')->paginate(5);
    return response()->json($products);
 }

    public function category()
    {
       $categories = Category::orderBy('id', 'ASC')->where(['status' => 1, 'is_selected' => 1])->with(['subCategory.SubSubCategory'])->take(10)->get();
        return response()->json([
            'status' => 'SUCCESS',
            'categories' => $categories
        ]);
    }

    public function categoryWiseProduct(Request $request)
    {
      $category=Category::where('slug',$request->slug)->first();
      $products=Product::where('category_id',$category->id)->with('productImage')->paginate(12);
      return response()->json($products);
    }

    public function categoryWiseProductPriceFilter(Request $request){
         
        $category=Category::where('slug',$request->slug)->first();
        $products=Product::where('category_id',$category->id)->where('price','>=',$request->min_price)->where('price','<=',$request->max_price)->with('productImage')->paginate(20);
        return response()->json([
            "status" => "OK",
            "products" => $products ,
        ]);
    }

    public function slider()
    {
       
        $slider = Slider::where('status',1)->where('position',1)->get();
        $slider_banner =Slider::where('status',1)->where('position',2)->orderBy('id','DESC')->first();
         $best_selling_produc_id=OrderItem::select('product_id',DB::raw('count(*) as total'))
                                                ->groupBy('product_id')
                                                ->orderBy('total','DESC')
                                                ->take(12)
                                                ->pluck('product_id');
        $best_seller_products =Product::WhereIn('id',$best_selling_produc_id)->where('status',1)->with('productImage')->get();
        return response()->json([
            'status' => 'SUCCESS',
            'sliders' => $slider,
            'slider_banner'=>$slider_banner,
            'best_seller'=>$best_seller_products
        ]);

    }

 //function for display category slider 
    public  function display_category_slider(){
         $category_sliders = Category_slider::where('page_position',1)->where('status',1)->orderBy('id','DESC')->get();
            return response()->json([
                    "status" => "OK",
                    "category_sliders" => $category_sliders ,
            ]);
    }

    //function for display sub category slider 
    public  function display_sub_category_slider(){
        $sub_category_sliders = Category_slider::where('page_position',2)->where('status',1)->orderBy('id','DESC')->get();
        return response()->json([
                "status" => "OK",
                "sub_category_sliders" => $sub_category_sliders ,
        ]);
    }

     //function for display sub sub category slider 
     public   function display_sub_sub_category_slider(){
        $sub_sub_category_sliders = Category_slider::where('page_position',3)->where('status',1)->orderBy('id','DESC')->get();
        return response()->json([
                "status" => "OK",
                "sub_sub_category_sliders" => $sub_sub_category_sliders ,
        ]);
    }

     public function offers(){
        $offers = Offer::where('status', 1)->orderBY('id','DESC')->take(12)->get();
        return response()->json([
            'status' => 'SUCCESS',
            'offers' => $offers
        ]);
    }

    public function subCategory($slug){
        $sub_category=SubCategory::where('slug',$slug)->first();
        $sub_categories = SubCategory::orderBy('id', 'DESC')->where('status',1)->where('category_id',$sub_category->category_id)->get();
        return response()->json([
            'status' => 'SUCCESS',
            'sub_categories' => $sub_categories
        ]);
    }

    public function subCategoryWiseProduct(Request $request){
         $sub_category=SubCategory::where('slug',$request->slug)->first();
        $products=Product::where('sub_category_id',$sub_category->id)->with('productImage')->paginate(8);
        return response()->json($products);
    }

    public function SearchProduct($search){
        $products=Product::where('name','like', '%' . $search . '%')
                          ->orWhere('product_code','like', '%' . $search . '%')
                          ->where('status',1)
                          ->with('productImage')
                         ->get();
        return \response()->json($products);                

    }

    public function subSubCategory($slug){

        $sub_sub_category=SubSubCategory::where('slug',$slug)->first();
        $sub_sub_categories = SubSubCategory::orderBy('id', 'DESC')->where('status',1)->where('subcategory_id',$sub_sub_category->subcategory_id)->get();
        return response()->json([
            'status' => 'SUCCESS',
            'sub_sub_categories' => $sub_sub_categories
        ]);
    }
    public function subSubCategoryWiseProduct(Request $request){

        $sub_sub_category=SubSubCategory::where('slug',$request->slug)->first();
        $products=Product::where('sub_sub_category_id',$sub_sub_category->id)->where('status',1)->with('productImage')->paginate(8);
        return response()->json($products);
    }

    public function subSubSubCategoryProduct(){
        $sub_sub_category=SubSubCategory::where('status',1)->where('show_homepage',1)->get();
        return response()->json($sub_sub_category);
    }

//function for sort via price 
   public  function sort_by_price(Request $request){
        $orderBy='ASC';
            if($request->sort_value==2){
                $orderBy='DESC';
            }
            $category=Category::where('slug',$request->slug)->first();
            $products=Product::where('category_id',$category->id)->orderBy('price',$orderBy)->where('status',1)->with('productImage')->get();
            return response()->json([
                    "products" => $products , 
            ]);         
          
   }

   //function for sub_category_sort_by_price
    public  function sub_category_sort_by_price(Request $request){
    
        $orderBy='ASC';
        if($request->sort_value==2){
            $orderBy='DESC';
        }
        $sub_category=SubCategory::where('slug',$request->slug)->first();
        $products=Product::where('sub_category_id',$sub_category->id)->orderBy('price',$orderBy)->where('status',1)->with('productImage')->get();
        return response()->json([
                "products" => $products , 
        ]);         
      
     }

     //function for sub_sub_category_sort_by_price
    public  function sub_sub_category_sort_by_price(Request $request){
    
        $orderBy='ASC';
        if($request->sort_value==2){
            $orderBy='DESC';
        }
        $sub_sub_category=SubSubCategory::where('slug',$request->slug)->first();
        $products=Product::where('sub_sub_category_id',$sub_sub_category->id)->orderBy('price',$orderBy)->where('status',1)->with('productImage')->get();
        return response()->json([
                "products" => $products , 
        ]);         
      
     }

      public function get_quick_view_product($id){

        $product= Product::where('id',$id)->with(['productAttribute.attribute','productVariant.variant','productImage'])->first();
        $recommended_products=Product::where('sub_category_id',$product->sub_category_id)->where('id','!=',$product->id)->where('status',1)
        ->with(['productAttribute.attribute','productVariant.variant','productImage'])
        ->take(24)->get();
              return  response()->json([
                  "status" => "OK",
                  "product" => $product ,
                  'recommended_products'=>$recommended_products
              ]);
      }


    public function get_general_setting(){

          $general_setting = GeneralSetting::latest()->first();
          return response()->json([
               'general_setting' => $general_setting,
          ]);

      }


    public function get_footer_setting(){

        $footer_setting = FooterSetting::latest()->first();
        return response()->json([
             'footer_setting' => $footer_setting,
        ]);


      }


    public function get_theme_setting(){

        $theme_setting = BackgroundAndColor::latest()->first();
        return response()->json([
             'theme_setting' => $theme_setting,
        ]);


     }





     public function saleCampaignProducts(){
        $sale_campaign=SaleCampaign::where('status',1)->orderBy('order_by','ASC')->with('campaign_products.productImage')->get();
      
        return response()->json([
            'status' => 'OK',
            'sale_campaign' => $sale_campaign,
        ]);
    }



    
   
     public function get_all_products(){
        $products=Product::where('status',1)->orderBy('id','desc')->with('productImage')->get();
      
            return response()->json([
                'status' => 'OK',
                'products' => $products,
            ]);

    }





         
    public function get_about_and_contact() {

        $setting = AboutAndContact::latest()->take(1)->first();
          if ($setting) {
              return response()->json([
                  "status" => "OK",
                  "setting" => $setting ,
              ]);
          }
       }



      
public function get_order_shipment_return() {

    $setting = OrderShipmentAndReturnPolicy::latest()->take(1)->first();
    if ($setting) {
        return response()->json([
            "status" => "OK",
            "setting" => $setting ,
        ]);
    }
 }







}

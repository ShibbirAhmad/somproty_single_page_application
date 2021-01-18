<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductBarcode;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Variant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Purchaseitem;
use DB;
use Illuminate\Validation\Rule;
use Picqer;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Order;


class ProductController extends Controller
{
      
    public function index(Request $request)
    {

      //  return $request->all();
        $paginate = $request->item ?? 20;

        if($request->status=="all"){
            $products = Product::where('merchant_id',session()->get('merchant')['id'])->orderBy('id', 'DESC')->with(['productImage', 'productBarcode'])->paginate($paginate);

        }else{
            $products = Product::where('merchant_id',session()->get('merchant')['id'])->orderBy('id', 'DESC')->with(['productImage', 'productBarcode'])->where('status',$request->status)->paginate($paginate);
 
        }
        return response()->json([
            'status' => 'SUCCESS',
            'products' => $products
        ]);
    }





    public function store_product(Request $request)
    {
        
       
        $validatedData = $request->validate([
            'name' => 'required ',
            'category' => 'required',
             'quantity' => 'required',
            //  'alert_quantity' => 'required',
            //  'purchase_price' => 'required',
            'sale_price' => 'required',
            'price' => 'required',
            'details' => 'required',
            'image' => 'required',
            

        ]);

        //get products tables max id
        $id = Product::max('id') ?? 0;

        $product_code = 1001 + $id;

        //save product data
       
        $slug=explode(" ", $request->name);
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->merchant_id= session()->get('merchant')['id'] ;
        $product->sub_category_id = $request->sub_category ?? null;
        $product->sub_sub_category_id = $request->sub_sub_category ?? null;
        $product->product_code = $product_code;
        $product->slug =  $slug[count($slug)-1] . '-' . $product_code;
        $product->stock = $request->quantity;
        $product->sale_price = $request->sale_price;
        $product->price = $request->price;
        $product->discount = $request->discount ?? null;
        $product->status = 2;
        $product->details = $request->details;
        $product->product_placement = $request->product_placement ?? 0;
        $product->product_position = $request->product_position ?? 0;
      
        if ($product->save()) {

            //if product save then generate product barcode
            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
            $barcode = $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128);
            $product_barcode = new ProductBarcode();
            $product_barcode->product_id = $product->id;
            $product_barcode->barcode = $barcode;
            $product_barcode->barcode_number = $product->product_code;
            $product_barcode->save();

            //save product multiple image in store directory
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {
                    $product_image = new ProductImage();
                    $product_image->product_id = $product->id;
                    $path = $file->store('images/products', 'public');
                    $product_image->product_image = $path;
                    $product_image->save();
                }
            }
            //save the product properties
            if (isset($request->attribute) && !empty($request->attribute)) {

                   $product_attribute = new ProductAttribute();
                    $product_attribute->product_id = $product->id;
                    $product_attribute->attribute_id = $request->attribute;
                    $product_attribute->save();
                

            }
            if (isset($request->variant) && !empty($request->variant)) {
                foreach ($request->variant as $item) {
                    $product_variant = new ProductVariant();
                    $product_variant->product_id = $product->id;
                    $product_variant->variant_id = $item;
                    $product_variant->save();
                }

            }
            //return success message
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'product add successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'FAILED',
                'message' => 'product upload fail'
            ]);
        }

    }


    
    public function get_edit_product($id){
        
          $product = Product::where('merchant_id',session()->get('merchant')['id'])->where('id',$id)->with(['productImage','productAttribute'])->first();  
                    return response()->json([
                        "status" => "OK",
                        "product" => $product ,
                    ]); 
    }



   
    public function edit_product(Request $request , $id){
        
        $validatedData = $request->validate([
            'name' => 'required ',
            'category' => 'required',
            //   'quantity' => 'required',
            //  'alert_quantity' => 'required',
            // 'purchase_price' => 'required',
            'sale_price' => 'required',
            'price' => 'required',
            'details' => 'required',
            'image' => 'required',
            

        ]);

        //save product data
        $product=Product::where('merchant_id',session()->get('merchant')['id'])->where('id',$id)->first() ;
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->merchant_id= session()->get('merchant')['id'] ;
        $product->sub_category_id = $request->sub_category ?? null;
        $product->sub_sub_category_id = $request->sub_sub_category ?? null;
        $product->stock = 0;
        $product->sale_price = $request->sale_price;
        $product->price = $request->price;
        $product->discount = $request->discount ?? null;
        $product->details = $request->details;
       
      
        if ($product->save()) {

            //save product multiple image in store directory
            if ($request->hasFile('image')) {
                ProductImage::where('product_id',$id)->delete();
                $files = $request->file('image');
                foreach ($files as $file) {
                    $product_image= new ProductImage () ;
                    $product_image->product_id=$id ;
                    $path = $file->store('images/products', 'public');
                    $product_image->product_image = $path;
                    $product_image->save();
                }
            }
            //save the product properties
            if (isset($request->attribute) && !empty($request->attribute)) {
                    ProductAttribute::whereIn('product_id',[$id])->delete();
                    $product_attribute=new ProductAttribute () ;
                    $product_attribute->product_id = $product->id;
                    $product_attribute->attribute_id = $request->attribute;
                    $product_attribute->save();
                

            }
            if (isset($request->variant) && !empty($request->variant)) {
                    ProductVariant::whereIn('product_id',[$id])->delete();
                foreach ($request->variant as $item) {
                    $product_variant= new ProductVariant() ;
                    $product_variant->product_id = $product->id;
                    $product_variant->variant_id = $item;
                    $product_variant->save();
                }

            }
            //return success message
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'product updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'product updating fail '
            ]);
        }
    }



    public function search_products($search)
    {
        $merchant_product = Product::where('merchant_id',session()->get('merchant')['id'])->get();
        $products = $merchant_product->where('name', 'like', '%' . $search . '%')
                                     ->orWhere('product_code', 'like', '%' . $search . '%')
                                     ->orderBy('id', 'DESC')
                                     ->with(['productImage', 'productBarcode'])->paginate(10);

                return response()->json([
                    'status' => 'SUCCESS',
                    'products' => $products
                ]);

        
    }


   public function delete_product_image(Request $request , $id){

        $product_image=ProductImage::where('product_id',$id)->get();
        if ($product_image[$request->index]->delete()){
            return response()->json([
                'status'=>'SUCCESS',
                'message'=>'product image was deleted'
            ]);
        }    
   }

    
    public function delete_product($id){
          
        // $merchant_product = Product::where('merchant_id',session()->get('merchant')['id'])->get();
        // $product_want_delete = $merchant_product->where('id',$id)->where('status',2)->first();
        // if ($product_want_delete->delete()) {
        //     return response()->json([
        //         "success"  => "OK",
        //         "message"  => "product has deleted from your store" 
        //     ]);
        // }
    }













}

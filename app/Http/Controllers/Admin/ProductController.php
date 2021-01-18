<?php

namespace App\Http\Controllers\Admin;

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
        $paginate = $request->item ?? 30;

        if($request->status=="all"){
            $products = Product::orderBy('id', 'DESC')->with(['productImage', 'productBarcode'])->paginate($paginate);

        }else{
            $products = Product::orderBy('id', 'DESC')->with(['productImage', 'productBarcode'])->where('status',$request->status)->paginate($paginate);
 
        }
        return response()->json([
           // 'status' => 'SUCCESS',
            'products' => $products
        ]);
    }


    




    public function create()
    {

    }

    public function store(Request $request)
    {
        //validation data
      //  return $request->all();
        $validatedData = $request->validate([
            'name' => 'required ',
           'sub_category' => 'required',
            'category' => 'required',
             'quantity' => 'required',
             'alert_quantity' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'price' => 'required',
            'details' => 'required',
            'image' => 'required',
            

        ]);

        //get products tables max id
        $id = Product::max('id') ?? 0;

        $product_code = 1001 + $id;

        //save product data

        $slug=\str_slug($request->name);
        $product = new Product();
        $product->name = $request->name;
        $product->merchant_id=282;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category ?? null;
        $product->sub_sub_category_id = $request->sub_sub_category ?? null;
        $product->product_code = $product_code;
        $product->slug =  $slug. '-' . $product_code;
        $product->quantity = $request->quantity;
        $product->alert_quantity=$request->alert_quantity;
        $product->sale_price = $request->sale_price;
        $product->purchase_price=$request->purchase_price;
        $product->price = $request->price;
        $product->discount = $request->discount ?? null;
        $product->status = 1;
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
                'status' => 'SUCCESS',
                'message' => 'product add successfully'
            ]);
        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            $productImage = ProductImage::where('product_id', $product->id)->get();
            $productAttribute = ProductAttribute::where('product_id', $product->id)->get();
            $productVariant = ProductVariant::where('product_id', $product->id)->get();
            return response()->json([
                'status' => 'SUCCESS',
                'product' => $product,
                'productImage' => $productImage,
                'productAttribute' => $productAttribute,
                'productVariant' => $productVariant,

            ]);
        }

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {

    }

    public function search($search)
    {

      //  $products = Product::where('name', 'like', '%' . $search . '%')->orWhere('product_code', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->with(['productImage', 'productBarcode'])->paginate(110);

        $products = Product::where('product_code',$search)->with(['productImage', 'productBarcode'])->paginate(110);
        return response()->json([
            'status' => 'SUCCESS',
            'products' => $products
        ]);
    }

    public function approved($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->status = 1;
            if ($product->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'product approved successfully'
                ]);
            }
        }
    }

    public function pending($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->status = 2;
            if ($product->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'product pending successfully'
                ]);
            }
        }
    }

    public function deny($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->status = 3;
            if ($product->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'product deny successfully'
                ]);
            }
        }
    }

    public function stockUpdate(Request $request, $id)
    {

        $product = Product::find($id);
        if ($product) {
            $product->stock = $request->stock;
            if ($product->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'product - ' . $product->product_code . ' - stock updated'
                ]);
            }
        }
    }

    public function updateBasicInformation(Request $request, $id)
    {

        //data validation
    //  return $request->all();
        $validatedData = $request->validate([
            'name' => 'required ',
            'category' => 'required',
            'sale_price' => 'required',
            'purchase_price' => 'required',
            'price' => 'required',
            'details' => 'required',
        ]);

        //find product
        $product = Product::find($id);
        if ($product) {
            //update product basic information
            $product->update([
                'name' => $request->name,
                'category_id' => $request->category,
                'sub_category_id' => $request->sub_category ?? null,
                'sub_sub_category_id' => $request->sub_sub_category ?? null,
                'sale_price' => $request->sale_price,
                'price' => $request->price,
                'discount' => $request->discount ?? null,
                'details' => $request->details,
                'product_placement'=>$request->product_placement ?? 0,
                'product_position'=>$request->product_position ?? 0,
                'purchase_price'=>$request->purchase_price,
                'updated_at' => Carbon::now(),
                'created' => Carbon::now(),
            ]);
//            $product->name = $request->name;
//            $product->category_id = $request->category;
//            $product->sub_category_id = $request->sub_category ?? null;
//            $product->sub_sub_category_id = $request->sub_sub_category ?? null;
//            $product->sale_price = $request->sale_price;
//            $product->price = $request->price;
//            $product->discount = $request->discount ?? null;
//            $product->details = $request->details;
//            if($product->save()){
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Product information was updated'
            ]);

        }


    }

    public function updateProperties(Request $request, $id)
    {


        //return $request->all();
        $validatedData = $request->validate([
            'attribute' => 'required ',
            'variant' => 'required',
        ]);

        if (Product::find($id)) {
            //find product old attribute

            if (isset($request->attribute) && !empty($request->attribute)) {
                    $product_attribute =ProductAttribute::where('product_id',$id)->first();
                    if($product_attribute){
                         $product_attribute->attribute_id = $request->attribute;
                         $product_attribute->save();
                    }else{
                         $product_attribute =new ProductAttribute();
                         $product_attribute->attribute_id = $request->attribute;
                         $product_attribute->product_id = $id;
                        $product_attribute->save();
                     }
                   
              }
             
              //find product old variant
            $product_old_variants = ProductVariant::whereIn('product_id', [$id])->get();

            //delete product old variant
            foreach ($product_old_variants as $product_old_variant) {
                $product_old_variant->delete();
            }

            //save the new variant
            foreach ($request->variant as $variant) {
                $p_variant = new ProductVariant();
                $p_variant->product_id = $id;
                $p_variant->variant_id = $variant;
                $p_variant->save();
            }
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'product properties update successfully'
            ]);
        }


    }

    public function UpdateProductImage(Request $request, $id)
    {

        //save product multiple image in store directory
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach ($files as $file) {
                $product_image = new ProductImage();
                $product_image->product_id = $id;
                $path = $file->store('images/products', 'public');
                $product_image->product_image = $path;
                $product_image->save();
            }
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'product image was update successfully'
            ]);
        }

    }

    public function deleteImage(Request $request, $id)
    {

       $product_image=ProductImage::where('product_id',$id)->get();
       if ($product_image[$request->index]->delete()){
           return response()->json([
                'status'=>'SUCCESS',
               'message'=>'product image was deleted'
           ]);
       }

    }

    public function searchWithCode($code){
        $product=Product::where('product_code',$code)->where('status',1)->first();
        if($product){
            $product_attributes=ProductAttribute::where('product_id',$product->id)->with('attribute')->get();
            $product_variants=ProductVariant::where('product_id',$product->id)->with('variant')->get();
            $data[] = array_merge($product->toArray(),['attributes' => $product_attributes, 'variants' =>$product_variants]);
            return \response()->json([
                'status'=>'SUCCESS',
                'product'=>$data
               ]);
        }
     

    }

    public function productStock(Request $request){
    
          $item=$request->item??20;
          $products=Product::where('status',1)->where('stock','>',0)->with('purchaseItem')->paginate($item);
          return response()->json($products);


     


}

    public function printBarcode($id,$howmany){
        
    
        $product_barcode=ProductBarcode::where('product_id',$id)->first();
        $pdf=PDF::loadView('admin.pdf.barcode',compact('product_barcode','howmany'));
  //      return $pdf->stream();
        return view('admin.pdf.barcode',\compact('product_barcode','howmany'));
    }

    public function searchCustomer(Request $request,$number){

        if(!$request->ajax()){
            return \abort(404);
        }
           
       $customer=Customer::where('phone',$number)->first();

      if(!empty($customer)){
        $customer_order=Order::where('customer_id',$customer->id)->orderBy('id','DESC')->first();
     
       return \response()->json([
             'message'=>"customer al ready register.",
            'customer'=>$customer
       ]);

      }else{
        return \response()->json([
            'message'=>"new customer for us",
            
          ]);
      }

    }
    public function get_suggested_product(Request $request){

        $paginate_item= $request->item ?? 10 ; 
        $products=Product::orderBy('id','DESC')->where('status', 1)->where('stock', '>=', 1 )->with(['productImage'])->paginate($paginate_item);
        return response()->json([
               'status' => "OK",
               'products' => $products ,
        ]);
 }


 public function search_suggested_product($product_code){

    $products=Product::where('product_code', 'like', '%'.$product_code.'%')->with(['productImage'])->paginate(20);
    return response()->json([
           'status' => "OK",
           'products' => $products ,
    ]);
}

 public function search_suggested_product_code_name($data){

   
    $products=Product::where('product_code', 'like', '%'.$data.'%')
                        ->orWhere('name', 'like', '%'.$data.'%')
                        ->with(['productImage','purchaseItem','productBarcode'])
                        ->paginate(20);
    return response()->json($products);
}



    public function searchSingleProduct($code){
        $product=Product::where('product_code',$code)->first();
            return response()->json([
                'status' => "OK",
                'product' => $product ,
            ]);
    }


     
    public function stock_report_pdf(){
        
            $stock_items = Purchaseitem::orderBy('id','DESC')->with('product')->get();
                   $pdf = PDF::loadView('admin.pdf.product_stock_report',compact('stock_items')); 
           return  $pdf->stream();

    }













}

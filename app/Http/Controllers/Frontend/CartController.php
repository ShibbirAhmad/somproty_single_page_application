<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Cart;

class CartController extends Controller
{
    public function addCart(Request $request){

        $product=Product::where('slug',$request->slug)->first();
         $product_attribute=ProductAttribute::where('product_id',$product->id)->get();

         if($product_attribute->count()>=1 && $request->attribute_id==null){
            return response()->json([
                'status'=>'error',
                'message'=>'missing product information'
             ]);
        }else if($product->quantity<=0){
            return response()->json([
            'status'=>'error',
            'message'=>"Product quantity Out"
            ]);
        }
         else if($request->quantity > $product->quantity){
            return response()->json([
                    'status'=>'error',
                    'message'=>"Product Hisgest Quanity '$product->quantity'"
            ]);
        }
        else{
            Cart::add([
                'id' => $product->id,
                'name'=>$product->name,
                'qty' => $request->quantity ?? 1,
                'price' => $product->price,
                'weight' => 0,
                'tax' => 0,
                'options' =>
                     [
                         'attribute_id' => $request->attribute_id,
                         'variant_id'=>$request->variant_id,
                         'image'=>ProductImage::where('product_id',$product->id)->get()
                      ]
            ]);

        return response()->json([
            'status'=>'SUCCESS',
            'message'=>$product->name.' add your cart'
        ]);
        }

 }
 public function carToContent(){

  
    $cart_content=Cart::content();
    $cart_total=Cart::total();

        return response()->json([
            'cart_total'=>$cart_total,
            'cart_content'=>$cart_content,
            'item_count'=>Cart::count()
        ]);

    }

    

    public  function carToUpdate(Request $request){

        $rowId =$request->rowId ;
        if(Cart::update($rowId, $request->qty)){
            return response()->json([
                'status'=>'SUCCESS',
               
            ]); 
        }
        
    }
    
    public  function carToDestroy(Request $request){

       // return $request->all();

        $rowId =$request->rowId ;
        Cart::remove($rowId);
        return response()->json([
            'status'=>'SUCCESS',
           
        ]);
           
        
    }
}

<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merchant ;
use App\Models\Order ;
use App\Models\Product ;
use App\Models\OrderItem ;
use App\Models\Customer ;

use Illuminate\Support\Facades\Session ;

class OrderController extends Controller
{
      public function get_merchant_order(Request $request){
            $item = $request->item ?? 10 ;
            $product_id=Product::where('merchant_id',session()->get('merchant')['id'])->select('id')->pluck('id');
            $order_id=OrderItem::whereIn('product_id',$product_id)->select('order_id')->pluck('order_id');
            $orders=Order::whereIn('id',$order_id)->with(['customer'])->paginate($item);
              return response()->json([
                  "status" => "OK",
                  "orders" => $orders ,
              ]);

      }




      public function merchant_order_details($id){

        $order=Order::where('id',$id)->with(['customer','courier','city','approvedBy'])->first();
        $order_items=OrderItem::where('order_id',$order->id)->with(['product.productVariant.variant.attribute','attribute','variant'])->get();
      
               
             return response()->json([
                   "status" => "SUCCESS",
                   "order"  => $order ,
                   "items"  => $order_items ,
             ]);
               
      }



      
}

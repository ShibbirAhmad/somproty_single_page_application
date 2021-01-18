<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderBarcode;
use App\Models\OrderItem;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Auth;
use Picqer;


class OrderController extends Controller
{

    public function __construct(Request $request)
    {   
        if(!$request->ajax()){
            return abort(404);
        }
        
    }
    public function checkout(Request $request){

       // return Cart::total();
      //  return str_replace(Cart::total(),',','');
   //     return $request->all();
        $validatedData = $request->validate([
            'mobile_no' => 'required|digits:11',
            'name' => 'required ',
            'address' => 'required',
            'city' => 'required',

        ]);

       // return $request->all();
        $user=Auth::user();

        //update user city and address
        
        if($user->city_id==null || $user->address==null){

            $user->city_id=$request->city;
            $user->sub_city_id=$request->sub_city;
            $user->address=$request->address;
            $user->save();

        }
        $customer=Customer::where('phone',$user->mobile_no)->first();
        if(!$customer){
              $customer=new Customer();
            $customer->name=$request->name;
            $customer->phone=$request->mobile_no;
            $customer->address=$request->address;
            $customer->city_id=$request->city;
            $customer->sub_city_id=$request->sub_city;
            $customer->custome_type=1;
             $customer->save();

        }
    
        //  return Cart::total();
          //save the order
          $id = Order::max('id') ?? 0;
          $invoice = 100 + $id;
          $order=new Order();
          $order->customer_id=$customer->id;
          $order->cutomer_phone=$request->mobile_no;
          $order->invoice_no=$invoice;
          $order->order_type=1;
          $order->city_id=$request->city;
          $order->sub_city_id=$request->sub_city;
          $order->shipping_cost=$request->shipping_cost ?? 0;
          $order->discount=$request->discount ?? 0;
          $order->paid=$request->paid ?? 0;
          $order->total=Cart::total();
          $order->status=1;
        
        //if order save then save the order details

        if($order->save()){
            foreach(Cart::content() as $product){

              //update product stock
                // $product_stock=Product::where('id',$product->id)->first();
                // $product_stock->stock=$product_stock->stock-$product->qty;
                // $product_stock->save();
    
                $details=new OrderItem();
                $details->order_id=$order->id;
                $details->product_id=$product->id;
                $details->price=$product->price;
                $details->quantity=$product->qty;
                $details->attribute_id=$product->options->attribute_id??null;
                $details->variant_id=$product->options->variant_id??null;
                $details->total=$product->qty*$product->price;
                $details->save();
             }

             $invoice=$order->invoice_no;
             $name=$customer->name;
             $number=$order->cutomer_phone;
             Order::SendMessageCustomer($number,$name,$invoice);

             return response()->json([
                'status'=>'SUCCESS',
                'message'=>'Order was place successfully',
                Cart::destroy()
            ]);

        }
         
    }

    public function orderList(){

       $user=Auth::user();
       
       $customer=Customer::where('phone',$user->mobile_no)->first();
        if($customer){
            $orders=Order::where('customer_id',$customer->id)->paginate(10);
            return response()->json([
                'status'=>'SUCCESS',
                'orders'=>$orders
            ]);
        }
    }


    public function user_order_details($id){
            
          $order =  Order::findOrFail($id);
          $order_items=OrderItem::where('order_id',$order->id)->with(['product.productVariant.variant.attribute','attribute','variant'])->get();
        
          return response()->json([
            'status'=>'SUCCESS',
            'order'=>$order,
            'items'=>$order_items
        ]);
    }




    public function customer_invoice_print($id){

           $order_id = explode(',',$id) ;
           $orders = Order::whereIn('id',$order_id)->get(); 
           return view('frontend.pdf.invoicePrint', \compact('orders'));
    }

}

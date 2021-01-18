<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\session;
use App\Models\Merchant ;
use App\Models\OrderItem ;
use App\Models\Product ;
use Carbon\Carbon;

class HomeController extends Controller
{
      
      public  function index(){

           return view ('merchant.index');
      }




      public function  get_current_merchant(){

            if (session::has('merchant')) {
                 $merchant = session()->get('merchant') ;  
                 return response()->json([
                       'status' => 'OK',
                       'merchant' => $merchant ,
                 ]);
            }
           
      }




      
      public function  current_merchant_update(Request $request){

            $validatedData = $request->validate([
                  'name'  => 'required',
                  'email'  => 'required|unique:merchants,email,'.session()->get('merchant')['id'],
                  'phone'  => 'required|digits:11,unique:merchants,phone,'.session()->get('merchant')['id'],
                  'address'  => 'required',
                
              ]);
      
      
               $merchant= session()->get('merchant');
               $merchant->name=$request->name ;
               $merchant->phone=$request->phone ;
               $merchant->email=$request->email ;
               $merchant->address=$request->address ;
               $merchant->company_name=$request->company_name ;
               $merchant->status=1;
               if ($request->hasFile('image')) {
                
                   $file_path=$request->file('image')->store('images/merchant','public'); 
                   $merchant->image=$file_path ;
               }
             
               if ($merchant->save()) {
                   return response()->json([
                       'success' => 'OK',
                        'message' => 'Information updated successfully '
                   ]);
               }
           
      }

 

      public function  get_dashboard_highlight_info(){

              $merchant_id = session()->get('merchant')['id'];
              $products=array();
              $products['product_total']=Product::where('merchant_id',$merchant_id)->count() ;
              $products['product_approved']=Product::where('merchant_id',$merchant_id)->where('status',1)->count() ;
              $products['product_pending']=Product::where('merchant_id',$merchant_id)->where('status',2)->count() ;
             
              $orders=array();
              $orders['merchant_total_order_items']= OrderItem::where('merchant_id',$merchant_id)->count(); 

            //   $orders['today_ordered']=Order::where('merchant_id',$merchant_id)->where('created_at', '>=', Carbon::today()->startOfDay())
            //   ->where('created_at', '<=', Carbon::today()->endOfDay())
            //   ->count();
            //   $order['delivered_order']=Order::where('merchant_id',$merchant_id)->where('status',5)
            //   ->count();
            //   $order['return_order']=Order::where('merchant_id',$merchant_id)->where('status',7)
            //   ->count();
            //   $order['cancel_order']=Order::where('merchant_id',$merchant_id)->where('status',6)
            //   ->count();



              return response()->json([
                     "status" => "OK",
                     'products' => $products ,
                     'orders' => $orders ,
              ]);

      }



}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Debit;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Purchaseitem;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
       

         $sub_categories=SubSubCategory::where('status',1)->get();

      
    //  return $data;

     //  return view('welcome',compact('sub_categories'));
      

 

        
        $order=Order::orderCount();
         $balnce=Credit::Balance();
        $quantity=array();
        
         $quantity['total_price']=0;
         $products=Product::where('quantity','>',0)->get();
         $quantity['total_quantity']=$products->sum('quantity');
      
       foreach($products as $product){
            $product_purchase_item=Purchaseitem::where('product_id',$product->id)->get();
             $price=0;
           
            foreach($product_purchase_item as $item){
                $price+=$item->price*$item->quantity;
              
            }
            if($product_purchase_item->sum('quantity')>0){
                $quantity['total_price'] += ($price/$product_purchase_item->sum('quantity'))*$product->quantity;
            }
 
      }


     
     $admin_order=Order::adminOrderAnalysis();
     $topSellinProductToday=Order::topSellingProductToday();

     $analysis=Order::analysis();
     $due=Order::due();
     

        return response()->json([
            'orders'=>$order,
            'balance'=>$balnce,
            'quantity'=>$quantity,
            'admin_order'=>$admin_order,
            'top_selling_products_today'=>$topSellinProductToday,
            'due'=>$due,
            'analysis'=>$analysis
        ]);
    }
}

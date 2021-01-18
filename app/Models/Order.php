<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class Order extends Model
{

   public function getCreatedAtAttribute($attr) {        
        return Carbon::parse($attr)->format('d-m-Y - h:ia'); 
    }
 public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    public function createAdmin()
    {
        return $this->belongsTo('App\Models\Admin','create_admin_id');
    }
    public function courier()
    {
        return $this->belongsTo('App\Models\Courier','courier_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function orderItem(){
      return  $this->hasMany('App\Models\OrderItem','order_id');
      
     
    }
    public static function orderQuantity(){
        return $abc="aaa";
      
     
    }
    public function resellerOrderDetails(){
      return $this->hasOne('App\Models\ResellerOrderDetails','order_id');
    }

    public function approvedBy(){
        return $this->belongsTo('App\Models\Admin','approved_admin_id');
    }
    public function orderBarcode(){
        return $this->hasOne('App\Models\OrderBarcode','order_id');
    }
    public function reseller(){
        return $this->belongsTo('App\Models\Reseller','reseller_id');
    }

    public static function ordersAll($request){

          $paginate=$request->item??10;
          if($request->status!="all"){
                if($request->type=="all"){
                 $orders=Order::orderBy('id','DESC')
                            ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->paginate($paginate);
              }else{
                $orders=Order::orderBy('id','DESC')
                             ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->where('order_type',$request->type)
                            ->paginate($paginate);
              }
            }else{
               if($request->type=="all"){
                 $orders=Order::orderBy('id','DESC')
                                 ->with(['customer','createAdmin','courier','reseller'])
                                ->paginate($paginate);
              }else{
                $orders=Order::orderBy('id','DESC')->with(['customer','createAdmin','courier','reseller'])->where('order_type',$request->type)->paginate($paginate);
              }
            }
            return \response()->json([
                'status'=>'SUCCESS',
                'orders'=>$orders
            ]);
    }

    public static function orderFilterWithStartDate($request){
        
          $paginate=$request->item??10;
             if($request->status!="all"){
                if($request->type=="all"){
                 $orders=Order::orderBy('id','DESC')
                           ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->whereDate('created_at','=',$request->start_date)
                            ->paginate($paginate);
              }else{
                $orders=Order::orderBy('id','DESC')
                            ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->where('order_type',$request->type)
                            ->whereDate('created_at','=',$request->start_date)
                            ->paginate($paginate);
              }
            }else{

               if($request->type=="all"){
                 $orders=Order::orderBy('id','DESC')
                                 ->with(['customer','createAdmin','courier','reseller'])
                                ->whereDate('created_at','=',$request->start_date)
                                ->paginate($paginate);
              }else{
                $orders=Order::orderBy('id','DESC')->with(['customer','createAdmin','courier'])
                               ->where('order_type',$request->type)
                               ->whereDate('created_at','=',$request->start_date)
                               ->paginate($paginate);
              }
            }
             return \response()->json([
                'status'=>'SUCCESS',
                'orders'=>$orders
            ]);
    }

    public static function orderFilterWithStartAndEndDate($request){
        
        $paginate=$request->item??10;
             if($request->status!="all"){
                if($request->type=="all"){
                 $orders=Order::orderBy('id','DESC')
                            ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->whereDate('created_at','>=',$request->start_date)
                            ->whereDate('created_at','<=',$request->end_date)
                            ->paginate($paginate);
              }else{
                $orders=Order::orderBy('id','DESC')
                            ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->where('order_type',$request->type)
                            ->whereDate('created_at','>=',$request->start_date)
                            ->whereDate('created_at','<=',$request->end_date)
                            ->paginate($paginate);
              }
            }else{
                
               if($request->type=="all"){
                 $orders=Order::orderBy('id','DESC')
                                 ->with(['customer','createAdmin','courier','reseller'])
                                ->whereDate('created_at','>=',$request->start_date)
                                 ->whereDate('created_at','<=',$request->end_date)
                                ->paginate($paginate);
              }else{
                $orders=Order::orderBy('id','DESC')->with(['customer','createAdmin','courier','reseller'])
                               ->where('order_type',$request->type)
                               ->whereDate('created_at','>=',$request->start_date)
                              ->whereDate('created_at','<=',$request->end_date)
                               ->paginate($paginate);
              }
            }
             return \response()->json([
                'status'=>'SUCCESS',
                'orders'=>$orders
            ]);
    }
     public static function orderFilterWithCourier($request){
        

         $paginate=$request->item??10;
        if(!empty($request->start_date) && empty($request->end_date)){
            
            if($request->status!="all"){
                $orders=Order::orderBy('id','DESC')
                            ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->whereDate('created_at','=',$request->start_date)
                            ->where('courier_id',$request->courier_id)
                            ->paginate($paginate);
              }else{
               $orders=Order::orderBy('id','DESC')->with(['customer','createAdmin','courier','reseller'])
                            ->whereDate('created_at','=',$request->start_date)
                            ->where('courier_id',$request->courier_id)
                            ->paginate($paginate);
             }
           
        }
        elseif(!empty($request->start_date) && !empty($request->end_date)){
              if($request->status!="all"){
                $orders=Order::orderBy('id','DESC')
                             ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->whereDate('created_at','>=',$request->start_date)
                            ->whereDate('created_at','<=',$request->end_date)
                            ->where('courier_id',$request->courier_id)
                            ->paginate($paginate);
              }else{
               $orders=Order::orderBy('id','DESC')->with(['customer','createAdmin','courier'])
                            ->whereDate('created_at','>=',$request->start_date)
                            ->whereDate('created_at','<=',$request->end_date)
                            ->where('courier_id',$request->courier_id)
                            ->paginate($paginate);
             }

        }else{
            if($request->status!="all"){
                $orders=Order::orderBy('id','DESC')
                             ->with(['customer','createAdmin','courier','reseller'])
                            ->where('status',$request->status)
                            ->where('courier_id',$request->courier_id)
                            ->paginate($paginate);
              }else{
               $orders=Order::orderBy('id','DESC')->with(['customer','createAdmin','courier','reseller'])
                             ->where('courier_id',$request->courier_id)
                            ->paginate($paginate);
             }
        }
        return \response()->json([

                'status'=>'SUCCESS',
                'orders'=>$orders
            ]);
    }

       public static function SendMessageCustomer($number,$name,$invoice){

        $api_key = "C20047545e16e1c02a1b38.69878796";
        $contacts = $number;
        $senderid = '8809601000740';
        $sms = 'Dear '.$name.','. 'Your order has been received. Invoice number is '.$invoice. '.' .'If you have any query please contact with us .'. '09636-203040. Thanks by  mohasagor.com';   // put here your dynamic message text here
        $URL = "http://bulk.fmsms.biz/smsapi?api_key=" . urlencode($api_key) . "&type=text&contacts=" . urlencode($contacts) . "&senderid=" . urlencode($senderid) . "&msg=" . urlencode($sms);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);
        try {
            $output = $content = curl_exec($ch);
          //  print_r($output);
        } catch (Exception $ex) {
           return back();
        }
        return $output;
    }

    public static function sendShipmentMenssage($order)
    {
      $total=0;
      if(!empty($order->total)){

        $total=($order->total)-($order->paid+$order->discount)+$order->shipping_cost;
      }
      $contacts=$order->cutomer_phone;

        $api_key = "C20047545e16e1c02a1b38.69878796";
        $senderid = '8809601000740';
        $courier=$order->courier->name;
        $name=$order->customer->name;
         $sms = 'Dear ' . $name .'.'. ' Your order has been shipped to '.$courier.' Courier.'.'Your memo no. ' .$order->memo_no.' and payable amount '.$total.' Tk.'.' Thanks by mohasagor.com';   // put here your dynamic message text here
        $URL = "http://bulk.fmsms.biz/smsapi?api_key=" . urlencode($api_key) . "&type=text&contacts=" . urlencode($contacts) . "&senderid=" . urlencode($senderid) . "&msg=" . urlencode($sms);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);
        try {
            $output = $content = curl_exec($ch);
            //  print_r($output);
        } catch (Exception $ex) {
            $output = "-100";
        }
        return $output;



        
    }

    public static function adminOrderAnalysis(){
       $admin_id=session()->get('admin')['id'];
       $admin_order=array();
       $admin_order['session_admin']=Order::where('create_admin_id',$admin_id)
                        ->select(DB::raw('DATE(created_at) as created_at'),DB::raw('count(*) as total'))
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->orderBy('created_at','DESC')
                        ->get();
       $admin_order['all']=Order::whereNotNull('create_admin_id')
                         ->where('created_at', '>=', Carbon::today()->startOfDay())
                         ->where('created_at', '<=', Carbon::today()->endOfDay())
                         ->select('create_admin_id',DB::raw('count(*) as total'))
                         ->groupBy('create_admin_id')
                         ->orderBy('total','DESC')
                         ->with('createAdmin')
                         ->get();                  

       return $admin_order;                   
    }

    public static function topSellingProductToday(){
      $products=OrderItem::where('created_at', '>=', Carbon::today()->startOfDay())
                         ->where('created_at', '<=', Carbon::today()->endOfDay())
                         ->select('product_id',DB::raw('count(*) as total'))
                         ->groupBy('product_id')
                         ->orderBy('total','DESC')
                         ->with('product.productImage')
                          ->get(); 

     return $products;
    }

public static function orderCount(){
       $order=array();
        $order['total']=Order::count();
    
        $order['new_order']=Order::where('status',1)
                                  ->count();
        $order['pending_order']=Order::where('status',2)
                                ->count();
        $order['approved_order']=Order::where('status',3)
                                 ->count();
        $order['shipment_order']=Order::where('status',4)
                                  ->count();
        $order['delivered_order']=Order::where('status',5)
                                      ->count();
        $order['return_order']=Order::where('status',7)
                                   ->count();
        $order['cancel_order']=Order::where('status',6)
                                ->count();
       return $order;
}

public static function profite(){
  $profite=array();
  $profite['today']=0;
  $today_order_items=OrderItem::where('created_at','>=',Carbon::today()->startOfDay())
                              ->where('created_at','<=',Carbon::today()->endOfDay())
                              ->get()
                              ->map(function($value){
                                 return $value->price*$value->quantity;
                                });

      
     
 
  return  $today_order_items;
}

public static function due(){
  $due=[];
  $due['office_sale_due']=CustomerDue::where('status',0)->sum('amount');
   $shipment_order=Order::where('status',4)->get();
   $due['order_due']=0;
   $due['whole_sale_due']=0;
   foreach($shipment_order as $item){
    // return $item->order_type;
      if($item->order_type!=3){
        $due['order_due']+=($item->total+$item->shipping_cost)-($item->paid+$item->discount);
      }
      if($item->order_type==3){
        $due['whole_sale_due']+=($item->total+$item->shipping_cost)-($item->paid+$item->discount);
      }
   }
   $purchases=Purchase::all();

   $product_supplier_id=Supplier::where('status',1)->select('id')->pluck('id');
   $fabrice_supplier_id=Supplier::where('status',2)->select('id')->pluck('id');
   $product_purchase=Purchase::where('status',1)->sum('total');
   $fabrice_purchase=Purchase::where('status',2)->sum('total');
   $product_purchase_supplier_paid_amount=SupplierPayment::whereIn('supplier_id',$product_supplier_id)->sum('amount');
   $fabrics_purchase_supplier_paid_amount=SupplierPayment::whereIn('supplier_id',$fabrice_supplier_id)->sum('amount');
   $due['product_supplier']=$product_purchase-$product_purchase_supplier_paid_amount;
   $due['fabrics_supplier']=$fabrice_purchase-$fabrics_purchase_supplier_paid_amount;
   return $due;
  }


  //this method for analysir all type of order and sale
  //1.order
  //2.whole sale
  //3.office sale, etc
  public static function analysis(){
   
    $analysis=[];
   $analysis['order']=self::OrderAnalysis();
   $analysis['wholesale']=self::WholeSaleAnalysis();
   $analysis['sale']=self::SaleAnalysis();
   return $analysis;
  }

  public static function OrderAnalysis(){

    //get today order
    $totday_orders=Order::where('created_at','>=',Carbon::today()->startOfDay())
                          ->where('created_at','<=',Carbon::today()->endOfDay())
                          ->where('status','!=',6)
                           ->where('order_type','!=',3)
                          ->get();

    //get yesterday order
    $yesterday_orders=Order::where('created_at','>=',Carbon::yesterday()->startOfDay())
                          ->where('created_at','<=',Carbon::yesterday()->endOfDay())
                          ->where('status','!=',6)
                           ->where('order_type','!=',3)
                          ->get();
   //get this week order                     
   $this_week_orders=Order::where('created_at','>=',Carbon::yesterday()->subDays('7')->startOfDay())
                          ->where('created_at','<=', Carbon::yesterday()->endOfDay())
                          ->where('status','!=',6)
                           ->where('order_type','!=',3)
                          ->get(); 

   //get this month order                     
   $this_month_orders=Order::where('created_at','>=',Carbon::yesterday()->subDays('30')->startOfDay())
                          ->where('created_at','<=', Carbon::yesterday()->endOfDay())
                          ->where('status','!=',6)
                          ->where('order_type','!=',3)
                          ->get();


$analysis=[];
$product_quantity_today=0;
$product_quantity_week=0;
$product_quantity_month=0;

$analysis['today']=[];
$analysis['this_week']=[];
$analysis['this_month']=[];


//today order summary
  foreach($totday_orders as $totday_order){
       $product_quantity_today+=OrderItem::where('order_id',$totday_order->id)->sum('quantity');
       $analysis['today']=[
          'order_quantity'=>$totday_orders->count(),
          'product_quanity'=>$product_quantity_today,
          'amount'=>$totday_orders->sum('total')-$totday_orders->sum('discount')
         ];   
    } 
//this week  order summary
     foreach($this_week_orders as $this_week_order){
       $product_quantity_week += OrderItem::where('order_id',$this_week_order->id)->sum('quantity');
       $analysis['this_week']=[
          'order_quantity'=>$this_week_orders->count(),
          'product_quanity'=>$product_quantity_week,
          'amount'=>$this_week_orders->sum('total')-$this_week_orders->sum('discount')
         ];   
    } 

//this month  order summary
     foreach($this_month_orders as $this_month_order){
       $product_quantity_month += OrderItem::where('order_id',$this_month_order->id)->sum('quantity');
       $analysis['this_month']=[
          'order_quantity'=>$this_month_order->count(),
          'product_quanity'=>$product_quantity_month,
          'amount'=>$this_month_order->sum('total')-$this_month_order->sum('discount')
         ];   
    } 
    
    return $analysis;

  }



  public static function WholeSaleAnalysis(){

    //get today _whole_sales
    $totday_whole_sales=Order::where('created_at','>=',Carbon::today()->startOfDay())
                          ->where('created_at','<=',Carbon::today()->endOfDay())
                          ->where('status','!=',6)
                           ->where('order_type',3)
                          ->get();
   //get this week _whole_sales                     
   $this_week_whole_sales=Order::where('created_at','>=',Carbon::yesterday()->subDays('7')->startOfDay())
                          ->where('created_at','<=', Carbon::yesterday()->endOfDay())
                          ->where('status','!=',6)
                           ->where('order_type',3)
                          ->get(); 

   //get this month _whole_sales                     
   $this_month_whole_sales=Order::where('created_at','>=',Carbon::yesterday()->subDays('30')->startOfDay())
                          ->where('created_at','<=', Carbon::yesterday()->endOfDay())
                          ->where('status','!=',6)
                          ->where('order_type',3)
                          ->get();
//return $this_month_whole_sales->count();

$analysis=[];
$product_quantity_today=0;
$product_quantity_week=0;
$product_quantity_month=0;
$analysis['today']=[];
$analysis['this_week']=[];
$analysis['this_month']=[];


//today _whole_sales summary
  foreach($totday_whole_sales as $totday_whole_sale){
       $product_quantity_today+=OrderItem::where('order_id',$totday_whole_sale->id)->sum('quantity');
       $analysis['today']=[
          'order_quantity'=>$totday_whole_sales->count(),
          'product_quanity'=>$product_quantity_today,
          'amount'=>$totday_whole_sales->sum('total')-$totday_whole_sales->sum('discount')
         ];   
    } 
//this week  _whole_sales summary
     foreach($this_week_whole_sales as $this_week_whole_sale){
       $product_quantity_week += OrderItem::where('order_id',$this_week_whole_sale->id)->sum('quantity');
       $analysis['this_week']=[
          'order_quantity'=>$this_week_whole_sales->count(),
          'product_quanity'=>$product_quantity_week,
          'amount'=>$this_week_whole_sales->sum('total')-$this_week_whole_sales->sum('discount')
         ];   
    } 

//this month  _whole_sales summary
     foreach($this_month_whole_sales as $this_month_whole_sale){
       $product_quantity_month += OrderItem::where('order_id',$this_month_whole_sale->id)->sum('quantity');
       $analysis['this_month']=[
          'order_quantity'=>$this_month_whole_sales->count(),
          'product_quanity'=>$product_quantity_month,
          'amount'=>$this_month_whole_sales->sum('total')-$this_month_whole_sales->sum('discount')
         ];   
    } 
    
    return $analysis;

  }

   public static function SaleAnalysis(){

    //get today sales
    $totday_sales=Sale::where('created_at','>=',Carbon::today()->startOfDay())
                        ->where('created_at','<=',Carbon::today()->endOfDay())
                        ->get();
   //get this week _whole_sales                     
   $this_week_sales=Sale::where('created_at','>=',Carbon::yesterday()->subDays('7')->startOfDay())
                         ->where('created_at','<=', Carbon::yesterday()->endOfDay())
                         ->get(); 

   //get this month order                     
   $this_monthe_sales=Sale::where('created_at','>=',Carbon::yesterday()->subDays('30')->startOfDay())
                          ->where('created_at','<=', Carbon::yesterday()->endOfDay())
                          ->get();


$analysis=[];
$product_quantity_today=0;
$product_quantity_week=0;
$product_quantity_month=0;
$analysis['today']=[];
$analysis['this_week']=[];
$analysis['this_month']=[];


//today order summary
  foreach($totday_sales as $totday_sale){
       $product_quantity_today+=SaleItems::where('sale_id',$totday_sale->id)->sum('qty');
       $analysis['today']=[
          'order_quantity'=>$totday_sales->count(),
          'product_quanity'=>$product_quantity_today,
          'amount'=>$totday_sales->sum('total')-$totday_sales->sum('discount')
         ];   
    } 
//this week  order summary
     foreach($this_week_sales as $this_week_sale){
       $product_quantity_week += OrderItem::where('order_id',$this_week_sale->id)->sum('quantity');
       $analysis['this_week']=[
          'order_quantity'=>$this_week_sales->count(),
          'product_quanity'=>$product_quantity_week,
          'amount'=>$this_week_sales->sum('total')-$this_week_sales->sum('discount')
         ];   
    } 

//this month  order summary
     foreach($this_monthe_sales as $this_monthe_sale){
       $product_quantity_month += OrderItem::where('order_id',$this_monthe_sale->id)->sum('quantity');
       $analysis['this_month']=[
          'order_quantity'=>$this_monthe_sales->count(),
          'product_quanity'=>$product_quantity_month,
          'amount'=>$this_monthe_sales->sum('total')-$this_monthe_sales->sum('discount')
         ];   
    } 
    
    return $analysis;

  }

}

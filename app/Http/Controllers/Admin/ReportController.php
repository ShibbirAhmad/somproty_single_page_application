<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Debit;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Purchase;
use App\Models\Purchaseitem;
use App\Models\Sale;
use App\Models\SaleItems;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{

     public function __construct()
    {
        $this->middleware('admin');
    }

   public function orderReport(Request $request){
      
    $item=$request->item ?? 10;
    if(!empty($request->start_date) && empty($request->end_date)){
         $orders=Order::where('created_at','=',$request->start_date)
                        ->orderBy('id','DESC')
                        ->with('orderItem')                   
                        ->paginate($item);
      }elseif(!empty($request->start_date) && !empty($request->end_date)){
          $orders=Order::where('created_at','>=',$request->start_date)
                        ->where('created_at','<=',$request->end_date)
                        ->orderBy('id','DESC')
                        ->with('orderItem')    
                        ->paginate($item);
       }else{
         $orders=Order::orderBy('id','DESC')->with('orderItem')->paginate($item);
      }


      return \response()->json($orders);
      

   }

   public function officeSaleReport(Request $request){
       
    
       $item=$request->item ?? 10;

      if(!empty($request->start_date) && empty($request->end_date)){
         $sales=Sale::where('created_at','=',$request->start_date)
                        ->orderBy('id','DESC')
                        ->with('saleItems')   
                        ->where('status',1)                
                        ->paginate($item);
      }elseif(!empty($request->start_date) && !empty($request->end_date)){
          $sales=Sale::where('created_at','>=',$request->start_date)
                        ->where('created_at','<=',$request->end_date)
                        ->orderBy('id','DESC')
                        ->with('saleItems')
                       ->where('status',1)                
                     ->paginate($item);
       }else{
         $sales=Sale::orderBy('id','DESC')->with('saleItems')->where('status',1)->paginate($item);
      }

      return \response()->json($sales);
      

   }

   public function accountReport(Request $request){

       $account=array();
       $account['credit']=0;
       $account['debit']=0;

        if(empty($request->start_date) && empty($request->end_date)){
            $credit=Credit::all();
            $debit=Debit::all();
        }

      if(!empty($request->start_date) && empty($request->end_date)){
          $credit=Credit::whereDate('date','=',$request->start_date)->get();
          $debit=Debit::whereDate('date','=',$request->start_date)->get();
        
      }
       if(!empty($request->start_date) && !empty($request->end_date)){
           $credit=Credit::whereDate('date','>=',$request->start_date)->whereDate('date','<=',$request->end_date)->get();
           $debit=Debit::whereDate('date','>=',$request->start_date)->whereDate('date','<=',$request->end_date)->get();
       }

      $account['credit']=$credit->sum('amount');
      $account['debit']=$debit->sum('amount');

      return \response()->json($account);
      
   }

   public function purchaseReport(Request $request){

        $item=$request->item ?? 10;

        if(!empty($request->start_date) && empty($request->end_date)){
          $purchase=Purchase::where('created_at','=',$request->start_date)
                          ->orderBy('id','DESC')
                          ->with(['purchaseItems','supplier'])                   
                          ->paginate($item);

        }elseif(!empty($request->start_date) && !empty($request->end_date)){
          //return $request->all();
            $purchase=Purchase::where('created_at','>=',$request->start_date)
                          ->where('created_at','<=',$request->end_date)
                          ->orderBy('id','DESC')
                          ->with(['purchaseItems','supplier'])                   
                          ->paginate($item);
        }elseif(empty($request->start_date) && !empty($request->end_date)){

                          $purchase=Purchase::where('created_at','=',$request->end_date)
                          ->orderBy('id','DESC')
                          ->with(['purchaseItems','supplier'])                   
                          ->paginate($item);
        }else{
          $purchase=Purchase::orderBy('id','DESC')
                        ->with(['purchaseItems','supplier'])                   
                        ->paginate($item);
       }
       
        return \response()->json($purchase);
    }



 
 
    public function supplierReport(){
      $supplier_id=Purchase::select('supplier_id')->pluck('supplier_id')->unique();

      $suppliers=Supplier::whereIn('id',$supplier_id)->get();

      $data=[];

      foreach($suppliers as $k=> $supplier){
        
          $data[$supplier->company_name]=[
            'total_purchase_amount'=>Purchase::where('supplier_id',$supplier->id)->sum('total'),
            'total_paid_amount'=>SupplierPayment::where('supplier_id',$supplier->id)->sum('amount'),
            'purchase_count'=>Purchase::where('supplier_id',$supplier->id)->count()
          ];
        }
       return \response()->json($data);
    }


    public function profitReport(Request $request){


  
    $sales=Sale::whereDate('created_at','=',$request->start_date)->get();
     $sale_items=SaleItems::whereDate('created_at','=',$request->start_date)->get();

    //only  delivered order count
    $orders=Order::where('status',5)->whereDate('delivery_date','=',$request->start_date)->get();
    $order_id=Order::where('status',5)->whereDate('delivery_date','=',$request->start_date)->select('id')->pluck('id');

    if(!empty($request->start_date) && !empty($request->end_date)){
      $sales=Sale::whereDate('created_at','>=',$request->start_date)->whereDate('created_at','<=',$request->end_date)->get();
      $sale_items=SaleItems::whereDate('created_at','=',$request->start_date)->whereDate('created_at','<=',$request->start_date)->get();
      $orders=Order::where('status',5)->whereDate('delivery_date','>=',$request->start_date)->whereDate('delivery_date','<=',$request->end_date)->get();
      $order_id=Order::where('status',5)->whereDate('delivery_date','>=',$request->start_date)->whereDate('delivery_date','<=',$request->end_date)->select('id')->pluck('id');
   }
    $order_items=OrderItem::whereIn('order_id',$order_id)->get();

    $sale_details=[
      'sale_amount_from_sale_product'=>$sales->sum('total')-$sales->sum('discount'),
      'purchase_amount_from_sale_product'=>0,
    ];
     $order_details=[
      'order_amount_from_order_sale_product'=>$orders->sum('total')-$orders->sum('discount'),
      'purchase_amount_from_order_sale_product'=>0,
    ];
  
 
     foreach($sale_items as $k=> $sale_item){
        $product_purchase_item=Purchaseitem::where('product_id',$sale_item->product_id)->get();
        $purchase_price=0;
        foreach($product_purchase_item as $item){
          $purchase_price+=$item->price*$item->stock;
        }
        if( $purchase_price > 0){
               $a_price=$purchase_price/$product_purchase_item->sum('stock');
       
            $sale_details['purchase_amount_from_sale_product']+=$a_price*$sale_item->qty; 
          
        }
    
    }

foreach($order_items as $k=> $order_item){

        $product_purchase_items=Purchaseitem::where('product_id',$order_item->product_id)->get();
        $p_price=0;
        foreach($product_purchase_items as $product_purchase_item){
          $p_price +=($product_purchase_item->price*$product_purchase_item->stock);
        }
            
     if($p_price>0){
        $avarage_purchase_price=$p_price/$product_purchase_items->sum('stock');
        $order_details['purchase_amount_from_order_sale_product']+=$avarage_purchase_price*$order_item->quantity;
     }
  
    }
     $total_product_sale_amount=$sale_details['sale_amount_from_sale_product']+$order_details['order_amount_from_order_sale_product'];
    $total_product_purchase_amount=$sale_details['purchase_amount_from_sale_product']+$order_details['purchase_amount_from_order_sale_product'];
    return response()->json([
        'total_product_sale_amount'=>$total_product_sale_amount,
        'total_product_purchase_amount'=>$total_product_purchase_amount
    ]);
  }



   



  public function office_sale_report_pdf($start_date,$end_date){

    if($start_date=="All" && $end_date=="All" ){
      $sales=Sale::orderBy('id','DESC')->with('saleItems')->get();
    }

    if($start_date!="All" && $end_date =="All"){
      $sales=Sale::where('created_at','=',$start_date)
                          ->orderBy('id','DESC')
                          ->with('saleItems')   
                          ->where('status',1)                
                          ->get();
    }

    if($start_date=="All" && $end_date !="All"){
      $sales=Sale::where('created_at','=',$start_date)
                          ->orderBy('id','DESC')
                          ->with('saleItems')   
                          ->where('status',1)                
                          ->get();
    }

    if($start_date!='All' && $end_date!="All"){
      $sales=Sale::where('created_at','>=',$start_date)
                  ->where('created_at','<=',$end_date)
                  ->orderBy('id','DESC')
                  ->with('saleItems')
                  ->where('status',1)                
                ->get();
    }
 
                  $pdf = PDF::loadView('admin.pdf.office_sale_report',compact('sales')); 
           return $pdf->stream();
  
  }



  public function order_sale_report_pdf($start_date,$end_date){

    if($start_date=="All" && $end_date=="All" ){
      $orders=Order::orderBy('id','DESC')->with('orderItem')->get();
    }

    if($start_date!="All" && $end_date =="All"){
      $orders=Order::where('created_at','=',$start_date)
                        ->orderBy('id','DESC')
                        ->with('orderItem')                   
                        ->get();
    }

    if($start_date=="All" && $end_date !="All"){
      $orders=Order::where('created_at','=',$end_date)
                          ->orderBy('id','DESC')
                          ->with('orderItem')      
                          ->get();
    }

    if($start_date!='All' && $end_date!="All"){
      $orders=Order::where('created_at','>=',$start_date)
                  ->where('created_at','<=',$end_date)
                  ->orderBy('id','DESC')
                  ->with('orderItem')             
                ->get();
    }
 
                  $pdf = PDF::loadView('admin.pdf.order_sale_report',compact('orders')); 
           return $pdf->stream();
  
  }



  public function purchase_report_pdf($start_date,$end_date){

    if($start_date=="All" && $end_date=="All" ){
      $purchases=Purchase::orderBy('id','DESC')->with(['purchaseItems','supplier'])->get();
    }

    if($start_date!="All" && $end_date =="All"){
      $purchases=Purchase::where('created_at','=',$start_date)
                          ->orderBy('id','DESC')
                          ->with(['purchaseItems','supplier'])                   
                          ->get();
    }

    if($start_date=="All" && $end_date !="All"){
      $purchases=Purchase::where('created_at','=',$end_date)
                          ->orderBy('id','DESC')
                          ->with(['purchaseItems','supplier'])                   
                          ->get();
    }

    if($start_date!='All' && $end_date!="All"){
      $purchases=Purchase::where('created_at','>=',$start_date)
                            ->where('created_at', '<=', $end_date)
                            ->orderBy('id','DESC')
                            ->with(['purchaseItems','supplier'])                   
                            ->get();
    }
 
      $pdf = PDF::loadView('admin.pdf.purchase_report',compact('purchases')); 
      return $pdf->stream();
  
  }

  public function saleProfite(Request $request){


  //  return $request->all();

    $sale_items=SaleItems::orderBy('id','DESC')->where('status',1)->groupBy('sale_id');

      if(!empty($request->start_date) && empty($request->end_date)){
            $sale_items=SaleItems::whereDate('created_at','=',$request->start_date)
                                          ->orderBy('id','DESC')
                                          ->where('status',1)
                                          ->get()
                                          ->groupBy('sale_id');

      }
      if(!empty($request->start_date) && !empty($request->end_date)){
           $sale_items=SaleItems::whereDate('created_at','>=',$request->start_date)
                                  ->whereDate('created_at','<=',$request->end_date)
                                  ->orderBy('id','DESC')->where('status',1)
                                  ->get()
                                  ->groupBy('sale_id');

      }



    $data=[];

    $i=0;
    foreach($sale_items as $k=> $sale_item){

    //  return $sale_item;
      $i++;
      $purchase_total=0;
      
          foreach($sale_item as $item){
             $product_purchase_items=Purchaseitem::where('product_id',$item->product_id)->get();
              $purchase_price=0;
              foreach($product_purchase_items as $product_purchase_item){
                $purchase_price+=$product_purchase_item->price*$product_purchase_item->stock;
              }
            if( $purchase_price > 0){
               $a_price=$purchase_price/$product_purchase_items->sum('stock');
            }
            $purchase_total+=$a_price*$item->qty;
         
       }
        $sale=Sale::where('id',$k)->where('status',1)->first();
        $s_total=0;
        $s_discount=0;

        if(!empty($sale->total)){
          $s_total=$sale->total;
        }
         if(!empty($sale->discount)){
          $s_discount=$sale->discount;
        }
            $data[$i]=[
              'sale_invoice'=>$k,
              'sale_total'=>$s_total-$s_discount,
              'product_purchase_amount' =>$purchase_total,
              'product_count'=>$sale_item->sum('qty')
          ];

    }
  return \response()->json($data);

  }

  public function orderProfite(Request $request){

      $order_items=OrderItem::get()->groupBy('order_id');

      if(!empty($request->start_date) && empty($request->end_date)){
          $order_items=OrderItem::whereDate('created_at','=',$request->start_date)->get()->groupBy('order_id');
      }

     if(!empty($request->start_date) && !empty($request->end_date)){
          $order_items=OrderItem::whereDate('created_at','>=',$request->start_date)
                                  ->whereDate('created_at','<=',$request->end_date)
                                  ->get()
                                 ->groupBy('order_id');
      }
      
      $data=[];
      $i=0;
      foreach($order_items as $k=> $order_item){
          
      $i++;
      $purchase_total=0;
      
          foreach($order_item as $item){
             $product_purchase_items=Purchaseitem::where('product_id',$item->product_id)->get();
              $purchase_price=0;
            foreach($product_purchase_items as $product_purchase_item){
              $purchase_price+=$product_purchase_item->price*$product_purchase_item->stock;
            }
            if( $purchase_price > 0){
               $a_price=$purchase_price/$product_purchase_items->sum('stock');
            }
            $purchase_total+=$a_price*$item->quantity;
         
       }
        $order=Order::where('id',$k)->first();

        if(!empty($order) && $order->status==5){
           $data[$i]=[
              'order_invoice'=>$order->invoice_no,
              'order_total'=>$order->total-$order->discount,
              'product_purchase_amount' =>$purchase_total,
              'product_count'=>$order_item->sum('quantity'),
              'order_date'=> date("d-m-Y", strtotime($order->created_at)),
              'order_delivered_date'=> date("d-m-Y", strtotime($order->delivery_date)) ?? ""
            ];
        }
         
    }
    return $data;
   }

}

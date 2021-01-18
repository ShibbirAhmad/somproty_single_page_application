<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItems;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct(Request $request)
    {
        if(!$request->ajax()){
          
            return abort(404);

        }
        
        $this->middleware('admin');
        
    }

    public function office_sale_index(Request $request)
    {
        $item=$request->item??20;
        
        $sales=Sale::orderBy('id','DESC')->where('sale_type',1)->with('company')->paginate($item);
        return response()->json([
            'sales'=>$sales,
            'status'=>"SUCCESS"
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       //  return $request->all();
    
        $sale=new Sale();
        $sale->sale_type=$request->type;
        $sale->company_id=$request->company_id ?? null;
        $sale->paid_by=$request->paid_by;
        $sale->name=$request->name ?? null;
        $sale->mobile_no=$request->mobile_no ?? null;
        $sale->address=$request->address;
        $sale->invoice_no=$request->invoice_no ?? null;
        $sale->total=$request->AmountTotal;
        $sale->paid=$request->paid ?? 0;
         $sale->discount=$request->discount ?? 0;
        if($sale->save()){


         //save the sale item
        foreach ($request->products as $item) {

            //manage product stock
            $product = Product::where('id', $item['product_id'])->first();
            $product->stock = $product->stock - $item['quantity'];
            $product->save();

            //save the product stock
            $sale_item = new SaleItems();
            $sale_item->sale_id = $sale->id;
            $sale_item->product_id = $item['product_id'];
            $sale_item->price = $item['price'];
            $sale_item->qty = $item['quantity'];
            $sale_item->total=$item['price'] * $item['quantity'];
            $sale_item->save();

         }

         //add the credit balance
         if($sale->sale_type==1){
            
         ///when create a office sale, we create a credit and customer.......
         //first search customer new or exists
         $customer=Customer::where('phone',$request->mobile_no)->first();
        
         //if not customer then save, as a new customer
        if(!$customer){
            $customer=new Customer();
            $customer->name=$request->name;
            $customer->phone=$request->mobile_no;
            $customer->address=$request->address;
            $customer->city_id=2;
            $customer->custome_type=3;        //ofice sale customer 
            $customer->save();
        }

        //create a credit.......
            // $comment='office sale. Amount BDT '.$sale->total.' and paid by '.$sale->paid_by .' Sale created by_'. session()->get('admin')['name']; 
            $credit = new Credit();
            $credit->purpose = "Office sale";
            $credit->amount = $sale->paid-$request->partials_payment_amount;
            $credit->credit_in=$sale->paid_by;
            $credit->comment ='Office Sale. Invoice No  S-'.$sale->id;
            $credit->date = date('Y-m-d');
            $credit->insert_admin_id=session()->get('admin')['id'];
            $credit->save();

            if($request->partials_payment_amount > 0){
                $credit = new Credit();
                $credit->purpose = "Office sale";
                $credit->amount =$request->partials_payment_amount;
                $credit->credit_in=$request->partials_paid_by;
                $credit->comment ="Office sale, Partials Payment";
                $credit->date = date('Y-m-d');
                $credit->insert_admin_id=session()->get('admin')['id'];
                $credit->save();
            }

            //if customer not paid total amount,then create a customer dues
             if($sale->paid < $sale->total ){
                $due=$sale->total-$sale->paid-$sale->discount;
                if($due>0){
                    DB::table('customer_dues')->insert([
                    'sale_id'=>$sale->id,
                    'customer_mobile_no'=>$request->mobile_no,
                    'customer_name'=>$request->name,
                    'amount'=>$due,
                    'created_at'=>Carbon::now(),
                    'memo_no'=>$sale->id
                ]);
                }
            }
         }


        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'new sale was added'
        ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale=Sale::find($id);
        $sale_item=SaleItems::where('sale_id',$sale->id)->with('product')->get(); 

        return response()->json([
            'sale'=>$sale,
            'items'=>$sale_item,
            'status'=>"SUCCESS"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paid($id){

        $sale=Sale::findOrFail($id);

        $sale->status=2;
        if($sale->save()){
        
                //make comment
                $paid_by='';
                if($sale->paid_by==1){
                    $paid_by='Cash';
                }elseif($sale->paid_by==2){
                    $paid_by="bKash";
                }else{
                    $paid_by="Bank";
                }
     
                $comment="company sale.created at ".date_format($sale->created_at,'Y-m-d'). " and paid date " . date_format($sale->updated_at,'Y-m-d') . ". Amount BDT ". $sale->total . " and paid by ".$paid_by; 
                $credit = new Credit();
                $credit->purpose = "company sale";
                $credit->amount = $sale->total;
                $credit->comment =$comment;
                $credit->date = date('Y-m-d');
                $credit->insert_admin_id=session()->get('admin')['id'];
                $credit->save();

                return \response()->json([
                    'success'=>"OK",
                    'message'=>'sale paid was successfully'
                ]);
        
    }
        
    }   
    public function return($id){
        $sale=Sale::findOrFail($id);
        $sale->status=3;
        $sale->save();

        $sale_itmes=SaleItems::where('sale_id',$id)->get();
      //save the sale item
      foreach ($sale_itmes as $item) {
        //return $item->qty;
        //manage product stock
        $product = Product::where('id', $item->product_id)->first();
        $product->stock = $product->stock + $item->qty;
        $product->save();

        return \response()->json([
            'success'=>"OK",
            'message'=>'sale returned was successfully'
        ]);

        
         }

    }



    public function  office_sale_search_according_data($search){

        $sale_items=Sale::where('sale_type',1)->get();
        $sales=Sale::where('id', 'like', '%' . $search . '%')
                        ->orWhere('mobile_no','like', '%' . $search . '%')
                        ->orWhere('name','like', '%' . $search . '%')
                        ->where('sale_type',1)
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
    
        return response()->json([
            'status'=>"OK",
            'sales'=>$sales,
        ]);        
    }


    

    public function  office_sale_search_according_date_wise(Request $request){
        
        $sales='';
        $paginate=$request->item??10;
        if(!empty($request->start_date) && empty($request->end_date)){
            
                $sales=Sale::whereDate('created_at','=',$request->start_date)
                             ->where('sale_type',1)
                             ->paginate($paginate);
             
        }
        elseif(!empty($request->end_date) && !empty($request->start_date)){

                $sales=Sale::whereDate('created_at', '>=', $request->start_date)
                                ->whereDate('created_at', '<=', $request->end_date)
                                ->where('sale_type',1)
                                ->paginate($paginate);
         }else{
              $sales=Sale::whereDate('created_at','=',$request->end_date)
                     ->where('sale_type',1)
                     ->paginate($paginate);
              
         }
             return response()->json([
                'status'=>'OK',
                'sales'=>$sales
             ]);


    }





    public function company_sale_index(Request $request)
    {
        $item=$request->item??20;
        
        $sales=Sale::orderBy('id','DESC')->where('sale_type',2)->with('company')->paginate($item);
        return response()->json([
            'sales'=>$sales,
            'status'=>"SUCCESS"
        ]);
    }


   
    
    public function  company_sale_search_according_data($search){

        $sales = Sale::where('sale_type',2)->where('name', 'like', '%' . $search . '%')
                        ->orWhere('mobile_no','like', '%' . $search . '%')
                        ->orWhere('address','like', '%' . $search . '%')
                       
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
    
        return response()->json([
            'status'=>'OK',
            'sales'=>$sales
        ]);        
    }


    

    public function  company_sale_search_according_date_wise(Request $request){
        
        $sales='';
        $paginate=$request->item??10;
        if(!empty($request->start_date) && empty($request->end_date)){
            
                $sales=Sale::whereDate('created_at','=',$request->start_date)
                             ->where('sale_type',2)
                             ->paginate($paginate);
             
        }
        elseif(!empty($request->end_date) && !empty($request->start_date)){

                $sales=Sale::whereDate('created_at', '>=', $request->start_date)
                                ->whereDate('created_at', '<=', $request->end_date)
                                ->where('sale_type',2)
                                ->paginate($paginate);
         }else{

            $sales=Sale::whereDate('created_at','=',$request->end_date)
                     ->where('sale_type',2)
                     ->paginate($paginate);
              
         }
        return response()->json([
            'status'=>'OK',
            'sales'=>$sales
        ]);


    }

    public function exchangeStore(Request $request){
        

        //return $request->all();
        if(empty($request->products)){
            return \response()->json('Sale Product Empty');
        }
        
        if(empty($request->exchnage_products)){
            return \response()->json('exchnage_products Empty');
        }
        if($request->exchange_total>$request->sale_total){
            return \response()->json('Exchaneg amount can not be bigger then Sale amount');
        }
        if($request->AmountTotal < $request->paid){
            return \response()->json('Paid can not be bigger invoice total');

        }

        $sale=new Sale();
        $sale->sale_type=$request->type;
        $sale->paid_by=$request->paid_by;
        $sale->name=$request->name ?? null;
        $sale->mobile_no=$request->mobile_no ?? null;
        $sale->address=$request->address;
        $sale->total=$request->AmountTotal;
        $sale->paid=$request->paid ?? 0;
        $sale->discount=$request->discount ?? 0;
        $sale->status=2;

        if($sale->save()){
            foreach ($request->products as $item) {

            //manage product stock
            $product = Product::where('id', $item['product_id'])->first();
            $product->stock = $product->stock - $item['quantity'];
            $product->save();

            //save the product stock
            $sale_item = new SaleItems();
            $sale_item->sale_id = $sale->id;
            $sale_item->product_id = $item['product_id'];
            $sale_item->price = $item['price'];
            $sale_item->qty = $item['quantity'];
            $sale_item->total=$item['price'] * $item['quantity'];
            $sale_item->save();

         }
         foreach ($request->exchnage_products as $prroduct) {

            //manage product stock
            $pro = Product::where('id', $prroduct['product_id'])->first();
            $pro->stock = $pro->stock + $prroduct['quantity'];
            $pro->save();

            $sale_item = new SaleItems();
            $sale_item->sale_id = $sale->id;
            $sale_item->product_id = $prroduct['product_id'];
            $sale_item->price = $prroduct['price'];
            $sale_item->qty = $prroduct['quantity'];
            $sale_item->total=$prroduct['price'] * $prroduct['quantity'];
            $sale_item->status=2;
            $sale_item->save();

         }

         //new credit
           if($sale->paid>0){
                $credit = new Credit();
                $credit->purpose = "Office sale";
                $credit->amount = $sale->paid;
                $credit->credit_in=$sale->paid_by;
                $credit->comment ='Office Sale | Exchange Sale. Invoice No  S-'.$sale->id;
                $credit->date = date('Y-m-d');
                $credit->insert_admin_id=session()->get('admin')['id'];
                $credit->save();
           }
           if($request->due>0){
                 DB::table('customer_dues')->insert([
                    'sale_id'=>$sale->id,
                    'customer_mobile_no'=>$request->mobile_no,
                    'customer_name'=>$request->name,
                    'amount'=>$request->due,
                    'created_at'=>Carbon::now(),
                    'memo_no'=>$sale->id
                ]);
           }

           return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Exchange Sale Was added',
         ]);
        }
    }



}

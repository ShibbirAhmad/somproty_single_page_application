<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reseller;
use App\Models\ResellerOrderDetails;
use App\Models\ResellerPayments;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel ;
use App\Exports\ResellersExport ;
use App\Models\Order;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReseller(Request $request)
    {
            $item=$request->item??10;
            $reseller = Reseller::orderBy('id','DESC')->paginate($item);

          

           return response()->json([

                "success" => "OK",
                "resellers" => $reseller  ,
           ]) ;
     }
   
   
   
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addReseller(Request $request)
    {

        $validatedData = $request->validate([
            'name'  => 'required',
            'companyName'  => 'required',
            'email'  => 'required|unique:resellers',
            'phone'  => 'required|unique:resellers|digits:11',
            'address'  => 'required',
        ]);
          
         $username=Reseller::max('id')+100;
          $reseller = new Reseller();
          $reseller->name=$request->name ;
          $reseller->username='ms'.''.$username;
          $reseller->company_name=$request->companyName ;
          $reseller->email=$request->email ;
          $reseller->phone=$request->phone ;
          $reseller->bkash_no=$request->bkashNumber ;
          $reseller->address=$request->address ?? null;
          $reseller->password=Hash::make(123456);
          $reseller->status=1;
              if ($request->hasFile('image')) {
               $file_path = $request->file('image')->store('images/reseller','public');
                $reseller->image=$file_path ;
               }

        if ($reseller->save()) {
           return response()->json([
            "success"  => "OK",
            "message"  => "Resller was added "
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
            
        $reseller  = Reseller::find($id);

        if ($reseller) {
            return response()->json([
                "success"  => "OK",
                 "reseller"  => $reseller,
           ]);
      }else {
     return  response()->json([
           "success" => "Fail",
          "message" => "something wrong "
     ]);
    
      }
   


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


    public function reseller_search($data){

           $resellers = Reseller::where('username','like','%'.$data.'%')
                                  ->orWhere('email','like','%'.$data.'%')
                                  ->orWhere('phone','like','%'.$data.'%')
                                  ->paginate(10);
          return response()->json([
              "status" => "OK",
              'resellers' => $resellers ,
          ]);

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



    }

    public function updateRseller(Request $request, $id) {

           $validatedData = $request->validate([
                'name'  => 'required',
                'companyName'  => 'required',
                'email'  => 'required|unique:resellers,email,'.$id,
                'phone'  => 'required',
                'address'  => 'required',
               
            ]);
               $reseller = Reseller::find($id);
               $reseller->name=$request->name ;
               $reseller->company_name=$request->companyName ;
               $reseller->email=$request->email ;
               $reseller->phone=$request->phone ;
               $reseller->bkash_number=$request->bkashNumber ;
               $reseller->address=$request->address ;
                    if ($request->hasFile('image')) {

                         if (file_exists('storage/'.$reseller->image )) {
                         unlink('storage/'.$reseller->image);
                         }
                         
                           $file_path = $request->file('image')->store('images/reseller','public');
                           $reseller->image=$file_path ;
                    }
                     if ($reseller->save()) {
                         return response()->json([
                              "success"  => "OK",
                              "message"  => "Resller updated successfully ",
                              "reseller"  => $reseller ,
                         ]);
                   }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            
         $reseller  = Reseller::find($id);

         if ($reseller->delete()) {
              return response()->json([
                 "success"  => "OK",
                  "message"  => "one reseller removed "
            ]);
       }else {
           return  response()->json([
                "success" => "Fail",
               "message" => "something wrong "
          ]);
     
  }


}
public function accountAccess($id){
     $reseller=Reseller::find($id);
        if ($reseller){
         session()->put('reseller',$reseller);
            return redirect()->route('dashboard.reseller');
        }
  }

   public function deactive($id)
    {
        $reseller = Reseller::find($id);
           $reseller->status = 0;
            if ($reseller->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'Reseller deactive successfully'
                ]);
            }
       
    }


    function active($id)
    {
        $reseller = Reseller::find($id);
        $reseller->status = 1;
            if ($reseller->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'Reseller active successfully'
                ]);
            }
      
    }

    public function unpaidPayment(Request $request){

        $item=$request->item??10;

          if (!empty($request->reseller)) {
            $orders_id = Order::where('status', 5)->where('reseller_id', $request->reseller_id)->where('order_type', 4)->select('id')->pluck('id');

        } else {
            $orders_id = Order::where('status', 5)->whereNotNull('reseller_id')->where('order_type', 4)->select('id')->pluck('id');

        }
        $unpaid_payment=ResellerOrderDetails::WhereNull(['paid','paid_date'])->with(['order','reseller'])->whereIn('order_id',$orders_id)->paginate($item);
          if(!empty($request->reseller_id)){
                $unpaid_payment=ResellerOrderDetails::WhereNull(['paid','paid_date'])->with(['order','reseller'])->where('reseller_id',$request->reseller_id)->paginate($item);
         }
        return response()->json($unpaid_payment);
    }
      public function paidPayment(Request $request){

        $item=$request->item??10;

        
        $paid_payment=ResellerOrderDetails::WhereNotNull(['paid','paid_date'])->with(['order','reseller'])->paginate($item);
          if(!empty($request->reseller_id)){
                $paid_payment=ResellerOrderDetails::WhereNotNull(['paid','paid_date'])->with(['order','reseller'])->where('reseller_id',$request->reseller_id)->paginate($item);
         }
        return response()->json($paid_payment);
    }

    public function toPaid(Request $request){

        if(empty($request->reseller_id)){
           return response()->json("Please select a sepecific Reseller");
         }
         if(empty($request->id)){
            return response()->json("Please select at least on row");
        }
        $reseller_order=ResellerOrderDetails::whereIn('id',$request->id)->where('reseller_id',$request->reseller_id)->whereNull('paid')->get();
        $reseller=Reseller::where('id',$request->reseller_id)->first();

        if(count($reseller_order)<=0){
            return response()->json($reseller->username.'-Reseller Order Not Found');

        }
        $reseller_payment=new ResellerPayments();
        $reseller_payment->reseller_id=$request->reseller_id;
        $reseller_payment->paid_amount=$reseller_order->sum('total_amount');
       // return $reseller_payment;
        if($reseller_payment->save()){
            foreach($reseller_order as $item){
               // return $item;
                $item->paid_date= date('Y-m-d');
                $item->paid=1;
                $item->paid_id=$reseller_payment->id;
                $item->save();
            }
        }
    }

    public function export_reseller(){

        //$abc= new ResellersExport();

       // return $abc->collection();

       return Excel::download(new ResellersExport(),'reseller.xlsx') ;
    }
    public function paymentInvoice(Request $request){
        $item=$request->item??10;
        $invoice=ResellerPayments::orderBy('id','DESC')->with('reseller')->paginate($item);
      return response()->json($invoice);

    }
    public function paymentInvoiceDetails($id){
        $payment_items=ResellerOrderDetails::where('paid_id',$id)->with('order')->get();
        $payment=ResellerPayments::find($id);
        return \response()->json([
            'payment_items'  => $payment_items,
            'payment'        => $payment
        ]);
    }


}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\CreditDue;
use App\Models\CustomerDue;

class CreditDueController extends Controller
{
   public function __construct(Request $request)
    {
        if(!$request->ajax()){
            abort(404);
        }

        $this->middleware('admin');
        
    }
    public function index(Request $request)
    {
        $item=$request->item??10;
        $credit_dues=CustomerDue::orderBy('id','DESC')->where('status',0)->paginate($item);
        return response()->json($credit_dues);
    }

    public function  duePaid(Request $request,$id){
        
        $customer_due=CustomerDue::find($id);

        if($request->amount > $customer_due->amount){
            return response()->json('Due Amount '.$customer_due->amount.' But Request Amount '. $request->amount);
        }
        if($customer_due->amount==$request->amount){
            $customer_due->status=1;
        }  


        $customer_due->amount=$customer_due->amount-$request->amount;
        
        if($customer_due->save()){
      
          //create a credit.......     
        $credit = new Credit();
        $credit->purpose ="Due amount, Paid....";
        $credit->amount =$request->amount;
        $credit->comment ="customer due amount paid.... Extra Hint(Paid Amount: ". $request->amount.' Due Amount: '.($customer_due->amount+$request->amount);
        $credit->date =  date('Y-m-d');
        $credit->credit_in=$request->paid_by;
        $credit->insert_admin_id=session()->get('admin')['id'];
        $credit->save();
         return response()->json([
                'status' => 'SUCCESS',
                'message' => 'paid successfully',
                'due'=>$customer_due
            ]);
        }
    }
   

}

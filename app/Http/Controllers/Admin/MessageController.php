<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\Team;
use App\Models\Reseller;

use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class MessageController extends Controller
{
   
     // public  function customer_import(Request $request){

     //      // return $request->file ;
     //     // return Excel::import(new CustomersImport($request->file));
     //      // return response()->json([ 
     //      //      "message" => "uploaded" ,
     //      // ]);
     //    }


     
     public function send_message(Request $request){
     
         if($request->customer_type === "wholesale"){
            
                        $message=$request->message ;
                        $customers=Customer::where('customer_type',2)->get();
             return     Customer::sendMessageToWholeSaleCustomer($customers,$message);
             

        }elseif($request->customer_type === "officesale"){
                
                        $message=$request->message ;
                        $customers=Customer::where('customer_type',3)->get();
             return     Customer::sendMessageToOfficeSaleCustomer($customers,$message) ;

        }elseif($request->customer_type === "retailsale"){

                        $message=$request->message ;
                        $customers=Customer::where('customer_type',1)->get();
            return      Customer::sendMessageToRetailSaleCustomer($customers,$message) ;

        }elseif($request->customer_type === "admins"){

                        $message=$request->message ;
                        $admins=Team::where('id',19)->get();
            return      Customer::sendMessageToAdmins($admins,$message) ;

        }elseif($request->customer_type === "resellers"){
            
                        $message=$request->message ;
                        $resellers=Reseller::where('status',1)->get();
             return     Customer::sendMessageToResellers($resellers,$message) ;

        }elseif($request->customer_type  == "instantMessage" ){   

                       $instant_customers=$request->instantContants  ;
                       $message=$request->message  ;               
            return  Customer::sendMessageToInstantCustomers($instant_customers,$message) ;
               
        }elseif($request->has('file')){
               
          //              $message=$request->message ;               
          //    return    Customer::sendMessageToCustomCustomers($custom_customers,$message) ;
               
        }else{
            
            $message=$request->message ;
              $merchants=Merchant::where('status',1)->get();
            return Customer::sendMessageToMerchants($merchants,$message);
        }



          
     }


     // public static  function customer_import() 
     // {
     //     Excel::import(new CustomersImport, 'customers.xlsx');
         
     //     return response()->json([

     //           "message" => "uploaded" ,
     //     ]);
     // }



}

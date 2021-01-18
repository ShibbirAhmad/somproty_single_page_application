<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MerchantExport ;


class MerchantController extends Controller
{
    
   

    //function for admin to merchan access
    public function adminAccessMerchant($id){

          $merchant = Merchant::find($id);
         
          if ($merchant) {
              session()->put('merchant',$merchant);
              return response()->json([
                  'status'=>"OK",
                  'token'=>'427525ghfhgdcgfc',
                  'merchant'=>$merchant,
              ]);
          }
    }



    public  function index(Request $request){
        $item = $request->item ?? 10 ;
        $merchants= Merchant::orderBy('id','DESC')->paginate($item);
        return response()->json([
            "success" => "OK",
            "merchants" => $merchants ,
        ]);
    }



    public function addMerchant(Request $request){
           
        $validatedData = $request->validate([
            'name'  => 'required',
            'email'  => 'required|unique:merchants',
            'phone'  => 'required|unique:merchants|digits:11',
            'address'  => 'required',
            'company_name'  => 'required | unique:merchants',
        ]);


         $merchant= new Merchant ();
         $merchant->name=$request->name ;
         $merchant->phone=$request->phone ;
         $merchant->email=$request->email ;
         $merchant->address=$request->address ;
         $merchant->company_name=$request->company_name ;
         $merchant->password=Hash::make('123456');
         $merchant->status=1;
         if ($request->hasFile('image')) {
             $file_path=$request->file('image')->store('images/merchant','public');
              $merchant->image=$file_path ;
         }
        
         if ($merchant->save()) {
             return response()->json([
                 'success' => 'OK',
                  'message' => 'New  merchant added successfully '
             ]);
         }




    }



    public function getEditMerchant($id){

        $merchant  = Merchant::find($id);  
         if ($merchant) {       
            return response()->json([
                    "success"  => "OK",
                    "merchant"  => $merchant,  ]);
        }else {
            return  response()->json([
                            "success" => "Fail",
                            "message" => "something wrong "  ]);
            }

}
      
    public function searchMerchant($data){
                        
           $merchants = Merchant::where('company_name','like','%'.$data.'%')
                                ->orWhere('email','like','%'.$data.'%')
                                ->orWhere('phone','like','%'.$data.'%')
                                ->orWhere('address','like','%'.$data.'%')
                                ->paginate(10);

           return response()->json([
                  "status" => "OK",
                  'merchants' => $merchants ,
                ]);
    }


    public function updateMerchant(Request $request, $id){
           
 
        $validatedData = $request->validate([
            'name'  => 'required',
            'email'  => 'required|unique:merchants,email,'.$id,
            'phone'  => 'required|digits:11,unique:merchants,phone,'.$id,
            'address'  => 'required',
          
        ]);


         $merchant= Merchant::find($id) ;
         $merchant->name=$request->name ;
         $merchant->phone=$request->phone ;
         $merchant->email=$request->email ;
         $merchant->address=$request->address ;
         $merchant->company_name=$request->company_name ;
         $merchant->status=1;
         if ($request->hasFile('image')) {
            
            if (file_exists('storage/'.$merchant->image)) {
                 unlink('storage/'.$merchant->image);
             }

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



     public function deactiveMerchant($id){

        $merchant  = Merchant::find($id);
        $merchant->status=0 ;
        if ($merchant->save()) {       
           return response()->json([
                   "success"  => "OK",
                   "message"  => "This merchant de-activated",  ]);
       }else {
           return  response()->json([
                           "success" => "Fail",
                           "message" => "something wrong "  ]);
           }
     } 




     public function activeMerchant($id){

        $merchant  = Merchant::find($id);
        $merchant->status=1 ;
        if ($merchant->save()) {       
           return response()->json([
                   "success"  => "OK",
                   "message"  => "This merchant activated",  ]);
       }else {
           return  response()->json([
                           "success" => "Fail",
                           "message" => "something wrong "  ]);
           }
     }


     

    
    public function destroyMerchant($id){

        $merchant  = Merchant::find($id);
         if ($merchant->delete()) {       
            return response()->json([
                    "success"  => "OK",
                    "message"  => "This merchant has removed",  ]);
        }else {
            return  response()->json([
                            "success" => "Fail",
                            "message" => "something wrong "  ]);
            }

    }


    public function exportMerchant(){

        return Excel::download(new MerchantExport, 'merchant.xlsx');
    }


        

}

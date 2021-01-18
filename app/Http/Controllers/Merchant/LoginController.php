<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merchant ;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash ;
use Illuminate\support\Facades\session;

class LoginController extends Controller
{
    //function for merchant register 

    public function register_merchant(Request $request){

         $validatedData = $request->validate([
            'name'  => 'required',
            'email'  => 'required|unique:merchants',
            'phone'  => 'required|unique:merchants|digits:11',
            'address'  => 'required',
            'company_name'  => 'required | unique:merchants',
            'password' => 'required | min:6 ',
        ]); 

                $merchant = new Merchant();
                $merchant->name=$request->name ;
                $merchant->email=$request->email ;
                $merchant->phone=$request->phone ;
                $merchant->address=$request->address ;
                $merchant->company_name=$request->company_name ;
                $merchant->password=Hash::make($request->password);
                $merchant->status = 0 ;
                if ($merchant->save()) {
                    return response()->json([
                        "status" => "OK",
                        "message" => "successfuly registerd, our support team contact with you soon"
                    ]);
                }
    }




    //function for login merchant
    public  function check_login(Request $request){
     
           $validateData = $request->validate([
                    'email' => 'required' ,
                    'password' => 'required' ,
           ]); 

           $credential = [ 'email' => $request->email , 'password' => $request->password , 'status' => '1'] ;
  
           if (Auth::guard('merchant')->attempt($credential)) {
               Session::put('merchant', Auth::guard('merchant')->user() );
               return response()->json([
                   'status' => 'SUCCESS',
                   'merchant'   => Auth::guard('merchant')->user(),
                   'merchant_token'  => Hash::make($request->password),
                   'message' => 'Login successfully ',
               ]);
           }else{

              return response()->json([
                  'status' => 'Fail',
                  'message' => 'Sorry :) in-valid login information'
              ]);
           }
    }


    public function current_merchant_password_update(Request $request){

        $validatedData = $request->validate([
            'old_password' => 'required ',
            'new_password' => 'required',

        ]);

        $merchant= session()->get('merchant');
        $merchant_current_password=$merchant->password;

        if (Hash::check($request->old_password,$merchant_current_password)) {
            if($request->new_password==$request->old_password){
                return response()->json([
                    "message" => "current password and new password can't be same ",
                ]);
            }else{
                $merchant->password=Hash::make($request->new_password);  
                    if ($merchant->save()) {
                        return response()->json([ "success" => "OK", "message" => "password changed successfully" ]);
                    }  
            }
         }else{
             return response()->json([
                "message" => "current password is incorrect! ",
              ]);
         } 

    }


    public function merchant(){
            
         $merchant= Session()->get('merchant');
         
         return response()->json([
             "success" => "OK",
             "merchant" => $merchant ,
         ]);

    }


    public function check_session(){

          if (Session::has('merchant')) {

                return response()->json([
                    "session" => "running",
                    "merchant" => session()->get('merchant') ,
                ]);

          } else {
                return response()->json([
                    "session" => "expired", 
                ]);
          }
          
    }



    public  function logout(){

          Auth::guard('merchant')->logout();
          session()->forget('merchant');
          return response()->json([
            'status' => 'OK',
            'message' => 'Logout successfully'
        ]);
    }


    public function send_reset_code(Request $request){
       
        $validatedData = $request->validate([
            'phone' => 'required|digits:11',
            ]);

          $merchant=Merchant::where('phone',$request->phone)->first();
        if(empty($merchant)){
            return response()->json([
                'status'=>"ERROR",
                'message'=>"The mobile number does not match our records"
            ]);
       }else{
            $code=rand(000000,999999);
            DB::table('password_resets')->insert([
                'mobile_no'=>$request->phone,
                'token'=>Hash::make($code)
            ]);
            Merchant::SendMerchantPasswordResetCode($request->phone,$code);

            return response()->json([
                'status'=>"SUCCESS",
                'message'=>"Sent verification code on your mobile"
            ]);
          }
        } 




        public function merchant_reset_code_verified(Request $request, $phone){
    
           
            $phone=DB::table('password_resets')->where('mobile_no',$phone)->orderBy('id','DESC')->first();
            if(!empty($phone)){
               if (Hash::check($request->code, $phone->token)) {
                  return response()->json([
                       'status'=>"SUCCESS",
                       'message'=>"Code Match"
                   ]);
               }else{
                    return response()->json([
                       'status'=>"ERROR",
                       'message'=>"Code Matching Error"
                   ]);
               }
            }else{
                 return response()->json([
                       'status'=>"ERROR",
                       'message'=>"Code Matching Error"
                    ]);
              }
       
           }



        
    public function merchant_set_new_password(Request $request,$phone){

        $merchant=Merchant::where('phone',$phone)->first();
        if(!empty($merchant)){
            $merchant->password=Hash::make($request->password);
            if($merchant->save()){
                return response()->json([
                    'status'=>"SUCCESS",
                    'message'=>"Passwrod update successfully"
                ]);
            }else{
                 return response()->json([
                    'status'=>"ERROR",
                    'message'=>"Error establish"
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>"ERROR",
                'message'=>"Error estblish"
            ]);
        }
    
    }




}

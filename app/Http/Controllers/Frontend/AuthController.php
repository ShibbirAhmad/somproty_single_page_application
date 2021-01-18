<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Customer;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;
use Illuminate\Support\Facades\Password;
use Illuminate\Notifications\Notifiable;
use App\Mail\userTokenSend;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
   
   
    public function register(Request $request){

        $validatedData = $request->validate([
            'mobile_no' => 'required|digits:11|unique:users',
            'name' => 'required ',
            'password' => 'required|min:6',
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->mobile_no=$request->mobile_no;
        $user->password=Hash::make($request->password);
        if($user->save()){

            //make login user
            Auth::attempt(['mobile_no' => $request->mobile_no, 'password' => $request->password,'status'=>1]);
            return response()->json([
                'status'=>'SUCCESS',
                'message'=>'Thank you for join with us. Enjoy your online shopping',
                'user'=>Auth::user(),
                'token'=>$user->password
            ]);

        }
        

    }

     //function for password reset 
     public function send_password_reset_code(Request $request){

            $request->validate(['email' => 'required|email']);

                $status = Password::sendResetLink(
                    $request->only('email')
                );
     }

    public function login(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>1])) {
          return response()->json([
              'status'=>'SUCCESS',
              'message'=>'Login successfully',
              'user'=>Auth::user(),
          ]);
        }
        
    }


    public function chekAuthUser(){
        if(Auth::user()){
            return response()->json([
                'status'=>'AUTHORIZED',
                'message'=>'you are login now',
                'user'=>Auth::user(),
            
            ]);
        }else{
            return response()->json([
                'status'=>'UNAUTHORIZED',
                'message'=>'you are not login'
            ]);

        }
    }



    public function logout(){


        if(Auth::logout()){
            
            return response()->json([
                'status'=>'SUCCESS',
                'message'=>'Log out was successfully'
            ]);

        }
    }


  
    public function userProfileUpdate(Request $request){

     //  return $request->all() ;
             $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'mobile_no' => 'required|unique:users,mobile_no,'.Auth::user()->id,
            'address' => 'required',
            'city'=>'required',
           
        ]);

        $user=Auth::user();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->mobile_no=$request->mobile_no;
        $user->address=$request->address;
        $user->city_id=$request->city;

        if ($request->hasFile('image')) {
        //return "yes";
            $file_path = $request->file('image')->store('images/user','public');
            $user->image=$file_path ;

      }
        if($user->save()){
            $customer=Customer::where('phone',$user->mobile_no)->first();
             if($customer){
                $customer->name=$request->name;
                $customer->phone=$request->mobile_no;
                $customer->address=$request->address;
                $customer->city_id=$request->city;
                $customer->save();
            }
         }
     return response()->json([
            'status'=>'SUCCESS',
            'message'=>'your profile was update successfully',
            'user'=>$user
        ]);
  }
     public function updatePassword(Request $request){

        $validatedData = $request->validate([
            'old_password' => 'required ',
            'new_password' => 'required',

        ]);

        $before_update_user=Auth::user();

        $user=User::where('mobile_no',$before_update_user->mobile_no)->first();
        $user_current_password=$user->password;

        if (Hash::check($request->old_password,$user_current_password)) {
            if($request->new_password==$request->old_password){
                return response()->json([
                    "message" => "current password and new password can't be same ",
                ]);
            }else{
                $user->password=Hash::make($request->new_password);  
                    if ($user->save()) {
                        
                        return response()->json([ "success" => "OK", "message" => "password changed successfully" ]);
                    }  
            }
         }else{
             return response()->json([
                "message" => "current password is incorrect! ",
              ]);
         } 
    }

    public function resetCode(Request $request){
       

        $validatedData = $request->validate([
            'email' => 'required|email',
            ]);

          $user=User::where('email',$request->email)->first();
        if(empty($user)){
            return response()->json([
                'status'=>"ERROR",
                'message'=>"Email does not match our records"
            ]);
       }else{
            $code=rand(000000,999999);
            $user->password_reset_token=Hash::make($code);
            $user->save();
            Mail::to($user->email)->send(new userTokenSend($code));

            return response()->json([
                'status'=>"SUCCESS",
                'message'=>"Check your email and verify the six digits code"
            ]);
    }
}

public function codeVerify(Request $request, $email){
    
     $user=User::where('email',$email)->first();
 
     if(!empty($user)){
        if (Hash::check($request->code,$user->password_reset_token)) {
           return response()->json([
                'status'=>"SUCCESS",
                'message'=>"Code matched"
            ]);
        }else{
             return response()->json([
                'status'=>"ERROR",
                'message'=>"Code matching error"
            ]);
        }
     }

}


public function ResetPassword(Request $request,$email){

    $user=User::where('email',$request->email)->first();
    if(!empty($user)){
        $user->password=Hash::make($request->password);
        if($user->save()){
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

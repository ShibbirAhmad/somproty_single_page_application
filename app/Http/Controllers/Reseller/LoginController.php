<?php

namespace App\Http\Controllers\Reseller;

use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('reseller.login');
    }

    public function login(Request $request)
    {

     //    return $request->all();
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
         $credential = ['username' => $request->username, 'password' => $request->password, 'status' => 1];
        if (Auth::guard('reseller')->attempt($credential)) {
            Session::put('reseller', Auth::guard('reseller')->user());
            return redirect()->route('dashboard.reseller');

        } else {
            return back()->with('message', 'username or password incorrect');
        }
    }

    public  function logout(){
        Auth::guard('reseller')->logout();
        session()->forget('reseller');
        return view('reseller.login');
    }
    
     public function passwordReset(Request $request)
     {
        $validator = Validator::make($request->all(), [

            'mobile' => 'required',

        ]);

        if (!$validator->fails()) {


            $mobile = $request->mobile;
            $reseller = Reseller::where('mobile', '0'.$mobile)->first();
            if ($reseller) {
                $code = rand(0, 999999);

                if (\session()->has('reseller_password_reset')) {
                    \session()->forget('reseller_password_reset');
                }

                Session::put('reseller_password_reset', ['code' => $code, 'reseller' => $reseller]);
                Self::codeSend($reseller, $code);
                return response()->json([
                    'success' => "OK",
                    'reseller' => $reseller,
                    'message' => " Hi " . $reseller->name . ', we are send a verification code in your mobile number',
                    'code' => $code,
                    'status' => 'send'

                ]);
            } else {
                return response()->json([
                    'success' => "Faild",
                    'message' => "sorry ! we couldn't find any account againist this mobile number " . $mobile
                ]);
            }

            return response()->json([
                'success' => "Faild",
                'message' => "some thing want to wrong"
            ]);
        }

        return response()->json([
            'success' => 'FALD',
            'message' => $validator->errors()->all()
        ]);
    }


    public function codeVerification(Request $request)
    {
    //     $validator = Validator::make($request->all(), [

    //         'verification_code' => 'required',

    //     ]);

    //     if (!$validator->fails()) {


    //         $sendCode = \session()->get('reseller_password_reset')['code'];
    //         $reseller = \session()->get('reseller_password_reset')['reseller'];

    //         if ($sendCode == $request->verification_code && $reseller) {
    //             return response()->json([
    //                 'success' => "OK",
    //                 'message' => "Code matching",
    //                 'reseller' => $reseller,
    //                 'status' => 'code'
    //             ]);
    //             \session()->forget('reseller_password_reset');
    //         } elseif ($sendCode != $request->verification_code) {
    //             return response()->json([
    //                 'success' => "Faild",
    //                 'message' => " sorry ! , code dosn't match"
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'success' => "Faild",
    //                 'message' => "something want to wrong"
    //             ]);
    //         }
    //     }
    //     return response()->json([
    //         'success' => 'FALD',
    //         'message' => $validator->errors()->all()
    //     ]);


    // }

    // public function changePassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [

    //         'reseller_id' => 'required',

    //     ]);

    //     if (!$validator->fails()) {


    //         $reseller = Reseller::where('id', $request->reseller_id)->first();
    //         if ($reseller) {
    //             $reseller->password = Hash::make($request->password);
    //             if ($reseller->save()) {
    //                 return response()->json([
    //                     'success' => "OK",
    //                     'message' => "Password change successfully. Please login now .",
    //                     'status' => 'change'
    //                 ]);
    //             }
    //         }
    //     }
    //     return response()->json([
    //         'success' => 'FALD',
    //         'message' => $validator->errors()->all()
    //     ]);
    }

    public function codeSend($reseller, $code)
    {

        // $api_key = "C20047545e16e1c02a1b38.69878796";

        // $senderid = 'mohasagor';
        // $sms = "Hi! " . $reseller->name . " You'r password reset code " . $code . " Thank you.";

        // $URL = "http://bulk.fmsms.biz/smsapi?api_key=" . urlencode($api_key) . "&type=text&contacts=" . urlencode("0" . $reseller->mobile) . "&senderid=" . urlencode($senderid) . "&msg=" . urlencode($sms);

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $URL);
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 0);
        // try {
        //     $output = $content = curl_exec($ch);
        //     //  print_r($output);
        // } catch (Exception $ex) {
        //     $output = "-100";
        // }
        // return $output;
    }
    
       public  function showRegister(){
       return view('reseller.register');
    }

    public  function register(Request $request){

 // return $request->all();
        $validatedData = $request->validate([
            'name'  => 'required',
            'company_name'  => 'required|unique:resellers',
            'email'  => 'required|unique:resellers',
            'phone'  => 'required|unique:resellers|digits:11',
            'address'  => 'required',
            'password'  => 'required|min:6',
        ]);
          
          $username=Reseller::max('id')+100;
          $reseller = new Reseller();
          $reseller->name=$request->name ;
          $reseller->username='ms'.''.$username;
          $reseller->company_name=$request->company_name ;
          $reseller->email=$request->email ;
          $reseller->phone=$request->phone ;
          $reseller->bkash_no=$request->bkash_number ;
          $reseller->address=$request->address ?? null;
          $reseller->password=Hash::make($request->password);

          //return $reseller;
          $reseller->status=0;

          if ($request->hasFile('image')) {
               $file_path = $request->file('image')->store('images/reseller','public');
               $reseller->image=$file_path ;
               }

          if($reseller->save()){
              $this->sendMessage($reseller);
              return redirect()->route('reseller.login')->with('message','registered successfully, wait for Admin review');
          }     

        
        
      


    }
        public  function sendMessage($reseller){
        $api_key = "C20047545e16e1c02a1b38.69878796";

        $senderid = '8809601000740';
        $sms="Hi ".$reseller->name.", Thank you for join with us. Your Reseller ID: ".$reseller->username." Login your account here https://mohasagor.com/_reseller/login.";
        $URL = "http://bulk.fmsms.biz/smsapi?api_key=" . urlencode($api_key) . "&type=text&contacts=" . urlencode($reseller->phone) . "&senderid=" . urlencode($senderid) . "&msg=" . urlencode($sms);

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
   

}

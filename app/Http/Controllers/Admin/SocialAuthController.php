<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider){

     return Socialite::driver($provider)->redirect();

 }
     public function callback($provider, Request $request){
        $provider;
        $getInfo = Socialite::driver($provider)->user();
        
     //  return json_encode($getInfo);
        $user = $this->createUser($getInfo,$provider);
        $credential = ['email' => $user->email, 'password'=>123456];
            if (Auth::guard('user')->attempt($credential)) {
              Session::put('frontendUser',Auth::guard('user')->user());
              Session::put('last_login_lang',Auth::guard('user')->user()->last_login_lang);
             if (Session::has('cartInfo')){
            //  return redirect()->route('checkout');
          }
          else{
               //  return redirect('/');
           }
    	}else{
    		Session::flash('flash_error', 'Your Given Credential Is Wrong.');
    		//return redirect()->route('userLogin');
    	}
}
    function createUser($getInfo,$provider){
     
     if($getInfo->email==null){
         
            $user = User::where('email',substr($getInfo->id,-11))->first();
            if(!$user){
            $user=new User();
            $user->full_name=$getInfo->name;
            $user->email=substr($getInfo->id,-11);
            $user->password=Hash::make('123456');
            $user->provider_id=$getInfo->id;
            $user->provider=$provider;
            $user->save(); }
         }else{
            
        $user = User::where('email', $getInfo->email)->first();
       // dd($user);
         if (!$user) {
        $user=new User();
        $user->full_name=$getInfo->name;
        $user->email=$getInfo->email;
        $user->password=Hash::make('123456');
        $user->provider_id=$getInfo->id;
        $user->provider=$provider;
        $user->save();
        }
        
    }return $user;
 }
}

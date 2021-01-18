<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use App\Models\Subscriber;

class SubscriberController extends Controller
{
    

    public   function addSubscriber(Request $request){

            $validator= Validator::make($request->all(),[
                     
                  'email' => 'required|unique:subscribers',
            ]);

            if (!$validator->fails()) {
               
                   $subscriber = new Subscriber() ;
            $subscriber->email = $request->email ;

            if ($subscriber->save()) {
            
                return response()->json([

                  "success" => "OK",
                  "message" => 'Thanks for subscibed us' ,
           
           
                  ]);   
 
            }

            }else{

                return response()->json([

                    "success" => "Fail",
                    "message" => 'this email  already exists',

                ]);
             
            }
         

            

    }




}

<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Contact ;
class ContactController extends Controller
{
    //


    public function contactCustomer(Request $req) {
       
      $validator= Validator::make($req->all(),[            
         'name' => 'required',
         'email' => 'required|email',
         'message' => 'required',
        ]);

       if (!$validator->fails()) {               
                  $contact = new Contact ();
                  $contact->name = $req->name ;
                  $contact->email=$req->email;
                  $contact->message=$req->message;

               if ($contact->save()) {        
                  return response()->json([

                     "success" => "OK",
                     "message" => 'Thank you our customer servie will conatct with you' ,
               ]);  

           }

         } else {
            
            return response()->json([
               "success" => "Fail",
               "message" => 'Message not sent try again ' ,
         ]);

         }

  }






}

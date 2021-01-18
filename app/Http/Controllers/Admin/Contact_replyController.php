<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ReaplyEmail;

use Illuminate\Support\Facades\Mail;

class Contact_replyController extends Controller
{
    
    
    
    public function  reply_contacted_customer(Request $request,$to,$sub,$msg){

          Mail::to($to)->send(new ReaplyEmail($sub,$msg));
          
    }

    




}

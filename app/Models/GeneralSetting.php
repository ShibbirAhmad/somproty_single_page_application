<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
   
     public static function first(){

       return   $general_setting = GeneralSetting::latest()->first();
     }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundAndColor extends Model
{
   
            
     public  static function first(){

         return $color = BackgroundAndColor::latest()->first();
     }



}

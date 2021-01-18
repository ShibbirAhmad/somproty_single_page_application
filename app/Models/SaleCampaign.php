<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleCampaign extends Model
{
          
      public   function  campaign_products(){

           return $this->hasMany('App\Models\Product','product_placement') ;
      }



}

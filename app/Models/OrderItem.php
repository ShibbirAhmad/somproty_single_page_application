<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function attribute(){
        return $this->belongsTo('App\Models\Attribute','attribute_id');
    }
    public function variant(){
         return $this->belongsTo('App\Models\Variant','variant_id');
    }

   
  
  
}

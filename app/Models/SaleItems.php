<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItems extends Model
{
    public function product(){
        
        return $this->belongsTo('App\Models\Product','product_id');
    }
}

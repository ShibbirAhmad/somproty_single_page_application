<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchaseitem extends Model
{
    public function merchant(){
        return $this->belongsTo('App\Models\Merchant','merchant_id');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}

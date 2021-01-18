<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResellerOrderDetails extends Model
{
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id');
    }

    public function reseller(){
          return $this->belongsTo('App\Models\Reseller','reseller_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResellerPayments extends Model
{
    public function reseller(){
        return $this->belongsTo('App\Models\Reseller','reseller_id');
    }
}

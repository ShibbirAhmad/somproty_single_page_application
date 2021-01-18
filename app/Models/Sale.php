<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

      public function getCreatedAtAttribute($attr) {        
        return Carbon::parse($attr)->format('d-m-Y,h:i'); 
    }
    public function company(){
        
        return $this->belongsTo('App\Models\Company','company_id');
    }

    public function saleItems(){
        return $this->hasMany('App\Models\SaleItems','sale_id');
    }
}

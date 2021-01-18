<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }

    public function purchaseItems(){
        return $this->hasMany('App\Models\Purchaseitem','purchase_id');
    }
    
      public function getCreatedAtAttribute($attr) {        
        return Carbon::parse($attr)->format('d-m-Y - h:ia'); 
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    public function getCreatedAtAttribute($attr) {        
        return Carbon::parse($attr)->format('d-m-Y - h:ia'); 
    }
}

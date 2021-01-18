<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function variant(){
        return $this->belongsTo('App\Models\Variant','variant_id');
    }
}

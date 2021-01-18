<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute','attribute_id');
    }
}

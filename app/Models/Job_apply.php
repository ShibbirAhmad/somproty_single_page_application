<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job_apply extends Model
{
     
      public function job(){

            return $this->belongsTo('App\Models\Carrier','id');
      }


}

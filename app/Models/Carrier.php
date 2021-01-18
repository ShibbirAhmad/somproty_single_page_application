<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    //
     public  function applied_user(){

        return $this->hasMany('App\Models\Job_apply','job_id');
     }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public  function subCategory(){
        return $this->hasMany('App\Models\SubCategory','category_id');
    }
    public  function subSubCategory(){
        return $this->hasMany('App\Models\SubSubCategory','category_id');
    }

    public  function product(){

        return $this->hasMany('App\Models\Product','category_id');

    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public  function subCategory(){
        return $this->belongsTo('App\Models\SubCategory','subcategory_id');
    }

      public function products()
    {
        return $this->hasMany('App\Models\Product','sub_sub_category_id')->where('status',1);

    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'name',
        'merchant_id',
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
        'product_code',
        'product_code',
        'slug',
        'stock',
        'sale_price',
        'discount',
        'price',
        'status',
        'details',
        'product_placement',
        'product_position',
        'purchase_price'
    ];

    public function productImage()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id');
    }

    public function productAttribute()
    {
        return $this->hasOne('App\Models\ProductAttribute', 'product_id');
    }

    public function productVariant()
    {
        return $this->hasMany('App\Models\ProductVariant', 'product_id');
    }

    public  function supplier(){
        return $this->belongsTo('App\Models\Supplier','merchant_id');
    }

    public  function productBarcode(){
        return $this->hasOne('App\Models\ProductBarcode','product_id');
    }

     public function purchaseItem()
    {
        return $this->hasMany('App\Models\Purchaseitem','product_id');

    }
}

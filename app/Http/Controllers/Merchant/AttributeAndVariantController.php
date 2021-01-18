<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Attribute;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeAndVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::orderBy('id', 'DESC')->get();
        return response()->json([
            'attributes' => $attributes,
            'status' => 'SUCCESS'
        ]);
    }


   
    public function variant()
    {
        $variants = Variant::orderBy('id', 'DESC')->with('attribute')->get();
        return response()->json([
            'variants' => $variants,
            'status' => 'SUCCESS'
        ]);
    }
  

    public  function attributeWiseVariant($id){
        $variants=Variant::whereIn('attribute_id',[$id])->get();
        if ($variants){
            return response()->json([
                'status' => 'SUCCESS',
                'variants' => $variants
            ]);
        }

    }

}

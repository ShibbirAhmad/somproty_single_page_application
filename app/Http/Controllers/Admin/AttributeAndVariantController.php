<?php

namespace App\Http\Controllers\Admin;

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


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:attributes',

        ]);
        $attribute = new Attribute();
        $attribute->name = $request->name;
        if ($attribute->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'attribute add successfully'
            ]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function active($id)
    {

        $attribute = Attribute::find($id);
        $attribute->status = 1;
        if ($attribute->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'attribute active successfully'
            ]);
        }

    }

    public function deActive($id)
    {

        $attribute = Attribute::find($id);
        $attribute->status = 0;
        if ($attribute->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'attribute de-active successfully'
            ]);
        }

    }

    public function variant()
    {
        $variants = Variant::orderBy('id', 'DESC')->with('attribute')->get();
        return response()->json([
            'variants' => $variants,
            'status' => 'SUCCESS'
        ]);
    }

    public function activeVariant($id)
    {

        $variant = Variant::find($id);
        $variant->status = 1;
        if ($variant->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'variant active successfully'
            ]);
        }

    }

    public function deActiveVariant($id)
    {

        $variant = Variant::find($id);
        $variant->status = 0;
        if ($variant->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'variant de-active successfully'
            ]);
        }

    }

    public function storeVariant(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:variants',
            'attribute' => 'required',

        ]);
        $variant = new Variant();
        $variant->name = $request->name;
        $variant->attribute_id = $request->attribute;
        if ($variant->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Variant add successfully'
            ]);
        }
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

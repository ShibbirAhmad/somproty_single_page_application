<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subSubCategories = SubSubCategory::orderby('id', 'desc')->with(['category','subCategory'])->paginate(10);
        return response()->json([
            'subSubCategories' => $subSubCategories,
            'status' => 'SUCCESS'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_sub_categories',
            'category' => 'required',
            'subcategory' => 'required',

        ]);

         //for slug
         $id =SubSubCategory::max('id') ?? 0;
         $sub_sub_category_code = 1000 + $id;
         $slug=explode(" ", $request->name);

        $subSubCategory = new SubSubCategory();
        $subSubCategory->name = $request->name;
        $subSubCategory->category_id = $request->category;
        $subSubCategory->subcategory_id = $request->subcategory;
        $subSubCategory->slug = $sub_sub_category_code. '-' .$slug[count($slug)-1];   //make sub_category-category slug.

        $subSubCategory->status = 1;
        if ($request->hasFile('image')) {
            $validatedData = $request->validate([
                //'image' => 'required|file|image|dimensions:max_width=1000,max_height=1000',
            ]);
            $path = $request->file('image')->store('images/subSubCategory', 'public');
            $subSubCategory->image = $path;
        }
        if ($subSubCategory->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'sub-sub category add successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subSubCategory=SubSubCategory::find($id);
        if ($subSubCategory){
            return  response()->json([
                'status'=>'SUCCESS',
                'subSubCategory'=>$subSubCategory
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_sub_categories,name,'.$id,
            'category' => 'required',
            'subcategory' => 'required',

        ]);

        $subSubCategory = SubSubCategory::find($id);
        $subSubCategory->name = $request->name;
        $subSubCategory->category_id = $request->category;
        $subSubCategory->subcategory_id = $request->subcategory;
        $subSubCategory->status = 1;
        $subSubCategory->show_homepage = $request->show_home_page;
        if ($request->hasFile('image')) {
            $validatedData = $request->validate([
                //'image' => 'required|file|image|dimensions:max_width=1000,max_height=1000',
            ]);
            $path = $request->file('image')->store('images/subSubCategory', 'public');
            $subSubCategory->image = $path;
        }
        if ($subSubCategory->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'sub-sub category update successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function active($id)
    {
        $subSubCategory = SubSubCategory::find($id);
        if ($subSubCategory) {
            $subSubCategory->status = 1;
            if ($subSubCategory->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'sub-sub category active successfully'
                ]);
            }
        }
    }

    public function deActive($id)
    {
        $subSubCategory = SubSubCategory::find($id);
        if ($subSubCategory) {
            $subSubCategory->status = 0;
            if ($subSubCategory->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'sub-sub category de-active successfully'
                ]);
            }
        }
    }

    public function search($search)
    {
        $subSubCategories = SubSubCategory::where('name', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->with(['category','subCategory'])->paginate(10);

        if ($subSubCategories) {
            return response()->json([
                'subSubCategories' => $subSubCategories,
                'status' => 'SUCCESS'
            ]);
        }
    }
}

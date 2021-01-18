<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::orderby('id', 'desc')->with('category')->paginate(10);
        return response()->json([
            'subCategories' => $subCategories,
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:sub_categories',
            'category' => 'required',

        ]);


        //for slug
        $id =SubCategory::max('id') ?? 0;
        $sub_category_code = 1000 + $id;
        $slug=explode(" ", $request->name);
        //

        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category;
        $subCategory->status = 1;
        $subCategory->slug = $sub_category_code. '-' .$slug[count($slug)-1];   //make category slug.

        if ($request->hasFile('image')) {
            $validatedData = $request->validate([
                //'image' => 'required|file|image|dimensions:max_width=1000,max_height=1000',
            ]);
            $path = $request->file('image')->store('images/subCategory', 'public');
            $subCategory->image = $path;
        }
        if ($subCategory->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'sub category add successfully'
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategories = SubCategory::find($id);
        if ($subCategories) {
            return response()->json([
                'status' => 'SUCCESS',
                'subCategory' => $subCategories,
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_categories,name,'.$id,
            'category' => 'required',

        ]);
        $subCategory =SubCategory::find($id);
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category;
        $subCategory->status = 1;
        if ($request->hasFile('image')) {
            $validatedData = $request->validate([
                //'image' => 'required|file|image|dimensions:max_width=1000,max_height=1000',
            ]);
            $path = $request->file('image')->store('images/subCategory', 'public');
            $subCategory->image = $path;
        }
        if ($subCategory->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'sub category update successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search($search)
    {
        $subCategories = SubCategory::where('name', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->with('category')->paginate(10);

        if ($subCategories) {
            return response()->json([
                'subCategories' => $subCategories,
                'status' => 'SUCCESS'
            ]);
        }
    }

    public function active($id)
    {
        $subCategories = SubCategory::find($id);
        if ($subCategories) {
            $subCategories->status = 1;
            if ($subCategories->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'sub category active successfully'
                ]);
            }
        }
    }

    public function deActive($id)
    {
        $subCategories = SubCategory::find($id);
        if ($subCategories) {
            $subCategories->status = 0;
            if ($subCategories->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'sub category de-active successfully'
                ]);
            }
        }
    }

    public function subCategoryWiseSubCategory($id){
        $subSubCategory=SubSubCategory::where('subcategory_id',$id)->get();
        if ($subSubCategory){
            return response()->json([
                'status'=>'SUCCESS',
                'subsubcategories'=>$subSubCategory
            ]);
        }
    }

}

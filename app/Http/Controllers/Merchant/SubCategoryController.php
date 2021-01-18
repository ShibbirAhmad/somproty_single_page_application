<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    
    public function index()
    {
        $subCategories = SubCategory::orderby('id', 'desc')->with('category')->paginate(10);
        return response()->json([
            'subCategories' => $subCategories,
            'status' => 'SUCCESS'
        ]);
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

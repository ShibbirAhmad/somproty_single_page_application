<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderby('id', 'desc')->paginate(10);
        return response()->json([
            'categories' => $categories,
            'status' => 'SUCCESS'
        ]);
    }

   
    public function categoryWiseSubCategory($id){

     //   return $id;
        $subCategories=SubCategory::where('category_id',$id)->get();
        if ($subCategories){
            return response()->json([
                'status' => 'SUCCESS',
                'subCategories' =>$subCategories
            ]);
        }
    }

}

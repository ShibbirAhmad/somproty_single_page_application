<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Variant;
use App\Models\City;
use App\Models\Courier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;

class OthersController extends Controller
{
    public function others()
    {
        $categories = Category::where('status', 1)->get();
        $suppliers = Supplier::where('status', 1)->get();
        $attributes = Attribute::where('status', 1)->get();
        $variants = Variant::where('status', 1)->get();
        $subcategories=SubCategory::where('status',1)->get();
        $SubSubcategories=SubSubCategory::where('status',1)->get();
        $cities=City::where('status',1)->get();
        $couriers=Courier::where('status',1)->get();
        return response()->json([
            'status' => 'SUCCESS',
            'categories' => $categories,
            'subCategories' => $subcategories,
            'subSubCategories' => $SubSubcategories,
            'suppliers' => $suppliers,
            'attributes' => $attributes,
            'variants'=>$variants,
            'cities'=>$cities,
            'couriers'=>$couriers
        ]);
    }

}

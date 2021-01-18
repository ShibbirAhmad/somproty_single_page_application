<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackgroundAndColor;

class ThemeSettingController extends Controller
{
      
    public function get_theme_info() {

        $setting = BackgroundAndColor::latest()->take(1)->first();
        if ($setting) {
            return response()->json([
                "status" => "OK",
                "setting" => $setting ,
            ]);
        }

  }

 
public function edit_theme_info(Request $request,$id)
  {
    
        $setting = BackgroundAndColor::findOrFail($id);
        $setting->primary_color=$request->primary_color;
        $setting->primary_background_color=$request->primary_background_color;
        $setting->menu_background_color=$request->menu_background_color;
        $setting->sub_menu_background_color=$request->sub_menu_background_color;
        $setting->primary_text_color=$request->primary_text_color;
        $setting->menu_text_color=$request->menu_text_color;
        $setting->sub_menu_text_color=$request->sub_menu_text_color;

        if ($setting->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Theme updated successfully',
            ]);
        }

    }




  
}

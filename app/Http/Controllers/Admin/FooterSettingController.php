<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FooterSetting;

class FooterSettingController extends Controller
{
    

        
    public function get_footer_info() {

        $setting = FooterSetting::latest()->take(1)->first();
        if ($setting) {
            return response()->json([
                "status" => "OK",
                "setting" => $setting ,
            ]);
        }

  }

 
public function edit_footer_info(Request $request,$id)
  {
    
        $setting = FooterSetting::findOrFail($id);
        $setting->facebook_url=$request->facebook_url;
        $setting->twitter_url=$request->twitter_url;
        $setting->youtube_url=$request->youtube_url;
        $setting->linkedin_url=$request->linkedin_url;
        $setting->copyright_info=$request->copyright_info;
        $setting->footer_description=$request->footer_description;
      
    
        if ($setting->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Footer information updated successfully',
            ]);
        }

  }




}

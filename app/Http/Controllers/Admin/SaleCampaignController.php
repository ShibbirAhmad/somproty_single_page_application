<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SaleCampaign ;

class SaleCampaignController extends Controller
{
      
    
    
public function get_sale_campaign_list() {

        $sale_campaigns = SaleCampaign::orderBy('id','desc')->get();
            return response()->json([
                'status' => "OK",
                 'sale_campaigns' => $sale_campaigns,
            ]);


}
 

   
public function store_sale_campaign(Request $request)
 {

      $validatedData = $request->validate([
          'name'  => 'required',
          'expired_date'  => 'required',
          'border_width'  => 'required',
          
      ]);
    
      $sale_campaign =new SaleCampaign();
      $sale_campaign->name=$request->name;
      $sale_campaign->expired_date=$request->expired_date;
      $sale_campaign->background_color=$request->background_color;
      $sale_campaign->border_color=$request->border_color;
      $sale_campaign->border_width=$request->border_width;
      $sale_campaign->order_by=$request->order_by;
      $sale_campaign->status=1;
 
      if ($sale_campaign->save()) {
          return response()->json([
              'status' => 'SUCCESS',
              'message' => 'Sale capmaign addedsuccessfully',
          ]);
      }else{
          return response()->json([
              'status' => 'FAIL',
              'message' => 'Expire date is required and something went wrong',
          ]); 
      }
}




public function active_sale_campaign($id) {

    $sale_campaign = SaleCampaign::findOrFail($id);
    $sale_campaign->status=1 ;
    if ($sale_campaign->save()) {
        return response()->json([
            "status" => "OK",
            "message" => "this campaign activated",
        ]);
    }

}




public function de_active_sale_campaign($id) {

    $sale_campaign = SaleCampaign::findOrFail($id);
    $sale_campaign->status=0 ;
    if ($sale_campaign->save()) {
        return response()->json([
            "status" => "OK",
            "message" => "this campaign de-activated",
        ]);
     }
  }




public function destroy_sale_campaign($id) {

        $sale_campaign = SaleCampaign::findOrFail($id);
        if ($sale_campaign->delete()) {
            return response()->json([
                "status" => "OK",
                "message" => "this campaign destroyed",
            ]);
    }
 }






public function get_edit_campaign($id) {

    $sale_campaign = SaleCampaign::findOrFail($id);
        return response()->json([  
            'status' => "OK",
            'sale_campaign'=>$sale_campaign,
        ]);
    
     }


     

     
public function update_sale_campaign(Request $request,$id){

    $validatedData = $request->validate([
        'name'  => 'required',
        'expired_date'  => 'required',
        'border_width'  => 'required',
        
    ]);
  
    $sale_campaign = SaleCampaign::findOrFail($id);
    $sale_campaign->name=$request->name;
    $sale_campaign->expired_date=$request->expired_date;
    $sale_campaign->background_color=$request->background_color;
    $sale_campaign->border_color=$request->border_color;
    $sale_campaign->border_width=$request->border_width;
    $sale_campaign->order_by=$request->order_by;
    $sale_campaign->status=1;

    if ($sale_campaign->save()) {
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Sale capmaign updated successfully',
        ]);
    }else{
        return response()->json([
            'status' => 'FAIL',
            'message' => 'Expire date is required and something went wrong',
        ]); 
     }

 }




}
 









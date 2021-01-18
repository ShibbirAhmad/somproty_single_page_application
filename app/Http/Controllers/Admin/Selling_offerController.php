<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Selling_offer ;

class Selling_offerController extends Controller
{
    public  function getSellingOffer(Request $request){
        $item = $request->item ?? 10 ;
        $sellingOffer= Selling_offer::orderBy('id','DESC')->paginate($item);
        return response()->json([
            "success" => "OK",
            "sellingOffer" => $sellingOffer ,
        ]);
    }
    


    public function addSellingOffer(Request $request){
          
        $validatedData = $request->validate([
            'name'  => 'required',
            'expire_date'  => 'required',
            
        ]);
          
           $offer= new Selling_offer ();
           $offer->name=$request->name;  
           $offer->order_by=1;  
           $offer->status=1;  
           $offer->expire_date=$request->expire_date;  
           
           if ($offer->save()) {

            return response()->json([
                "success" => "OK",
                "message" => 'Selling Offer added successfully ' ,
            ]);

           }else{

            return response()->json([
                "success" => "OK",
                "message" => 'Something went wrong , try again ' ,
            ]); 

           }

    }



    
    public function editSellingOffer(Request $request,$id){
        
        $validatedData = $request->validate([
            'name'  => 'required',
            'expire_date'  => 'required',
            'order_by'  => 'required',
            
        ]);
           
           $offer= Selling_offer::find($id);
           $offer->name=$request->name;  
           $offer->order_by=$request->order_by;  
           $offer->status=1;  
           $offer->expire_date=$request->expire_date;  
           
           if ($offer->save()) {

            return response()->json([
                "success" => "OK",
                "message" => 'Selling Offer added successfully ' ,
            ]);

           }else{

            return response()->json([
                "success" => "OK",
                "message" => 'Something went wrong , try again ' ,
            ]); 

           }
    }


    public function findEditSellingOffer($id){
        
        $offer= Selling_offer::find($id);
            return response()->json([
                "offer" => $offer ,
            ]);
        
    }

    public function activeSellingOffer($id){
       
        $offer= Selling_offer::find($id);
        $offer->status=1 ;
        if ($offer->save()) {
           
            return response()->json([
                "success" => "OK",
                "message" => 'This offer activated ' ,
            ]);
        }
    }


    public function deactiveSellingOffer($id){
        
        $offer= Selling_offer::find($id);
        $offer->status=0 ;
        if ($offer->save()) {
           
            return response()->json([
                "success" => "OK",
                "message" => 'This offer de-activated ' ,
            ]);
        }
    }



    
}

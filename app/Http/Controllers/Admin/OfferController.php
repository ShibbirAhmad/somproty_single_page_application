<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{

    public function index()
    {
        $offers = Offer::orderBy('id', 'DESC')->paginate(5);
        return response()->json([
            'offers' => $offers,
            'status' => 'SUCCESS'
        ]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|',
            'url' => 'required',
        ]);

        $offer=new Offer();
        if ($request->hasFile('image')){
            $path = $request->file('image')->store('images/offer', 'public');
            $offer->image = $path;
        }
        $offer->url=$request->url;
        if ($offer->save()){
            return response()->json([
                'status'=>'SUCCESS',
                'message'=>'offer was created successfully'
            ]);
        }


    }


    public function active($id)
    {
      $offer=Offer::find($id);
      if ($offer){
          $offer->status=1;
          if ($offer->save()){
              return response()->json([
                  'status'=>'SUCCESS',
                  'message'=>'offer was active successfully'
              ]);
          }
      }
    }


    public function deActive($id)
    {
        $offer=Offer::find($id);
        if ($offer){
            $offer->status=0;
            if ($offer->save()){
                return response()->json([
                    'status'=>'SUCCESS',
                    'message'=>'offer was De-active successfully'
                ]);
            }
        }
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $offer=Offer::find($id);
        if ($offer){
            if ($offer->delete()){
                return response()->json([
                    'status'=>'SUCCESS',
                    'message'=>'offer was removed'
                ]);
            }
        }
    }




   public  function  get_edit_offer_item($id){
          
          $offer = Offer::findOrFail($id);
          return response()->json([ 
                'status' => "OK",
                'offer' => $offer ,
            ]); 
   }




   
   public function edit_offer_item(Request $request,$id)
   {
       $this->validate($request, [
           'url' => 'required',
       ]);

       $offer=Offer::findOrFail($id);
       if ($request->hasFile('image')){
           if (file_exists("storage/".$offer->image)) {
               unlink("storage/".$offer->image) ;
           }
           $path = $request->file('image')->store('images/offer', 'public');
           $offer->image = $path;
       }
       $offer->url=$request->url;
       if ($offer->save()){
           return response()->json([
               'status'=>'SUCCESS',
               'message'=>'offer updated successfully'
           ]);
       }


   }



}

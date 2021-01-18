<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCity;

class SubCityController extends Controller
{
   


    public function get_sub_city_list()
    {
        $cities = SubCity::orderBy('id', 'desc')->with('city')->paginate(20);
        return response()->json([
            'status' => 'SUCCESS',
            'cities' => $cities,
        ]);
    }




    public function store_sub_city(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_cities',
            'city_id' => 'required',
        ]);

        $city = new SubCity();
        $city->city_id = $request->city_id;
        $city->name = $request->name;
        $city->status = 1;
        if ($city->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "city add successfully"
            ]);
        }else{
            return response()->json([
                'status' => 'FAIL',
                'message' => "Failed"
            ]);  
        }
    }

 
    public function get_edit_item($id)
    {
        $city = SubCity::find($id);
        if ($city) {
            return response()->json([
                'status' => 'SUCCESS',
                'city' => $city
            ]);
        }

    }



    public function update_sub_city(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_cities,name,'.$id,
            'city_id' => 'required',
        ]);

        $city = SubCity::find($id);
        if ($city) {
            $city->city_id = $request->city_id;
            $city->name = $request->name;
            $city->status = 1;
            if ($city->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => "city updated successfully"
                ]);
            }else{
                return response()->json([
                    'status' => 'FAIL',
                    'message' => "city updated failed"
                ]);
            }
        }

    }


    public function active_city($id)
    {
        $city = SubCity::find($id);
        if ($city) {
            $city->status = 1;
            if ($city->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'city active successfully'
                ]);
            }
        }
    }

    public function de_active_city($id)
    {
        $city = SubCity::find($id);
        if ($city) {
            $city->status = 0;
            if ($city->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'city de-active successfully'
                ]);
            }
        }
    }

    
      public function search_sub_city($data){
              
           $cities = SubCity::where('name','like','%'.$data.'%')->with('city')->paginate(20);
           return response()->json(['cities'=>$cities]);   
      }





}

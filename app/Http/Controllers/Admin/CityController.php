<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'status' => 'SUCCESS',
            'cities' => $cities
        ]);
    }


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
            'name' => 'required|unique:cities|',
            'delivery_charge' => 'required|numeric',
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->delivery_charge = $request->delivery_charge;
        if ($city->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "city add successfully"
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        if ($city) {
            return response()->json([
                'status' => 'SUCCESS',
                'city' => $city
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
            'name' => 'required|',
            'delivery_charge' => 'required',
        ]);

        $city = City::find($id);
        if ($city) {
            $city->name = $request->name;
            $city->delivery_charge = $request->delivery_charge;
            if ($city->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => "city Update successfully"
                ]);
            }
        }

    }


    public function destroy($id)
    {
        //
    }

    public function active($id)
    {
        $city = City::find($id);
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

    public function deActive($id)
    {
        $city = City::find($id);
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

    
      public function search_city($data){
              
           $cities = City::where('name','like','%'.$data.'%')->paginate(20);
           return response()->json(['cities'=>$cities]);   
      }



}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourierController extends Controller
{


    public function index()
    {
        $courier = Courier::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'status' => 'SUCCESS',
            'couriers' => $courier
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:couriers|',

        ]);

        $courier = new Courier();
        $courier->name = $request->name;
        if ($courier->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "courier add successfully"
            ]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $courier = Courier::find($id);
        if ($courier) {
            return response()->json([
                'status' => 'SUCCESS',
                'courier' => $courier
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|',
        ]);

        $courier = courier::find($id);
        if ($courier) {
            $courier->name = $request->name;
            if ($courier->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => "courier Update successfully"
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
        $courier = courier::find($id);
        if ($courier) {
            $courier->status = 1;
            if ($courier->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'courier active successfully'
                ]);
            }
        }
    }

    public function deActive($id)
    {
        $courier = courier::find($id);
        if ($courier) {
            $courier->status = 0;
            if ($courier->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'courier de-active successfully'
                ]);
            }
        }
    }


    
    public function search_courier($data){
              
        $couriers = Courier::where('name','like','%'.$data.'%')->paginate(20);
        return response()->json(['couriers'=>$couriers]);   
     }



}

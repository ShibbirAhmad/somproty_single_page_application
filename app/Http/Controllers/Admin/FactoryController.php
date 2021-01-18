<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Factory ;

class FactoryController extends Controller
{
    public function index()
    {
        $factories = Factory::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'status' => 'SUCCESS',
            'factories' => $factories
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:factories',

        ]);
        $factory = new Factory();
        $factory->name = $request->name;
        $factory->address = $request->address;
        if ($factory->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "factory add successfully"
            ]);
        }
    }


    public function edit($id)
    {
        $factory = Factory::find($id);
        if ($factory) {
            return response()->json([
                'status' => 'SUCCESS',
                'factory' => $factory
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:factories,name,'.$id,
        ]);

        $factory = Factory::find($id);
        $factory->name = $request->name;
        $factory->address = $request->address;
        if ($factory->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "factory Update successfully"
            ]);
        }
    

    }




    public function active($id)
    {
        $factory = Factory::find($id);
        if ($factory) {
            $factory->status = 1;
            if ($factory->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'factory active successfully'
                ]);
            }
        }
    }

    public function deActive($id)
    {
        $factory = Factory::find($id);
        if ($factory) {
            $factory->status = 0;
            if ($factory->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'factory de-active successfully'
                ]);
            }
        }
    }
}

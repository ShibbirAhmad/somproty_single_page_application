<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Loaner;

class LoanerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loaners=Loaner::all();

        return \response()->json([
            'success'=>"OK",
            'loaners'=>$loaners
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
         $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:loaners|digits:11',
            'address'=>"required"
          ]);

          $loaner=new Loaner();
          $loaner->name=$request->name;
          $loaner->phone=$request->phone;
          $loaner->address=$request->address;
          $loaner->email=$request->email??null;
          if($loaner->save()){
              return \response()->json([
                  'success'=>"OK",
                  'message'=>"Loaner Was Add"
              ]);
          }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeLoan(Request $request){
        return $request->all();
    }
}

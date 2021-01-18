<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Models\Category_slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('id', 'DESC')->paginate(5);
        return response()->json([
            'sliders' => $sliders,
            'status' => 'SUCCESS'
        ]);
    }

    public  function getEditSlider($id){
            
             $slider = Slider::find($id);
             if ($slider) {
                 return response()->json([
                     "success" => "OK",
                     "slider" => $slider ,
                 ]);
             }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required',
            'page_position' => 'required',
        ]);

        $slider = new Slider();
        $slider->status = 1;
        $slider->page_position = $request->page_position;
        $slider->url=$request->url;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/slider', 'public');
            $slider->image = $path;
        }
        if ($slider->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'slider add successfully'
            ]);
        }

    }

    public function updateSlider(Request $request , $id){
           $validatedData = $request->validate([
               'url' => 'required',
               'page_position' => 'required',
           ]);

           $slider = Slider::find($id);
           $slider->url=$request->url ;
           $slider->page_position=$request->page_position;
           if ($request->hasFile('image')) {
               if (file_exists('storage/'.$slider->image)) {
                   unlink('storage/'.$slider->image);
               }
                $path = $request->file('image')->store('images/slider', 'public');
                $slider->image=$path ;
                if($slider->save()){
                   
                    return response()->json([
                        'status' => 'SUCCESS',
                        'message' => 'slider updated successfully',
                    ]);
                      
                }
           }
         
    }


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            if ($slider->delete()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'slider delete successfully'
                ]);
            }
        }
    }


    public function active($id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            $slider->status = 1;
            if ($slider->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'slider active successfully'
                ]);
            }
        }
    }

    public function deActive($id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            $slider->status = 0;
            if ($slider->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'slider de-active successfully'
                ]);
            }
        }
    }





    //function for display category slider 
    public function category_slider_index(){

        $sliders = Category_slider::orderBy('id', 'DESC')->paginate(10);
        return response()->json([
            'sliders' => $sliders,
            'status' => 'SUCCESS'
        ]);
    }



    public function category_slider_store(Request $request){

                $validatedData = $request->validate([
                    'image' => 'required',
                    'page_position' => 'required',
                ]);

                $slider = new Category_slider();
                $slider->status = 1;
                $slider->page_position = $request->page_position;
                $slider->url=$request->url;
                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('images/category_slider', 'public');
                    $slider->image = $path;
                }
                if ($slider->save()) {
                    return response()->json([
                        'status' => 'SUCCESS',
                        'message' => 'slider add successfully'
                    ]);
                }             
    }



    public function get_category_slider_edit($id){

        $slider = Category_slider::find($id);
        if ($slider) {
            return response()->json([
                "success" => "OK",
                "slider" => $slider ,
            ]);
        }
    }



    public function update_category_slider(Request $request, $id){

            $validatedData = $request->validate([
                'page_position' => 'required',
            ]);

           // return $request->all();
            $slider = Category_slider::find($id);
            $slider->page_position=$request->page_position;
            $slider->url=$request->url;
            if ($request->hasFile('image')) {
                if (file_exists('storage/'.$slider->image)) {
                    unlink('storage/'.$slider->image);
                }
                $path = $request->file('image')->store('images/category_slider', 'public');
                $slider->image=$path ;
                
            }
            if($slider->save()){
                    
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'slider updated successfully',
                ]);
                
            }
      
    }

    

    public function active_category_slider($id){
           
        $slider = Category_slider::find($id);
        if ($slider) {
            $slider->status = 1;
            if ($slider->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'slider active successfully'
                ]);
            }
        }
             
    }




    public function deActive_category_slider($id){

        $slider = Category_slider::find($id);
        if ($slider) {
            $slider->status = 0;
            if ($slider->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'slider de-active successfully'
                ]);
            }
        }
    }



    public function destroy_category_slider($id){

        $slider = Category_slider::find($id);
        if ($slider) {
            if ($slider->delete()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'slider delete successfully'
                ]);
            }
        }


    }









}

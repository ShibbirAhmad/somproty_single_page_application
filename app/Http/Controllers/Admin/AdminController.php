<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Contracts\Session\Session;
use Image;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{


    public function __construct(Request $request)
    {
        $this->middleware('admin');
        if(!$request->ajax()){
          return abort(404);
        }
        
    }
    public function index(Request $request)
    {

        $items = $request->item ?? 10;
        $admins = Admin::orderby('id', 'desc')->paginate($items);
        return response()->json([
            'admins' => $admins,
            'status' => 'SUCCESS'
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

        $validatedData = $request->validate([
            'email' => 'required ',
            'password' => 'required',
            'name' => 'required',


        ]);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);

        if ($request->hasFile('image')) {

            //validate image size || dimensions
            $validatedData = $request->validate([
                'image' => 'required|file|image|dimensions:max_width=1000,max_height=1000',
            ]);
            $path = $request->file('image')->store('images/admin', 'public');
            $admin->image = $path;
        }
        if ($admin->save()) {

           
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'admin add successfully'
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


    public function edit($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            return response()->json([
                'status' => 'SUCCESS',
                'admin' => $admin
            ]);
        }


    }


    public function search_admin($data){

        $admins = Admin::Where('email','like','%'.$data.'%')
                      ->orWhere('name','like','%'.$data.'%')
                      ->paginate(10);

            return response()->json([
                 "status" => "OK",
                 'admins' => $admins ,
            ]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {

        //return $request->all();
        $validatedData = $request->validate([
            'email' => 'required ',
            'name' => 'required',


        ]);

     //   return $request->all();

        $admin =Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->hasFile('image')) {
             
            $path = $request->file('image')->store('images/admin', 'public');
            $admin->image = $path;
        }  
        if ($admin->save()) {

            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'admin update successfully'
            ]);
        }
    }


    public function updatePassword(Request $request , $id){

        $validatedData = $request->validate([
            'old_password' => 'required ',
            'new_password' => 'required',

        ]);

        $admin= Admin::find($id);
        $admin_current_password=$admin->password;

        if (Hash::check($request->old_password,$admin_current_password)) {
            if($request->new_password==$request->old_password){
                return response()->json([
                    "message" => "current password and new password can't be same ",
                ]);
            }else{
                $admin->password=Hash::make($request->new_password);  
                    if ($admin->save()) {
                        return response()->json([ "success" => "OK", "message" => "password changed successfully" ]);
                    }  
            }
         }else{
             return response()->json([
                "message" => "current password is incorrect! ",
              ]);
         } 
        

           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }

    public function deactive($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->status = 0;
            if ($admin->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'admin deactive successfully'
                ]);
            }
        }
    }


  public function active($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->status = 1;
            if ($admin->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'admin active successfully'
                ]);
            }
        }
    }


    public function getAdminRole($id){
        $roles=Role::all();
        $admin=Admin::find($id);
        $admin_roles=DB::table('model_has_roles')->where('model_id',$id)->select('role_id')->pluck('role_id');
        return response()->json([
            'roles'=>$roles,
            'admin_roles'=>$admin_roles,
            'admin'=>$admin
        ]);
    }

    public function updateAdminRole(Request $request, $id){

       // return $request->all();
         $admin=Admin::find($id);
         $admin_roles=DB::table('model_has_roles')->where('model_id',$id)->delete();

         foreach($request->role as $role_id){
         $role=Role::where('id',$role_id)->first();
          $admin->assignRole($role);
       }
     return \response()->json('Adim Assign Role Updated');

    }



    public function getAdminPermission($id){

          $permissions = Permission::all();
          $admin_name=Admin::where('id',$id)->select('name')->get();
         $admin_has_permissions_id=DB::table('model_has_permissions')->where('model_id',$id)->select('permission_id')->pluck('permission_id') ;
          return response()->json([

              "status" => "OK",
              "permissions" => $permissions ,
              "admin_name"   => $admin_name ,
              "admin_has_permissions_id" => $admin_has_permissions_id ,
              
          ]);
    }



    
    public function assignAdminPermission(Request $request , $id){

      //  $model = Permission::findOrFail($id);
        $admin=Admin::findOrFail($id);

        //delete the previous permisson
        $model_has_permissons=DB::table('model_has_permissions')->where('model_id',$id)->delete();

        //insert the new permison
        foreach($request->permissons_id as $permison_id){
           $permission=Permission::where('id',$permison_id)->first();
           $admin->givePermissionTo($permission);
         }

       return response()->json([

            "status" => "OK",
            "message" => "Permission assigned successfully" ,
            
        ]);
  }




       
    
}

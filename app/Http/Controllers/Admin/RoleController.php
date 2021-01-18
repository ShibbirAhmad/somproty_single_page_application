<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    
   public function __construct(Request $request)
    {
        $this->middleware('admin');
        if(!$request->ajax()){
            abort(404);
        }
        
    }
    public function index()
    {

        // Permission::create([
        //     'name'=>'cancel credit',
        //     'guard_name'=>'admin'
        // ]);

        //   Permission::create([
        //     'name'=>'edit credit',
        //     'guard_name'=>'admin'
        // ]);

        //  Permission::create([
        //     'name'=>'cancel debit',
        //     'guard_name'=>'admin'
        // ]);

        //   Permission::create([
        //     'name'=>'edit debit',
        //     'guard_name'=>'admin'
        // ]);
        
        $roles=Role::all();
        return \response()->json($roles);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
            $validatedData = $request->validate([
            'name' => 'required|unique:roles',
            ]);

            $role = Role::create([
                'name' => $request->name,
                'guard_name'=>'admin'
          ]);
        return \response()->json('Role Was created');
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        //
    }

  
     
    public function update(Request $request, $id)
    {
       
    }

    public function destroy($id)
    {
       
    }


    public function editRolePermissons($id){
        $role=Role::find($id);
        $permissons=Permission::all();
         $role_has_permissons=DB::table('role_has_permissions')->where('role_id',$id)->select('permission_id')->pluck('permission_id');
        return \response()->json([
            'permissons'=>$permissons,
            'role'=>$role,
            'role_has_permissons'=>$role_has_permissons
        ]);
    }

    public function updateRolePermissons(Request $request,$id){

         $role=Role::find($id);

         //delete the previous permisson
         $role_has_permissons=DB::table('role_has_permissions')->where('role_id',$id)->delete();

         //insert the new permison
         foreach($request->permissons_id as $permison_id){
            $permission=Permission::where('id',$permison_id)->first();
            $role->givePermissionTo($permission);
          }

          return \response()->json('Permisson assign updated Successfully');
     }
}

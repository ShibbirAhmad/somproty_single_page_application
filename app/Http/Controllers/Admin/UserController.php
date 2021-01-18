<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Exports\UsersExport ;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    
    public function getUser(Request $request){

            $item=$request->item??10;
             $users= User::orderBy('id','DESC')->with('userCity')->paginate($item);
             return response()->json([
                'success' => 'OK',
                'users' => $users,
               
            ]);
      }
   
       
     public function search_user(Request $request,$data){
        $item=$request->item??10;
            $users = User::where('name','like','%'.$data.'%')->orWhere('mobile_no','like'.'%'.$data.'%')->with('userCity')->paginate($item);
            return response()->json([
                "success" => "OK",
                "users" => $users ,
            ]);
            
     }


      public function deActiveUser($id){
             $user = User::find($id) ;
             $user->status=0 ;
             if ($user->save()) {
                   return response()->json([
                       "status" => "SUCCESS",
                       "message" => "This user de-activated successfully",
                   ]);
             }
      }




      public function activeUser($id){
        $user = User::find($id) ;
        $user->status=1 ;
        if ($user->save()) {
              return response()->json([
                  "status" => "SUCCESS",
                  "message" => "This user activated successfully",
              ]);
        }
 }

 
    
  public function export_users(){

        return Excel::download(new UsersExport(),'users.xlsx') ;
  }



}

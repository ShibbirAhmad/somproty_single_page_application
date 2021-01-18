<?php

namespace App\Http\Controllers\Reseller;

use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    
    public  function  home(){

       //  return view('reseller.home');
    }
    
    
    public function index()
    {

      // return "hhe";
        $orders=array();
        $orders['total']=Order::where('order_type',4)->where('reseller_id',session()->get('reseller')['id'])->count();
        $orders['new']=Order::where('order_type',4)->where('reseller_id',session()->get('reseller')['id'])->where('status',1)->count();
        $orders['pending']=Order::where('order_type',4)->where('reseller_id',session()->get('reseller')['id'])->where('status',2)->count();
        $orders['approved']=Order::where('order_type',4)->where('reseller_id',session()->get('reseller')['id'])->where('status',3)->count();
        $orders['delivered']=Order::where('order_type',4)->where('reseller_id',session()->get('reseller')['id'])->where('status',5)->count();
        $orders['cancel']=Order::where('order_type',4)->where('reseller_id',session()->get('reseller')['id'])->where('status',6)->count();
        $orders['shipment']=Order::where('order_type',4)->where('reseller_id',session()->get('reseller')['id'])->where('status',4)->count();
       return view('reseller.index',\compact('orders'));
        
    }
    public  function editProfile(){

        return view('reseller.profile.edit');
    }

    public  function UpdateProfile(Request $request){
    


     $validatedData = $request->validate([

            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:11',
            'address' => 'required',
            'company_name' => 'required',

     ]);

        $reseller = Reseller::where('id', $request->id)->first();
         
        if ($reseller) {
            $reseller->name = $request->name;
             $reseller->email = $request->email;
            $reseller->phone = $request->phone;
            $reseller->bkash_no = $request->bkash_no;
             $reseller->company_name = $request->company_name;
             $reseller->address = $request->address;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images/reseller', 'public');
                $reseller->image = $path;
            }
            
            if ($reseller->save()){
                return back()->with('message','Update Successfully');
            }

        }      
           
   
    }
    
      public function viewProfile()
    {
        $id = session()->get('reseller')['id'];
        $reseller = Reseller::find($id);
        if ($reseller) {
            return view('reseller.profile.view');

        }

    }

    public function changePassword(Request $request)
    {

        $id = session()->get('reseller')['id'];

        $reseller = Reseller::findorfail($id);
        if (!empty($request->old_password)) {
            $current_password = $reseller->password;
            if (Hash::check($request->old_password, $current_password)) {
                return back()->with('oldPassword', 'Password Match');
            } else {
                return back()->with('error', 'password do not match');
            }


        } elseif (!empty($request->new_password)) {
            $reseller->password = Hash::make($request->new_password);
            if ($reseller->save()) {
                Auth::guard('reseller')->logout();
                session()->forget('reseller');
                return redirect()->route('reseller.login')->with('message', 'Password change successfully and please again login');
            }
        } else {
            return view('reseller.profile.changePassword');
        }

    }
      


}

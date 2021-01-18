<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required ',
            'password' => 'required',
        ]);
        $credential = ['email' => $request->email, 'password' => $request->password, 'status' => 1];

        if (Auth::guard('admin')->attempt($credential)) {
            Session::put('admin', Auth::guard('admin')->user());
            $admin=Auth::guard('admin')->user();
            $admin->last_login_time=Carbon::now();
            $admin->save();
            return response()->json([
                'status' => 'SUCCESS',
                'admin' => $admin,
                'token' => Hash::make($request->password),
                'message' => 'Login successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'FAILD',
                'message' => 'sorry ! invalid login information '
            ]);
        }

    }

    public function admin()
    {

        // return "hello";
        $admin = session()->get('admin');
        if ($admin) {
            return response()->json([
                'status' => 'SUCCESS',
                'admin' => $admin
            ]);
        }


    }

    public function logout()
    {

        $admin=Auth::guard('admin')->user();
        $admin->last_logout_time=Carbon::now();
        $admin->save();
        Auth::guard('admin')->logout();
        session()->forget('admin');
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Logout successfully'
        ]);
    }

    public function sessionCheck()
    {


        if (!Session::has('admin')) {
            return response()->json([
                'status' => 'EXPIRED',
                'message' => 'Your session has expired'
            ]);
        } else {
            return response()->json([
                'status' => 'RUNNING',
                'message' => 'your session is running',
                'admin'=>session()->get('admin'),
            ]);
        }
    }
}

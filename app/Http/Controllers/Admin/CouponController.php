<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::orderby('id', 'desc')->get();
        return response()->json([
            'coupons' => $coupons,
            'status' => 'SUCCESS'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'coupon_code' => 'required',
            'type' => 'required',
            'expire_date' => 'required',
            'value' => 'required',
        ]);
        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->type = $request->name;
        $coupon->expire_date = $request->name;
        $coupon->value = 1;
        if ($coupon->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'coupon add successfully'
            ]);
        }
    }



    public function active($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            $coupon->status = 1;
            if ($coupon->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'coupon active successfully'
                ]);
            }
        }
    }

    public function deActive($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            $coupon->status = 0;
            if ($coupon->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'coupon de-active successfully'
                ]);
            }
        }
    }


    public function edit($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            return response()->json([
                'status' => 'SUCCESS',
                'coupon' => $coupon
            ]);
        }

    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'coupon_code' => 'required',
            'type' => 'required',
            'expire_date' => 'required',
            'value' => 'required',
        ]);

        $coupon = Coupon::find($id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->type = $request->name;
        $coupon->expire_date = $request->name;
        if ($coupon->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'coupon update successfully'
            ]);
        }
    }
    public function destroy($id)
    {
        //
    }
}

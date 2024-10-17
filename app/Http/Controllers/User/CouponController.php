<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $coupon = !empty($request['coupon']) ? Coupon::where('code', $request['coupon'])->first() : 0 ;
        if (!empty($coupon) && $coupon->status == 1) {
            Session::put('coupon', [
                'code' => $request['coupon'],
                'type' => $coupon->type,
                'discount' => $coupon->amount,
            ]);
            $amount = !empty($coupon->type) && $coupon->type == 2 ? $coupon->amount : ($coupon->type == 1 ? (session('booking_details.total_price') * $coupon->amount) / 100 : 0);
            session(['coupon_amount'=> $amount ]);
            return response()->json([
                'valid' => true,
                'code' => $request['coupon'],
                'type' => $coupon->type,
                'discount' => $coupon->amount,
                'final_amount' => $amount,
            ]);
        } else {
            return response()->json([
                'valid' => false,
            ]);
        }
    }

    public function removeCoupon()
    {
        // Remove coupon from session
        Session::forget('coupon');
        Session::forget('coupon_amount');

        return response()->json(['success' => true]);
    }

}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {

         if (!Auth::check()){
            return response()->json([
                'message' => 'please login The Account',
            ]);
        }
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
       session()->forget('coupon_amount');
        return response()->json(['success' => true]);
    }

    public function getOrderId(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret_key'));
        $total_amount = !empty(session('coupon_amount')) ? $request['amount'] - session('coupon_amount') : (int)$request['amount'];
               $orderData = [
            'receipt'         => 'order_rcptid_' . time(),
            'amount'          => $total_amount * 100, // Convert amount to paise
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto-capture
        ];
        // Example: Fetch coupon value dynamically
        try {
            $razorpayOrder = $api->order->create($orderData);
            $orderId = $razorpayOrder['id'];

            return response()->json([
                'success' => true,
                'order_id' => $orderId,
                'amount' => $total_amount * 100,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


}

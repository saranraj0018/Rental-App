<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;

class PaymentController extends Controller
{

    // Store booking details
    public function orderBooking(Request $request)
    {

     $id = rand(100000, 999999);
      $booking = new Booking();
      $booking->booking_id = $id;
      $booking->user_id = Auth::id();
      $booking->car_id = session('booking_details.car_id');
      $booking->total_price = session('booking_details.total_price');
      $booking->start_date = formDateTime(session('booking_details.start_date'));
      $booking->end_date = formDateTime(session('booking_details.end_date'));
      $booking->status = 1;
      $booking->car_details = json_encode(session('booking_details.car_details'));
      $booking->payment_id = $request['payment_id'] ?? 1;
      $booking->save();

      $booking_details = new BookingDetail();
      $booking_details->booking_id = $booking->id;
      $booking_details->coupon = !empty(session('coupon')) ?  json_encode(session('coupon')) : null;
      $booking_details->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment successful',
        ]);
    }

    public function bookingHistory() {
        $booking = Booking::with(['user','car'])->get();
        dd($booking);
        return view('user.frontpage.booking.list', compact('booking'));
    }

}

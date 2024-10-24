<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\CarDetails;
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
      $booking->total_price = session('booking_details.total_price') + session('delivery_fee') ?? 0;
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

        $car_status = CarDetails::find(session('booking_details.car_id'));
        $car_status->status = 2;
        $car_status->save();
        session(['booking_id' => $id]);
        return response()->json([
            'success' => true,
            'message' => 'Payment successful',
        ]);
    }

    public function bookingHistory() {
        $booking = Booking::with(['user','car'])->get();
        return view('user.frontpage.booking.list', compact('booking'));
    }

    public function updateDeliveryFee(Request $request)
    {
        if (!empty($request['delivery_fee'])) {
            // Store the delivery fee in the session
            session(['delivery_fee' => $request['delivery_fee']]);
            return response()->json(['message' => 'Delivery fee added']);
        } else {
            // Remove the delivery fee from the session
            session()->forget('delivery_fee');
            return response()->json(['message' => 'Delivery fee removed']);
        }
    }

}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Available;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\CarDetails;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingConfirmed;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
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
        $booking->car_id = !empty(session('booking_details.car_id')) ?  session('booking_details.car_id') : 0;
        $booking->booking_type = 'delivery';
        $booking->start_date = formDateTime(session('booking_details.start_date'));
        $booking->end_date = formDateTime(session('booking_details.end_date'));
        $booking->latitude = !empty(session('pickup.lat')) ? session('pickup.lat') : session('pick-delivery.lat');
        $booking->longitude = !empty(session('pickup.lng')) ? session('pickup.lng') : session('pick-delivery.lng');
        $booking->address = !empty(session('pickup.address')) ? session('pickup.address') : session('pick-delivery.address');
        $booking->delivery_fee = session('booking_details.delivery_fee') ?? session('delivery_fee');
        $booking->status = 1;
        $booking->payment_id = $request['payment_id'] ?? 1;
        $booking->save();


        $delivery_booking = new Booking();
        $delivery_booking->booking_id = $id;
        $delivery_booking->user_id = Auth::id();
        $delivery_booking->car_id = !empty(session('booking_details.car_id')) ?  session('booking_details.car_id') : 0;
        $delivery_booking->booking_type = 'pickup';
        $delivery_booking->start_date = formDateTime(session('booking_details.start_date'));
        $delivery_booking->end_date = formDateTime(session('booking_details.end_date'));
        $delivery_booking->latitude = !empty(session('delivery.lat')) ? session('delivery.lat') : session('pick-delivery.lat');
        $delivery_booking->longitude = !empty(session('delivery.lng')) ? session('delivery.lng') : session('pick-delivery.lng');
        $delivery_booking->address = !empty(session('delivery.address')) ? session('delivery.address') : session('pick-delivery.address');;
        $delivery_booking->delivery_fee = session('booking_details.delivery_fee') ?? session('delivery_fee');
        $delivery_booking->status = 1;
        $delivery_booking->payment_id = $request['payment_id'] ?? 1;
        $delivery_booking->save();

        $booking_details = new BookingDetail();
        $booking_details->booking_id = $id;
        $booking_details->coupon = !empty(session('coupon')) ?  json_encode(session('coupon')) : null;
        $booking_details->payment_details = json_encode(session('booking_details.price_list'));
        $booking_details->car_details = json_encode(session('booking_details.car_details'));
        $booking_details->save();


        $model_id = !empty(session('booking_details.car_id')) ? CarDetails::find(session('booking_details.car_id'))->model_id : 0;
        $car_available = new Available();
        $car_available->car_id = !empty(session('booking_details.car_id')) ?  session('booking_details.car_id') : 0;
        $car_available->model_id = !empty($model_id) ? $model_id: 0;
        $car_available->booking_id = $id;
        $car_available->start_date = formDateTime(session('booking_details.start_date'));
        $car_available->end_date = formDateTime(session('booking_details.end_date'));
        $car_available->booking_type = 1;
        $car_available->save();

        // Send booking confirmation email
        Mail::to(Auth::user()->email)->send(new BookingConfirmed($delivery_booking));

        // Send SMS via Twilio
        $this->sendSMS(Auth::user()->mobile, $delivery_booking->booking_id);

        session(['booking_id' => $id]);
        return response()->json([
            'success' => true,
            'message' => 'Payment successful',
        ]);
    }

    public function bookingHistory() {
        $booking = Booking::with(['user','car','details'])->where('user_id',Auth::id())->get()->unique('booking_id');
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


    public function sendSMS($phone, $booking_id)
    {

        $client = new Client(config('services.twilio_sms.sid'), config('services.twilio_sms.token'));

        // Send SMS
        $client->messages->create(
            '+91' . $phone,
            [
                'from' =>config('services.twilio_sms.mobile_number'),
                'body' => "Your booking is confirmed! Booking ID: {$booking_id}."
            ]
        );
    }

    public function calculatePrice(Request $request)
    {
        $request->validate([
            'delivery_date' => 'required|date_format:d-m-Y  H:i|after:end_date',
        ]);

        if (!empty($request['end_date']) && !empty($request['delivery_date']) && !empty($request['model_id'])) {
            $car_model = CarModel::find($request['model_id']);
            $prices = ['festival' =>  $car_model->peak_reason_surge ?? 0,
                'weekend' => $car_model->weekend_surge ?? 0,
                'weekday' =>  $car_model->price_per_hour ?? 0];
            $result = UserController::calculatePrice($prices, $request['end_date'], $request['delivery_date']);
            session(['reschedule_total_price' => $result['total_price']]);
        }
        return response()->json([
            'success' => true,
            'total_price' => $result['total_price'] ?? 0,
            'festival_amount' => $result['festival_amount'] ?? 0,
            'week_end_amount' => $result['week_end_amount'] ?? 0,
            'week_days_amount' => $result['week_days_amount'] ?? 0,
            'total_days' => $result['total_days'] ?? 0,
            'total_hours' => $result['total_hours'] ?? 0,
        ]);
    }



}

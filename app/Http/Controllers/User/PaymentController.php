<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Available;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\CarDetails;
use App\Models\CarModel;
use App\Models\Frontend;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingConfirmed;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingCancelledMail;
use App\Mail\NotifyBookingReScheduleMail;
use App\Mail\BookingReScheduleMail;
use App\Mail\NofiyBookingConfrimedMail;
use App\Mail\NotifyBookingCancelledMail;
use App\Mail\NotifyBookingConfirmedMail;
use App\Models\AdminDetail;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;
use Razorpay\Api\Api;

class PaymentController extends Controller {

    // Store booking details
    public function orderBooking(Request $request) {

        $last_booking = Booking::orderBy('id', 'desc')->first() ?? 0;

        if ($last_booking) {
            // Increment the last booking ID by 1
            $new_booking_id = $last_booking->booking_id + 1;
        } else {
            // Start from 100001 if no booking exists
            $new_booking_id = 100001;
        }
        $booking = new Booking();
        $booking->booking_id = $new_booking_id;
        $booking->user_id = Auth::id();
        $booking->car_id = !empty(session('booking_details.car_id')) ? session('booking_details.car_id') : 0;
        $booking->city_code = !empty(session('booking_details.city_id')) ? session('booking_details.city_id') : 0;
        $booking->booking_type = 'delivery';
        $booking->start_date = formDateTime(session('booking_details.start_date'));
        $booking->end_date = formDateTime(session('booking_details.end_date'));
        $booking->latitude = !empty(session('delivery.lat')) ? session('delivery.lat') : session('pick-delivery.lat');
        $booking->longitude = !empty(session('delivery.lng')) ? session('delivery.lng') : session('pick-delivery.lng');
        $booking->address = !empty(session('delivery.address')) ? session('delivery.address') : session('pick-delivery.address');
        $booking->delivery_fee = session('booking_details.delivery_fee') ? session('delivery_fee') : 0;
        $booking->status = 1;
        $booking->payment_id = $request['payment_id'] ?? 1;
        $booking->save();


        $delivery_booking = new Booking();
        $delivery_booking->booking_id = $new_booking_id;
        $delivery_booking->user_id = Auth::id();
        $delivery_booking->car_id = !empty(session('booking_details.car_id')) ? session('booking_details.car_id') : 0;
        $delivery_booking->city_code = !empty(session('booking_details.city_id')) ? session('booking_details.city_id') : 0;
        $delivery_booking->booking_type = 'pickup';
        $delivery_booking->start_date = formDateTime(session('booking_details.start_date'));
        $delivery_booking->end_date = formDateTime(session('booking_details.end_date'));
        $delivery_booking->latitude = !empty(session('pickup.lat')) ? session('pickup.lat') : session('pick-delivery.lat');
        $delivery_booking->longitude = !empty(session('pickup.lng')) ? session('pickup.lng') : session('pick-delivery.lng');
        $delivery_booking->address = !empty(session('pickup.address')) ? session('pickup.address') : session('pick-delivery.address');
        $delivery_booking->delivery_fee = session('booking_details.delivery_fee') ? session('delivery_fee') : 0;
        $delivery_booking->status = 1;
        $delivery_booking->payment_id = $request['payment_id'] ?? 1;
        $delivery_booking->save();

        $paymentDetails = $this->getPaymentDetails($request['payment_id']);

        if ($paymentDetails instanceof \Illuminate\Http\JsonResponse) {
            $data = $paymentDetails->getData(true);
        } else {
            $data = $paymentDetails;
        }



        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret_key'));

        $orderData = [
            'receipt'         => 'order_rcptid_11',
            'amount'          => $data['amount'] * 100,
            'currency'        => 'INR',
            'payment_capture' => 1
        ];
        $razorpayOrder = $api->order->create($orderData);
        $orderId = $razorpayOrder['id'] ?? 11;

        $payment = new Payment();
        $payment->payment_id = $request['payment_id'];
        $payment->order_id = $orderId ?? 0;
        $payment->booking_id = $new_booking_id;
        $payment->amount = $data['amount'];
        $payment->currency = $data['currency'];
        $payment->customer_id = Auth::id();
        $payment->payment_status = $data['status'];
        $payment->save();

        $booking_details = new BookingDetail();
        $booking_details->booking_id = $new_booking_id;
        $booking_details->coupon = !empty(session('coupon')) ? json_encode(session('coupon')) : null;
        $booking_details->payment_details = json_encode(session('booking_details.price_list'));
        $booking_details->car_details = json_encode(session('booking_details.car_details'));
        $booking_details->save();

        $setting = Frontend::where('data_keys', 'general-setting')->orderBy('created_at', 'desc')->first();
        $timing_setting = !empty($setting['data_values']) ? json_decode($setting['data_values'], true) : [];
        $car_details = !empty(session('booking_details.car_id')) ? CarDetails::find(session('booking_details.car_id')) : 0;
        $car_available = new Available();
        $car_available->car_id = !empty(session('booking_details.car_id')) ? session('booking_details.car_id') : 0;
        $car_available->model_id = !empty($car_details->model_id) ? $car_details->model_id : 0;
        $car_available->register_number = !empty($car_details->register_number) ? $car_details->register_number : 0;
        $car_available->booking_id = $new_booking_id;
        $car_available->start_date = formDateTime(session('booking_details.start_date'));
        $car_available->end_date = formDateTime(session('booking_details.end_date'));
        $car_available->next_booking = Carbon::parse(formDateTime(session('booking_details.end_date')))->addHours($timing_setting['booking_duration'] ?? 3);
        $car_available->booking_type = 1;
        $car_available->save();

        $user = User::find(Auth::id());
        $user->drop_location = null;
        $user->pick_location = null;
        $user->save();

        // Send booking confirmation email
        event(new \App\Events\BookingUpdated($booking, 'created'));

        session()->forget(['booking_details.car_id', 'booking_details.city_id',
            'booking_details.start_date', 'booking_details.end_date', 'delivery.lat',
            'delivery.lng', 'delivery.address', 'booking_details.delivery_fee',
            'booking_details.price_list', 'booking_details.car_details', 'coupon','delivery_fee','coupon_amount']);
        Session::forget('delivery_fee');
        session(['booking_id' => $new_booking_id]);
        return response()->json([
            'success' => true,
            'message' => 'Payment successful',
        ]);
    }



    public function getPaymentDetails($payment_id) {

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret_key'));


        try {
            // Fetch payment details from Razorpay
            $payment = $api->payment->fetch($payment_id);

            // Extract the amount (it's in paise, so divide by 100 for the actual amount)
            $amount = $payment->amount / 100;
            $currency = $payment->currency;
            $status = $payment->status;

            return response()->json([
                'amount' => $amount,
                'currency' => $currency,
                'status' => $status,
                'payment_id' => $payment_id,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function bookingHistory() {
        $booking = Booking::with(['user', 'car', 'details'])->
            where('booking_type', 'pickup')->where('user_id', Auth::id())->get()->unique('booking_id');
        return view('user.frontpage.booking.list', compact('booking'));
    }

    public function updateDeliveryFee(Request $request) {
        if (!empty($request['delivery_fee'])) {
            // Store the delivery fee in the session
            session(['delivery_fee' => (int)$request['delivery_fee']]);
            return response()->json(['message' => 'Delivery fee added','fee' => session('delivery_fee')]);
        } else {
            // Remove the delivery fee from the session
            session()->forget('delivery_fee');
            return response()->json(['message' => 'Delivery fee removed','fee' => session('delivery_fee')]);
        }
    }


    public static function sendSMS($phone, $booking_id) {
        $client = new Client(config('services.twilio_sms.sid'), config('services.twilio_sms.token'));
        // Send SMS
        $client->messages->create(
            '+91' . $phone,
            [
                'from' => config('services.twilio_sms.mobile_number'),
                'body' => "Your booking is confirmed! Booking ID: {$booking_id}."
            ]
        );
    }


    public static function sendSMSToAdmin($phone, $booking_id) {
        $client = new Client(config('services.twilio_sms.sid'), config('services.twilio_sms.token'));
        // Send SMS
        $client->messages->create(
            '+91' . $phone,
            [
                'from' => config('services.twilio_sms.mobile_number'),
                'body' => "New Booking Alert!, A user has made a booking, and the payment is complete. Booking Details: User: " . auth()?->user()?->name . " Booking ID: $booking_id. Log in to the admin panel for more details."
            ]
        );
    }

    public function calculatePrice(Request $request) {
        $request->validate([
            'delivery_date' => 'required|date_format:d-m-Y H:i|after:end_date',
        ], [
            'delivery_date.required' => 'The Pickup date is mandatory.',
            'delivery_date.after' => 'The Pickup date must be after the end date.',
        ]);
        if (!empty($request['end_date']) && !empty($request['delivery_date']) && !empty($request['model_id'])) {
            session(['delivery_date' => $request['delivery_date']]);

            $car_model = CarModel::find($request['model_id']);
            $prices = ['festival' => $car_model->peak_reason_surge ?? 0,
                'weekend' => $car_model->weekend_surge ?? 0,
                'weekday' => $car_model->price_per_hour ?? 0];
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

    public function completePayment(Request $request) {
        $booking_id = $request['booking_id'];
        $payment_id = $request['payment_id'];


        $payment = new Payment();
        $payment->payment_id = $payment_id;
        $payment->booking_id = $booking_id;
        $payment->amount = session('reschedule_total_price');
        $payment->currency = "INR";
        $payment->customer_id = Auth::id();
        $payment->payment_status = 'completed';
        $payment->save();

        $booking = Booking::where('booking_id', $booking_id)->where('booking_type', 'pickup')->first();
        $booking->reschedule_date = !empty(session('delivery_date')) ? formDateTime(session('delivery_date')) : '';
        $booking->save();

        $setting = Frontend::where('data_keys', 'general-setting')->orderBy('created_at', 'desc')->first();
        $timing_setting = !empty($setting['data_values']) ? json_decode($setting['data_values'], true) : [];
        $next_booking = Carbon::parse(formDateTime(session('delivery_date')))->addHours($timing_setting['booking_duration'] ?? 3);
        Available::where('booking_id', $booking->booking_id)->update(['end_date' => formDateTime(session('delivery_date')), 'next_booking' => formDateTime($next_booking)]);

        event(new \App\Events\BookingUpdated($booking, 'rescheduled'));
        session()->forget(['reschedule_total_price', 'delivery_date']);
        return response()->json(['success' => true]);
    }

    public function bookingCancel(Request $request) {
        $booking_id = $request['cancel_booking_id'];

        if (empty($booking_id)) {
            return response()->json(['success' => false]);
        }

        $bookings = Booking::where('booking_id', $booking_id)->where('booking_type', 'pickup')->where('status', 2)->first();

        if (!empty($bookings)) {
            return response()->json(['success' => false]);
        }

        $booking = Booking::where('booking_id', $booking_id);

        $booking->update([
            'notes' => $request['cancel_reason'],
            'status' => 3,
        ]);
        Available::where('booking_id', $request['booking_id'])->delete();
        event(new \App\Events\BookingUpdated($booking->get()->first(), 'cancelled'));

        return response()->json(['success' => true]);
    }

    public function getRescheduleOrderId()
    {

        $amount = session('reschedule_total_price') ?? 0;
        if (empty($amount)) {
            return response()->json(['success' => false, 'message' => 'Amount not reflected']);
        }
        $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret_key'));
        $orderData = [
            'receipt'         => 'order_rcptid_' . time(),
            'amount'          => $amount * 100, // Convert amount to paise
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
                'amount' => $amount * 100,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

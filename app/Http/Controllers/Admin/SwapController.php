<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as Controller;
use App\Http\Controllers\User\UserController;
use App\Mail\NofityCarSwappedMail;
use App\Models\Available;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\CarDetails;
use App\Models\City;
use App\Models\SwapCar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use App\Models\Payment;
use Illuminate\Http\Request;

class SwapController extends Controller {

    public int $amount = 0;
    public function list() {

        $this->authorizePermission('swap_cars_view');
        $city_list = City::where('city_status', 1)->pluck('name', 'code');

        $permissions = getAdminPermissions();

        return view('admin.swap-cars.show', compact('city_list', 'permissions'));
    }

    public function table() {
        $swap_cars = SwapCar::with('user', 'car.carModel', 'swapCar.carModel')
            ->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.swap-cars.table', compact('swap_cars'));
    }


    public function getBookingDate(Request $request) {


        $this->authorizePermission('swap_cars_search');

        $data = [];
        if (!empty($request['booking_id'])) {
            $booking = Booking::where('booking_id', $request['booking_id'])
                ->where('city_code', $request['city_code'])
                ->where('status', 1)->get();

            foreach ($booking as $booking) {
                if (!empty($booking && $booking->status == 1 && $booking->booking_type == 'delivery')) {
                    $data['start_date'] = !empty($booking->reschedule_date) ? $booking->reschedule_date : $booking->start_date;
                } elseif (!empty($booking && $booking->status == 1 && $booking->booking_type == 'pickup')) {
                    $data['end_date'] = $booking->booking_type == 'pickup' && !empty($booking->reschedule_date) ? $booking->reschedule_date : $booking->end_date;
                }
            }
            return response()->json(['data' => $data, 'success' => 'Data Fetching Successfully.']);

        }
        return response()->json(['data' => $data, 'success' => 'Data Found.']);
    }

    public static function availableCars(Request $request) {
        $data = [
            'available_cars' => [],
            'booked_cars' => [],
        ];

        // Check if both start_date and end_date are provided
        if (!empty($request['start_date']) && !empty($request['end_date']) && !empty($request['hub_list'])) {
            $start_date = Carbon::parse($request['start_date']);
            $end_date = Carbon::parse($request['end_date']);


            $car_list = CarDetails::with('carModel')->where('city_code', $request['hub_list'])->get();

            foreach ($car_list as $car) {
                // Check if the car is booked during the requested period
                $isBooked = Available::where('car_id', $car->id)
                    ->where(function ($query) use ($start_date, $end_date) {
                        $query->whereBetween('start_date', [$start_date, $end_date])
                            ->orWhereBetween('next_booking', [$start_date, $end_date])
                            ->orWhere(function ($q) use ($start_date, $end_date) {
                                $q->where('start_date', '<=', $start_date)
                                    ->where('next_booking', '>=', $end_date);
                            });
                    })
                    ->exists();
                // Add car to the respective list based on its availability
                if ($isBooked) {
                    $data['booked_cars'][] = $car;
                } else {
                    $data['available_cars'][] = $car;
                }
            }
            $result = !empty($data['available_cars']) ? collect($data['available_cars'])->unique('model_id')->values()->all() : [];
            return response()->json(['data' => $result, 'success' => 'Data Fetching Successfully.']);
        }

        return response()->json(['data' => $data, 'success' => 'Data Found.']);
    }

    public function swapCar(Request $request) {
        $car_id = !empty($request['car_id']) ?$request['car_id'] : $request['old_car_id'];
        if (!empty($request['booking_id']) && !empty($car_id)) {

            $car_id = !empty($request['car_id']) ?$request['car_id'] : $request['old_car_id'];
            $old_booking = Booking::where('booking_id', $request['booking_id'])->first();


            $booking = Booking::where('booking_id', $request['booking_id'])->where('status', 1);
            $booking->update(['car_id' => $car_id]);

            $_booking = $booking->get()->first();


            $car_details = CarDetails::with('carModel')->find($car_id);
            BookingDetail::where('booking_id', $request['booking_id'])->update(['car_details' => json_encode($car_details)]);

            if (!empty($request['start_date']) && !empty($request['end_date'])) {
                $available = new Available();
                $available->car_id = $car_id;
                $available->model_id = $car_details->carModel->car_model_id ?? 0;
                $available->booking_id = $request['booking_id'];
                $available->register_number = $car_details->register_number;
                $available->start_date = $request['start_date'];
                $available->end_date = $request['end_date'];
                $available->booking_type = 1;
                $available->save();

                $available = new SwapCar();
                $available->booking_id = $request['booking_id'];
                $available->user_id = Auth::guard('admin')->id();
                $available->car_id = !empty($old_booking->car_id) ? $old_booking->car_id : 0;
                $available->swap_car_id = $car_id;
                $available->save();
            }



            Mail::to(auth('admin')->user()->email)->send(new NofityCarSwappedMail($_booking));

            twilio()->send("Hello there, Car Swapped for the Customer: ( $_booking->user->name ) - Booking ID: ( $_booking->booking_id )")->to('+91' . auth('admin')->user()->mobile_number);

            return response()->json(['success' => true, 'message' => 'Data Saved Successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Data not Found .']);

    }


    public function swapCarCalculate(Request $request) {
        if (!empty($request['booking_id']) && !empty($request['car_id']) && !empty($request['start_date']) && !empty($request['end_date'])) {

            $booking_price = Payment::where('booking_id', $request['booking_id'])
                ->where('payment_status', 'completed')
                ->groupBy('booking_id')
                ->sum('amount');

            $car_details = CarDetails::find($request['car_id']);
            $prices = ['festival' => $car_details->carModel->peak_reason_surge ?? 0,
                'weekend' => $car_details->carModel->weekend_surge ?? 0,
                'weekday' => $car_details->carModel->price_per_hour ?? 0];

            $swap_price = UserController::calculatePrice($prices, showDateformat($request['start_date']), showDateformat($request['end_date']));

            $total_price = $booking_price < $swap_price['total_price'] ? $swap_price['total_price'] - $booking_price : $booking_price;

            session(['swap_total_price' => $swap_price], ['final_total_price' => $total_price]);
            $this->amount = $total_price;

            return response()->json([
                'success' => true,
                'total_price' => $swap_price['total_price'] ?? 0,
                'final_total_price' => $total_price ?? 0,
                'festival_amount' => $swap_price['festival_amount'] ?? 0,
                'week_end_amount' => $swap_price['week_end_amount'] ?? 0,
                'week_days_amount' => $swap_price['week_days_amount'] ?? 0,
                'total_days' => $swap_price['total_days'] ?? 0,
                'total_hours' => $swap_price['total_hours'] ?? 0,
                'booking_price' => $booking_price ?? 0,
            ]);

        }
        return response()->json(['success' => 'false', 'message' => 'Data not Found .']);
    }
    public function sendPayment(Request $request) {
        if (!empty($request['booking_id']) && !empty($request['amount'])) {
            $booking = Booking::with('user')->where('booking_id', $request['booking_id'])->first();
            $booking->user->email;
            $amount = $request['amount'] * 100; // Amount in paise (e.g., ₹1000 = 100000)
            $email = $booking->user->email;

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret_key'));

            try {
                $uniqueReceiptId = 'rcptid_' . rand(100000, 999999); // Generate a unique receipt ID using the booking ID

                $response = $api->invoice->create([
                    'type' => 'link',
                    'amount' => $amount,
                    'currency' => 'INR',
                    'description' => 'Payment for Car Booking',
                    'customer' => [
                        'email' => $email,
                        'contact' => $request->input('contact') // Optionally include contact number
                    ],
                    'receipt' => $uniqueReceiptId, // Use the unique receipt ID
                    'reminder_enable' => true,
                    'sms_notify' => true,
                    'email_notify' => true
                ]);

                $paymentLink = $response->short_url;

                // Send email with the payment link
                Mail::to($email)->send(new \App\Mail\PaymentDetails($amount, $paymentLink));

                return response()->json(['success' => 'Payment link created and sent successfully.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to create payment link: ' . $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => 'Failed to create payment link: '], 500);
    }

    public function searchHistory(Request $request) {
        $this->authorizePermission('swap_cars_history');
        $query = SwapCar::with('user', 'car.carModel', 'swapCar.carModel');

        if (!empty($request['booking_id'])) {
            $query->where('booking_id', 'like', '%' . $request['booking_id'] . '%');
        }
        $swap_list = $query->orderBy('created_at', 'desc')->paginate(10);
        return response()->json(['data' => ['swap' => $swap_list->items(), 'pagination' => $swap_list->links()->render()]]);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\User\UserController;
use App\Mail\BookingConfirmed;
use App\Models\Available;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\CarDetails;
use App\Models\CarModel;
use App\Models\Commend;
use App\Models\Frontend;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;

class PickupDeliveryController extends BaseController
{
    public function list(Request $request)
    {
        $this->authorizePermission('hub_list');
        $bookings = Booking::with(['user','details','comments','user.bookings'])->where('status',1)->paginate(5);
        return view('admin.hub.list',compact('bookings'));
    }

    public function rescheduleDate(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $booking = Booking::find(request('booking_id'));
        $booking->reschedule_date = $request['date'];
        $booking->save();
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'success' => 'Reschedule date Update successfully']);

    }

    public function riskCommends(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|numeric',
            'commends' => 'required',
        ]);

        $commend = new Commend();
        $commend->booking_id = $request['booking_id'];
        $commend->commends = $request['commends'];
        $commend->save();
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Commends Update successfully']);
    }

    public function riskStatus(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|numeric',
            'status' => 'required',
        ]);
        $booking = Booking::find($request['booking_id']);

        if (!empty($booking) && !empty($request['note']) && $request['note'] == 'complete' ) {
            $booking->status = $request['status'];
            $booking->risk = 2;
            $booking->save();
            $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
            return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Risk updated successfully']);
        } elseif (!empty($booking) && !empty($request['note']) && $request['note'] == 'risk' ) {
            $booking->risk = $request['status'];
            $booking->save();
            $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
            return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Risk updated successfully']);

        }
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Booking not found']);
    }

    public function bookingCancel(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'reason' => 'required|string|max:255',
        ]);

        $booking = Booking::find($request['booking_id']);
        $booking->status = 3;
        $booking->notes = $request['reason'];
        $booking->save();
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Booking cancelled successfully']);
    }

    public function fetchBookings(Request $request) {
        // Set the number of items per page
        $perPage = $request->input('per_page', 10); // Default to 10 items per page

        $query = Booking::with(['user','details','comments','user.bookings']);

        // Apply filters based on request parameters
        if (!empty($request['car_model'])) {
            $query->whereHas('details', function($query) use ($request) {
                $query->where('car_details->car_model->model_name', 'like', '%' . $request->input('car_model') . '%');
            });
        }
        if (!empty($request['register_number'])) {
            $query->where('register_number', 'like', '%' . $request->input('register_number') . '%');
        }
        if (!empty($request['booking_id'])) {
            $query->where('booking_id', $request->input('booking_id'));
        }
        if (!empty($request['customer_name'])) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('customer_name') . '%');
            });
        }
        if ($request->has('booking_type') && $request->input('booking_type') !== 'both') {
            $query->where('booking_type', $request->input('booking_type'));
        }

        // Paginate the results
        $bookings = $query->paginate($perPage);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Data Fetch successfully']);

    }

    public function calculatePrice(Request $request)
    {
        if (!empty($request['car_model_id']) && !empty($request['start_date']) && !empty($request['end_date'])) {

            $car_model = CarModel::where('car_model_id',$request['car_model_id'])->first();
            $prices = ['festival' =>  $car_model->peak_reason_surge ?? 0,
                'weekend' => $car_model->weekend_surge ?? 0,
                'weekday' =>  $car_model->price_per_hour ?? 0];
            $general = Frontend::where('data_keys','general-setting')->first();
            $data = !empty($general) && optional($general)->data_values ? json_decode($general->data_values, true) : [];
            $model_price = UserController::calculatePrice($prices, showDateformat($request['start_date']), showDateformat($request['end_date']));
            return response()->json([
                'success' => true,
                'total_price' => $model_price['total_price'] ?? 0,
                'final_total_price' => $total_price ?? 0,
                'festival_amount' => $model_price['festival_amount'] ?? 0,
                'week_end_amount' => $model_price['week_end_amount'] ?? 0,
                'week_days_amount' => $model_price['week_days_amount'] ?? 0,
                'total_days' => $model_price['total_days'] ?? 0,
                'total_hours' => $model_price['total_hours'] ?? 0,
                'car_model' => $car_model,
                'delivery_fee' => (int)$data['delivery_fee'] ?? 0
            ]);

        }
        return response()->json(['success' => 'false','message' => 'Data not Found .']);
    }

    public function sendUserPayment(Request $request)
    {
        if (!empty($request['email']) && !empty($request['amount'])) {

            $amount = $request['amount'] * 100; // Amount in paise (e.g., ₹1000 = 100000)
            $email = $request['email'];

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret_key'));

            try {
                $uniqueReceiptId = 'rcptid_' .  rand(100000, 999999); // Generate a unique receipt ID using the booking ID

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
        return response()->json(['error' => 'Data Not found:'], 500);

    }

    public static function createBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'required|digits:10|unique:users',
            'pickup_location' => 'required|string|max:255',
            'drop_location' => 'required|string|max:255',
            'license_number' => 'required|string|max:20',
            'aadhaar_card' => 'required|digits:12',
            'user_start_date' => 'required|date|after_or_equal:today',
            'user_end_date' => 'required|date|after:user_start_date',
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->mobile = $request['mobile'];
        $user->email = $request['email'];
        $user->aadhaar_number  = $request['aadhaar_card'];
        $user->driving_licence = $request['license_number'];
        $user->save();

        if (!empty($request['user_car_model'])) {
            $car_available = self::carAvailablity($request['user_car_model'], $request['user_start_date'], $request['user_end_date']);
            if (!empty($car_available)) {
                $available_car = current($car_available);

            }
            $general = Frontend::where('data_keys','general-setting')->first();
            $data = !empty($general) && optional($general)->data_values ? json_decode($general->data_values, true) : [];

            $id = rand(100000, 999999);
            $booking = new Booking();
            $booking->booking_id = $id;
            $booking->user_id = $user->id;
            $booking->car_id = $available_car->id;
            $booking->booking_type = 'delivery';
            $booking->start_date = formDateTime( $request['user_start_date']);
            $booking->end_date = formDateTime( $request['user_end_date']);
            $booking->address = $request['drop_location'] ?? '';
            $booking->delivery_fee = $data['delivery_fee'] ?? '';
            $booking->status = 1;
            $booking->save();


            $delivery_booking = new Booking();
            $delivery_booking->booking_id = $id;
            $delivery_booking->user_id = $user->id;
            $delivery_booking->car_id = $available_car->id;
            $delivery_booking->booking_type = 'pickup';
            $delivery_booking->start_date = formDateTime($request['user_start_date']);
            $delivery_booking->end_date = formDateTime($request['user_end_date']);
            $delivery_booking->address = $request['pickup_location'] ?? '';
            $delivery_booking->delivery_fee = $data['delivery_fee'] ?? '';
            $delivery_booking->status = 1;
            $delivery_booking->save();

            $car_details =  CarDetails::with('carModel')->find($available_car->id);

            $booking_details = new BookingDetail();
            $booking_details->booking_id = $id;
            $booking_details->car_details = json_encode($car_details);
            $booking_details->save();


            $car_available = new Available();
            $car_available->car_id  = $available_car->id;
            $car_available->model_id = $request['user_car_model'];
            $car_available->booking_id = $id;
            $car_available->register_number = $available_car->register_number;
            $car_available->start_date = formDateTime($request['user_start_date']);
            $car_available->end_date = formDateTime($request['user_end_date']);
            $car_available->booking_type = 1;
            $car_available->save();
//
////            Send booking confirmation email
//        Mail::to(Auth::user()->email)->send(new BookingConfirmed($delivery_booking));
//
//        // Send SMS via Twilio
      //  $this->sendSMS(Auth::user()->mobile, $delivery_booking->booking_id);

        return response()->json(['success' => true, 'message' => 'Booking cancelled successfully']);
        }
    }


    public static function carAvailablity($model_id ,$start_date, $end_date) {
        if (!empty($model_id)) {
            $car_details = CarDetails::where('model_id', $model_id)->get();
            $start_date = Carbon::parse($start_date);
            $end_date = Carbon::parse($end_date);
            $available_cars = [];
            foreach ($car_details as $car_detail) {
                // Check if the car is booked during the given period
                $isBooked = Available::where('car_id', $car_detail->id)
                    ->where(function ($query) use ($start_date, $end_date) {
                        $query->whereBetween('start_date', [$start_date, $end_date])
                            ->orWhereBetween('end_date', [$start_date, $end_date])
                            ->orWhere(function ($query) use ($start_date, $end_date) {
                                $query->where('start_date', '<=', $start_date)
                                    ->where('end_date', '>=', $end_date);
                            });
                    })
                    ->exists();

                // If not booked, add to available cars list
                if (!$isBooked) {
                    $available_cars[] = $car_detail;
                }
            }

            return $available_cars;
        }
        return [];
    }


}

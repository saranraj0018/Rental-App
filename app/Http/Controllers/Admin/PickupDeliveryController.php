<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserController;
use App\Mail\BookingConfirmed;
use App\Models\Available;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\CarDetails;
use App\Models\CarModel;
use App\Models\City;
use App\Models\Commend;
use App\Models\Frontend;
use App\Models\Payment;
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
       // $bookings = self::getBooking();
        $city_list = City::where('city_status',1)->pluck('name','code');
        return view('admin.hub.list',compact('city_list'));
    }

    public static function getBooking()
    {
        $timeLimit = now()->addHours(48);
        return Booking::with(['user', 'details', 'comments', 'user.bookings'])
            ->where('status', 1)
            ->where(function ($query) use ($timeLimit) {
                $query->where('risk', 1)
                    ->where(function ($query) use ($timeLimit) {
                        $query->where(function ($query) use ($timeLimit) {
                            $query->where('booking_type', 'delivery')
                                ->whereBetween('start_date', [now(), $timeLimit]);
                        })->orWhere(function ($query) use ($timeLimit) {
                            $query->where('booking_type', 'pickup')
                                ->whereBetween('end_date', [now(), $timeLimit]);
                        });
                    })
                    ->orWhere(function ($query) {
                        $query->where('risk', 1);
                    });
            })
            ->orWhere(function ($query) {
                $query->where('risk', 2)
                    ->where('status', 1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    public function rescheduleDate(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|numeric',
            'car_id' => 'required|numeric',
            'model_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $booking = Booking::find($request['booking_id']);

        $booking->reschedule_date = formDateTime($request['end_date']);
        $booking->save();
        $availableCars = self::checkAvailability($request['start_date'], $request['end_date'], $request['car_id'], $request['model_id']);


        if (!empty($availableCars['booking_details'])) {
            // Counter for available cars
            $availableCarsIndex = 0;

            foreach ($availableCars['booking_details'] as $booking) {
                if (!empty($booking->booking_id)) {
                    // Check if there is an available car in the "available_cars" array
                    if (!empty($availableCars['available_cars'][$availableCarsIndex])) {
                        $carId = $availableCars['available_cars'][$availableCarsIndex]['car_id'];
                        // Update booking with the available car_id
                        $bookingUpdate = Booking::where('booking_id', $booking->booking_id)
                            ->update(['car_id' => $carId]);

                        if (!empty($carId)){
                            $car_details =  CarDetails::with('carModel')->find($carId);
                             BookingDetail::where('booking_id', $booking->booking_id)
                                ->update(['car_details' => json_encode($car_details)]);
                        }

                        $car_available = new Available();
                        $car_available->car_id = !empty($carId) ? $carId : 0;
                        $car_available->model_id = !empty($request['model_id']) ? $request['model_id'] : 0;
                        $car_available->register_number = !empty($car_details->register_number) ? $car_details->register_number: 0;
                        $car_available->booking_id =  $booking->booking_id;
                        $car_available->start_date = formDateTime($request['start_date']);
                        $car_available->end_date = formDateTime($request['end_date']);
                        $car_available->next_booking = Carbon::parse(formDateTime($request['end_date']))->addHours(3);
                        $car_available->booking_type = 1;
                        $car_available->save();

                        if (!empty($bookingUpdate)) {
                            // Move to the next available car
                            $availableCarsIndex++;
                        }
                    } else {
                        // No more available cars, set car_id to 0 for the remaining bookings
                        Booking::where('booking_id', $booking->booking_id)
                            ->update(['car_id' => 0]);
                    }
                }
            }
        }

        $bookings = self::getBooking();
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'success' => 'Reschedule date Update successfully']);

    }

    public static function checkAvailability($startDate, $endDate, $carId, $model_id)
    {
        $availableCars = [];

        if (!empty($startDate) && !empty($endDate) && !empty($carId)) {
            // Get booking details for the specified car_id
            $bookingDetails = Available::where('car_id', $carId)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('next_booking', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('start_date', '<=', $startDate)
                                ->where('next_booking', '>=', $endDate);
                        });
                })->get();

            if ($bookingDetails) {
                $otherCars = CarDetails::where('model_id', $model_id)->
                where('id','!=', $carId)->get();
                // Check availability of other cars within the date range
                foreach ($otherCars as $car) {
                    $isAvailable = Available::where('car_id', $car->id)
                        ->where(function ($query) use ($startDate, $endDate) {
                            $query->whereBetween('start_date', [$startDate, $endDate])
                                ->orWhereBetween('next_booking', [$startDate, $endDate])
                                ->orWhere(function ($q) use ($startDate, $endDate) {
                                    $q->where('start_date', '<=', $startDate)
                                        ->where('next_booking', '>=', $endDate);
                                });
                        })->doesntExist();

                    if ($isAvailable) {
                        $availableCars[] = [
                            'car_id' => $car->id,
                            'status' => 'available'
                        ];
                    }
                }
                return [
                    'booking_details' => $bookingDetails,
                    'available_cars' => $availableCars
                ];
            }
        }
        return [
            'booking_details' => []
        ];
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
        $bookings = self::getBooking();
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
            $bookings = self::getBooking();
            return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Risk updated successfully']);
        } elseif (!empty($booking) && !empty($request['note']) && $request['note'] == 'risk' ) {
            $booking->risk = $request['status'];
            $booking->save();
            $bookings = self::getBooking();
            return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Risk updated successfully']);

        }
        $bookings = self::getBooking();
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Booking not found']);
    }

    public function bookingCancel(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'reason' => 'required|string|max:255',
        ]);
        Booking::where('booking_id', $request['booking_id'])
            ->update([
                'notes' => $request['cancel_reason'],
                'status' => 3,
            ]);
        $bookings = self::getBooking();
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Booking cancelled successfully']);
    }

    public function fetchBookings(Request $request) {
        // Set the number of items per page
        $perPage = $request->input('per_page', 20);
        $timeLimit = now()->addHours(48);
        $query = Booking::with(['user','details','comments','user.bookings'])->where('status', 1)
            ->where(function ($query) use ($timeLimit) {
                $query->where('risk', 1)
                    ->where(function ($query) use ($timeLimit) {
                        $query->where(function ($query) use ($timeLimit) {
                            $query->where('booking_type', 'delivery')
                                ->whereBetween('start_date', [now(), $timeLimit]);
                        })->orWhere(function ($query) use ($timeLimit) {
                            $query->where('booking_type', 'pickup')
                                ->whereBetween('end_date', [now(), $timeLimit]);
                        });
                    })
                    ->orWhere(function ($query) {
                        $query->where('risk', 1);
                    });
            })
            ->orWhere(function ($query) {
                $query->where('risk', 2)
                    ->where('status', 1);
            })
         ;

        if ($request->has('hub_type')) {
            $query->where('city_id', $request->input('hub_type'));
        }
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
        $status = !empty($request->input('status')) ? $request->input('status') : 1;
        $query->where('status', $status);

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
            'hub_list' => 'required|numeric',
        ]);

        if (!empty($request['user_car_model'])) {
            $car_available = self::carAvailablity($request['user_car_model'], $request['user_start_date'], $request['user_end_date']);
            if (!empty($car_available)) {
                $available_car = current($car_available);
            }
            $general = Frontend::where('data_keys','general-setting')->first();
            $data = !empty($general) && optional($general)->data_values ? json_decode($general->data_values, true) : [];

            $user = new User();
            $user->name = $request['name'];
            $user->mobile = $request['mobile'];
            $user->email = $request['email'];
            $user->aadhaar_number  = $request['aadhaar_card'];
            $user->driving_licence = $request['license_number'];
            $user->save();

            $id = rand(100000, 999999);
            $booking = new Booking();
            $booking->booking_id = $id;
            $booking->user_id = $user->id;
            $booking->car_id = $available_car->id;
            $booking->city_code = $request['hub_list'] ?? 0;
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
            $delivery_booking->city_code = $request['hub_list'] ?? 0;
            $delivery_booking->booking_type = 'pickup';
            $delivery_booking->start_date = formDateTime($request['user_start_date']);
            $delivery_booking->end_date = formDateTime($request['user_end_date']);
            $delivery_booking->address = $request['pickup_location'] ?? '';
            $delivery_booking->delivery_fee = $data['delivery_fee'] ?? '';
            $delivery_booking->status = 1;
            $delivery_booking->save();
            Mail::to($user->email)->send(new BookingConfirmed($delivery_booking));

            $car_details =  CarDetails::with('carModel')->find($available_car->id);

            $prices = ['festival' =>  $car_details->carModel->peak_reason_surge ?? 0,
                'weekend' => $car_details->carModel->weekend_surge ?? 0,
                'weekday' =>  $car_details->carModel->price_per_hour ?? 0];

            $general = Frontend::where('data_keys','general-setting')->first();
            $data = !empty($general) && optional($general)->data_values ? json_decode($general->data_values, true) : [];
            $delivery_fee = $data['delivery_fee'] ?? 0;
            $deposit_amount = $car_details->carModel->dep_amount ?? 0;

            $model_price = UserController::calculatePrice($prices, showDateformat($request['user_start_date']), showDateformat($request['user_end_date']));

            $total_price = $model_price['total_price'] + $delivery_fee + $deposit_amount;

            $booking_details = new BookingDetail();
            $booking_details->booking_id = $id;
            $booking_details->car_details = json_encode($car_details);
            $booking_details->payment_details = json_encode($model_price);
            $booking_details->save();


            $payment = new Payment();
            $payment->payment_id = 'custom_'.rand(100, 999);
            $payment->booking_id = $id;
            $payment->amount = $total_price;
            $payment->currency = 'INR';
            $payment->customer_id = $user->id;
            $payment->payment_status =  'complete';
            $payment->save();


            $car_available = new Available();
            $car_available->car_id  = $available_car->id;
            $car_available->model_id = $request['user_car_model'];
            $car_available->booking_id = $id;
            $car_available->register_number = $available_car->register_number;
            $car_available->start_date = formDateTime($request['user_start_date']);
            $car_available->end_date = formDateTime($request['user_end_date']);
            $car_available->next_booking = Carbon::parse(formDateTime($request['user_end_date']))->addHours($data['booking_duration'] ?? 3);
            $car_available->booking_type = 1;
            $car_available->save();

            PaymentController::sendSMS($user->mobile, $id);

            return response()->json(['success' => true, 'message' => 'Booking Created successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Booking Fail']);
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
    public function bookingComplete()
    {
        $bookings = Booking::with(['user','details','comments','user.bookings'])->where('status',2)->paginate(20);
        return view('admin.hub.complete_booking',compact('bookings'));
    }

    public function bookingCancelList()
    {
        $bookings = Booking::with(['user','details','comments','user.bookings'])->where('status',3)->paginate(20);
        return view('admin.hub.cancel_booking',compact('bookings'));
    }

}

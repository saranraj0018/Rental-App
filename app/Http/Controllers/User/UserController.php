<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Available;
use App\Models\CarDetails;
use App\Models\City;
use App\Models\Holiday;
use App\Models\User;
use App\Models\UserDocument;
use GuzzleHttp\Client;
use App\Models\CarModel;
use App\Models\Coupon;
use App\Models\Frontend;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function view()
    {
        $section1 = Frontend::with('frontendImage')->where('data_keys','section1-image-car')->first();
        $section2 = Coupon::where('status',1)->whereDate('end_date', '>=', now())->get();
        $city_list = City::where('city_status', 1)->pluck('name', 'code');
        $filter_car_info = !empty(self::getAvailableCars()) ? self::getAvailableCars() : CarDetails::all();
        $section3 = collect($filter_car_info)->unique('model_id')->values()->all();
        $car_info = Frontend::with('frontendImage')->where('data_keys','car-info-section')->first();
        $section4 = !empty($car_info['data_values']) ? json_decode($car_info['data_values'],true) : [];
        $brand_info = Frontend::with('frontendImage')->where('data_keys','brand-section')->first();
        $section8 = !empty($brand_info['data_values']) ? json_decode($brand_info['data_values'],true) : [];
        $brand_image = !empty($brand_info->frontendImage) ? $brand_info->frontendImage : null;
        $car_image = !empty($car_info->frontendImage) ? $car_info->frontendImage : null;
        $faq_items = Frontend::where('data_keys','faq-section')->orderBy('created_at', 'desc')->get()->take(5);
        $general_setting = Frontend::where('data_keys','faq-section')->orderBy('created_at', 'desc')->get();
        $setting = Frontend::where('data_keys','general-setting')->orderBy('created_at', 'desc')->first();
        $timing_setting = !empty($setting['data_values']) ? json_decode($setting['data_values'],true) : [];
        return view('user.frontpage.list-home',compact('section1','section2','section3','section4','car_image'
            ,'brand_image','section8','faq_items','general_setting','timing_setting','city_list'));
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'city_id' => 'required',
        ]);

            if (!empty($request['start_date']) && !empty($request['end_date'])) {
                $start_date = str_replace('T', '  ', $request['start_date']);
                $end_date = str_replace('T', '  ', $request['end_date']);

                $start = Carbon::parse($start_date);
                $end = Carbon::parse($end_date);
                $setting = Frontend::where('data_keys','general-setting')->first();
                $timing_setting = !empty($setting['data_values']) ? json_decode($setting['data_values'],true) : [];
                $totalHours = $start->diffInHours($end);
                if ($totalHours < $timing_setting['total_minimum_hours'] || $totalHours > $timing_setting['total_maximum_hours']) {
                    return redirect()->back();
                }

                // If the input does not have a space, manually format it
                $start_date = preg_replace('/(\d{4}-\d{2}-\d{2})(\d{2}:\d{2})/', '$1 $2', showDateformat($start_date));
                $end_date = preg_replace('/(\d{4}-\d{2}-\d{2})(\d{2}:\d{2})/', '$1 $2', showDateformat($end_date));


                $request->session()->put('start_date',   $start_date);
                $request->session()->put('end_date', $end_date);
                $request->session()->put('city_id', $request['city_id']);
        }
        return response()->json(['success' => true]);
    }

     public function listCars() {
        $date = ['start_date' => Session::get('start_date'), 'end_date' =>  Session::get('end_date')];
        $city_list = City::where('city_status', 1)->pluck('name', 'code');
        $setting = Frontend::where('data_keys','general-setting')->orderBy('created_at', 'desc')->first();
        $timing_setting = !empty($setting['data_values']) ? json_decode($setting['data_values'],true) : [];
        $car_models = self::getAvailableCars();
        $festival_days = Holiday::pluck('event_date')->toArray();
        $section2 = Coupon::whereDate('end_date', '>=', now())->get();
        return view('user.frontpage.list-cars.list',compact('car_models','festival_days','date','city_list','timing_setting','section2'));
    }

    public static function getAvailableCars()
    {
        $available_models = self::showCarAvailable( Session::get('start_date'),Session::get('end_date'),Session::get('city_id'));
        $booking_models = !empty($available_models['available_cars']) ?
            array_map(function($car) {
                $car['booking_status'] = 'available'; // Add status as 'available'
                return $car;
            }, $available_models['available_cars']) : [];

        $sold_cars = !empty($available_models['booking_cars']) ?
            array_map(function($car) {
                $car['booking_status'] = 'sold'; // Add status as 'sold'
                return $car;
            }, $available_models['booking_cars']) : [];
        $booking_model_ids = array_column($booking_models, 'model_id');
        $result = array_filter($sold_cars, function ($item) use ($booking_model_ids) {
            return !in_array($item['model_id'], $booking_model_ids);
        });
        return array_merge($booking_models, $result);
    }

    public static function showCarAvailable($start_date, $end_date, $city_id=null)
    {
        if (!empty($start_date) && !empty($end_date) && !empty($city_id)) {
            $car_details = CarDetails::with('carModel')->where('city_code',$city_id)->get();
            $start_date = Carbon::parse($start_date);
            $end_date = Carbon::parse($end_date);

            $available_cars = $booked_cars = [];

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
                } else {
                    $booked_cars[] = $car_detail;
                }
            }
            // Ensure uniqueness based on 'model_id' for both lists
            $unique_available_cars = collect($available_cars)->unique('model_id')->values()->all();
            $unique_booking_cars = collect($booked_cars)->unique('model_id')->values()->all();
            // Return both lists
            return [
                'available_cars' => $unique_available_cars,
                'booking_cars' => $unique_booking_cars
            ];
        }

        return [
            'available_cars' => [],
            'booking_cars' => []
        ];
    }

    public function bookingCar($id)
    {
        $car_model = !empty($id) ? CarDetails::with('carModel')->find($id) : [];
        $prices = ['festival' =>  $car_model->carModel->peak_reason_surge ?? 0,
            'weekend' => $car_model->carModel->weekend_surge ?? 0,
            'weekday' =>  $car_model->carModel->price_per_hour ?? 0];
        $price_list = $this->calculatePrice($prices,session('start_date'),session('end_date'));
        $car_images = CarModel::with(['carDoc'])->where('car_model_id', $car_model->model_id)->first();
        $image_list = !empty($car_images->carDoc) ? $car_images->carDoc : [];
        $ipr_info = Frontend::whereIn('data_keys',['ipr-info-section','general-setting'])->get();
        $info_section = !empty($ipr_info) ? $ipr_info->first() : [];
        $ipr_data = !empty($info_section['data_values']) ? json_decode($info_section['data_values'],true) : [];
        $general_setting = !empty($ipr_info) ? $ipr_info->last() : [];
        $general_section =  !empty($general_setting['data_values']) ? json_decode($general_setting['data_values'],true) : [];
          $available_cars = self::getAvailableCars();
        // Store booking details in session
        session([
            'booking_details' => [
                'car_id' => $id,
                'city_id' => session('city_id'),
                'car_details' => $car_model,
                'price_list' => $price_list,
                'delivery_fee' => $general_section['delivery_fee'],
                'total_price' => !empty($price_list['total_price']) ? $price_list['total_price'] : 0,
                'car_model' => $car_images,
                'start_date' => session('start_date'),
                'end_date' => session('end_date'),
            ]
        ]);

        return view('user.frontpage.single-car.view',compact('car_model','ipr_data','image_list','price_list','general_section','available_cars'));
    }

    public static function calculatePrice($prices, $from_date = null, $to_date = null)
    {
        $price = [];
        if (empty($from_date) && empty($to_date)) return $price;
        $start_date = str_replace('T', '  ', $from_date);
        $end_date = str_replace('T', '  ', $to_date);

        // If the input does not have a space, manually format it
        $start_date = preg_replace('/(\d{4}-\d{2}-\d{2})(\d{2}:\d{2})/', '$1 $2', showDateformat($start_date));
        $end_date = preg_replace('/(\d{4}-\d{2}-\d{2})(\d{2}:\d{2})/', '$1 $2', showDateformat($end_date));


        $start = Carbon::createFromFormat('d-m-Y H:i', $start_date);
        $end = Carbon::createFromFormat('d-m-Y H:i', $end_date);

        $festival_dates = Holiday::pluck('event_date')->toArray();

        $current = $start->copy();
        $dailyDetails = [];

        while ($current < $end) {
            $date = $current->format('Y-m-d');
            if (in_array($date, $festival_dates)) {
                $dailyDetails[$date]['hours'] = ($dailyDetails[$date]['hours'] ?? 0) + 1;
            } elseif ($current->isWeekend()) {
                $dailyDetails[$date]['hours'] = ($dailyDetails[$date]['hours'] ?? 0) + 1;
            } else {
                $dailyDetails[$date]['hours'] = ($dailyDetails[$date]['hours'] ?? 0) + 1;
            }
            // Move to the next hour
            $current->addHour();
        }
       $festival_total = $week_end_total = $week_days_total = $festival_amount = $week_end_amount = $week_days_amount = 0;
        foreach ($dailyDetails as $date => $details) {
            $hours = $details['hours'];
            if (in_array($date, $festival_dates)) {
                $festival_total += $prices['festival'] * $hours;
                $festival_amount = $festival_total;
            } elseif (Carbon::parse($date)->isWeekend()) {
                $week_end_total += $prices['weekend'] * $hours;
                $week_end_amount = $week_end_total;
            } else {
                $week_days_total += $prices['weekday'] * $hours;
                $week_days_amount = $week_days_total;
            }
        }
        $total_price = $festival_total + $week_end_total + $week_days_total;
        $diffInDays = $start->diffInDays($end);
        $diffInHours = $start->diffInHours($end) % 24;
        $diff_hour = $start->diffInHours($end);
        return ['total_days'=> $diffInDays , 'total_hours'=> $diffInHours ,'different_hours' =>$diff_hour, 'total_price'=> $total_price,
            'festival_amount' => $festival_amount , 'week_end_amount' => $week_end_amount, 'week_days_amount' => $week_days_amount];
    }


    public function storeDocuments(Request $request)
    {
        $request->validate([
            'aadhaar_number' => 'required|digits:12',
            'driving_licence' => 'required',
            'documents' => 'nullable|array|max:2',
            'documents.*' => 'mimes:jpg,png|max:2048',
        ]);

        $auth_id = Auth::id() ?? 0;
        $user = User::find($auth_id);
        $user->aadhaar_number = $request['aadhaar_number'];
        $user->driving_licence = $request['driving_licence'];
        $user->save();

        if ($request->hasFile('documents')) {
            foreach ($request['documents'] as $image) {
                $img_name = $image->getClientOriginalName();
                $img_name = Auth::id() . '_' . $img_name;
                $image->storeAs('user-documents/',  $img_name, 'public');
                $user_doc = new UserDocument();
                $user_doc->image_name = $img_name;
                $user_doc->user_id = Auth::id();
                $user_doc->save();
            }
        }
        return response()->json(['success' => 'User Documents saved successfully']);
    }


    public function profile() {
        $user_details = User::with('userDoc')->find(Auth::id());
        return view('user.frontpage.profile.view',compact('user_details'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'profile_name' => 'required|string|max:255',
            // 'user_mobile' => 'required|numeric|digits:10',
            //   'user_email' => 'required|email',
            // 'aadhaar_number' => 'required|digits:12',
            // 'driving_licence' => 'required',
            // 'other_documents' => 'nullable|mimes:jpg,png,pdf|max:2048',

        ]);
        $auth_id = Auth::id() ?? 0;
        $user = User::find($auth_id);


        // add the last username to the updated user name json array in db
        $updated_user_name = json_decode($user->updated_user_name, true);
        if (is_null($updated_user_name)) {
            $updated_user_name = [];
        }
        $updated_user_name[] = [
            "user_name" => $user->name,
            "updated_at" => now(),
        ];
        $user->updated_user_name = json_encode($updated_user_name);
        $user->name = $request['profile_name'];
        // $user->mobile = $request['user_mobile'];
        // $user->email = $request['user_email'];
        // $user->aadhaar_number = $request['aadhaar_number'];
        // $user->driving_licence = $request['driving_licence'];
        $user->save();

        return response()->json(['success' => true, 'message' => 'User Profile updated successfully']);

    }

     public function updateUserDocs(Request $request) {
        $request->validate([
            'documents' => 'required|string',
        ]);

        $auth_id = Auth::id() ?? 0;
        $user = User::find($auth_id);
        $user->documents = $request['documents'];
        $user->save();

        return response()->json(['success' => true, 'message' => 'User Profile updated successfully']);
    }

     public function updateUserDocument(Request $request)
    {
        $uniq_id =  Str::random(6);
        if ($request->hasFile('other_documents') && !empty($request['other_documents'])) {
            foreach ($request->file('other_documents') as $file) {
                $img_name = $file->getClientOriginalName();
                $img_name = $uniq_id . '_' . $img_name;
                $file->storeAs('user-documents/', $img_name, 'public');
                $user_docs = new UserDocument();
                $user_docs->image_name = $img_name;
                $user_docs->user_id = Auth::id();
                $user_docs->save();
            }
            return response()->json(['success' => true, 'message' => 'User Documents updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'User Documents updated Failed']);

    }

        public function destroy($id)
    {
        if (empty($id)) {
            return response()->json(['success' => false,'message' => 'Image not found.'], 404);
        }
            $userDoc = UserDocument::find($id);
            Storage::disk('public')->delete('user-documents/' . $userDoc->image_name);
            $userDoc->delete();
            return response()->json(['success' => true,'message' => 'Image deleted successfully.'], 200);
    }


    public function logout()
    {
       Auth::logout();
       session()->flush();
       return redirect()->route('home');
    }





}

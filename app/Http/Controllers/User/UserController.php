<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CarDetails;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function view()
    {
        $section1 = Frontend::with('frontendImage')->where('data_keys','section1-image-car')->first();
        $section2 = Coupon::all();
        $section3 = CarDetails::with('carModel')->get();
        $car_info = Frontend::with('frontendImage')->where('data_keys','car-info-section')->first();
        $section4 = !empty($car_info['data_values']) ? json_decode($car_info['data_values'],true) : [];
        $brand_info = Frontend::with('frontendImage')->where('data_keys','brand-section')->first();
        $section8 = !empty($brand_info['data_values']) ? json_decode($brand_info['data_values'],true) : [];
        $brand_image = !empty($brand_info->frontendImage) ? $brand_info->frontendImage : null;
        $car_image = !empty($car_info->frontendImage) ? $car_info->frontendImage : null;
        $faq_items = Frontend::where('data_keys','faq-section')->orderBy('created_at', 'desc')->get();
        return view('user.frontpage.list-home',compact('section1','section2','section3','section4','car_image'
            ,'brand_image','section8','faq_items'));
    }

    public function updateLocation(Request $request)
    {

        if (!empty($request['latitude']) && !empty($request['longitude'])) {
            $latitude = $request['latitude'];
            $longitude = $request['longitude'];

            if (!empty($request['start_date']) && !empty($request['end_date'])) {
                $request->session()->put('start_date',  str_replace('|', '', $request['start_date']));
                $request->session()->put('end_date', str_replace('|', '', $request['end_date']));
            }

            $client = new Client();
            $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
                'query' => [
                    'latlng' => $latitude . ',' . $longitude,
                    'key' => 'AIzaSyCgkUiA7zkxsdc8BwvCqVeSTDuJVncMmAY',
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            $isWithinCoimbatore = $this->isWithinCoimbatore($data);

            return response()->json(['isWithinCoimbatore' => $isWithinCoimbatore]);
        }
        return response()->json(['isWithinCoimbatore' => false]);
    }

    private function isWithinCoimbatore($data)
    {
        if (empty($data)) {
            return false;
        }
        foreach ($data['results'] as $result) {
            foreach ($result['address_components'] as $component) {
                if (in_array('administrative_area_level_3', $component['types']) && $component['long_name'] === 'Coimbatore') {
                    return true;
                }
            }
        }
        return false;
    }

    public function listCars() {
        $date = ['start_date' => Session::get('start_date'), 'end_date' =>  Session::get('end_date')];
        $car_models = CarDetails::with('carModel')->get();
        $festival_days = Holiday::pluck('event_date')->toArray();
        return view('user.frontpage.list-cars.list',compact('car_models','festival_days','date'));
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
        // Store booking details in session
        session([
            'booking_details' => [
                'car_id' => $id,
                'car_details' => $car_model,
                'price_list' => $price_list,
                'total_price' => !empty($price_list['total_price']) ? $price_list['total_price'] : 0,
                'car_model' => $car_images,
                'start_date' => session('start_date'),
                'end_date' => session('end_date'),
            ]
        ]);
        return view('user.frontpage.single-car.view',compact('car_model','ipr_data','image_list','price_list','general_section'));
    }

    public function calculatePrice($prices, $from_date = null, $to_date = null)
    {
        $price = [];
        if (empty($from_date) && empty($to_date)) return $price;
        $start_date = str_replace('|', '', $from_date);
        $end_date = str_replace('|', '', $to_date);

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
        return ['total_days'=> $diffInDays , 'total_hours'=> $diffInHours , 'total_price'=> $total_price,
            'festival_amount' => $festival_amount , 'week_end_amount' => $week_end_amount, 'week_days_amount' => $week_days_amount];
    }


    public function storeDocuments(Request $request)
    {
        $request->validate([
            'aadhaar_number' => 'required|digits:12',
            'driving_licence' => 'required',
            'documents' => 'required|array|max:2',
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
        $user_details = User::with('userDoc')->find(Auth::id())->first();
        return view('user.frontpage.profile.view',compact('user_details'));
    }

    public function downloadFile($filename)
    {
        $filePath = storage_path('app/public/user-documents/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404);
        }
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_mobile' => 'required|numeric|digits:10',
            'aadhaar_number' => 'required|digits:12',
            'driving_licence' => 'required',
            'driving_licence_doc' => 'nullable|mimes:jpg,png,pdf|max:2048',
            'aadhaar_number_doc' => 'nullable|mimes:jpg,png,pdf|max:2048',
        ]);
        $auth_id = Auth::id() ?? 0;
        $user = User::find($auth_id);
        $user->name = $request['user_name'];
        $user->mobile = $request['user_mobile'];
        $user->aadhaar_number = $request['aadhaar_number'];
        $user->driving_licence = $request['driving_licence'];

        $user->save();


        $uniq_id =  Str::random(6);
        if ($request->hasFile('driving_licence_doc') && !empty($request['driving_licence_id'])) {
            $user_doc = UserDocument::find($request['driving_licence_id']);
            $img_name = $request->file('driving_licence_doc')->getClientOriginalName();
            $img_name = $uniq_id . '_' . $img_name;
            $request->driving_licence_doc->storeAs('user-documents/', $img_name, 'public');
            $user_doc->image_name =  $img_name;
            $user_doc->user_id = Auth::id();
            $user_doc->save();
        }

        if ($request->hasFile('aadhaar_number_doc') && !empty($request['aadhaar_number_id'])) {
            $user_docs = UserDocument::find($request['aadhaar_number_id']);
            $img_name = $request->file('aadhaar_number_doc')->getClientOriginalName();
            $img_name = $uniq_id . '_' . $img_name;
            $request->aadhaar_number_doc->storeAs('user-documents/', $img_name, 'public');
            $user_docs->image_name =  $img_name;
            $user_docs->user_id = Auth::id();
            $user_docs->save();
        }

    }

    public function logout()
    {
       Auth::logout();
       return redirect()->route('home');
    }
}

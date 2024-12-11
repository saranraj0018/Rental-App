<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Trait\FaqTrait;
use App\Http\Controllers\Controller;
use App\Models\AdminDetail;
use App\Models\Frontend;
use App\Models\FrontendImage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BannerController extends Controller {

    use FaqTrait;
    public function view() {
        $frontend = Frontend::with('frontendImage')->where('data_keys', 'section1-image-car')->first();
        return view('admin.banner.section1', compact('frontend'));
    }

    public function save(Request $request) {
        if (empty($request['banner_id'])) {
            $request->validate([
                'image_car' => 'required|array|min:3',
                'image_car.*' => 'mimes:jpeg,png,jpg|max:2048',
            ]);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'features' => 'required|array|min:1',
            'features.*' => 'string',
        ]);


        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
            'features' => json_encode($request['features']),
        ];

        $frontend = !empty($request['banner_id']) ? Frontend::find($request['banner_id']) : new Frontend();
        $frontend->data_keys = 'section1-image-car';
        $frontend->data_values = json_encode($data);
        $frontend->save();

        if ($request->hasFile('image_car')) {
            foreach ($request['image_car'] as $key => $image) {
                $img_name = $image->getClientOriginalName();
                $img_name = uniqid() . '_' . $img_name;
                $image->storeAs('section1-image-car/', $img_name, 'public');
                if (!empty($request['banner_id'])) {
                    $car_image = FrontendImage::where('slug', 'banner-car-' . $key)->first();
                } else {
                    $car_image = new FrontendImage();
                    $car_image->slug = 'banner-car-' . $key;
                }
                $car_image->frontend_id = $frontend->id;
                $car_image->name = $img_name;
                $car_image->save();
            }
        }

        return response()->json(['success' => 'Banner section saved successfully']);
    }

    public function carInfo() {
        $car_info = Frontend::with('frontendImage')->where('data_keys', 'car-info-section')->first();
        $car_data = !empty($car_info['data_values']) ? json_decode($car_info['data_values'], true) : [];
        $car_image = !empty($car_info->frontendImage) ? $car_info->frontendImage : null;
        $car_info_id = !empty($car_info['id']) ? $car_info['id'] : null;
        return view('admin.car-info.view', compact('car_data', 'car_image', 'car_info_id'));
    }

    public function carSave(Request $request) {
        $request->validate([
            'daily_price' => ['required',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value) && !is_bool($value)) {
                        $fail($attribute . ' must be a number or a boolean.');
                    }
                },
            ],
            'daily_price_title' => 'required|string',
            'car_model' => 'required|string',
            'car_model_title' => 'required|string',
            'hour_rate' => ['required',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value) && !is_bool($value)) {
                        $fail($attribute . ' must be a number or a boolean.');
                    }
                },
            ],
            'hour_rate_title' => 'required|string',
            'rating' => ['required',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value) && !is_bool($value)) {
                        $fail($attribute . ' must be a number or a boolean.');
                    }
                },
            ],
            'rating_title' => 'required|string',
            'flexibility' => 'required|string',
            'flexibility_description' => 'required|string',
            'maintained' => 'required|string',
            'maintained_description' => 'required|string',
            'delivery' => 'required|string',
            'delivery_description' => 'required|string',
            'price' => 'required|string',
            'price_description' => 'required|string',
            'car_title' => 'required|string',
            'travel_description' => 'required|string',
            'description' => 'required|string',
            'discount' => 'required|string',
        ]);


        $data = [
            'car_information' => $request['car_information'],
            'daily_price' => $request['daily_price'],
            'daily_price_title' => $request['daily_price_title'],
            'car_model' => $request['car_model'],
            'car_model_title' => $request['car_model_title'],
            'hour_rate' => $request['hour_rate'],
            'hour_rate_title' => $request['hour_rate_title'],
            'rating' => $request['rating'],
            'rating_title' => $request['rating_title'],
            'valam_title' => $request['valam_title'],
            'flexibility' => $request['flexibility'],
            'flexibility_description' => $request['flexibility_description'],
            'maintained' => $request['maintained'],
            'maintained_description' => $request['maintained_description'],
            'delivery' => $request['delivery'],
            'delivery_description' => $request['delivery_description'],
            'price' => $request['price'],
            'price_description' => $request['price_description'],
            'car_title' => $request['car_title'],
            'travel' => $request['travel'],
            'travel_description' => $request['travel_description'],
            'valam_ride' => $request['valam_ride'],
            'description' => $request['description'],
            'discount' => $request['discount'],
        ];

        $frontend = !empty($request['car_info_id']) ? Frontend::find($request['car_info_id']) : new Frontend();
        $frontend->data_keys = 'car-info-section';
        $frontend->data_values = json_encode($data);
        $frontend->save();

        if ($request->hasFile('front_car_image')) {
            $img_name = $request->file('front_car_image')->getClientOriginalName();
            $img_name = uniqid() . '_' . $img_name;
            $request->front_car_image->storeAs('car-info-section/', $img_name, 'public');
            $car_image = FrontendImage::where('slug', 'car-info-section')->first();
            if (empty($car_image)) {
                $car_image = new FrontendImage();
                $car_image->slug = 'car-info-section';
            }
            $car_image->frontend_id = $frontend->id;
            $car_image->name = $img_name;
            $car_image->save();
        }

        return response()->json(['success' => 'Car info section saved successfully']);
    }

    public function brandList() {
        $brand_info = Frontend::with('frontendImage')->where('data_keys', 'brand-section')->first();
        $brand_titles = !empty($brand_info['data_values']) ? json_decode($brand_info['data_values'], true) : [];
        $brand_image = !empty($brand_info->frontendImage) ? $brand_info->frontendImage : null;
        $brand_id = !empty($brand_info['id']) ? $brand_info['id'] : null;
        return view('admin.brand.view', compact('brand_titles', 'brand_image', 'brand_id'));
    }

    public function brandSave(Request $request) {

        $request->validate([
            'vacation_description.*' => 'required|string|max:255',
            'vacation_url.*' => 'required|string|max:255',
        ]);



        $data = [
            'brand_title' => $request['brand_title'],
            'vacation_trip' => $request['vacation_trip'],
        ];

        $frontend = !empty($request['brand_id']) ? Frontend::find($request['brand_id']) : new Frontend();
        $frontend->data_keys = 'brand-section';
        $frontend->data_values = json_encode($data);
        $frontend->save();
        // Handle vacation descriptions and URLs
        foreach ($request->all() as $key => $value) {
            if (preg_match('/^vacation_description_(\d+)$/', $key, $matches)) {
                $index = !empty($matches[1]) ? $matches[1] : 0;

                if (!empty($request['brand_id']) && !empty($index)) {
                    $vac_image = FrontendImage::find($index);
                    if (empty($vac_image)) {
                        $vac_image = new FrontendImage();
                        $vac_image->slug = 'vacation-image';
                        $vac_image->frontend_id = $frontend->id;
                    }
                } else {
                    $vac_image = new FrontendImage();
                    $vac_image->slug = 'vacation-image';
                    $vac_image->frontend_id = $frontend->id;
                }
                if ($request->hasFile("vacation_image_$index")) {
                    $file = $request->file("vacation_image_$index");
                    $vacation_image = uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('vacation-section/', $vacation_image, 'public');
                    $vac_image->name = $vacation_image;
                }
                $vac_image->title = $request['vacation_url_' . $index];
                $vac_image->description = $request['vacation_description_' . $index];
                $vac_image->save();

            }

            if (preg_match('/^car_image_(\d+)$/', $key, $matches)) {
                $index_or_id = !empty($matches[1]) ? $matches[1] : 0;


                if (!empty($request['brand_id']) && !empty($index_or_id)) {
                    $car_image = FrontendImage::find($index_or_id);
                    if (empty($car_image)) {
                        $car_image = new FrontendImage();
                        $car_image->slug = 'brand-image';
                        $car_image->frontend_id = $frontend->id;
                    }
                } else {
                    $car_image = new FrontendImage();
                    $car_image->slug = 'brand-image';
                    $car_image->frontend_id = $frontend->id;
                }
                if ($request->hasFile("car_image_$index_or_id")) {
                    $file = $request->file("car_image_$index_or_id");
                    $brand_image = uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('brand-section/', $brand_image, 'public');
                    $car_image->name = $brand_image;
                    $car_image->save();
                }
            }
        }
        return response()->json(['success' => 'Brand And Vacation saved successfully']);
    }

    public function delete($id) {
        $frontend = FrontendImage::find($id);
        $frontend->delete();
        return response()->json(['success' => 'Deleted Image successfully']);
    }

    public function iprInfo() {
        $ipr_info = Frontend::where('data_keys', 'ipr-info-section')->first();
        $ipr_data = !empty($ipr_info['data_values']) ? json_decode($ipr_info['data_values'], true) : [];
        $ipr_id = !empty($ipr_info['id']) ? $ipr_info['id'] : null;
        return view('admin.ipr-info.list', compact('ipr_data', 'ipr_id'));
    }

    public function iprSave(Request $request) {
        $request->validate([
            'price_plan' => 'required|string',
            'price_description' => 'required|string',
            'fuel' => 'required|string',
            'fuel_description' => 'required|string',
            'picture_id' => 'required|string',
            'picture_description' => 'required|string',
            'car_key' => 'required|string',
            'car_key_description' => 'required|string',
        ]);

        $data = [
            'point_title' => $request['point_title'],
            'price_plan' => $request['price_plan'],
            'price_description' => $request['price_description'],
            'fuel' => $request['fuel'],
            'fuel_description' => $request['fuel_description'],
            'picture_id' => $request['picture_id'],
            'picture_description' => $request['picture_description'],
            'car_key' => $request['car_key'],
            'car_key_description' => $request['car_key_description'],
        ];
        $frontend = !empty($request['ipr_info_id']) ? Frontend::find($request['ipr_info_id']) : new Frontend();
        $frontend->data_keys = 'ipr-info-section';
        $frontend->data_values = json_encode($data);
        $frontend->save();

        return response()->json(['success' => 'Important Points section saved successfully']);
    }

    public function generalList() {
        $general = Frontend::where('data_keys', 'general-setting')->first();
        $referral_code = AdminDetail::where('role', 1)->value('referral_code');
        return view('admin.general.list', compact('general', 'referral_code'));
    }

    public function generalSave(Request $request) {
        $request->validate([
            'minimum_hours' => 'required|numeric',
            'maximum_hours' => 'required|numeric|gt:minimum_hours',
            'delivery_fee' => 'required|numeric',
            'show_duration' => 'required|numeric',
            'show_bookmarks' => 'required',

        ], [
            'maximum_hours.gt' => 'The maximum hours must be greater than the minimum hours.',
        ]);




        $minimum_hours = $maximum_hours = $duration = 0;
        $show_bookmarks = $request->show_bookmarks;

        if ($request['minimum_duration_type'] == 'hours') {
            $minimum_hours = (int) $request['minimum_hours'];
        } elseif ($request['minimum_duration_type'] == 'days') {
            $minimum_hours = (int) $request['minimum_days'] * 24;
        }

        if ($request['maximum_duration_type'] == 'hours') {
            $maximum_hours = (int) $request['maximum_hours'];
        } elseif ($request['maximum_duration_type'] == 'days') {
            $maximum_hours = (int) $request['maximum_hours'] * 24;
        }

        if ($request['duration_type'] == 'year') {
            $year = (int) $request['show_duration'];
            $duration = Carbon::now()->addYears($year)->format('d-m-Y');
        } elseif ($request['duration_type'] == 'months') {
            $month = (int) $request['show_duration'];
            $duration = Carbon::now()->addMonths($month)->format('d-m-Y');
            ;
        }


        $data = [
            'minimum_hours' => $request['minimum_hours'],
            'maximum_hours' => $request['maximum_hours'],
            'delivery_fee' => $request['delivery_fee'],
            'show_delivery' => $request['show_delivery'] ?? 0,
            'booking_duration' => $request['booking_duration'] ?? 0,
            'show_duration' => $request['show_duration'] ?? 0,
            'front_duration' => $duration,
            'duration_type' => $request['duration_type'] ?? 0,
            'total_minimum_hours' => $minimum_hours,
            'total_maximum_hours' => $maximum_hours,
            'show_bookmarks' => $show_bookmarks,
        ];

        $frontend = !empty($request['general_id']) ? Frontend::find($request['general_id']) : new Frontend();
        $frontend->data_keys = 'general-setting';
        $frontend->data_values = json_encode($data);
        $frontend->save();

        return response()->json(['success' => 'General Setting Saved Successfully']);
    }

}

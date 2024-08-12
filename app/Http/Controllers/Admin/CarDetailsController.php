<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarDetails;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarDetailsController extends Controller
{
    public function list(Request $request)
    {
        return view('admin.cars.list');
    }

    public function save(Request $request)
    {
         $request->validate([
            'service_city' => 'required',
            'hub_city' => 'required',
            'car_model' => 'required|integer',
            'register_number' => 'required|string|max:80',
            'current_km' => 'required|numeric',
        ]);

        if (!empty($request['car_id'])) {
            $car_details = CarDetails::find($request['car_id']);
        } else {
            $car_details = new CarDetails();
        }

        $service_city = $request['service_city'];
        $hub_city = $request['hub_city'];
        $hub = explode('-', $hub_city);
        $city = explode('-', $service_city);
        $hub_code = current($hub);
        $hub_city = end($hub);
        $city_code = current($city);
        $city_name = end($city);
        $car_details->city_name = $city_name;
        $car_details->city_code = $city_code;
        $car_details->hub =$hub_city;
        $car_details->hub_code = $hub_code;
        $car_details->model_id = $request['car_model'];
        $car_details->register_number = $request['register_number'];
        $car_details->current_km = $request['current_km'];
        $car_details->save();
        return response()->json(['success' => 'Car details saved successfully']);
    }
}

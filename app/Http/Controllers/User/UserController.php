<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\CarModel;
use App\Models\Coupon;
use App\Models\Frontend;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view()
    {
        $section1 = Frontend::with('frontendImage')->where('data_keys','section1-image-car')->first();
        $section2 = Coupon::all();
        $section3 = CarModel::all();
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
        $car_models = CarModel::with('carDoc')->get();
        return view('user.frontpage.list-cars.list',compact('car_models'));
    }

    public function bookingCar(Request $request,$id)
    {
        if (!empty($id)) {
            $car_model = CarModel::with('carDoc')->where('car_model_id', $id)->first();
        }
        return view('user.frontpage.single-car.view',compact('car_model'));

    }
}

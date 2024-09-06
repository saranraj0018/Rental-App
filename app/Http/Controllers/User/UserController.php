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
        return view('user.frontpage.main',compact('section1','section2','section3','section4','car_image'
        ,'brand_image','section8','faq_items'));
    }

    public function updateLocation(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

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

//    private function getDistrictFromCoordinates($latitude, $longitude)
//    {
//        $apiKey = 'AIzaSyCgkUiA7zkxsdc8BwvCqVeSTDuJVncMmAY'; // Store your API key in .env file
//        $client = new Client();
//        $response = $client->get("https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}");
//        $data = json_decode($response->getBody(), true);
//
//        if (!empty($data['results'])) {
//
//            foreach ($data['results'][0]['address_components'] as $component) {
//                if (in_array('administrative_area_level_3', $component['types'])) {
//                    dd($data);
//                    return $component['long_name'];
//                }
//            }
//        }
//
//        return 'Unknown district';
//    }

    private function isWithinCoimbatore($data)
    {
        foreach ($data['results'] as $result) {
            foreach ($result['address_components'] as $component) {
                if (in_array('administrative_area_level_3', $component['types']) && $component['long_name'] === 'Coimbatore') {
                    return true;
                }
            }
        }
        return false;
    }

}

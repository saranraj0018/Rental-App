<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CarDetails;
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
}

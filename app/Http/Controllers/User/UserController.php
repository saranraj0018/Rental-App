<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Frontend;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view()
    {
        $section1 = Frontend::with('frontendImage')->where('data_keys','section1-image-car')->first();
        $section2 = Coupon::all();
        return view('user.frontpage.main',compact('section1','section2'));
    }
}

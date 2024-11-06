<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function list(Request $request)
    {
        $holidays = City::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.holiday.list', compact('holidays'));
    }
}

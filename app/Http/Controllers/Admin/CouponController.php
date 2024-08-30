<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $coupons = Coupon::paginate(10);
        return view('admin.coupon.list', compact('coupons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'prefix' => 'max:144',
            'coupon_code' => 'required|string|max:20',
            'coupon_start_date' => 'required|date|before:coupon_end_date',
            'coupon_end_date' => 'required||after:coupon_start_date',
        ]);
        $coupon = $request['coupon_id'] ? Coupon::find($request['coupon_id']) : new Coupon();
        $car_details->city_name = $city_name;
        $car_details->city_code = $city_code;
        $car_details->hub = $hub_city;
        $car_details->hub_code = $hub_code;
        $car_details->model_id = $request['car_model'];
        $car_details->register_number = $request['register_number'];
        $car_details->current_km = $request['current_km'];
        $car_details->save();

        $cars = CarDetails::with('carModel')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=> $cars,'success' => 'Car details saved successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}

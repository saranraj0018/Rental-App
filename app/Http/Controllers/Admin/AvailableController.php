<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Available;
use App\Models\CarDetails;
use App\Models\CarModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AvailableController extends Controller
{
    public function availableList(Request $request)
    {
        $car_available = Available::all();
        $car_model = CarModel::pluck('model_name','car_model_id');
        return view('admin.car-available.show',compact('car_available','car_model'));
    }

    public function available(Request $request)
    {
        $model_id = $request['model_id'];

        $current_month = Carbon::now()->month;
        $current_year = Carbon::now()->year;

        $bookings = Available::where('model_id', $model_id)
            ->whereYear('start_date', $current_year)
            ->whereMonth('start_date', $current_month)
            ->get();

        $availability = [];
        foreach ($bookings as $booking) {
            $day = Carbon::parse($booking->start_date)->dayOfWeek; // 0 for Sunday, 6 for Saturday
            $availability[$day][] = [
                'start_time' => Carbon::parse($booking->start_date)->format('H:i'),
                'end_time' => Carbon::parse($booking->end_date)->format('H:i'),
                'booking_type' => $booking->booking_type,
            ];
        }
        return view('admin.car-available.model', compact('availability'));
    }


}

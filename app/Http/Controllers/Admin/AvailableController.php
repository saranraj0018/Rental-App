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
        $car_model = CarModel::pluck('model_name');
        return view('admin.car-available.show',compact('car_available','car_model'));
    }

    public function getCarAvailability(Request $request)
    {
        $modelId = $request->input('model_id');

        $cars = CarDetails::where('model_id', $modelId)->get();
        $bookings = Available::whereIn('car_id', $cars->pluck('id'))
            ->get();

        $availability = [];

        foreach ($cars as $car) {
            $availability[$car->reg_no] = [];
            for ($day = 0; $day < $date->daysInMonth; $day++) {
                for ($hour = 0; $hour < 24; $hour++) {
                    $availability[$car->reg_no][$day][$hour] = 'Available'; // Default status
                }
            }

            foreach ($bookings as $booking) {
                if ($booking->car_id == $car->id) {
                    $start = Carbon::parse($booking->start_date);
                    $end = Carbon::parse($booking->end_date);

                    while ($start->lessThanOrEqualTo($end)) {
                        $day = $start->day - 1; // Adjusting for zero-indexed array
                        $hour = $start->hour;

                        $availability[$car->reg_no][$day][$hour] = $booking->booking_type; // e.g., 'Booking', 'Maintenance'
                        $start->addHour();
                    }
                }
            }
        }

        return view('admin.car-availability', compact('availability', 'date', 'modelId'));
    }


}

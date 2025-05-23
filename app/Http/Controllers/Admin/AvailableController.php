<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as Controller;
use App\Models\Available;
use App\Models\CarDetails;
use App\Models\CarModel;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AvailableController extends Controller {
    public function availableList() {
        $this->authorizePermission('car_availablity_view');
        $car_available = Available::all();
        $car_model = CarModel::pluck('model_name', 'car_model_id');
        $city_list = City::where('city_status', 1)->pluck('name', 'code');
        return view('admin.car-available.show', compact('car_available', 'car_model', 'city_list'));
    }



        public function available(Request $request) {
        if (empty($request['model_id']) || empty($request['city_code'])) {
            return ['bookings' => []];
        }
        $model_id = $request['model_id'];
        $city_code = $request['city_code'];
        $week_offset = $request['week_offset'];;
        $startDate = now()->addDays(intval($week_offset) * 7)->format('Y-m-d');
        $endDate = now()->addDays(intval($week_offset) * 7 + 6)->format('Y-m-d');
        $startDate = Carbon::parse($startDate)->startOfDay(); // Ensure start of day
        $endDate = Carbon::parse($endDate)->endOfDay();
        // Fetch car details with related bookings
        $carDetails = CarDetails::with(['availableBookings' => function ($query) use ($startDate, $endDate) {
            $query->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate]) // Booking starts within the range
                ->orWhereBetween('end_date', [$startDate, $endDate]) // Booking ends within the range
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->where('start_date', '<=', $startDate) // Booking starts before the range
                    ->where('end_date', '>=', $endDate);   // and ends after the range
                });
            });
        }])->where('city_code', $city_code)
            ->where('model_id', $model_id)
            ->get();


        $bookings = [];

        foreach ($carDetails as $carDetail) {
            $registerNumber = $carDetail->register_number;
            $carDetailBookings = $carDetail->availableBookings->map(function ($booking) use ($registerNumber) {
                $startDate = $booking->start_date;
                $endDate = $booking->end_date;

                return [
                    'register_number' => $registerNumber, // Include register number here
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'booking_type' => $booking->booking_type,
                    'booking_id' => $booking->booking_id
                ];
            })->toArray(); // Convert the collection to an array
            if (empty($carDetailBookings)) {
                $bookings[] = [
                    'register_number' => $registerNumber, // Set to null
                    'start_date' => null,
                    'end_date' => null,
                    'booking_type' => null,
                    'booking_id' => null,
                ];
            }

            // Merge the current car detail bookings into the $bookings array
            $bookings = array_merge($bookings, $carDetailBookings);
        }
        return response()->json(['bookings' => $bookings]);
    }

}

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
        $model_id = $request->input('model_id');
        $week_offset = $request->input('week_offset', 0);

        // Fetch car details with related bookings
        $carDetails = CarDetails::with(['availableBookings' => function($query) use ($week_offset) {
            $startDate = now()->addDays($week_offset * 7);
            $endDate = $startDate->copy()->addDays(6);
            $query->whereBetween('start_date', [$startDate, $endDate]);
        }])->where('model_id', $model_id)->get();

        $bookings = [];
        foreach ($carDetails as $carDetail) {
            // Extract the register number
            $registerNumber = $carDetail->register_number;
            // Map bookings for the current car detail and handle empty dates
            $carDetailBookings = $carDetail->availableBookings->map(function($booking) use ($registerNumber) {
                // Check if start_date or end_date is empty
                $startDate = $booking->start_date;
                $endDate = $booking->end_date;
                // Otherwise, return the booking with the register number
                return [
                    'register_number' => $registerNumber, // Include register number here
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'booking_type' => $booking->booking_type,
                ];
            })->toArray(); // Convert the collection to an array
           if (empty($carDetailBookings)) {
               $bookings[] = [
                   'register_number' => $registerNumber, // Set to null
                   'start_date' => null,
                   'end_date' => null,
                   'booking_type' => null,
               ];
           }

            // Merge the current car detail bookings into the $bookings array
            $bookings = array_merge($bookings, $carDetailBookings);
        }
        return response()->json(['bookings' => $bookings]);
    }





}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as Controller;
use App\Models\Available;
use App\Models\CarBlock;
use App\Models\CarDetails;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;

class DashboardController extends Controller {
    public function view() {
        return view('admin.dashboard', ['hubs' => City::where('city_status', 1)->where('name', '!=', '')->pluck('name')->toArray()]);
    }

    public function dataset(Request $request) {

         $hub = $request->query('hub');


        // get booked cars
        $booked_cars = \App\Models\Booking::where('status', '=', 1)
            ->where('booking_type', '=', "pickup")
            ->whereDate('end_date', '>=', now()->toDateString())
            ->pluck('car_id', 'id')
            ->toArray();


        # get available list
        $_available = Available::where('end_date', '>=', now())->pluck('car_id','id')->toArray();
        $_blocked = CarBlock::where('end_date', '>=', now())->pluck('car_register_number')->toArray();
        
        $todays_booking = \App\Models\Booking::select('booking_id')->whereBetween('created_at', [
            Carbon::now()->startOfDay(),
            Carbon::now()->endOfDay()
        ])->groupBy('booking_id')->get()->count();

        # get cars list
        $cars = CarDetails::with('city')->get()->toArray();

        $main = collect($cars)->map(function ($car) use ($_available, $_blocked, $booked_cars) {
            return [
              'id' => !empty($car['id']) ? $car['id'] : 0,
                "city" => !empty($car["city"]["name"]) ? $car["city"]["name"] : '',
                "booked" => in_array($car['id'], $booked_cars),
                "blocked" => in_array($car['register_number'], $_blocked)
            ];
        })->filter(fn($hub) => $hub["city"] != "");
        

        if($hub != 'all') {
            $main = $main->filter(fn($item) => $item["city"] == $hub);
        }
        

        $dataset = new Fluent();
        $dataset->available_cars = $main->filter(fn($car) => !$car['booked'] && !$car['blocked'])->count();
        $dataset->booked_cars = $main->filter(fn($car) => $car['booked'] == true)->count();
        $dataset->blocked_cars = $main->filter(fn($car) => $car['blocked'] == true)->count();
        $dataset->total_users = User::count();
        $dataset->todays_booking = $todays_booking;
        


        # get booking cars list
        $dataset->hubs_list = City::where('city_status', 1)->where('name', '!=', '')->pluck('name');
        $dataset->hubs = $main->groupBy('city');

        $dataset->hubs_available = $dataset->hubs->map(function ($hub) {
            return $hub->filter(fn($_item) => !$_item['booked'] && !$_item['blocked'])->count();
        })->toArray();

        $dataset->hubs_booked = $dataset->hubs->map(function ($hub) {
            return $hub->filter(fn($_item) => $_item['booked'] == true)->count();
        })->toArray();

        $dataset->hubs_available_list = array_values($dataset->hubs_booked);
        $dataset->hubs_blocked = $dataset->hubs->map(function ($hub) {
            return $hub->filter(fn($_item) => $_item['blocked'] == true)->count();
        });


        return response()->json($dataset);
    }



}

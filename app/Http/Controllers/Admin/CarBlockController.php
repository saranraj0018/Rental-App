<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Available;
use App\Models\CarBlock;
use App\Models\CarDetails;
use App\Models\CarModel;
use App\Models\City;
use App\Models\Frontend;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarBlockController extends BaseController
{
    public function list(Request $request)
    {
        //$this->authorizePermission('car_bk_tab');
        $car_block = CarBlock::with('user')->orderBy('created_at', 'desc')->paginate(20);
        $car_models = CarModel::all(['car_model_id','model_name']);
        $car_details = CarDetails::where('status',1)->pluck('register_number');
        $city_list = City::where('city_status',1)->pluck('name','code');
        $permissions = getAdminPermissions();
        return view('admin.cars.blocks.list',compact('car_block','car_models','car_details','city_list','permissions'));
    }

    public function save(Request $request)
    {
        $this->authorizePermission('car_av_add');
        $blockType = $request['block_type'];
        $request->validate([
            'block_type' => 'required|in:0,1,2,3,4,5',
            'hub_city' => 'required',
            'car_model' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'comment' => $blockType != '1' ? 'required|string' : 'nullable',
            'block_car_register_number' => 'required|not_in:Car Register Number',
            'reason' => 'required_if:block_type,0',
            'reason_discretion' => 'required_if:block_type,1',

        ]);
        $car_block = new CarBlock();
        $car_block->block_type = $request['block_type'];
        $car_block->hub = $request['hub_city'];
        $car_block->car_model = $request['car_model'];
        $car_block->booking_id = $request['booking_id'];
        $car_block->car_register_number = $request['block_car_register_number'];
        $car_block->start_date = $request['start_date'];
        $car_block->end_date = $request['end_date'];
        $car_block->comment = $request['block_type'] != 1 ? $request['comment'] : null;
        $car_block->reason =  $request['block_type'] == 0 || $request['block_type'] == 1 ?
            !empty($request['reason']) ? $request['reason'] : $request['reason_discretion'] : null;
        $car_block->user_id = Auth::guard('admin')->id();
        $car_block->save();

        $setting = Frontend::where('data_keys','general-setting')->orderBy('created_at', 'desc')->first();
        $timing_setting = !empty($setting['data_values']) ? json_decode($setting['data_values'],true) : [];
        $car_available = new Available();
        $car_available->car_id = !empty($car_status->id) ?  $car_status->id : 0;
        $car_available->model_id = !empty($request['car_model']) ? $request['car_model']: 0;
        $car_available->booking_id = !empty($car_block->id) ? $car_block->id: 0;
        $car_available->register_number = !empty($request['block_car_register_number']) ? $request['block_car_register_number'] : 0;
        $car_available->start_date = $request['start_date'];
        $car_available->end_date = $request['end_date'];
        $car_available->next_booking = Carbon::parse(formDateTime($request['end_date']))->addHours($timing_setting['booking_duration'] ?? 3);
        $car_available->booking_type = $request['block_type'] == 1 ? 6 : $request['block_type'];
        $car_available->save();

        $car_block_list = CarBlock::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=> $car_block_list,'success' => 'Car blocked saved successfully']);
    }

    public function update(Request $request)
    {
        $this->authorizePermission('car_av_edit');
        $request->validate([
            'edit_start_date' => 'required|date',
            'edit_end_date' => 'required|date|after:start_date',
            'edit_comment' => 'required|string',
        ]);
        $car_block = CarBlock::find($request['block_id']);
        $car_block->start_date = $request['edit_start_date'];
        $car_block->end_date = $request['edit_end_date'];
        $car_block->comment = $request['edit_comment'];
        $car_block->user_id = Auth::guard('admin')->id();
        $car_block->save();
        $car_block_list = CarBlock::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=> $car_block_list,'success' => 'Car blocked Update successfully']);
    }

    public function delete($id)
    {
        CarBlock::find($id)?->delete();
        Available::where('booking_id', $id)->first()?->delete();

        $car_block_list = CarBlock::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=> $car_block_list,'success' => 'Car blocked Delete successfully']);
    }

    public function search(Request $request)
    {
        $query = CarBlock::with('user');
        if ($request->filled('block_type')) {
            $query->where('block_type', $request['block_type']);
        }

        if ($request->filled('register_number')) {
            $query->where('car_register_number', 'like', '%' .  $request['register_number']. '%');
        }

        $car_block = $query->get();

        return response()->json([
            'data' => $car_block,
        ]);
    }

    public function getCarModelsByHub(Request $request)
    {
        if (!$request->filled('hub_id')) {
            return response()->json([
                'carModels' => []
            ]);
        }
        $hub_id = $request['hub_id'];
        // Fetch car details related to the selected hub, and eager load the related car model
        $carModels = CarDetails::with('carModel') // Eager load the car model
        ->where('city_code', $hub_id) // Filter by hub (city_code)
        ->get();

        // Prepare the data for the response
        $models = $carModels->map(function ($carDetail) {
            return [
                'id' => $carDetail->carModel->car_model_id, // Access the related car model ID
                'name' => $carDetail->carModel->model_name, // Access the related car model name
            ];
        });
        $all_models = !empty($models) ? collect($models)->unique('id')->values()->all() : [];
        return response()->json([
            'carModels' => $all_models
        ]);
    }

    public function getCarRegistrationNumbersByModel(Request $request)
    {
        if (!$request->filled('model_id') && !$request->filled('start_date') && !$request->filled('end_date')) {
            return response()->json([
                'cars' => []
            ]);
        }
        $register_number = [];
        $available_cars = PickupDeliveryController::carAvailablity($request['model_id'],$request['start_date'],$request['end_date']);
        if (!empty($available_cars)) {
            foreach ($available_cars as $available_car) {
                $register_number[] = $available_car['register_number'];
            }
        }
        return response()->json([
            'register_number' => $register_number
        ]);
    }
}

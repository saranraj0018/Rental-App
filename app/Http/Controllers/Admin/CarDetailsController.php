<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\CarDetails;
use App\Models\CarDocument;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CarDetailsController extends BaseController
{

    public function list(Request $request)
    {
        $this->authorizePermission('car_list_tab');
        $permissions = getAdminPermissions();
        $car_list =  CarDetails::with('carModel')->orderBy('created_at', 'desc')->paginate(10);
        $car_models = CarModel::all(['car_model_id','model_name']);
        return view('admin.cars.list',compact('car_list','car_models','permissions'));
    }

    public function save(Request $request)
    {
        $this->authorizePermission('car_list_add');

        if (!empty($request['car_id'])) {
            $this->authorizePermission('car_list_edit');
        }
        if (!empty($request['car_location_option']) && empty($request['car_latitude'])) {
            $request->merge(['car_location' => '']);
            $request->validate([
                'car_location' => 'required',
            ]);
        }



         $request->validate([
            'service_city' => 'required',
            'hub_city' => 'required',
            'car_model' => 'required',
            'register_number' => 'required|string|max:50|unique:car_details,register_number',
            'current_km' => 'required|numeric',
        ]);

         $car_details = !empty($request['car_id']) ? CarDetails::find($request['car_id']) :  new CarDetails();
        $service_city = $request['service_city'];
        $hub_city = $request['hub_city'];
        $hub = explode('-', $hub_city);
        $city = explode('-', $service_city);
        $hub_code = current($hub);
        $hub_city = end($hub);
        $city_code = current($city);
        $city_name = end($city);
        $car_details->city_name = $city_name;
        $car_details->city_code = $city_code;
        $car_details->hub = $hub_city;
        $car_details->hub_code = $hub_code;
        $car_details->model_id = $request['car_model'];
        $car_details->register_number = $request['register_number'];
        $car_details->current_km = $request['current_km'];
        $car_details->latitude = $request['car_latitude'];
        $car_details->longitude = $request['car_longitude'];
        $car_details->address = $request['car_address'];
        $car_details->save();

        $cars = CarDetails::with('carModel')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=> $cars,'success' => 'Car details saved successfully']);
    }


    public function saveModels(Request $request)
    {

        $this->authorizePermission('car_list_add_model');

        if (!empty($request['model_id'])) {
            $this->authorizePermission('car_list_model_edit');
        }

        $request->validate([
            'producer' => 'required|max:144',
            'model_name' => [
                'required_if:model_id,null',
                'max:50',
                Rule::unique('car_models')->ignore($request['model_id'])
            ],
            'seats' => 'required|max:14',
            'fuel_type' => 'required|string|max:30',
            'transmission' => 'required|max:50',
            'engine_power' => 'required|max:80',
            'price_per_hours' => 'required',
            'weekend_surge' => 'required|max:144',
            'peak_season' => 'required|max:144',
            'extra_km_charge' => 'required',
            'dep_amount' => 'required|numeric',
            'extra_hours_charge' => 'required',
            'day_km' => 'required',
            'car_image' => 'required|mimes:jpg,png',
            'car_other_image' => 'required|array|min:2',
            'car_other_image.*' => 'mimes:jpg,png',
        ]);
        $uniq_id =  Str::random(15);

        if (!empty($request['model_id'])) {
            $car_models = CarModel::find($request['model_id']);
        } else {
            $car_models = new CarModel();
            $car_models->car_model_id = $uniq_id;
        }
        $car_models->producer = $request['producer'];
        $car_models->model_name = $request['model_name'];
        $car_models->seat = $request['seats'];
        $car_models->fuel_type = $request['fuel_type'];
        $car_models->transmission = $request['transmission'];
        $car_models->engine_power = $request['engine_power'];
        $car_models->extra_hours_price = $request['extra_hours_charge'];
        $car_models->dep_amount = $request['dep_amount'];
        $car_models->per_day_km = $request['day_km'];
        $car_models->price_per_hour = $request['price_per_hours'];
        $car_models->weekend_surge = $request['weekend_surge'];
        $car_models->peak_reason_surge = $request['peak_season'];
        $car_models->extra_km_charge = $request['extra_km_charge'];

        if ($request->hasFile('car_image')) {
            $img_name = $request->file('car_image')->getClientOriginalName();
            $img_name = $uniq_id . '_' . $img_name;
            $request->car_image->storeAs('car_image/', $img_name, 'public');
            $car_models->car_image =  $img_name;
        }
        $car_models->save();

        if ($request->hasFile('car_other_image')) {
            foreach ($request['car_other_image'] as $image) {
                $img_name = $image->getClientOriginalName();
                $img_name = $uniq_id . '_' . $img_name;
                $image->storeAs('car_other_image/',  $img_name, 'public');
                $car_documents =  !empty($request['model_id']) ? CarDocument::where('model_id',$request['model_id'])->first()
                    : new CarDocument();
                $car_documents->name = $img_name;
                $car_documents->model_id = $car_models->id;
                 $car_documents->save();

            }
        }
        return response()->json(['success' => 'Car Models saved successfully']);
    }

    public function delete($id)
    {
        $this->authorizePermission('car_list_delete');
        $delete_car = CarDetails::find($id);
        $delete_car->delete();
        $cars = CarDetails::with('carModel')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=> $cars,'success' => 'Car details saved successfully']);
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        $query = CarDetails::with('carModel');

        if (!empty($keyword)) {
            // Concatenate search conditions if keyword is provided
            $query->where(function($q) use ($keyword) {
                $q->where('model_id', 'LIKE', "%$keyword%")
                    ->orWhere('register_number', 'LIKE', "%$keyword%")
                    ->orWhereHas('carModel', function ($query) use ($keyword) {
                        $query->where('model_name', 'LIKE', "%$keyword%");
                    });
            });
        }

        $car_list = $query->get();

        return response()->json([
            'data' => $car_list,
        ]);
    }
}

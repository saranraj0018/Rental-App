<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function list(Request $request)
    {
        $city = City::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.city.list', compact('city'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'city_name' => 'required|string|max:144',
        ]);
        $city = !empty($request['city_id']) ? City::find($request['city_id']) : new City();
        $city->name = $request['city_name'];
        $city->code = rand(100, 999);
        $city->city_status = $request['city_status'];
        $city->user_id = Auth::guard('admin')->id();
        $city->save();

        $city_list = City::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return response()->json(['data'=> ['city' => $city_list->items(), 'pagination' => $city_list->links()->render()],'success' => 'City Created successfully']);

    }

    public function delete($id)
    {
        City::find($id)->delete();
        $city_list = City::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return response()->json(['data'=> ['city' => $city_list->items(), 'pagination' => $city_list->links()->render()],'success' => 'City Deleted successfully']);
    }

}

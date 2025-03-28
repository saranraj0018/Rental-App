<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as Controller;
use App\Models\City;
use App\Models\HubAera;
use App\Models\HubArea;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function show()
    {
         $permissions = getAdminPermissions();
        $this->authorizePermission('cities_map_view');
    $city_list = City::where('city_status', 1)->get(['name', 'code', 'latitude', 'longitude']);
        return view('admin.city-map.show', compact('city_list', 'permissions'));
    }

    public function store(Request $request)
    {
           $this->authorizePermission('cities_map_create');
        $validated = $request->validate([
            'polygons' => 'required|array',
            'hub' => 'required',
            'polygons.*' => 'required|array',
            'polygons.*.*.lat' => 'required|numeric',
            'polygons.*.*.lng' => 'required|numeric',
        ]);

        HubArea::where('hub', $validated['hub'])->delete();

        foreach ($validated['polygons'] as $polygon) {
            $area = new HubArea();
            $area->coordinates = json_encode($polygon); // Save each polygon as JSON
            $area->hub = $validated['hub'];
            $area->save();
        }
        return response()->json(['message' => 'Area saved successfully']);
    }

    public function getCityCoordinates(Request $request)
    {
        $city = $request->input('city');
        $areas = HubArea::where('hub', $city)->get(); // Get all polygons for the city
        $coordinates = $areas->map(function($area) {
            return json_decode($area->coordinates, true); // Decode each area’s coordinates
        });
          return response()->json(['data' => $coordinates]);
    }


}

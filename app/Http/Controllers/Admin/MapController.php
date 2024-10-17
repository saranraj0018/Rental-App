<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HubAera;
use App\Models\HubArea;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function show()
    {
        return view('admin.city-map.show');
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'coordinates' => 'required|array',
            'hub' => 'required',
            'coordinates.*.lat' => 'required|numeric',
            'coordinates.*.lng' => 'required|numeric',
        ]);
        $area = HubArea::where('hub',$validated['hub'])->first();
        // Store the area in the database
        $area = !empty($area) ? $area : new HubArea();
        $area->coordinates = json_encode($validated['coordinates']); // Save as JSON
        $area->hub = $validated['hub']; // Save as JSON
        $area->save();
    }

    public function getCityCoordinates(Request $request)
    {
        $city = $request['city'];
        $coordinates = !empty($city) ? HubArea::where('hub',$city)->first()->coordinates : [];
        return response()->json($coordinates);
    }
}

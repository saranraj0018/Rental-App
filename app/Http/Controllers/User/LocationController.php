<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HubArea;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function checkLocation(Request $request)
    {
        $lat = $request['lat'];
        $lng = $request['lng'];
        $location = $request['type'];
        $address = $request['address'];

        // Fetch the coordinates of the polygon
        $hubArea = HubArea::where('hub', 'coimbatore')->first();

        if ($hubArea && !empty($hubArea->coordinates)) {
            // Assuming coordinates are stored as a JSON string, decode them
            $coordinates = json_decode($hubArea->coordinates, true);

            // Check if decoding was successful and resulted in an array
            if (is_array($coordinates)) {
                $polygon = array_map(function($point) {
                    return [$point['lat'], $point['lng']];
                }, $coordinates);

                // Check if the point is inside the polygon
                $isInside = $this->pointInPolygon([$lat, $lng], $polygon);
                if (!empty($isInside)) {
                    if ($location == 'same_location') {
                        session(['pick-delivery' => ['lat' => $lat, 'lng' => $lng, 'address' => $address]]);
                        session()->forget(['delivery_location', 'pickup_location']);
                    } elseif ($location == 'delivery_location') {
                        session(['delivery' => ['lat' => $lat, 'lng' => $lng, 'address' => $address]]);
                        session()->forget(['delivery_location', 'pickup_location']);
                    } elseif ($location == 'pickup_location') {
                        session(['pickup' => ['lat' => $lat, 'lng' => $lng, 'address' => $address]]);
                        session()->forget(['delivery_location', 'pickup_location']);
                    }
                }
                return response()->json(['inside' => $isInside]);
            }
        }

        return response()->json(['inside' => false]);
    }


    // Function to check if a point is inside a polygon
    private function pointInPolygon($point, $polygon)
    {
        $x = $point[0];
        $y = $point[1];
        $inside = false;

        $n = count($polygon);
        for ($i = 0, $j = $n - 1; $i < $n; $j = $i++) {
            $xi = $polygon[$i][0];
            $yi = $polygon[$i][1];
            $xj = $polygon[$j][0];
            $yj = $polygon[$j][1];

            $intersect = (($yi > $y) != ($yj > $y)) &&
                ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);

            if ($intersect) {
                $inside = !$inside;
            }
        }

        return $inside;
    }
}

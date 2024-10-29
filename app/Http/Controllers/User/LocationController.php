<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HubArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function checkLocation(Request $request)
    {

        if (!Auth::id()){
            return response()->json(['message' => 'Authentication Failed please login']);
        }
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
                    $user = User::find(Auth::id());

                    switch ($location) {
                        case 'same_location':
                            session(['pick-delivery' => ['lat' => $lat, 'lng' => $lng, 'address' => $address]]);
                            session()->forget(['delivery_location', 'pickup_location']);
                            $user->drop_location = $address;
                            $user->pick_location = $address;
                            break;

                        case 'delivery_location':
                            session()->forget('pick-delivery');
                            session(['delivery' => ['lat' => $lat, 'lng' => $lng, 'address' => $address]]);
                            $user->drop_location = $address;
                            break;

                        case 'pickup_location':
                            session()->forget('pick-delivery');
                            session(['pickup' => ['lat' => $lat, 'lng' => $lng, 'address' => $address]]);
                            $user->pick_location = $address;
                            break;
                    }

                    $user->save();
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

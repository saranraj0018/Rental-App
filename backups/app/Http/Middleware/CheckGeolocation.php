<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CheckGeolocation
{
    public function handle(Request $request, Closure $next)
    {
        $latitude = $request->session()->get('latitude');
        $longitude = $request->session()->get('longitude');
        // Get the user's location (city) based on IP address
        $location = $this->getGeolocation($latitude,$longitude);

        // Redirect if the user is not in Coimbatore
        if ($location !== 'Coimbatore') {
            return redirect('/');
        }

        return $next($request);
    }

    private function getGeolocation($latitude,$longitude)
    {
        if (empty($latitude) && empty($longitude)) {
            return null;
        }
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'latlng' => $latitude . ',' . $longitude,
                'key' => 'AIzaSyCgkUiA7zkxsdc8BwvCqVeSTDuJVncMmAY',
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        if (empty($data)) {
            return null;
        }
        foreach ($data['results'] as $result) {
            foreach ($result['address_components'] as $component) {
                if (in_array('administrative_area_level_3', $component['types']) && $component['long_name'] === 'Coimbatore') {
                    return $component['long_name'];
                }
            }
        }
        return null;
    }


}

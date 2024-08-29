<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarDocument;
use App\Models\Frontend;
use App\Models\FrontendId;
use App\Models\FrontendImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function view()
    {
        $frontend = Frontend::where('data_keys','section1-image-car')->first();
        return view('admin.banner.section1', compact('frontend'));
    }

    public function save(Request $request)
    {
        if (empty($request['banner_id'])) {
            $request->validate([
                'image_car' => 'required|array|min:3',
                'image_car.*' => 'mimes:jpeg,png,jpg|max:2048',
            ]);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'features' => 'required|array|min:1',
            'features.*' => 'string',
        ]);


        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
            'features' => json_encode($request['features']),
        ];

        $frontend = $request['banner_id'] == 'section1-image-car' ? Frontend::where('data_keys', $request['banner_id'])->first() : new Frontend();
        $frontend->data_keys = 'section1-image-car';
        $frontend->data_values = json_encode($data);
        $frontend->save();

        if ($request->hasFile('image_car')) {
            // Clear the existing files from the directory
            Storage::disk('public')->deleteDirectory('section1-image-car/');
            Storage::disk('public')->makeDirectory('section1-image-car/');

            foreach ($request['image_car'] as $key => $image) {
                // Get the original file name
                $img_name = $image->getClientOriginalName();
                // Allow duplicate files by appending a timestamp to the file name
                $img_name = uniqid() . '_' . $img_name;
                // Store the file in the directory
                $image->storeAs('section1-image-car/', $img_name, 'public');
                if (!empty($request['image_car']) ){
                    $car_image = FrontendImage::where('slug','banner-car-'.$key)->first();
                } else {
                    $car_image = new FrontendImage();
                    $car_image->slug = 'banner-car-'.$key;
                }
                $car_image->frontend_id = 3;
                $car_image->data_values = $img_name;
                $car_image->save();
            }
        }

        return response()->json(['success' => 'Banner section saved successfully']);
    }
}

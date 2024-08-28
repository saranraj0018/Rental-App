<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend;
use Illuminate\Http\Request;

class BannerController extends Controller
{
   public function view()
   {
   return view('admin.banner.section1');
   }

   public function save(Request $request)
   {


       $request->validate([
           'image_car' => 'required|mimes:jpeg,png,jpg|max:2048',
           'title' => 'required|string',
           'description' => 'required|string',
           'features' => 'required|array|min:1',
           'features.*' => 'string',
       ]);

dd($request->all());
       if (count($request->file('image_car')) < 3) {
           return back()->withErrors(['image_car' => 'Please upload at least 3 images.']);
       }

       $imageData = [];
       if ($request->hasFile('image_car')) {
           foreach ($request['image_car'] as $image) {
               $img_name = $image->getClientOriginalName();
               $image->storeAs('section1-image-car/',  $img_name, 'public');
               $imageData[] = $img_name;
           }
       }

       $data = [
           'title' => $request['title'],
           'description' => $request['description'],
           'features' => json_encode($request['features']),
           'images' => json_encode($imageData) // Store image paths as JSON
       ];

      $frontend = new Frontend();
      $frontend->data_keys = 'section1-image-car';
      $frontend->data_values = json_encode($data);
      $frontend->save();

       return redirect()->back()->with('success', 'Data updated successfully.');
   }
}

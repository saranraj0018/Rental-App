<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as Controller;
use App\Models\Frontend;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function view($section)
    {

        $this->authorizePermission('others_view');
        $item = !empty($section) ? Frontend::where('data_keys', $section)->first() : [];
        return view('admin.setting.view', compact('item', 'section'));
    }

    public function update(Request $request)
    {
        $this->authorizePermission('others_update');
        $request->validate([
            'content' => 'required',
            'section' => 'required',
        ]);

        $frontend = !empty($request["{$request['section']}_id"])  ? Frontend::find($request["{$request['section']}_id"]) : new Frontend();
        $frontend->data_keys = $request['section'];
        $frontend->data_values = json_encode($request['content']);
        $frontend->save();

        return redirect()->back()->with('success', 'Content updated successfully.');
    }

}

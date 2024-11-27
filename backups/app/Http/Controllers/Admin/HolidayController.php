<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Coupon;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $holidays = Holiday::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.holiday.list', compact('holidays'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:144',
            'event_date' => 'required|date|after:today',
        ]);
        $holidays = !empty($request['holiday_id']) ? Holiday::find($request['holiday_id']) : new Holiday();
        $holidays->event_name = $request['event_name'];
        $holidays->event_date = formDate($request['event_date']);
        $holidays->notes = $request['description'];
        $holidays->user_id = Auth::guard('admin')->id();
        $holidays->save();

        $holiday_list = Holiday::with('user')->orderBy('created_at', 'desc')->paginate(5);
        return response()->json(['data'=> ['holiday' => $holiday_list->items(), 'pagination' => $holiday_list->links()->render()],'success' => 'Holidays Created successfully']);

    }

    public function delete($id)
    {
        $holidays = Holiday::find($id);
        $holidays->delete();
        $holiday_list = Holiday::with('user')->orderBy('created_at', 'desc')->paginate(5);
        return response()->json(['data'=> ['holiday' => $holiday_list->items(), 'pagination' => $holiday_list->links()->render()],'success' => 'Holidays Deleted successfully']);
    }

    public function search(Request $request)
    {
        $query = Holiday::with('user');
        if ($request->filled('holiday_search')) {
            $query->where('event_name', 'like', '%' .  $request['holiday_search']. '%');
        }

        $holiday_list = $query->paginate(5);
        return response()->json(['data'=> ['holiday' => $holiday_list->items(),'pagination' => $holiday_list->links()->render()]]);

    }
}

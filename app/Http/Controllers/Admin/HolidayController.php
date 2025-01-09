<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Coupon;
use App\Models\Holiday;
use App\Models\HolidayHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends BaseController {
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request) {
        $this->authorizePermission('holidays_view');

        $holidays = Holiday::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.holiday.list', compact('holidays'));
    }


    public function history(Request $request) {
        $this->authorizePermission('holidays_history');

        $holidays = HolidayHistory::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.holiday.history', compact('holidays'));
    }

    public function save(Request $request) {


        $this->authorizePermission('holidays_create');

        if (!empty($request['holiday_id'])) {
            $request->validate([
                'edit_event_name' => 'required|string|max:144',
                'event_date' => 'required|date|after:today',
            ]);

            $holidays = Holiday::find($request['holiday_id']);
            $holidays->event_name = $request['edit_event_name'];
            $holidays->event_date = formDate($request['event_date']);
            $holidays->notes = $request['edit_description'];
            $holidays->user_id = Auth::guard('admin')->id();
            $holidays->save();

            $holiday_list = Holiday::with('user')->orderBy('created_at', 'desc')->paginate(20);
            return response()->json(['data' => ['holiday' => $holiday_list->items(), 'pagination' => $holiday_list->links()->render()], 'success' => 'Holidays Created successfully']);

        }

        $request->validate([
            'event_name' => 'required|string|max:144',
            'event_start_date' => 'required|date|after:today',
            'event_end_date' => 'required|date|after:today',
        ]);

        $startDate = Carbon::parse($request['event_start_date']);
        $endDate = Carbon::parse($request['event_end_date']);

        while ($startDate->lte($endDate)) {
            $holiday = new Holiday();
            $holiday->event_name = $request['event_name'];
            $holiday->event_date = $startDate->format('Y-m-d');
            $holiday->notes = $request['description'];
            $holiday->user_id = Auth::guard('admin')->id();
            $holiday->save();

            // Move to the next day
            $startDate->addDay();
        }

        $holiday_list = Holiday::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return response()->json(['data' => ['holiday' => $holiday_list->items(), 'pagination' => $holiday_list->links()->render()], 'success' => 'Holidays Created successfully']);

    }

    public function delete($id) {


        $this->authorizePermission('holidays_delete');
        $holidays = Holiday::find($id);
        $holidays->delete();
        $holiday_list = Holiday::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return response()->json(['data' => ['holiday' => $holiday_list->items(), 'pagination' => $holiday_list->links()->render()], 'success' => 'Holidays Deleted successfully']);
    }

    public function search(Request $request) {
        $query = Holiday::with('user');
        if ($request->filled('holiday_search')) {
            $query->where('event_name', 'like', '%' . $request['holiday_search'] . '%');
        }

        $holiday_list = $query->paginate(20);
        return response()->json(['data' => ['holiday' => $holiday_list->items(), 'pagination' => $holiday_list->links()->render()]]);

    }
}

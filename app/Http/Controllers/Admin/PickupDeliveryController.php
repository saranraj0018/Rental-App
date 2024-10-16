<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Booking;
use Illuminate\Http\Request;

class PickupDeliveryController extends BaseController
{
    public function list(Request $request)
    {
        $this->authorizePermission('hub_list');
        $booking = Booking::with(['user','car'])->get();
        return view('admin.hub.list',compact('booking'));
    }
}

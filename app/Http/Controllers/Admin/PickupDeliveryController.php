<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Commend;
use Illuminate\Http\Request;

class PickupDeliveryController extends BaseController
{
    public function list(Request $request)
    {
        $this->authorizePermission('hub_list');
        $booking = Booking::with(['user','details','comments','user.bookings'])->get();
        return view('admin.hub.list',compact('booking'));
    }

    public function rescheduleDate(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $booking = Booking::find(request('booking_id'));
        $booking->reschedule_date = $request['date'];
        $booking->save();
        return response()->json(['data'=> true,'success' => 'Reschedule date Update successfully']);
    }

    public function riskCommends(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|numeric',
            'commends' => 'required',
        ]);

        $commend = new Commend();
        $commend->booking_id = $request['booking_id'];
        $commend->commends = $request['commends'];
        $commend->save();
        return response()->json(['data'=> true,'success' => 'Commends Update successfully']);
    }

    public function riskStatus(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|numeric',
            'status' => 'required',
        ]);
        $booking = Booking::find($request['booking_id']);

        if (!empty($booking) && !empty($request['note']) && $request['note'] == 'complete' ) {
            $booking->status = $request['status'];
            $booking->risk = 2;
            $booking->save();
            return response()->json(['success' => true, 'message' => 'Booking Completed successfully']);
        } elseif (!empty($booking) && !empty($request['note']) && $request['note'] == 'risk' ) {
            $booking->risk = $request['status'];
            $booking->save();
            return response()->json(['success' => true, 'message' => 'Risk updated successfully']);

        }

        return response()->json(['success' => false, 'message' => 'Booking not found']);
    }

    public function bookingCancel(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'reason' => 'required|string|max:255',
        ]);

        $booking = Booking::find($request['booking_id']);
        $booking->status = 3;
        $booking->notes = $request['reason'];
        $booking->save();

        return response()->json(['message' => 'Booking cancelled successfully']);
    }


}

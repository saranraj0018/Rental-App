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
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return view('admin.hub.list',compact('bookings'));
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
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'success' => 'Reschedule date Update successfully']);

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
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Commends Update successfully']);
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
            $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
            return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Risk updated successfully']);
        } elseif (!empty($booking) && !empty($request['note']) && $request['note'] == 'risk' ) {
            $booking->risk = $request['status'];
            $booking->save();
            $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
            return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Risk updated successfully']);

        }
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Booking not found']);
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
        $bookings = Booking::with(['user','details','comments','user.bookings'])->paginate(5);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Booking cancelled successfully']);
    }

    public function fetchBookings(Request $request) {
        // Set the number of items per page
        $perPage = $request->input('per_page', 10); // Default to 10 items per page

        $query = Booking::with(['user','details','comments','user.bookings']);

        // Apply filters based on request parameters
        if (!empty($request['car_model'])) {
            $query->whereHas('details', function($query) use ($request) {
                $query->where('car_details->car_model->model_name', 'like', '%' . $request->input('car_model') . '%');
            });
        }
        if (!empty($request['register_number'])) {
            $query->where('register_number', 'like', '%' . $request->input('register_number') . '%');
        }
        if (!empty($request['booking_id'])) {
            $query->where('booking_id', $request->input('booking_id'));
        }
        if (!empty($request['customer_name'])) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('customer_name') . '%');
            });
        }
        if ($request->has('booking_type') && $request->input('booking_type') !== 'both') {
            $query->where('booking_type', $request->input('booking_type'));
        }

        // Paginate the results
        $bookings = $query->paginate($perPage);
        return response()->json(['data'=> ['bookings' => $bookings->items(), 'pagination' => $bookings->links()->render()],'message' => 'Data Fetch successfully']);

    }
}

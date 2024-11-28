<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $coupons = Coupon::with('user')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.coupon.list', compact('coupons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'order_booking' => 'nullable|numeric|min:0',
            'prefix' => 'max:144',
            'coupon_code' => 'required|string|max:20',
            'coupon_start_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $endDate = $request->input('coupon_end_date');
                    if ($endDate && $value >= $endDate) {
                        $fail('The ' . $attribute . ' must be before the end date.');
                    }
                },
            ],
            'coupon_end_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = $request->input('coupon_start_date');
                    if ($startDate && $value <= $startDate) {
                        $fail('The ' . $attribute . ' must be after the start date.');
                    }
                },
            ],
        ]);

        $coupon = $request['coupon_id'] ? Coupon::find($request['coupon_id']) : new Coupon();
        $coupon->title = $request['title'];
        $coupon->description = $request['description'];
        $coupon->amount = $request['amount'];
        $coupon->type = $request['type'];
        $coupon->prefix = $request['prefix'];
        $coupon->code = $request['coupon_code'];
        $coupon->start_date = $request['coupon_start_date'];
        $coupon->end_date = $request['coupon_end_date'];
        $coupon->booking_order = $request['order_booking'];
        $coupon->status = $request['status'];
        $coupon->user_id = Auth::guard('admin')->id();
        $coupon->save();

        $coupon_list = Coupon::with('user')->orderBy('created_at', 'desc')->paginate(5);
        return response()->json(['data'=> ['coupon' => $coupon_list->items(), 'pagination' => $coupon_list->links()->render()],'success' => 'Coupon Created successfully']);

    }

    public function delete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        $coupon_list = Coupon::with('user')->orderBy('created_at', 'desc')->paginate(5);
        return response()->json(['data'=> ['coupon' => $coupon_list->items(), 'pagination' => $coupon_list->links()->render()],'success' => 'Coupon Deleted successfully']);
    }

    public function search(Request $request)
    {
        $query = Coupon::with('user');
        if ($request->filled('coupon_code')) {
            $query->where('code', 'like', '%' .  $request['coupon_code']. '%');
        }

        if ($request['status'] != 'Both' && $request->filled('status')) {
            $query->where('status', 'like', '%' .  $request['status']. '%');
        }
        $coupon = $query->paginate(5);
        return response()->json(['data'=> ['coupon' => $coupon->items(),'pagination' => $coupon->links()->render()]]);

    }

}

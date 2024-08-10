<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PickupDeliveryController extends Controller
{
    public function list(Request $request)
    {
        return view('admin.hub.list');
    }
}

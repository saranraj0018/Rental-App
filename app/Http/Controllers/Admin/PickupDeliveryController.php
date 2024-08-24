<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PickupDeliveryController extends BaseController
{
    public function list(Request $request)
    {
        $this->authorizePermission('hub_list');
        return view('admin.hub.list');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
    {
        return view('admin.dashboard');
    }
}

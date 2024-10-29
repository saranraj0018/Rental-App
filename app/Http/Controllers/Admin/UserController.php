<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        $user = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.list', compact('user'));
    }

    public function search(Request $request)
    {
        $query = User::query();
        if (!empty($request['name_search'])) {
            $query->where('name', 'like', '%' .  $request['name_search']. '%');
        }
        $user_list = $query->paginate(10);
        return response()->json(['data'=> ['user' => $user_list->items(),'pagination' => $user_list->links()->render()]]);

    }
}

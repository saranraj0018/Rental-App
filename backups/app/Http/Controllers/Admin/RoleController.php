<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends BaseController
{
    public function list(Request $request)
    {
        $this->authorizePermission('role_tab');
        $user_role =  Role::with('user')->orderBy('created_at', 'desc')->paginate(5);
        $permissions = getAdminPermissions();
        return view('admin.roles.list',compact('user_role','permissions'));
    }

    public function save(Request $request)
    {
        $this->authorizePermission('role_add');
        $request->validate([
            'role' => 'required|string',
        ]);
        $user_role = new Role();
        $user_role->user_role = ucfirst($request['role']);
        $user_role->user_id = Auth::guard('admin')->id();
        $user_role->save();
        $user_role_list = Role::with('user')->orderBy('created_at', 'desc')->paginate(5);
        $permissions = getAdminPermissions();
        return response()->json(['data'=> ['role' => $user_role_list->items(), 'pagination' => $user_role_list->links()->render()],
            'permission' =>$permissions,'success' => 'User Role saved successfully']);
    }

    public function Update(Request $request)
    {
        $this->authorizePermission('role_edit');
        $user_permission = Role::find($request['role_id']);
        $user_permission->permissions = json_encode($request['role']);
        $user_permission->user_id = Auth::guard('admin')->id();
        $user_permission->save();
        $user_role_list =  Role::with('user')->orderBy('created_at', 'desc')->paginate(5);
        $permissions = getAdminPermissions();
        return response()->json(['data'=> ['role' => $user_role_list->items(), 'pagination' => $user_role_list->links()->render()],
            'permission' =>$permissions,'success' => 'User Role Permissions Update Successfully']);
    }

    public function delete($id)
    {
        $this->authorizePermission('role_delete');
        $delete_car = Role::find($id);
        $delete_car->delete();
        $user_role_list =  Role::with('user')->orderBy('created_at', 'desc')->paginate(5);
        $permissions = getAdminPermissions();
        return response()->json(['data'=> ['role' => $user_role_list->items(), 'pagination' => $user_role_list->links()->render()],
            'permission' =>$permissions,'success' => 'User Role Deleted Successfully']);
    }
}

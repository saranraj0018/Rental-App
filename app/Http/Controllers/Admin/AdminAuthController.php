<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminDetail;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    /**
     * Check when admin are login.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminAuthenticate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!$validator->passes()){
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        if (!Auth::guard('admin')->attempt(['email' => $request['email'],
            'password' => $request['password']], $request->get('remember'))){
            return redirect()->route('admin.login')->with('error','Either Email/Password is incorrect');
        }

        $admin = Auth::guard('admin')->user();
        $role_id = Role::pluck('id')->all();

        if (!empty($admin->role) && !empty($role_id) && !in_array($admin->role,$role_id)){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error','You are not authorized to access');
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function registerUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_name' => 'required',
            'email' => 'required|email|unique:admin_details,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|Integer',
            'referral_code' => ['required',
                function ($attribute, $value, $fail) use ($request) {
                    if (!empty($request['referral_code']) && $request['referral_code'] != 'AaRS01') {
                        $fail('The referral code is required for the super-admin role.');
                    }
                }]
        ]);

        if (!$validator->passes()){
            return redirect()->route('admin.register')
                ->withErrors($validator)
                ->withInput($request->only('email','user_name', 'role', 'referral_code'));
        }

        $admin = new AdminDetail();
        $admin->user_name = $request['user_name'];
        $admin->email = $request['email'];
        $admin->password = Hash::make($request['password']);
        $admin->role = $request['role'];
        $admin->mobile_number = $request['mobile_number'];
        $admin->referral_code = $request['referral_code'];
        $admin->save();

        return redirect()->route('admin.login');
    }
}

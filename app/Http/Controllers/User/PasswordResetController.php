<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class PasswordResetController extends Controller
{


    public function forgotPassword(Request $request)
    {

        try {

            $request->validate([
                'email' => 'required|email'
            ]);

            if (!($user = \App\Models\User::where('email', '=', $request->email)->first()))
                throw new \Exception('User Not found or the email is not registered', 404);


            $token = Password::createToken($user);

            $resetUrl = url(route('password.reset', [
                'token' => $token,
                'email' => $user->email,
            ], false));

            $user->update([
                'password_reset_token' => $token
            ]);

            Mail::to($request->email)
                ->send(new \App\Mail\PasswordResetMail($user, $resetUrl));

            return response()->json([
                "status" => 200,
                "message" => 'Password reset link sent to the mail address'
            ], status: 200);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => $th->getCode() ?: 500,
                "message" => $th->getMessage()
            ], $th->getCode() ?: 500);
        }
    }



    public function create(Request $request, string $token) {

        if(!($user = \App\Models\User::where('email', '=', $request->get('email'))->first())) 
            abort(404);

        if(!($token === $user->password_reset_token)) 
            abort(404);


        return view('user.frontpage.profile.reset', [
            'token' => $token,
            'email' => $user->email
        ]);
    }



    public function store(Request $request) {
       
        try {

            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            if(!($user = \App\Models\User::whereEmail($request->email)->first())) 
                throw new \Exception('Invalid or Expired Token');

            if(!($request->token === $user->password_reset_token)) 
                throw new \Exception('Invalid or Expired Token');

            $user->update([
                'password_reset_token' => null,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Password changed succesfully"
            ], 200);

        } catch(\Throwable $th) {
            return response()->json([
                "status" => $th->getCode() ?: 500,
                "message" => $th->getMessage()
            ], $th->getCode() ?: 500);
        }

    } 



    public function update(Request $request) {
        
        try {

            $request->validate([
                'old_password' => 'required',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        
            $user = \App\Models\User::find(auth()->id());
        
            if (!$user) {
                throw new \Exception('User not found.');
            }
        
            if (!Hash::check($request->old_password, $user->password)) {
                throw new \Exception('Old Password did not match.');
                
            }
        
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                "status" => 200,
                "message" => "Password Updated succesfully"
            ], 200);

        } catch(\Throwable $th) {
            return response()->json([
                "status" => $th->getCode() ?: 500,
                "message" => $th->getMessage()
            ], $th->getCode() ?: 500);
        }

    }
}

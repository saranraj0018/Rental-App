<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|digits:10',
        ]);
        $user = User::where('mobile', $request['mobile_number'])->first();
        if (empty($user)) {
            return response()->json([
                'success' => 'false',
                'message' => 'User Not registered. Please registered Account try again.'
            ], 422);
        }
        $otp = rand(1000, 9999);
        $phone = $request['mobile_number'];

        session(['verification_code' => $otp, 'phone' => $phone]);
        $twilio = new Client( config('services.twilio_sms.sid'), config('services.twilio_sms.token'));
        $twilio->messages->create(
            '+91' . $phone,
            [
                'from' => config('services.twilio_sms.mobile_number'),
                'body' => 'Your OTP is: ' . $otp,
            ]
        );
        return response()->json([
            'success' => true,
            'phone' => $phone,
            'message' => 'OTP has been sent to your phone.'
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|digits:4',
        ]);

        $session_otp = session('verification_code');
        $session_phone = session('phone');
        $user = User::with('userDoc')->where('mobile', $session_phone)->first();
        session(['document_verification' => !empty(!$user->userDoc->isEmpty()) ? 1 : 0]);
        if (empty($user)) {
            return response()->json([
                'success' => 'false',
                'message' => 'User Not registered. Please registered Account try again.'
            ], 422);
        }
        if ($request['verification_code'] == $session_otp) {
                Auth::login($user); // Log the user in
                return response()->json([
                    'success' => 'true',
                    'name' => Auth::user()->name ?? '',
                    'message' => 'Login successful.',
                ]);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'Invalid OTP. Please try again.'
            ], 422); // Unprocessable entity, validation error status code
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'reg_mobile_number' => 'required|digits:10|unique:users,mobile',
        ]);

       $user = new User();
       $user->name = $request['user_name'];
       $user->mobile = $request['reg_mobile_number'];
       $user->email = $request['user_email'];
       $user->save();

        return response()->json(['success' => 'true','message' => 'Registration successful!']);
    }
    public function verifyDocument(Request $request)
    {
       // session()->forget(['pick-delivery','delivery','pickup']);
        $user = User::with('userDoc')->find(Auth::id());
       if ($user->userDoc->isEmpty()) {
           return response()->json(['success' => false,'message' => 'Document not found.']);
       }

        return response()->json(['success' => true,'message' => 'Document is Already Verify successful!']);
    }

    public function verifyLocation()
    {
        if (empty(Auth::user()->pick_location) || empty(Auth::user()->pick_location) || empty(Auth::user()->drop_location)) {
            return response()->json(['success' => false,'message' => 'Location not found.']);
        }

        return response()->json(['success' => true,'message' => 'Location Added']);
    }

}

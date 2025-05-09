<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Message\LoginMessage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Booking;
use Twilio\Rest\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller {




    public function emailLogin(Request $request) {
        
        $request->validate([
            'user_email' => 'required|email',
            'password' => 'required',
        ]);

    
        try {
            if (!Auth::attempt(['email' => $request->user_email, ...$request->only('password')])) {
              throw new \Exception('Invalid credentials', 401);
            }

            return response()->json([
                'success' => 'true',
                'name' => Auth::user()->name ?? '',
                'message' => 'Login successful.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500); 
        }
    }





    public function sendOtp(Request $request) {
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
        netty()->send(new LoginMessage($otp))->to($phone);

        return response()->json([
            'success' => true,
            'phone' => $phone,
            'message' => 'OTP has been sent to your phone.'
        ]);
    }

    public function verifyOtp(Request $request) {
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

    public function register(Request $request) {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'reg_mobile_number' => 'required|digits:10|unique:users,mobile',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request['user_name'];
        $user->mobile = $request['reg_mobile_number'];
        $user->email = $request['user_email'];
        $user->password = bcrypt($request['password']);
        $user->save();

        return response()->json(['success' => 'true', 'message' => 'Registration successful!']);
    }
    public function verifyDocument(Request $request) {

        $user = User::with('userDoc')->find(Auth::id());

        if(!$user->aadhaar_number || !$user->driving_licence) {
            return response()->json(['success' => false, 'message' => 'Document not found.']);
        }

        // if ($user->userDoc->isEmpty()) {
        //     return response()->json(['success' => false, 'message' => 'Document not found.']);
        // }

        return response()->json(['success' => true, 'message' => 'Document is Already Verify successful!']);
    }

    public function verifyBooking() {
        $startDateTime = Carbon::parse(session('booking_details.start_date')); // Assuming you have start_date_time field
        $endDateTime = Carbon::parse(session('booking_details.end_date')); //
        if (!empty($startDateTime) && !empty($endDateTime)) {
            $existingBooking = Booking::where('user_id', Auth::id())->where('status', 1)->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('start_date', [$startDateTime, $endDateTime]) // Check if start time is in the range
                    ->orWhereBetween('end_date', [$startDateTime, $endDateTime]) // Check if end time is in the range
                    ->orWhere(function ($query) use ($startDateTime, $endDateTime) {
                        $query->where('start_date', '<=', $startDateTime)
                            ->where('end_date', '>=', $endDateTime);
                    });
            })->exists();

            if (empty($existingBooking)) {
                return response()->json(['success' => true, 'message' => 'user not found.']);
            }
        }
        return response()->json(['success' => false, 'message' => 'User Found']);
    }

}

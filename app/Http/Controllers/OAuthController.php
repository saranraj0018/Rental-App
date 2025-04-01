<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            return redirect()->route('home', ['google_redirect' => 1])->with('google_register_data', $googleUser);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}

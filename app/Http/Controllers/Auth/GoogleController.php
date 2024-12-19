<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            \Log::info('Google User:', (array) $googleUser);

            if (!$googleUser || !$googleUser->email) {
                return redirect()->route('web.login')->with('error', 'Unable to retrieve Google account information.');
            }

            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name ?? 'No Name',
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'status' => 1, 
                    'password' => bcrypt(Str::random(24)),
                ]);
            }

            Auth::login($user, true);

            return redirect()->route('home')->with([
                'success' => 1,
                'msg' => 'Logged in with Google!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Google Login Error: ' . $e->getMessage());

            return redirect()->route('web.login')->with([
                'success' => 0,
                'msg' => 'Unable to login using Google. Please try again.'
            ]);
        }
    }
}

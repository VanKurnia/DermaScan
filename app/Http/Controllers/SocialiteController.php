<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }


    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                $userData = User::updateOrCreate([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('Password@1234'),
                    'google_id' => $googleUser->id,
                    'email_verified_at' => now(),
                ]);

                if ($userData) {
                    Auth::login($userData);
                    return redirect()->route('dashboard');
                }
            }
        } catch (Exception $e) {
            dd($e);
        }

        // // Cari user berdasarkan email, jika belum ada buat baru
        // $user = User::firstOrCreate([
        //     'email' => $googleUser->getEmail(),
        // ], [
        //     'name' => $googleUser->getName(),
        //     'password' => bcrypt(str()->random(16)), // Set password random agar tetap bisa login manual jika perlu
        // ]);

        // // Login user menggunakan Laravel Auth (sama seperti Fortify)
        // Auth::login($user);

        // return redirect()->route('dashboard'); // Redirect ke halaman setelah login
    }
}

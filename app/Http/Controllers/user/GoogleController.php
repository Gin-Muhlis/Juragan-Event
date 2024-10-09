<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $user = Socialite::driver('google')->user();

        $findUser = User::where('google_id', $user->getId())->first();

        if ($findUser) {
            Auth::login($findUser);
            return redirect()->intended('/');
        }

        $findEmail = User::where('email', $user->getEmail())->first();
        if ($findEmail) {
            $errors = ['error' => 'Email sudah digunakan, silahkan pilih email lain.'];
            return redirect()->route('welcome')->withErrors($errors);
        }

        $newUser = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'google_id' => $user->getId(),
            'password' => Hash::make('12345678'),
            'phone_number' => '000000000000',
            'image' => $user->getAvatar()
        ]);

        $newUser->assignRole('user');

        Auth::login($newUser);
        return redirect()->intended('/');
    }
}

<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        $user = Socialite::driver('facebook')->user();

        $findUser = User::where('facebook_id', $user->getId())->first();

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
            'password' => Hash::make('12345678'),
            'phone_number' => '000000000000',
            'facebook_id' => $user->getId(),
            'image' => $user->getAvatar()
        ]);

        $newUser->assignRole('user');

        Auth::login($newUser);

        return redirect()->intended('/');
    }
}

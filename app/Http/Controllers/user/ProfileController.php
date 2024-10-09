<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\ProfilePasswordUpdateRequest;
use App\Http\Requests\user\ProfileUpdateRequest;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{


    public function profile()
    {

        $user = Auth::user();
        SEOTools::setTitle($user->name);
        SEOTools::setDescription('Orang yang telah bergabung dengan Juragant Event untuk mengeksplor dan berpartisipasi di event yang telah disediakan oleh Juragan Event.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');
        return view('user.auth.user', ['user' => $user]);
    }

    public function editProfile(ProfileUpdateRequest $request, User $user)
    {

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete($user->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $user->update($validated);

        return redirect()
            ->route('profile.index', $user->name)
            ->withSuccess('Profile berhasil diperbarui');
    }

    public function editPassword(ProfilePasswordUpdateRequest $request, User $user)
    {

        $validated = $request->validated();

        if (!password_verify($validated['old_password'], $user->password)) {
            return redirect()
                ->route('profile.index', $user->name)
                ->withErrors(['Reset password gagal, password lama tidak sesuai']);
        }

        $user->update(['password' => Hash::make($validated['new_password'])]);

        Auth::logout();

        return redirect()
            ->route('user.login')
            ->with('success', 'Password berhasil diperbarui');
    }
}

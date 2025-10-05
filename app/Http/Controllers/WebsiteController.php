<?php

namespace App\Http\Controllers;


use App\Models\Setting;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function home()
    {
        $setting = Setting::first();
        return view('frontend.index', compact('setting'));
    }


   

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $imagePath = null;

        if ($socialUser->getAvatar()) {
            // Download image from URL
            $imageContents = file_get_contents($socialUser->getAvatar());

            // Generate unique filename
            $filename = 'users/' . Str::uuid() . '.jpg';

            // Store image to storage/app/public/users
            Storage::disk('public')->put($filename, $imageContents);

            $imagePath = $filename;
        }

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(Str::random(24)),
                'image' => $imagePath,
            ]
        );

        // Optional: Update image if user already exists but has no image
        if (!$user->image && $imagePath) {
            $user->image = $imagePath;
            $user->save();
        }

        Auth::login($user);
        return redirect()->intended('/home');
    }


    public function showRegistrationForm($referrer_id = null)
    {
        return view('auth.register-refer', ['referrer_id' => $referrer_id]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits_between:10,14|unique:users',
            'password' => 'required|confirmed|min:6',
            'referrer_id' => 'nullable|exists:users,id',
        ]);

      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'referrer_id' => $request->referrer_id,
        ]);

        // Log in the user
        auth()->login($user);

        // Trigger email verification event
        event(new Registered($user));

        return redirect()->route('verification.notice');
    }
}

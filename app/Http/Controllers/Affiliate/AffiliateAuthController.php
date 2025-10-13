<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AffiliateAuthController extends Controller
{
    // Show Register Form
    public function showRegister()
    {
        return view('affiliate.register');
    }

    // Register
    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:affiliates,email',
            'phone' => 'required|string|unique:affiliates,phone',
            'username' => 'required|string|unique:affiliates,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $affiliate = Affiliate::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'website_url' => $request->website_url,
            'social_media_link' => $request->social_media_link,
            'promotion_method' => $request->promotion_method,
            'referal_name_id' => $request->referal_name_id,
            'status' => 'pending', // default
        ]);

        return redirect()->back()->with('success', 'Registration successful! Your account is pending approval.');
    }

    // Show Login Form
    public function showLogin()
    {
        return view('affiliate.auth.login');
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('affiliate')->attempt($credentials)) {
            $affiliate = Auth::guard('affiliate')->user();
            if ($affiliate->status !== 'active') {
                Auth::guard('affiliate')->logout();
                return redirect()->back()->with('error', 'Your account is not active yet.');
            }
            return redirect()->route('affiliate.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    // Logout
    public function logout()
    {
        Auth::guard('affiliate')->logout();
        return redirect()->route('affiliate.login');
    }
}

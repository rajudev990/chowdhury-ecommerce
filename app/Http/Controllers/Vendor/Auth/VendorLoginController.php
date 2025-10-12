<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('vendor.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('vendor')->attempt($credentials, $request->remember)) {
            return redirect()->intended(route('vendor.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }
}
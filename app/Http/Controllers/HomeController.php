<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function settings()
    {
        return view('settings');
    }
    public function profile()
    {
        $data = Auth::user();
        return view('profile', compact('data'));
    }
    public function profileEdit()
    {
        $data = Auth::user();
        return view('profile-edit', compact('data'));
    }

    public function passwordEdit()
    {

        return view('password-edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => [
                'nullable',
                'regex:/^\d{11}$/',
                'unique:users,phone,' . $user->id,
            ],
            'gender' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'phone.regex' => 'ফোন নাম্বারটি অবশ্যই ১১ সংখ্যার হতে হবে।',
            'phone.unique' => 'এই ফোন নাম্বারটি ইতোমধ্যে ব্যবহৃত হয়েছে।',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Generate unique filename
            $filename = 'users/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

            // Store image in public disk
            Storage::disk('public')->put($filename, file_get_contents($image));

            // Set validated image path
            $validated['image'] = $filename;
        }

        // Update user data
        $user->update($validated);

        return redirect()->back()->with('success', 'প্রোফাইল সফলভাবে আপডেট হয়েছে!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:6', 'confirmed', 'different:current_password'],
        ], [
            'current_password.current_password' => 'বর্তমান পাসওয়ার্ড সঠিক নয়।',
            'new_password.confirmed' => 'নতুন পাসওয়ার্ড এবং নিশ্চিত পাসওয়ার্ড মিলে না।',
            'new_password.different' => 'নতুন পাসওয়ার্ডটি অবশ্যই বর্তমান পাসওয়ার্ড থেকে ভিন্ন হতে হবে।',
        ]);

        // Update password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
    }

}

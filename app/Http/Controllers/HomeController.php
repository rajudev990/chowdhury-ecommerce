<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $userId = Auth::id();

        // Total Orders
        $orders = Order::where('user_id', $userId)->count();

        // Pending Orders
        $pending_orders = Order::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        // Completed Orders
        $complete_orders = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        // Revenue (sum of paid amounts)
        $revenue = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->sum('paid');


        return view('user.dashboard', compact(
            'orders',
            'pending_orders',
            'complete_orders',
            'revenue',
        ));
        
    }

    public function settings()
    {
        return view('settings');
    }
    public function profile()
    {
        $data = Auth::user();
        return view('user.profile', compact('data'));
    }
    public function profileEdit()
    {
        $data = Auth::user();
        return view('profile-edit', compact('data'));
    }

    public function passwordEdit()
    {

        return view('user.change-password');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
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
            'phone.regex' => 'The phone number must be 11 digits.',
            'phone.unique' => 'This phone number has already been taken.',
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

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:6', 'confirmed', 'different:current_password'],
        ], [
            'current_password.current_password' => 'The current password is incorrect.',
            'new_password.confirmed' => 'The new password and confirmation password do not match.',
            'new_password.different' => 'The new password must be different from the current password.',
        ]);

        // Update password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password has been updated successfully.');
    }
}

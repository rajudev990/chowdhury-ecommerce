<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:affiliate');
    }


     // Dashboard
    public function dashboard()
    {

         $userId = Auth::guard('affiliate')->id();

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


        return view('affiliate.dashboard', compact(
            'orders',
            'pending_orders',
            'complete_orders',
            'revenue',
        ));

    }

     public function settings()
    {
        return view('affiliate.settings');
    }
    public function profile()
    {
        $data = Auth::guard('affiliate')->user();
        return view('affiliate.profile', compact('data'));
    }
    public function profileEdit()
    {
        $data = Auth::guard('affiliate')->user();
        return view('affiliate.profile-edit', compact('data'));
    }

    public function passwordEdit()
    {

        return view('affiliate.auth.change-password');
    }

     public function update(Request $request)
    {
        $affilitae = Auth::guard('affiliate')->user();

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:affiliates,username,' . $affilitae->id,
            'email' => 'required|email|max:255|unique:affiliates,email,' . $affilitae->id,
            'phone' => ['required','unique:affiliates,phone,' . $affilitae->id,],
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Delete old image if exists
            if ($affilitae->image && Storage::disk('public')->exists($affilitae->image)) {
                Storage::disk('public')->delete($affilitae->image);
            }

            // Generate unique filename
            $filename = 'affiliate/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

            // Store image in public disk
            Storage::disk('public')->put($filename, file_get_contents($image));

            // Set validated image path
            $data['image'] = $filename;
        }

        // Update user data
        $affilitae->update($data);

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
        $user = Auth::guard('affiliate')->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password has been updated successfully.');
    }
}

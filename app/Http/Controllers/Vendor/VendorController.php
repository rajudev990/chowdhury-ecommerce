<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    // Dashboard
    public function dashboard()
    {

        $userId = Auth::guard('vendor')->id();

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


        return view('vendor.dashboard', compact(
            'orders',
            'pending_orders',
            'complete_orders',
            'revenue',
        ));
    }


    public function settings()
    {
        return view('vendor.auth.settings');
    }

    public function changePassword()
    {

        return view('vendor.auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $admin = auth('vendor')->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!\Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        $admin->update([
            'password' => \Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }


    public function updateSettings(Request $request)
    {
        $vendor = auth('vendor')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendor,email,' . $vendor->id,
        ]);

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;

        if ($request->hasFile('image') && $vendor->image) {
            Storage::disk('public')->delete($vendor->image);
        }

        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' =>  $image,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
}

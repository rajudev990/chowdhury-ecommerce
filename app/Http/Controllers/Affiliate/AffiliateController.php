<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\AffiliateWithdraw;
use App\Models\Order;
use App\Models\Product;
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

        // Get orders where the affiliate_id in orderItems matches the authenticated user's ID
        $orders = Order::with(['orderItems' => function ($query) {
            // Only load order items where the affiliate_id matches the authenticated affiliate
            $query->where('affiliate_id', Auth::guard('affiliate')->user()->id);
        }])
            ->latest()
            ->get();

        // Get the total count of orders for the authenticated affiliate
        $totalOrderCount = Order::whereHas('orderItems', function ($query) {
            $query->where('affiliate_id', Auth::guard('affiliate')->user()->id);
        })->count();


        $totalCompletedCommission = 0;
        $totalPendingCommission = 0;

        // Calculate total commission for completed and pending orders
        foreach ($orders as $order) {
            foreach ($order->orderItems as $orderItem) {
                // Calculate commission only if the product has a commission associated with it
                $productCommission = $orderItem->product->commission;

                if ($productCommission) {
                    $commissionAmount = $productCommission->amount; // Get commission amount from ProductCommission model
                    $price = $orderItem->price * $orderItem->quantity; // OrderItem price

                    // Calculate the commission percentage for this order item
                    $commissionForItem = ($commissionAmount / 100) * $price;


                    // Accumulate the total commission based on the order status
                    if ($order->status == 'completed') {
                        $totalCompletedCommission += $commissionForItem;
                    } elseif ($order->status == 'pending') {
                        $totalPendingCommission += $commissionForItem;
                    }
                }
            }
        }


        $withdraw = AffiliateWithdraw::where('affiliate_id', Auth::guard('affiliate')->user()->id)->sum('amount');

        $balance = $totalCompletedCommission - $withdraw;

        return view('affiliate.dashboard', compact(
            'orders',
            'totalOrderCount',
            'totalCompletedCommission',
            'totalPendingCommission',
            'withdraw',
            'balance'
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
            'phone' => ['required', 'unique:affiliates,phone,' . $affilitae->id,],
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


    // Offer
    public function offers()
    {
        $data = Product::where('status', 1)
            ->whereHas('commission') // Fetch products with a commission
            ->with('commission')    // Eager load the commission relationship
            ->get();

        return view('affiliate.offers', compact('data'));
    }

    // Earnings
    public function earnings()
    {
        // Get orders where the affiliate_id in orderItems matches the authenticated user's ID
        $orders = Order::with(['orderItems' => function ($query) {
            // Only load order items where the affiliate_id matches the authenticated affiliate
            $query->where('affiliate_id', Auth::guard('affiliate')->user()->id);
        }])
            ->latest()
            ->get();


        $totalCompletedCommission = 0;
        $totalPendingCommission = 0;

        // Calculate total commission for completed and pending orders
        foreach ($orders as $order) {
            foreach ($order->orderItems as $orderItem) {
                // Calculate commission only if the product has a commission associated with it
                $productCommission = $orderItem->product->commission;

                if ($productCommission) {
                    $commissionAmount = $productCommission->amount; // Get commission amount from ProductCommission model
                    $price = $orderItem->price * $orderItem->quantity; // OrderItem price

                    // Calculate the commission percentage for this order item
                    $commissionForItem = ($commissionAmount / 100) * $price;


                    // Accumulate the total commission based on the order status
                    if ($order->status == 'completed') {
                        $totalCompletedCommission += $commissionForItem;
                    } elseif ($order->status == 'pending') {
                        $totalPendingCommission += $commissionForItem;
                    }
                }
            }
        }

        return view('affiliate.earnings', compact('orders', 'totalCompletedCommission', 'totalPendingCommission'));
    }

    // withdraw
    public function withdraw()
    {
        $data = AffiliateWithdraw::where('affiliate_id', Auth::guard('affiliate')->user()->id)->get();
        return view('affiliate.withdraw', compact('data'));
    }
    public function showWithdrawPage()
    {
        // Get orders where the affiliate_id in orderItems matches the authenticated user's ID
        $orders = Order::with(['orderItems' => function ($query) {
            // Only load order items where the affiliate_id matches the authenticated affiliate
            $query->where('affiliate_id', Auth::guard('affiliate')->user()->id);
        }])
            ->latest()
            ->get();


        $totalCompletedCommission = 0;
        $totalPendingCommission = 0;

        // Calculate total commission for completed and pending orders
        foreach ($orders as $order) {
            foreach ($order->orderItems as $orderItem) {
                // Calculate commission only if the product has a commission associated with it
                $productCommission = $orderItem->product->commission;

                if ($productCommission) {
                    $commissionAmount = $productCommission->amount; // Get commission amount from ProductCommission model
                    $price = $orderItem->price * $orderItem->quantity; // OrderItem price

                    // Calculate the commission percentage for this order item
                    $commissionForItem = ($commissionAmount / 100) * $price;


                    // Accumulate the total commission based on the order status
                    if ($order->status == 'completed') {
                        $totalCompletedCommission += $commissionForItem;
                    } elseif ($order->status == 'pending') {
                        $totalPendingCommission += $commissionForItem;
                    }
                }
            }
        }

        $withdraw = AffiliateWithdraw::where('affiliate_id', Auth::guard('affiliate')->user()->id)->sum('amount');

        $balance = $totalCompletedCommission - $withdraw;

        return view('affiliate.withdraw-request',compact('balance'));
    }

    public function storeWithdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'payment_info' => 'required|string',
        ]);

        // Store the withdrawal request
        AffiliateWithdraw::create([
            'affiliate_id' => Auth::guard('affiliate')->user()->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_info' => $request->payment_info,
            'status' => 'pending', // Default status is 'pending'
        ]);

        return redirect()->route('affiliate.withdraw')->with('success', 'Withdrawal request submitted successfully.');
    }
}

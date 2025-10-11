<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


     public function Orderindex()
    {
        $orders = Order::where('user_id', Auth::id())
            ->get();
        return view('user.order', compact('orders'));
    }

    // 🧡 Wishlist দেখানো
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();
        return view('user.wishlist', compact('wishlists'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'error', 'message' => 'Please login to add to wishlist.']);
        }

        $product_id = $request->product_id;
        $user_id = auth()->id();

        $exists = Wishlist::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($exists) {
            // remove if already exists
            $exists->delete();
            return response()->json(['status' => 'removed', 'message' => 'Removed from wishlist.']);
        }

        Wishlist::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
        ]);

        return response()->json(['status' => 'added', 'message' => 'Added to wishlist.']);
    }


}

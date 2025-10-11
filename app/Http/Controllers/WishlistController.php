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
        $orders = Order::with('orderItems')->where('user_id', Auth::id())
            ->get();
        return view('user.order', compact('orders'));
    }

    public function orderView($id)
    {
        $order = Order::with(['orderItems.product'])->where('id', $id)->firstOrFail();
        return response()->json($order);
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
            $exists->delete();
            $wishlistCount = Wishlist::where('user_id', $user_id)->count();

            return response()->json([
                'status' => 'removed',
                'message' => 'Removed from wishlist.',
                'wishlistCount' => $wishlistCount,
            ]);
        }

        Wishlist::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
        ]);

        $wishlistCount = Wishlist::where('user_id', $user_id)->count();

        return response()->json([
            'status' => 'added',
            'message' => 'Added to wishlist.',
            'wishlistCount' => $wishlistCount,
        ]);
    }
}

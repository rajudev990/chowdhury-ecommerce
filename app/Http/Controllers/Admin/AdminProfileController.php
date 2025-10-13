<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CustomerReview;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
        $orders = Order::count();
        $revenue = OrderItem::sum('price');
        $pending_orders = Order::where('status','pending')->count();
        $complete_orders = Order::where('status','complete')->count();
        $products = Product::count();
        $categories = Category::count();
        $customers = User::count();
        $new_customers = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $reviews = CustomerReview::where('status',1)->count();
        $pending_reviews = CustomerReview::where('status',0)->count();

      
       $allProducts = Product::with(['variants', 'orderItems'])->get();

        $productslist = $allProducts->map(function ($product) {
            $totalQty = $product->stock + $product->variants->sum('stock');
            $soldQty = $product->orderItems->sum('quantity');
            $product->available_stock = $totalQty - $soldQty;
            return $product;
        });

        $lowStockProducts = $productslist->filter(fn($p) => $p->available_stock <= 10);
        $otherProducts = $productslist->filter(fn($p) => $p->available_stock > 10);

        return view('admin.dashboard',compact('orders','pending_orders','complete_orders','products','categories','customers','new_customers','revenue','reviews','pending_reviews','lowStockProducts','otherProducts'));
    }


    public function settings()
    {
        return view('admin.auth.settings');
    }
    public function changePassword()
    {
        return view('admin.auth.change-password');
    }
    public function updateSettings(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;

        if ($request->hasFile('image') && $admin->image) {
            Storage::disk('public')->delete($admin->image);
        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' =>  $image,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $admin = auth('admin')->user();

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

    public function updateCurrency(Request $request)
    {
        $setting = Setting::first();

        $request->validate([
            'currency' => 'required|string'
        ]);

        $setting->currency = $request->currency;
        $setting->save();

       return back()->with('success', 'Currency updated successfully.');

    }
}

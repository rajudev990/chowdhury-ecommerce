<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CustomerContact;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class WebsiteController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $categories = Category::where('status', 1)->get();
        $is_new = Product::where('status', 1)->where('is_new', 1)->get();
        $is_popular = Product::where('status', 1)->where('is_popular', 1)->get();
        $is_featured = Product::where('status', 1)->where('is_featured', 1)->get();
        return view('frontend.index', compact('setting', 'categories', 'is_new', 'is_popular', 'is_featured'));
    }
    public function products()
    {
        $setting = Setting::first();
        $products = Product::where('status', 1)->latest()->get();
        return view('frontend.products', compact('setting','products'));
    }

    public function productSingle($slug)
    {
        $item = Product::where('slug', $slug)->firstOrFail(); // not found হলে automatic 404
        $setting = Setting::first();
        // Related products fetch
        $relatedProducts = $item->relatedProducts();
        return view('frontend.product-single', compact('item', 'setting', 'relatedProducts'));
    }
    
    
    public function categories($slug)
    {
        $category = Category::with('products')->where('slug', $slug)->firstOrFail(); // not found হলে automatic 404
        $setting = Setting::first();
        return view('frontend.categories', compact('category', 'setting'));
    }

    public function liveSearch(Request $request)
    {
        $query = $request->get('q');

        $products = Product::select('id', 'name', 'slug', 'regular_price', 'sale_price')
            ->where('name', 'like', "%{$query}%")
            ->limit(8)
            ->get();

        return response()->json($products);
    }



    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function orderStore(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'delivery_area' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'total' => 'required|numeric',
        ]);

        // User ID check
        if (Auth::check()) {
            $userId = Auth::id();
        } else {
            // Generate unique email and username
            $uniqueString = Str::random(6) . time();
            $guestEmail = 'guest_'.$uniqueString.'@example.com';
            $guestUsername = 'guest_'.$uniqueString;

            // Create a new guest user
            $guestUser = User::create([
                'name' => $request->customer_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $guestEmail,
                'username' => $guestUsername,
                'password' => bcrypt(Str::random(8)), // random password
            ]);

            $userId = $guestUser->id;
        }

        // Create Order
        $order = Order::create([
            'user_id' => $userId,
            'total' => $request->total,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'delivery_area' => $request->delivery_area,
            'delivery_charge' => $request->delivery_charge ?? 0,
            'transaction_id' => $request->transaction_id ?? null,
            'payment_date' => $request->payment_date ?? null,
        ]);

        // Save order items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'product_variant_id' => $item['variantId'] ?? null,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart after successful order
        session()->flash('success', 'Order Created Successfully');
        return redirect()->route('index');
    }



    public function reviews()
    {
        $setting = Setting::first();
        return view('frontend.reviews', compact('setting'));
    }
    public function contacts()
    {
        $setting = Setting::first();
        return view('frontend.contacts', compact('setting'));
    }

    public function contactStore(Request $request)
    {
        $data = $request->all();
        CustomerContact::create($data);
        return redirect()->back()->with('success', 'Thank you for contacting us!');
    }



    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $imagePath = null;

        if ($socialUser->getAvatar()) {
            // Download image from URL
            $imageContents = file_get_contents($socialUser->getAvatar());

            // Generate unique filename
            $filename = 'users/' . Str::uuid() . '.jpg';

            // Store image to storage/app/public/users
            Storage::disk('public')->put($filename, $imageContents);

            $imagePath = $filename;
        }

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(Str::random(24)),
                'image' => $imagePath,
            ]
        );

        // Optional: Update image if user already exists but has no image
        if (!$user->image && $imagePath) {
            $user->image = $imagePath;
            $user->save();
        }

        Auth::login($user);
        return redirect()->intended('/home');
    }


    public function showRegistrationForm($referrer_id = null)
    {
        return view('auth.register-refer', ['referrer_id' => $referrer_id]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits_between:10,14|unique:users',
            'password' => 'required|confirmed|min:6',
            'referrer_id' => 'nullable|exists:users,id',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'referrer_id' => $request->referrer_id,
        ]);

        // Log in the user
        auth()->login($user);

        // Trigger email verification event
        event(new Registered($user));

        return redirect()->route('verification.notice');
    }
}

@extends('user.layouts.app')

@section('content')
@if ($wishlists->count())
<section id="wishlist-products" class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">💖 My Wishlist</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($wishlists as $wishlist)
                @php
                    $item = $wishlist->product;
                    if (!$item) continue;

                    $discount = 0;
                    if ($item->regular_price > 0 && $item->sale_price < $item->regular_price) {
                        $discount = round((($item->regular_price - $item->sale_price) / $item->regular_price) * 100);
                    }

                    $inWishlist = auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())
                        ->where('product_id', $item->id)
                        ->exists();
                @endphp

                <div class="relative bg-white rounded-2xl shadow hover:shadow-lg transition duration-300 overflow-hidden group">

                    {{-- ❤️ Wishlist Icon --}}
                    <i data-id="{{ $item->id }}"
                       class="fa fa-heart add-to-wishlist absolute top-3 right-3 text-2xl transition-all duration-200 {{ $inWishlist ? 'text-red-500' : 'text-gray-400 group-hover:text-red-500' }}"
                       style="cursor:pointer; z-index:99;"></i>

                    {{-- 🔖 Discount Badge --}}
                    @if($discount > 0)
                        <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded-full">
                            {{ $discount }}% OFF
                        </span>
                    @endif

                    {{-- 🖼 Product Image --}}
                    <div class="overflow-hidden relative">
                        <img src="{{ Storage::url($item->featured_image_1) }}"
                             alt="{{ $item->name }}"
                             class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    {{-- 🧾 Product Info --}}
                    <div class="p-4 text-center">
                        <h5 class="text-lg font-semibold text-gray-800 mb-2">
                            <a href="{{ route('product.single',$item->slug) }}" class="hover:text-blue-600 transition">
                                {{ $item->name }}
                            </a>
                        </h5>

                        {{-- 💰 Price --}}
                        <div class="mb-3">
                            @if($item->regular_price > $item->sale_price)
                                <span class="text-gray-400 line-through mr-2">${{ $item->regular_price }}</span>
                            @endif
                            <span class="text-blue-600 font-bold">${{ $item->sale_price }}</span>
                        </div>

                        {{-- ⭐ Ratings --}}
                        <div class="mb-3 text-yellow-400 text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                            <span class="text-gray-500 ml-1">(120)</span>
                        </div>

                        {{-- 🛒 Order Now --}}
                        <a href="{{ route('product.single',$item->slug) }}"
                        class="order-now w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition inline-block text-center">
                        <i class="fas fa-shopping-cart mr-2"></i> Order Now
                        </a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@else
<div class="flex flex-col items-center justify-center py-16 bg-gray-50 text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076504.png" class="w-24 h-24 mb-4 opacity-70" alt="Empty Wishlist">
    <h4 class="text-xl font-semibold text-gray-700">Your wishlist is empty ❤️</h4>
    <a href="{{ route('home') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
        Continue Shopping
    </a>
</div>
@endif


@endsection
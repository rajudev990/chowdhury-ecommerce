@extends('layouts.app')
@section('title','Categories Products')
@section('content')


<section id="new-products" class="bg-light py-5">
    <div class="container">
        <h2 class="section-title">{{ $category->name }}</h2>
        <div class="row g-4">
            <!-- Product Item -->
             @if($category->products->count() > 0)
            @foreach ($category->products as $item)
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    @php
                    if($item->regular_price > 0 && $item->sale_price < $item->regular_price) {
                        $discount = round((($item->regular_price - $item->sale_price) / $item->regular_price) * 100);
                        } else {
                        $discount = 0;
                        }
                        @endphp

                        @if($discount > 0)
                        <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                            {{ $discount }}% OFF
                        </div>
                        @endif

                        @php
                        $inWishlist = auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())
                        ->where('product_id', $item->id)
                        ->exists();
                        @endphp

                        <i data-id="{{ $item->id }}"
                            class="fa fa-heart add-to-wishlist {{ $inWishlist ? 'text-danger' : 'text-dark' }}"
                            style="cursor:pointer;position:absolute;top:10px;right:20px;z-index:99;font-size:25px;">
                        </i>

                        <!-- Image Container -->
                        <div class="img-container position-relative overflow-hidden">
                            <!-- Main Image -->
                            <img src="{{ Storage::url($item->featured_image_1) }}" class="main-img w-100" alt="{{ $item->name }}">
                            <!-- Hover Image -->
                            @if($item->featured_image_2)
                            <img src="{{ Storage::url($item->featured_image_2) }}" class="hover-img w-100 position-absolute top-0 start-100"
                                alt="{{ $item->name }}">
                            @else
                            <img src="{{ Storage::url($item->featured_image_1) }}" class="hover-img w-100 position-absolute top-0 start-100"
                                alt="{{ $item->name }}">
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a class="text-decoration-none text-dark" href="{{ route('product.single',$item->slug) }}">{{ $item->name }}</a></h5>
                            <div class="price mb-2">
                                <span class="text-muted text-decoration-line-through me-2">${{ $item->regular_price }}</span>
                                <span class="fw-bold text-primary">${{ $item->sale_price }}</span>
                            </div>
                            <div class="mb-2">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                <span class="text-muted">(120)</span>
                            </div>
                            <a href="javascript:void(0)"
                                class="btn btn-primary w-100 order-now"
                                data-id="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                                data-slug="{{ $item->slug }}"
                                data-image="{{ Storage::url($item->featured_image_1) }}"
                                data-price="{{ $item->sale_price }}"
                                data-has-variant="{{ $item->variants->count() > 0 ? '1' : '0' }}">
                                <i class="fas fa-shopping-cart me-2"></i> Order Now
                            </a>
                        </div>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-center text-danger">Not Founded</p>
            @endif
            <!-- More product items can follow same structure -->
        </div>
    </div>
</section>


@endsection
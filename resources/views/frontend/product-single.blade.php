@extends('layouts.app')
@section('title', $item->slug)
@section('content')
<section class="product-single py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Left: Product Images -->
            <div class="col-lg-6 col-md-12">
                <div class="product-images">
                    <div class="main-image">
                        <img src="{{ Storage::url($item->featured_image_1) }}" alt="{{ $item->name }}" id="currentImage">
                    </div>
                    <div class="image-thumbnails mt-3 d-flex gap-2">
                        @if($item->images && $item->images->count() > 0)
                        @foreach($item->images as $key => $img)
                        <img src="{{ Storage::url($img->image) }}" class="thumb {{ $key == 0 ? 'active' : '' }}" alt="{{ $item->name }}">
                        @endforeach
                        @endif
                    </div>
                </div>



            </div>

            <!-- Right: Product Info -->
            <div class="col-lg-6 col-md-12">
                <div class="product-info">
                    <h2 class="product-title mb-1">{{ $item->name }}</h2>

                    <div class="price mb-3">
                        <span class="text-muted text-decoration-line-through me-2">{{currency()}}{{ $item->regular_price }}</span>
                        @if($item->sale_price)
                        <span class="fw-bold text-primary">{{currency()}}{{ $item->sale_price }}</span>
                        @else
                        <span class="fw-bold text-primary">{{currency()}}{{ $item->regular_price }}</span>
                        @endif
                    </div>

                    <div class="mb-3">Category: <span class="badge bg-secondary me-2">{{ $item->category->name ?? '-' }}</span></div>
                    <div class="mb-3">Brand: <span class="badge bg-secondary">{{ $item->brand->name ?? '-' }}</span></div>
                    @if($item->vendor_id)
                    <div class="mb-3">Seller: <span class="badge bg-secondary">{{ $item->vendor->name ?? '-' }}</span></div>
                    @endif

                    {{-- Variants --}}
                    @php
                    $firstVariant = $item->variants->first();
                    @endphp
                    @if($item->variants->count() > 0)
                    <div class="variants mb-3">
                        @if($item->variants->pluck('color_id')->filter()->count() > 0)
                        <div class="mb-2">
                            <label>Color:</label>
                            <select id="variant-color" class="form-select">
                                @foreach($item->variants->whereNotNull('color_id')->unique('color_id') as $variant)
                                <option value="{{ $variant->id }}" data-price="{{ $variant->price }}" data-stock="{{ $variant->stock }}" data-color="{{ $variant->color->name ?? '' }}" data-size="{{ $variant->size?->name ?? '' }}">
                                    {{ $variant->color->name ?? 'N/A' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        @if($item->variants->pluck('size_id')->filter()->count() > 0)
                        <div class="mb-2">
                            <label>Size:</label>
                            <select id="variant-size" class="form-select">
                                @foreach($item->variants->whereNotNull('size_id')->unique('size_id') as $variant)
                                <option value="{{ $variant->id }}" data-price="{{ $variant->price }}" data-stock="{{ $variant->stock }}" data-color="{{ $variant->color?->name ?? '' }}" data-size="{{ $variant->size->name }}">
                                    {{ $variant->size->name ?? 'N/A' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="mb-2">Price: {{currency()}}<span id="variant-price">{{ $firstVariant->price ?? $item->sale_price ?? $item->regular_price }}</span></div>
                        <div class="mb-2">Stock: <span id="variant-stock">{{ $firstVariant->stock ?? 100 }}</span></div>
                    </div>
                    @endif

                    {{-- Quantity Selector --}}
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <button type="button" id="decrement" class="btn btn-secondary">-</button>
                        <input type="number" id="qty" class="form-control text-center" value="1" min="1" style="width: 70px;">
                        <button type="button" id="increment" class="btn btn-secondary">+</button>
                    </div>

                    {{-- Add to Cart --}}
                    <div class="d-flex gap-2 mb-3">
                        <button id="add-to-cart" class="btn btn-primary flex-fill"
                            data-product-id="{{ $item->id }}"
                            data-name="{{ $item->name }}"
                            data-slug="{{ $item->slug }}"
                            data-affiliate-id="{{ $affiliate ? $affiliate->id : '' }}"
                            data-price="{{ $item->variants->first()?->price ?? $item->sale_price ?? $item->regular_price }}"
                            data-image="{{ Storage::url($item->featured_image_1) }}">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </button>

                    </div>
                </div>
            </div>

        </div>
</section>


@if($relatedProducts->count() > 0)
<!-- Related Products -->
<section id="related-products" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5">Related Products</h2>
        <div class="row g-4">
            @foreach($relatedProducts as $item)
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
                                <span class="text-muted text-decoration-line-through me-2">{{currency()}}{{ $item->regular_price }}</span>
                                <span class="fw-bold text-primary">{{currency()}}{{ $item->sale_price }}</span>
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
        </div>
    </div>
</section>
@endif

@include('frontend.components.customer-review')


@endsection


@section('script')
<script>
    // ✅ Product View Tracking (fires on page load)
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "view_item",
        ecommerce: {
            items: [{
                item_name: "{{ $item->name }}",
                item_id: "{{ $item->id }}",
                price: "{{ $item->sale_price ?? $item->regular_price }}",
                item_brand: "{{ $item->brand->name ?? '' }}",
                item_category: "{{ $item->category->name ?? '' }}",
                item_variant: "{{ $item->variants->count() > 0 ? 'Has Variant' : 'Single' }}",
                currency: "BDT"
            }]
        }
    });

    // ✅ Add to Cart / Order Now button tracking
    document.getElementById('add-to-cart').addEventListener('click', function() {
        const productName = this.dataset.name;
        const productId = this.dataset.productId;
        const productPrice = this.dataset.price;
        const productImage = this.dataset.image;

        dataLayer.push({
            event: "add_to_cart",
            ecommerce: {
                items: [{
                    item_name: productName,
                    item_id: productId,
                    price: productPrice,
                    item_image: productImage,
                    quantity: document.getElementById('qty').value,
                    currency: "BDT"
                }]
            }
        });
        console.log("✅ DataLayer event pushed: add_to_cart");
    });
</script>
@endsection
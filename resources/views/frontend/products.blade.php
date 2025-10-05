@extends('layouts.app')
@section('title','Products')
@section('content')
<!-- New Products -->
<section id="new-products" class="bg-light py-5">
    <div class="container">
        <h2 class="section-title">New Products</h2>
        <div class="row g-4">
            <!-- Product Item -->
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copy this block for other products -->
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- More product items can follow same structure -->
        </div>
    </div>
</section>

<!-- Most Popular Products -->
<section id="popular-products">
    <div class="container">
        <h2 class="section-title">Most Popular Products</h2>
        <div class="row g-4">
            <!-- Product Item -->
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copy this block for other products -->
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card product-card position-relative overflow-hidden border-0 shadow-sm">
                    <!-- Discount Badge -->
                    <div class="discount-badge position-absolute bg-danger text-white px-2 py-1 fw-bold">
                        20% OFF
                    </div>
                    <!-- Image Container -->
                    <div class="img-container position-relative overflow-hidden">
                        <!-- Main Image -->
                        <img src="assets/img/09.webp" class="main-img w-100" alt="Premium Honey Jar">
                        <!-- Hover Image -->
                        <img src="assets/img/02.jpg" class="hover-img w-100 position-absolute top-0 start-100"
                            alt="Premium Honey Jar Hover">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="product-single.html">Premium Honey Jar</a></h5>
                        <div class="price mb-2">
                            <span class="text-muted text-decoration-line-through me-2">$45.00</span>
                            <span class="fw-bold text-primary">$35.00</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="text-muted">(120)</span>
                        </div>
                        <a href="checkout.html" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Order Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- More product items can follow same structure -->
        </div>
    </div>
</section>
@endsection
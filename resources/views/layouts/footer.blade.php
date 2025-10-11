<!-- Footer -->
<footer id="footer">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-4 mb-3">
                @if($setting->footer_logo)
                <img src="{{ Storage::url($setting->footer_logo) }}" alt="{{ $setting->title }}">
                @else
                Logo
                @endif
                <p>{{ $setting->address }}</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('products') }}">All Products</a></li>
                    <li><a href="{{ route('reviews') }}">Reviews</a></li>
                    <li><a href="{{ route('contacts') }}">Contacts</a></li>
                    <li><a href="{{ route('affiliate.register') }}">Affiliate</a></li>
                    <li><a href="{{ route('track.order') }}">Track Order</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Contact Us</h5>
                <p>Email: {{ $setting->email_one }}</p>
                <p>Phone: {{ $setting->phone_one }}</p>
                <div>
                    <a href="{{ $setting->faceboook }}"><img src="https://img.icons8.com/color/48/000000/facebook.png" width="24"></a>
                    <a href="{{ $setting->twitter }}"><img src="https://img.icons8.com/color/48/000000/twitter.png" width="24"></a>
                    <a href="{{ $setting->instagram }}"><img src="https://img.icons8.com/color/48/000000/instagram-new.png" width="24"></a>
                </div>
            </div>
        </div>
        <hr class="bg-secondary">
        <p class="text-center mb-0">{{ $setting->copyright }}</p>
    </div>
</footer>

<!-- Bottom Navbar -->
<nav class="mobile-bottom-nav d-flex justify-content-around align-items-center">
    <a href="javascript:void" class="nav-item" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
        <span>Category</span>
    </a>
    <a href="#" class="nav-item">
        <i class="fas fa-comment-alt"></i>
        <span>Message</span>
    </a>
    <a href="{{ route('index') }}" class="nav-item active">
        <div class="circle-icon">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </div>
    </a>
    <a href="{{ route('checkout') }}" class="nav-item">
        <i class="fas fa-shopping-cart"></i>
        <span class="fcart">0</span>
    </a>
    <a href="{{ route('login') }}" class="nav-item">
        <i class="fas fa-user"></i>
        <span>Login</span>
    </a>
</nav>
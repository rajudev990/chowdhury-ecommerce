@php
    use App\Models\Wishlist;
    $wishlistCount = 0;

    if (auth()->check()) {
        $wishlistCount = Wishlist::where('user_id', auth()->id())->count();
    }
@endphp
<!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
     <div class="container d-flex justify-content-between align-items-center py-2">
         <!-- Small Device Hamburger -->
         <button class="btn d-lg-none" type="button" onclick="toggleSidebar()">
             <span class="navbar-toggler-icon"></span>
         </button>

         <!-- Logo -->
         <a class="navbar-brand fw-bold" href="{{ route('index') }}">
            @if($setting->header_logo)
            <img class="img-fluid" src="{{ Storage::url($setting->header_logo) }}" alt="{{ $setting->title }}" width="120">
            @else
            Logo
            @endif
         </a>

         <!-- Search Box Large -->
        <form class="d-none d-lg-flex mx-auto position-relative" role="search" id="searchForm">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search products..." aria-label="Search">
                <button class="btn" type="submit">Search</button>
            </div>

            <!-- 🔍 Live Search Result -->
            <div id="searchResults" 
                class="position-absolute bg-white shadow rounded mt-1 w-100 z-10 d-none top-100" 
                style="max-height: 350px; overflow-y: auto;">
            </div>
        </form>


         <!-- Right Menu -->
         <div class="d-flex align-items-center">
             
           <div class="me-4 d-lg-none position-relative" style="cursor:pointer;" onclick="goToWishlist()">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/like.png"/>
                <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle wishlist-count">
                    {{ $wishlistCount ?? 0 }}
                </span>
            </div>


            <!-- Cart Icon Small -->
             <div class="me-2 d-lg-none position-relative" onclick="toggleCart()" style="cursor:pointer;">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/shopping-cart.png"/>
                <span class="badge cart rounded-pill bg-danger position-absolute top-0 start-100 translate-middle">0</span>
            </div>


             <!-- Large Device Menu -->
             <ul class="navbar-nav d-none d-lg-flex">
                 <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
                 <li class="nav-item dropdown">
                     <a class="nav-link @if($categories->count()) dropdown-toggle @endif" href="#" id="catDropdown" role="button"
                         data-bs-toggle="dropdown" aria-expanded="false">
                         Category
                     </a>
                     @if($categories->count())

                     <ul class="dropdown-menu" aria-labelledby="catDropdown">
                        @foreach ($categories as $item)
                            <li><a class="dropdown-item" href="{{ route('categories',$item->slug) }}">{{ $item->name }}</a></li>
                        @endforeach
                        
                     </ul>
                     @endif
                 </li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('reviews') }}">Reviews</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Contact</a></li>

             </ul>
             <!-- Cart Icon Small -->
             <!-- Wishlist Icon -->
            <div class="me-4 d-lg-block d-none position-relative" style="cursor:pointer;" onclick="goToWishlist()">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/like.png"/>
                <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle">
                    {{ $wishlistCount ?? 0 }}
                </span>
            </div>
            <!-- Cart Icon -->
            <div class="me-2 d-lg-block d-none position-relative" onclick="toggleCart()" style="cursor:pointer;">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/shopping-cart.png"/>
                <span class="badge cart rounded-pill bg-danger position-absolute top-0 start-100 translate-middle">0</span>
            </div>
           <div class="me-2 d-lg-block d-none position-relative" style="cursor:pointer;">
                <a href="javascript:void(0)" id="accountLink" 
                class="text-white text-decoration-none d-flex align-items-center gap-1">
                    <img src="https://img.icons8.com/ios-filled/24/ffffff/user.png" alt="Profile" />
                    <span>Account</span>
                </a>
            </div>

             
         </div>
     </div>
 </nav>

 <!-- Sidebar -->
 <div id="sidebar">
     <div class="d-flex justify-content-between align-items-center mb-4">
         <h5 class="text-white m-0">Menu</h5>
         <span class="close-btn" onclick="toggleSidebar()">&times;</span>
     </div>
     <ul class="list-unstyled">
        <!-- Category Dropdown -->
         <li class="nav-item">
             <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                 href="#catSubmenu" role="button" aria-expanded="false" aria-controls="catSubmenu">
                 Category
                 <i class="bi bi-chevron-down text-white"></i>
             </a>
             @if($categories->count())
             <ul class="collapse list-unstyled ps-3" id="catSubmenu">
                @foreach ($categories as $item)
                 <li><a class="nav-link" href="{{ route('categories',$item->slug) }}">{{ $item->name }}</a></li>
                 @endforeach
                 
             </ul>
              @endif
         </li>

         <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
         <li class="nav-item"><a class="nav-link" href="{{ route('reviews') }}">Reviews</a></li>
         <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Contact</a></li>

         
     </ul>
 </div>




 <!-- Cart Sidebar -->
<div id="cartSidebar" class="bg-dark p-3 position-fixed top-0 end-0 vh-100" style="width:300px; display:none;">
    <div class="cart-header d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 text-white">Your Cart</h5>
        <span class="close-cart text-white" style="cursor:pointer;" onclick="toggleCart()">&times;</span>
    </div>
    <div class="cart-body"></div>
    <div class="cart-footer mt-4">
        <div class="d-flex justify-content-between text-white fw-bold mb-3">
            <span>Total:</span>
            <span class="price">৳ 0</span>
        </div>
        <a href="{{ route('checkout') }}" class="btn w-100">Checkout</a>
    </div>
</div>

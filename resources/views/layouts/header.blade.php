
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
            <img src="{{ Storage::url($setting->header_logo) }}" alt="{{ $setting->title }}">
            @else
            Logo
            @endif
         </a>

         <!-- Search Box Large -->
         <form class="d-none d-lg-flex mx-auto" role="search">
             <div class="input-group">
                 <input type="text" class="form-control" placeholder="Search products..." aria-label="Search">
                 <button class="btn" type="submit">Search</button>
             </div>
         </form>

         <!-- Right Menu -->
         <div class="d-flex align-items-center">
             <!-- Cart Icon Small -->
             <div class="me-2 d-lg-none position-relative" onclick="toggleCart()">
                 <a href="#"><img src="https://img.icons8.com/ios-filled/24/ffffff/shopping-cart.png" /></a>
                 <span
                     class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
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
                            <li><a class="dropdown-item" href="#">{{ $item->name }}</a></li>
                        @endforeach
                        
                     </ul>
                     @endif
                 </li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('reviews') }}">Reviews</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Contact</a></li>

             </ul>
             <!-- Cart Icon Small -->
             <div class="me-2 d-lg-block d-none position-relative" onclick="toggleCart()">
                 <a href="#"><img src="https://img.icons8.com/ios-filled/24/ffffff/shopping-cart.png" /></a>
                 <span
                     class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
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
         <li class="nav-item"><a class="nav-link" href="#categories">Categories</a></li>
         <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
         <li class="nav-item"><a class="nav-link" href="{{ route('reviews') }}">Reviews</a></li>
         <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Contact</a></li>

         <!-- Category Dropdown -->
         <li class="nav-item">
             <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                 href="#catSubmenu" role="button" aria-expanded="false" aria-controls="catSubmenu">
                 Category
                 <i class="bi bi-chevron-down text-white"></i>
             </a>
             <ul class="collapse list-unstyled ps-3" id="catSubmenu">
                 <li><a class="nav-link" href="#">Organic Honey</a></li>
                 <li><a class="nav-link" href="#">Bee Products</a></li>
                 <li><a class="nav-link" href="#">Honey Comb</a></li>
                 <li><a class="nav-link" href="#">Gift Packs</a></li>
             </ul>
         </li>
     </ul>
 </div>




 <!-- Cart Sidebar -->
 <div id="cartSidebar">
     <div class="cart-header d-flex justify-content-between align-items-center mb-3">
         <h5 class="m-0 text-white">Your Cart</h5>
         <span class="close-cart" onclick="toggleCart()">&times;</span>
     </div>
     <div class="cart-body">
         <!-- Example Cart Item -->
         <div class="cart-item d-flex align-items-center mb-3">
             <img src="assets/img/02.jpg" class="rounded me-2" alt="Product">
             <div class="flex-grow-1">
                 <h6 class="mb-1 text-white">Blackseed Honey</h6>
                 <small class="text-light">Qty: 2</small>
             </div>
             <span class="price fw-bold me-2">৳ 500</span>

             <!-- Trash Icon -->
             <i class="bi bi-trash text-danger" style="cursor:pointer; font-size:18px;"
                 onclick="removeCartItem(this)"></i>
         </div>

         <div class="cart-item d-flex align-items-center mb-3">
             <img src="assets/img/02.jpg" class="rounded me-2" alt="Product">
             <div class="flex-grow-1">
                 <h6 class="mb-1 text-white">Blackseed Honey</h6>
                 <small class="text-light">Qty: 2</small>
             </div>
             <span class="price fw-bold me-2">৳ 500</span>

             <!-- Trash Icon -->
             <i class="bi bi-trash text-danger" style="cursor:pointer; font-size:18px;"
                 onclick="removeCartItem(this)"></i>
         </div>
         <div class="cart-item d-flex align-items-center mb-3">
             <img src="assets/img/02.jpg" class="rounded me-2" alt="Product">
             <div class="flex-grow-1">
                 <h6 class="mb-1 text-white">Blackseed Honey</h6>
                 <small class="text-light">Qty: 2</small>
             </div>
             <span class="price fw-bold me-2">৳ 500</span>

             <!-- Trash Icon -->
             <i class="bi bi-trash text-danger" style="cursor:pointer; font-size:18px;"
                 onclick="removeCartItem(this)"></i>
         </div>
     </div>
     <div class="cart-footer mt-4">
         <div class="d-flex justify-content-between text-white fw-bold mb-3">
             <span>Total:</span>
             <span class="price">৳ 1800</span>
         </div>
         <a href="checkout.html" class="btn w-100">Checkout</a>
     </div>
 </div>
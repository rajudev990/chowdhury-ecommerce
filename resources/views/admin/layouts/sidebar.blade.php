<nav id="sidebar">
    <div class="p-3 text-center border-bottom fw-bold">{{ $setting->app_name ?? 'Admin Panel' }}</div>

    <ul class="nav flex-column mt-3">

        {{-- Dashboard --}}
        @canany(['create dashboard','edit dashboard','view dashboard','delete dashboard'])
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </li>
        @endcanany

        {{-- Category System --}}
        @canany([
        'create category','edit category','view category','delete category',
        'create subcategory','edit subcategory','view subcategory','delete subcategory',
        'create subsubcategory','edit subsubcategory','view subsubcategory','delete subsubcategory'
        ])
        @php
        $categoryActive = request()->is('admin/categories*') || request()->is('admin/subcategories*') || request()->is('admin/subsubcategories*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $categoryActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#categoryMenu" role="button" aria-expanded="{{ $categoryActive ? 'true' : 'false' }}">
                <div><i class="fas fa-list me-2"></i> Category System</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $categoryActive ? 'show' : '' }}" id="categoryMenu">
                <ul class="nav flex-column ms-3">
                    @canany(['create category','edit category','view category','delete category'])
                    <li><a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">All Categories</a></li>
                    @endcanany
                    @canany(['create subcategory','edit subcategory','view subcategory','delete subcategory'])
                    <li><a class="nav-link {{ request()->is('admin/subcategories*') ? 'active' : '' }}" href="{{ route('admin.subcategories.index') }}">Sub Categories</a></li>
                    @endcanany
                    @canany(['create subsubcategory','edit subsubcategory','view subsubcategory','delete subsubcategory'])
                    <li><a class="nav-link {{ request()->is('admin/subsubcategories*') ? 'active' : '' }}" href="{{ route('admin.subsubcategories.index') }}">Sub Sub Categories</a></li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany

        {{-- Product Management --}}
        @canany([
        'create product','edit product','view product','delete product',
        'create seller-product','edit seller-product','view seller-product','delete seller-product'
        ])
        @php
        $productActive = request()->is('admin/products*') || request()->is('admin/colors*') || request()->is('admin/sizes*') || request()->is('admin/brands*') || request()->is('admin/seller/product*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $productActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#productMenu" role="button" aria-expanded="{{ $productActive ? 'true' : 'false' }}">
                <div><i class="fas fa-boxes-stacked me-2"></i> Product Management</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $productActive ? 'show' : '' }}" id="productMenu">
                <ul class="nav flex-column ms-3">
                    @canany(['create product','edit product','view product','delete product'])
                    <li><a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">All Products</a></li>
                    <li><a class="nav-link {{ request()->is('admin/products/create') ? 'active' : '' }}" href="{{ route('admin.products.create') }}">Add Product</a></li>
                    <li><a class="nav-link {{ request()->is('admin/colors*') ? 'active' : '' }}" href="{{ route('admin.colors.index') }}">Colors</a></li>
                    <li><a class="nav-link {{ request()->is('admin/sizes*') ? 'active' : '' }}" href="{{ route('admin.sizes.index') }}">Sizes</a></li>
                    <li><a class="nav-link {{ request()->is('admin/brands*') ? 'active' : '' }}" href="{{ route('admin.brands.index') }}">Brands</a></li>
                    @endcanany
                    @canany(['create seller-product','edit seller-product','view seller-product','delete seller-product'])
                    <li><a class="nav-link {{ request()->is('admin/seller/product*') ? 'active' : '' }}" href="{{ route('admin.seller.product') }}">Seller Products</a></li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany

        {{-- Orders --}}
        @canany([
        'create order','edit order','view order','delete order',
        'create pending-order','edit pending-order','view pending-order','delete pending-order',
        'create processing-order','edit processing-order','view processing-order','delete processing-order',
        'create on-the-way','edit on-the-way','view on-the-way','delete on-the-way',
        'create hold','edit hold','view hold','delete hold',
        'create couriers','edit couriers','view couriers','delete couriers',
        'create complete','edit complete','view complete','delete complete',
        'create cancelled','edit cancelled','view cancelled','delete cancelled'
        ])
        @php
        $orderActive = request()->is('admin/all-orders*') || request()->is('admin/pending-orders*') || request()->is('admin/processing-orders*') || request()->is('admin/on-the-way*') || request()->is('admin/hold-orders') || request()->is('admin/courier-orders*') || request()->is('admin/complete-orders*') || request()->is('admin/cancelled-orders*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $orderActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#orderMenu" role="button" aria-expanded="{{ $orderActive ? 'true' : 'false' }}">
                <div><i class="fas fa-shopping-cart me-2"></i> Orders</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $orderActive ? 'show' : '' }}" id="orderMenu">
                <ul class="nav flex-column ms-3">
                    @canany(['create order','edit order','view order','delete order'])
                    <li><a class="nav-link {{ request()->is('admin/all-orders*') ? 'active' : '' }}" href="{{ route('admin.all-orders') }}">All Orders</a></li>
                    @endcanany
                    @canany(['create pending-order','edit pending-order','view pending-order','delete pending-order'])
                    <li><a class="nav-link {{ request()->is('admin/pending-orders*') ? 'active' : '' }}" href="{{ route('admin.pending-orders') }}">Pending</a></li>
                    @endcanany
                    @canany(['create processing-order','edit processing-order','view processing-order','delete processing-order'])
                    <li><a class="nav-link {{ request()->is('admin/processing-orders*') ? 'active' : '' }}" href="{{ route('admin.processing-orders') }}">Processing</a></li>
                    @endcanany
                    @canany(['create on-the-way','edit on-the-way','view on-the-way','delete on-the-way'])
                    <li><a class="nav-link {{ request()->is('admin/on-the-way*') ? 'active' : '' }}" href="{{ route('admin.on-the-way-orders') }}">On The Way</a></li>
                    @endcanany
                    @canany(['create hold','edit hold','view hold','delete hold'])
                    {{--<li><a class="nav-link {{ request()->is('admin/hold-orders') ? 'active' : '' }}" href="{{ route('admin/hold-orders') }}">On Hold</a></li>--}}
                    @endcanany
                    @canany(['create couriers','edit couriers','view couriers','delete couriers'])
                    <li><a class="nav-link {{ request()->is('admin/courier-orders*') ? 'active' : '' }}" href="{{ route('admin.courier-orders') }}">Courier</a></li>
                    @endcanany
                    @canany(['create complete','edit complete','view complete','delete complete'])
                    <li><a class="nav-link {{ request()->is('admin/complete-orders*') ? 'active' : '' }}" href="{{ route('admin.complete-orders') }}">Completed</a></li>
                    @endcanany
                    @canany(['create cancelled','edit cancelled','view cancelled','delete cancelled'])
                    <li><a class="nav-link {{ request()->is('admin/cancelled-orders*') ? 'active' : '' }}" href="{{ route('admin.cancelled-orders') }}">Cancelled</a></li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany


        {{-- Website Menu --}}
        @canany([
        'create coupon','edit coupon','view coupon','delete coupon',
        'create smtp','edit smtp','view smtp','delete smtp',
        'create courier','edit courier','view courier','delete courier',
        'create marketing','edit marketing','view marketing','delete marketing',
        'create payment','edit payment','view payment','delete payment',
        'create banner','edit banner','view banner','delete banner',
        'create setting','edit setting','view setting','delete setting'
        ])
        @php
        $websiteActive = request()->is('admin/coupons*') || request()->is('admin/smtp*') || request()->is('admin/courier*') || request()->is('admin/marketing*') || request()->is('admin/payment*') || request()->is('admin/bannars*') || request()->is('admin/settings*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $websiteActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#websiteMenu" role="button" aria-expanded="{{ $websiteActive ? 'true' : 'false' }}">
                <div><i class="fas fa-globe me-2"></i> Website</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $websiteActive ? 'show' : '' }}" id="websiteMenu">
                <ul class="nav flex-column ms-3">
                    @canany(['create coupon','edit coupon','view coupon','delete coupon'])
                    <li><a class="nav-link {{ request()->is('admin/coupons*') ? 'active' : '' }}" href="{{ route('admin.coupons.index') }}">Coupons</a></li>
                    @endcanany

                    @canany(['create smtp','edit smtp','view smtp','delete smtp'])
                    <li><a class="nav-link {{ request()->is('admin/smtp*') ? 'active' : '' }}" href="{{ route('admin.smtp.edit',1) }}">SMTP</a></li>
                    @endcanany

                    @canany(['create courier','edit courier','view courier','delete courier'])
                    <li><a class="nav-link {{ request()->is('admin/courier*') ? 'active' : '' }}" href="{{ route('admin.courier.setup') }}">Courier Setup</a></li>
                    @endcanany

                    @canany(['create marketing','edit marketing','view marketing','delete marketing'])
                    <li><a class="nav-link {{ request()->is('admin/marketing*') ? 'active' : '' }}" href="{{ route('admin.marketing.setup') }}">Marketing</a></li>
                    @endcanany

                    @canany(['create payment','edit payment','view payment','delete payment'])
                    <li><a class="nav-link {{ request()->is('admin/payment*') ? 'active' : '' }}" href="{{ route('admin.payment.setup') }}">Payment Method</a></li>
                    @endcanany

                    @canany(['create banner','edit banner','view banner','delete banner'])
                    <li><a class="nav-link {{ request()->is('admin/bannars*') ? 'active' : '' }}" href="{{ route('admin.bannars.index') }}">Banners</a></li>
                    @endcanany

                    @canany(['create setting','edit setting','view setting','delete setting'])
                    <li><a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">Settings</a></li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany


        {{-- Affiliate Menu --}}
        @canany([
        'create configuration','edit configuration','view configuration','delete configuration',
        'create affiliate-user','edit affiliate-user','view affiliate-user','delete affiliate-user',
        'create affiliate-withdraw','edit affiliate-withdraw','view affiliate-withdraw','delete affiliate-withdraw'
        ])
        @php
        $affiliateActive = request()->is('admin/product-commission*') || request()->is('admin/all-users*') || request()->is('admin/marketer-withdraw*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $affiliateActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#affiliateMenu" role="button" aria-expanded="{{ $affiliateActive ? 'true' : 'false' }}">
                <div><i class="fas fa-handshake me-2"></i> Affiliate</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $affiliateActive ? 'show' : '' }}" id="affiliateMenu">
                <ul class="nav flex-column ms-3">
                    @canany(['create configuration','edit configuration','view configuration','delete configuration'])
                    <li><a class="nav-link {{ request()->is('admin/product-commission*') ? 'active' : '' }}" href="{{ route('admin.product-commission.index') }}">Affiliate Configuration</a></li>
                    @endcanany

                    @canany(['create affiliate-user','edit affiliate-user','view affiliate-user','delete affiliate-user'])
                    <li><a class="nav-link {{ request()->is('admin/all-users*') ? 'active' : '' }}" href="{{ route('admin.all-users.index') }}">Affiliate Users</a></li>
                    @endcanany

                    @canany(['create affiliate-withdraw','edit affiliate-withdraw','view affiliate-withdraw','delete affiliate-withdraw'])
                    <li><a class="nav-link {{ request()->is('admin/marketer-withdraw*') ? 'active' : '' }}" href="{{ route('admin.marketer-withdraw.index') }}">Withdraw Requests</a></li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany


        {{-- Sellers Menu --}}
        @canany(['create sellers','edit sellers','view sellers','delete sellers'])
        @php
        $sellersActive = request()->is('admin/all-sellers*') || request()->is('admin/vendor-product*') || request()->is('admin/vendor-order*') || request()->is('admin/sellers-withdrawal*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $sellersActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#sellersMenu" role="button" aria-expanded="{{ $sellersActive ? 'true' : 'false' }}">
                <div><i class="fas fa-store-alt me-2"></i> Seller System</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $sellersActive ? 'show' : '' }}" id="sellersMenu">
                <ul class="nav flex-column ms-3">
                    @canany(['create sellers','edit sellers','view sellers','delete sellers'])
                    <li><a class="nav-link {{ request()->is('admin/all-sellers*') ? 'active' : '' }}" href="{{ route('admin.all-sellers.index') }}">Sellers</a></li>
                    <li><a class="nav-link {{ request()->is('admin/sellers-withdrawal*') ? 'active' : '' }}" href="{{ route('admin.sellers-withdrawal') }}">Withdrawal Requests</a></li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany

        {{-- Reports Menu --}}
        @canany(['create report','edit report','view report','delete report'])
        @php
        $reportsActive = request()->is('admin/stock-report*') || request()->is('admin/order-report*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $reportsActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#reportsMenu" role="button" aria-expanded="{{ $reportsActive ? 'true' : 'false' }}">
                <div><i class="fas fa-folder-open me-2"></i> Reports</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $reportsActive ? 'show' : '' }}" id="reportsMenu">
                <ul class="nav flex-column ms-3">
                    @canany(['create report','edit report','view report','delete report'])
                    <li>
                        <a class="nav-link {{ request()->is('admin/stock-report*') ? 'active' : '' }}" href="{{ route('admin.stock_report') }}">
                            Stock Report
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('admin/order-report*') ? 'active' : '' }}" href="{{ route('admin.order_report') }}">
                            Order Report
                        </a>
                    </li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany

        {{-- User Management --}}
        @canany(['create user','edit user','view user','delete user','create role','edit role','view role','delete role'])
        @php
        $userActive = request()->is('admin/users*') || request()->is('admin/roles*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $userActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#userManagementMenu" role="button" aria-expanded="{{ $userActive ? 'true' : 'false' }}">
                <div><i class="fas fa-users me-2"></i> User Management</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $userActive ? 'show' : '' }}" id="userManagementMenu">
                <ul class="nav flex-column ms-3">
                    @canany(['create user','edit user','view user','delete user'])
                    <li>
                        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            Users
                        </a>
                    </li>
                    @endcanany

                    @canany(['create role','edit role','view role','delete role'])
                    <li>
                        <a class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                            Roles
                        </a>
                    </li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany




    </ul>
</nav>
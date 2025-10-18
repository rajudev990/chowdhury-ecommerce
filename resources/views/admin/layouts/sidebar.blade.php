<aside id="sidebar"
    class="bg-gray-900 text-white flex flex-col fixed h-full w-64 sidebar-transition z-40 
           -translate-x-full md:translate-x-0">

    <!-- Logo / Title -->
    <div class="p-4 flex items-center justify-between border-b border-gray-700">
        <span class="text-xl font-bold">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
        <button id="closeSidebar" class="md:hidden text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-2 space-y-2 overflow-y-auto">

        {{-- Dashboard --}}
        @canany(['create dashboard','edit dashboard','view dashboard','delete dashboard'])
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('admin') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-home w-4"></i>
            <span>Dashboard</span>
        </a>
        @endcanany

        {{-- Category Dropdown --}}

        @php
        $categoryActive = request()->is('admin/categories*') || request()->is('admin/subcategories*') || request()->is('admin/subsubcategories*');
        @endphp

        @canany(['create category','edit category','view category','delete category',
        'create subcategory','edit subcategory','view subcategory','delete subcategory',
        'create subsubcategory','edit subsubcategory','view subsubcategory','delete subsubcategory'])
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $categoryActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2">
                    <i class="fas fa-sitemap w-4"></i> Category System
                </span>
                <i class="fas fa-chevron-down transition-transform {{ $categoryActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $categoryActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">

                @canany(['create category','edit category','view category','delete category'])
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/categories*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-box w-3"></i> Category
                </a>
                @endcanany

                @canany(['create subcategory','edit subcategory','view subcategory','delete subcategory'])
                <a href="{{ route('admin.subcategories.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/subcategories*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-box-open w-3"></i> Sub Category
                </a>
                @endcanany

                @canany(['create subsubcategory','edit subsubcategory','view subsubcategory','delete subsubcategory'])
                <a href="{{ route('admin.subsubcategories.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/subsubcategories*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-cubes w-3"></i> Sub Sub Category
                </a>
                @endcanany

            </div>
        </div>
        @endcanany


        {{-- Products Dropdown --}}
        @php
        $productActive = request()->is('admin/products*') || request()->is('admin/brands*') || request()->is('admin/colors*') || request()->is('admin/sizes*') || request()->is('admin/seller/product')|| request()->is('admin/brands');
        @endphp
        @canany(['create product','edit product','view product','delete product',
        'create seller-product','edit seller-product','view seller-product','delete seller-product'])
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $productActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-box w-4"></i> Products</span>
                <i class="fas fa-chevron-down transition-transform {{ $productActive ? 'rotate-180' : '' }}"></i>
            </button>
            <div class="dropdown-menu {{ $productActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                @canany(['create product','edit product','view product','delete product'])
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/products*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-boxes w-3"></i> All Products
                </a>
                @endcanany

                @canany(['create product','edit product','view product','delete product'])
                <a href="{{ route('admin.products.create') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/products/create') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-plus-circle w-3"></i> Add Product
                </a>
                @endcanany

                @canany(['create seller-product','edit seller-product','view seller-product','delete seller-product'])
                <a href="{{ route('admin.seller.product') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/seller/product*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-store-alt w-3"></i> Seller Products
                </a>
                @endcanany

                @canany(['create product','edit product','view product','delete product'])
                <a href="{{ route('admin.colors.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/colors*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-palette w-3"></i> Color
                </a>
                @endcanany

                @canany(['create product','edit product','view product','delete product'])
                <a href="{{ route('admin.sizes.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/sizes*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-ruler w-3"></i> Size
                </a>
                @endcanany

                @canany(['create product','edit product','view product','delete product'])
                <a href="{{ route('admin.brands.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/brands*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-tag w-3"></i> Brand
                </a>
                @endcanany

            </div>
        </div>
        @endcanany

        {{-- Orders Dropdown --}}
        @php
        $orderActive = request()->is('admin/all-orders*') || request()->is('admin/pending-orders*') || request()->is('admin/processing-orders*') || request()->is('admin/on-the-way*') || request()->is('admin/hold-orders*') || request()->is('admin/courier-orders*') || request()->is('admin/complete-orders*') || request()->is('admin/cancelled-orders*') || request()->is('admin/orders*');
        @endphp

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
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $orderActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-shopping-cart w-4"></i> Orders</span>
                <i class="fas fa-chevron-down transition-transform {{ $orderActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $orderActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                @canany(['create order','edit order','view order','delete order'])
                <a href="{{ route('admin.all-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/all-orders*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-list w-3"></i> All Orders
                </a>
                @endcanany

                @canany(['create pending-order','edit pending-order','view pending-order','delete pending-order'])
                <a href="{{ route('admin.pending-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-hourglass-start w-3 text-orange-400"></i> Pending
                </a>
                @endcanany

                @canany(['create processing-order','edit processing-order','view processing-order','delete processing-order'])
                <a href="{{ route('admin.processing-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-spinner w-3 text-blue-400"></i> Processing
                </a>
                @endcanany

                @canany(['create on-the-way','edit on-the-way','view on-the-way','delete on-the-way'])
                <a href="{{ route('admin.on-the-way-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-truck w-3 text-indigo-400"></i> On The Way
                </a>
                @endcanany

                @canany(['create hold','edit hold','view hold','delete hold'])
                <a href="{{ route('admin.hold-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-pause-circle w-3 text-yellow-500"></i> On Hold
                </a>
                @endcanany

                @canany(['create couriers','edit couriers','view couriers','delete couriers'])
                <a href="{{ route('admin.courier-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-shipping-fast w-3 text-teal-400"></i> Courier
                </a>
                @endcanany

                @canany(['create complete','edit complete','view complete','delete complete'])
                <a href="{{ route('admin.complete-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-check-circle w-3 text-green-500"></i> Completed
                </a>
                @endcanany

                @canany(['create cancelled','edit cancelled','view cancelled','delete cancelled'])
                <a href="{{ route('admin.cancelled-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-times-circle w-3 text-red-500"></i> Cancelled
                </a>
                @endcanany
            </div>
        </div>
        @endcanany



        {{-- Website Dropdown --}}
        @php
        $websiteActive = request()->is('admin/coupons*') || request()->is('admin/smtp*') || request()->is('admin/pixel*') || request()->is('admin/courier*') || request()->is('admin/marketing*') || request()->is('admin/payment*') || request()->is('admin/settings*') || request()->is('admin/bannars*');
        @endphp


        @canany([
        'create coupon','edit coupon','view coupon','delete coupon',
        'create smtp','edit smtp','view smtp','delete smtp',
        'create courier','edit courier','view courier','delete courier',
        'create marketing','edit marketing','view marketing','delete marketing',
        'create payment','edit payment','view payment','delete payment',
        'create banner','edit banner','view banner','delete banner',
        'create setting','edit setting','view setting','delete setting'
        ])
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $websiteActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-globe w-4"></i> Website</span>
                <i class="fas fa-chevron-down transition-transform {{ $websiteActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $websiteActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                @canany(['create coupon','edit coupon','view coupon','delete coupon'])
                <a href="{{ route('admin.coupons.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-ticket-alt w-3"></i> Coupon
                </a>
                @endcanany

                @canany(['create smtp','edit smtp','view smtp','delete smtp'])
                <a href="{{ route('admin.smtp.edit',1) }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-envelope w-3"></i> SMTP
                </a>
                @endcanany

                {{--<a href="{{ route('admin.pixel.edit',1) }}"
                class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                <i class="fas fa-bullseye w-3"></i> Pixels
                </a>--}}

                @canany(['create courier','edit courier','view courier','delete courier'])
                <a href="{{ route('admin.courier.setup') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-shipping-fast w-3"></i> Courier
                </a>
                @endcanany

                @canany(['create marketing','edit marketing','view marketing','delete marketing'])
                <a href="{{ route('admin.marketing.setup') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-bullhorn w-4"></i> Marketing
                </a>
                @endcanany


                @canany(['create payment','edit payment','view payment','delete payment'])
                <a href="{{ route('admin.payment.setup') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-credit-card w-3"></i> Payment Method
                </a>
                @endcanany

                @canany(['create banner','edit banner','view banner','delete banner'])
                <a href="{{ route('admin.bannars.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-images w-3"></i> Banners
                </a>
                @endcanany

                @canany(['create setting','edit setting','view setting','delete setting'])

                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('admin/settings*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-cog w-4"></i>
                    <span>Settings</span>
                </a>
                @endcanany
            </div>
        </div>

        @endcanany


        {{-- Affiliate  --}}

        @php
        $AffiliateActive = request()->is('admin/all-users*')||request()->is('admin/product-commission*') ||request()->is('admin/marketer-withdraw*');
        @endphp

        @canany([
        'create configuration','edit configuration','view configuration','delete configuration',
        'create affiliate-user','edit affiliate-user','view affiliate-user','delete affiliate-user',
        'create affiliate-withdraw','edit affiliate-withdraw','view affiliate-withdraw','delete affiliate-withdraw'
        ])
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $AffiliateActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2">
                    <i class="fas fa-handshake w-4"></i> Affiliate
                </span>
                <i class="fas fa-chevron-down transition-transform {{ $AffiliateActive ? 'rotate-180' : '' }}"></i>
            </button>



            <div class="dropdown-menu {{ $AffiliateActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                @canany(['create configuration','edit configuration','view configuration','delete configuration'])
                <a href="{{ route('admin.product-commission.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/product-commission*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-cogs w-3"></i> Affiliate Configuration
                </a>
                @endcanany

                @canany(['create affiliate-user','edit affiliate-user','view affiliate-user','delete affiliate-user'])
                <a href="{{ route('admin.all-users.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/all-users*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-users w-3"></i> Affiliate Users
                </a>
                @endcanany

                @canany(['create affiliate-withdraw','edit affiliate-withdraw','view affiliate-withdraw','delete affiliate-withdraw'])
                <a href="{{ route('admin.marketer-withdraw.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/marketer-withdraw*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-hand-holding-usd w-3"></i> Withdraw Request
                </a>
                @endcanany



            </div>
        </div>

        @endcanany



        {{-- Sellers --}}
        @php
        $VendorActive = request()->is('admin/all-sellers*')|| request()->is('admin/vendor-product*') || request()->is('admin/vendor-order*') || request()->is('admin/sellers-withdrawal');
        @endphp

        @canany(['create sellers','edit sellers','view sellers','delete sellers'])
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $VendorActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2">
                    <i class="fas fa-store-alt w-4"></i> Seller System
                </span>
                <i class="fas fa-chevron-down transition-transform {{ $VendorActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $VendorActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">

                @canany(['create sellers','edit sellers','view sellers','delete sellers'])
                <a href="{{ route('admin.all-sellers.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/all-sellers*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-users w-3"></i> Sellers
                </a>
                <a href="{{ route('admin.sellers-withdrawal') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/sellers-withdrawal') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-money-bill-wave w-3"></i> Withdrawal Request
                </a>
                @endcanany
            </div>
        </div>
        @endcanany


        {{-- Reports --}}
        @php
        $ReportActive = request()->is('admin/stock-report')|| request()->is('admin/order-report');
        @endphp

        @canany(['create report','edit report','view report','delete report'])
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $ReportActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2">
                    <i class="fas fa-folder-open w-4"></i> Reports
                </span>
                <i class="fas fa-chevron-down transition-transform {{ $ReportActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $ReportActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">

               
                <a href="{{ route('admin.stock_report') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/stock report') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-chart-bar w-3"></i> Stock Report
                </a>
                <a href="{{ route('admin.order_report') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/order-report') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-file-alt w-3"></i> Order Report
                </a>
                
            </div>
        </div>
        @endcanany




        {{-- User Management --}}

        @php
        $userActive = request()->is('admin/users*') || request()->is('admin/roles*');
        @endphp
        @canany(['create role','edit role','view role','delete role','create user','edit user','view user','delete user'])
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $userActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-users w-4"></i> User Management</span>
                <i class="fas fa-chevron-down transition-transform {{ $userActive ? 'rotate-180' : '' }}"></i>
            </button>
            <div class="dropdown-menu {{ $userActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                @canany(['create user','edit user','view user','delete user'])
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/users*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-user w-3"></i> Users
                </a>
                @endcanany
                @canany(['create user','edit user','view user','delete user'])
                <a href="{{ route('admin.roles.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/roles*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-user-shield w-3"></i> Roles
                </a>
                @endcanany
            </div>
        </div>
        @endcanany



    </nav>
</aside>
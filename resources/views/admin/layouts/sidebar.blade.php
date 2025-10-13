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
        @can('view dashboard')
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('admin') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-home w-4"></i>
            <span>Dashboard</span>
        </a>
        @endcan

        {{-- Category Dropdown --}}

        @php
        $categoryActive = request()->is('admin/categories*') || request()->is('admin/subcategories*') || request()->is('admin/subsubcategories*');
        @endphp

        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $categoryActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-box w-4"></i> Category</span>
                <i class="fas fa-chevron-down transition-transform {{ $categoryActive ? 'rotate-180' : '' }}"></i>
            </button>
            <div class="dropdown-menu {{ $categoryActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/categories*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-list w-3"></i> Category
                </a>
                <a href="{{ route('admin.subcategories.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/subcategories*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-layer-group w-3"></i> Sub Category
                </a>
                <a href="{{ route('admin.subsubcategories.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/subsubcategories*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-layer-group w-3"></i> Sub Sub Category
                </a>
            </div>
        </div>

        {{-- Products Dropdown --}}
        @php
        $productActive = request()->is('admin/products*') || request()->is('admin/brands*') || request()->is('admin/colors*') || request()->is('admin/sizes*');
        @endphp
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $productActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-box w-4"></i> Products</span>
                <i class="fas fa-chevron-down transition-transform {{ $productActive ? 'rotate-180' : '' }}"></i>
            </button>
            <div class="dropdown-menu {{ $productActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/products*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-boxes w-3"></i> All Products
                </a>
                <a href="{{ route('admin.products.create') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/products*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-plus w-3"></i> Add Product
                </a>
                <a href="{{ route('admin.brands.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/brands*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-copyright w-3"></i> Brand
                </a>
                <a href="{{ route('admin.colors.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/colors*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-palette w-3"></i> Color
                </a>
                <a href="{{ route('admin.sizes.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/sizes*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-ruler w-3"></i> Size
                </a>
            </div>
        </div>

        {{-- Orders Dropdown --}}
        @php
        $orderActive = request()->is('admin/all-orders*') || request()->is('admin/pending-orders*') || request()->is('admin/processing-orders*') || request()->is('admin/on-the-way*') || request()->is('admin/hold-orders*') || request()->is('admin/courier-orders*') || request()->is('admin/complete-orders*') || request()->is('admin/cancelled-orders*') || request()->is('admin/orders*');
        @endphp
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $orderActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-shopping-cart w-4"></i> Orders</span>
                <i class="fas fa-chevron-down transition-transform {{ $orderActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $orderActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                <a href="{{ route('admin.all-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/all-orders*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-list w-3"></i> All Orders
                </a>

                <a href="{{ route('admin.pending-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-hourglass-start w-3 text-orange-400"></i> Pending
                </a>

                <a href="{{ route('admin.processing-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-spinner w-3 text-blue-400"></i> Processing
                </a>

                <a href="{{ route('admin.on-the-way-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-truck w-3 text-indigo-400"></i> On The Way
                </a>

                <a href="{{ route('admin.hold-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-pause-circle w-3 text-yellow-500"></i> On Hold
                </a>

                <a href="{{ route('admin.courier-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-shipping-fast w-3 text-teal-400"></i> Courier
                </a>

                <a href="{{ route('admin.complete-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-check-circle w-3 text-green-500"></i> Completed
                </a>

                <a href="{{ route('admin.cancelled-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-times-circle w-3 text-red-500"></i> Cancelled
                </a>
            </div>
        </div>



        {{-- Website Dropdown --}}
        @php
        $websiteActive = request()->is('admin/coupons*') || request()->is('admin/smtp*') || request()->is('admin/pixel*') || request()->is('admin/courier*') || request()->is('admin/marketing*') || request()->is('admin/payment*') || request()->is('admin/settings*') || request()->is('admin/bannars*');
        @endphp
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $websiteActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-globe w-4"></i> Website</span>
                <i class="fas fa-chevron-down transition-transform {{ $websiteActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $websiteActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                <a href="{{ route('admin.coupons.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-ticket-alt w-3"></i> Coupon
                </a>

                <a href="{{ route('admin.smtp.edit',1) }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-envelope w-3"></i> SMTP
                </a>

                {{--<a href="{{ route('admin.pixel.edit',1) }}"
                class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                <i class="fas fa-bullseye w-3"></i> Pixels
                </a>--}}

                <a href="{{ route('admin.courier.setup') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-shipping-fast w-3"></i> Courier
                </a>

                <a href="{{ route('admin.marketing.setup') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-bullhorn w-4"></i> Marketing
                </a>


                <a href="{{ route('admin.payment.setup') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-credit-card w-3"></i> Payment Method
                </a>

                <a href="{{ route('admin.bannars.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-images w-3"></i> Banners
                </a>

                @can('view setting')
                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('admin/settings*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-cog w-4"></i>
                    <span>Settings</span>
                </a>
                @endcan
            </div>
        </div>


        {{-- Affiliate  --}}

        @php
        $AffiliateActive = request()->is('admin/all-users*');
        @endphp

        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $AffiliateActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2">
                    <i class="fas fa-handshake w-4"></i> Affiliate
                </span>
                <i class="fas fa-chevron-down transition-transform {{ $AffiliateActive ? 'rotate-180' : '' }}"></i>
            </button>



            <div class="dropdown-menu {{ $AffiliateActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                <a href="{{ route('admin.product-commission.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/product-commission*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-user-tie w-3"></i> Affiliate Configuration
                </a>

                <a href="{{ route('admin.all-users.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/all-users*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-user-tie w-3"></i>Affiliate Users
                </a>

                <a href="{{ route('admin.marketer-withdraw.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/marketer-withdraw*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-user-tie w-3"></i>Withdraw Request
                </a>


            </div>
        </div>



        {{-- Sellers --}}
        @php
        $VendorActive = request()->is('admin/all-sellers*')|| request()->is('admin/vendor-product*')|| request()->is('admin/vendor-order*');
        @endphp

        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $VendorActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2">
                    <i class="fas fa-store w-4"></i> Seller System
                </span>
                <i class="fas fa-chevron-down transition-transform {{ $VendorActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $VendorActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                <a href="{{ route('admin.all-sellers.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/all-sellers*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-store-alt w-3"></i> Sellers
                </a>

            </div>
        </div>





        {{-- User Management --}}
        @can(['view role','view user'])
        @php
        $userActive = request()->is('admin/users*') || request()->is('admin/roles*');
        @endphp
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $userActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-users w-4"></i> User Management</span>
                <i class="fas fa-chevron-down transition-transform {{ $userActive ? 'rotate-180' : '' }}"></i>
            </button>
            <div class="dropdown-menu {{ $userActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/users*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-user w-3"></i> Users
                </a>
                <a href="{{ route('admin.roles.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/roles*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-user-shield w-3"></i> Roles
                </a>
            </div>
        </div>
        @endcan



    </nav>
</aside>
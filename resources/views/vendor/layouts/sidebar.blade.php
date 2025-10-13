<aside id="sidebar"
    class="bg-gray-900 text-white flex flex-col fixed h-full w-64 sidebar-transition z-40 
           -translate-x-full md:translate-x-0">

    <!-- Logo / Title -->
    <div class="p-4 flex items-center justify-between border-b border-gray-700">
        <span class="text-xl font-bold">{{ Auth::guard('vendor')->user()->name ?? 'Admin' }}</span>
        <button id="closeSidebar" class="md:hidden text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-2 space-y-2 overflow-y-auto">

        
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('dashboard') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-home w-4"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('vendor.products.index') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('vendor/products*') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-box-open w-3"></i> Product
        </a>

        <a href="{{ route('vendor.products.commissions') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('vendor/product/commissions') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-box-open w-3"></i> Product Commissions
        </a>

         {{-- Orders Dropdown --}}
        @php
        $orderActive = request()->is('vendor/all-orders*') || request()->is('vendor/pending-orders*') || request()->is('vendor/processing-orders*') || request()->is('vendor/on-the-way*') || request()->is('vendor/hold-orders*') || request()->is('vendor/courier-orders*') || request()->is('vendor/complete-orders*') || request()->is('vendor/cancelled-orders*') || request()->is('vendor/orders*');
        @endphp
        <div class="dropdown">
            <button
                class="dropdown-btn flex justify-between items-center w-full p-2 rounded hover:bg-gray-700 focus:outline-none {{ $orderActive ? 'bg-gray-700 font-semibold' : '' }}">
                <span class="flex items-center gap-2"><i class="fas fa-shopping-cart w-4"></i> Orders</span>
                <i class="fas fa-chevron-down transition-transform {{ $orderActive ? 'rotate-180' : '' }}"></i>
            </button>

            <div class="dropdown-menu {{ $orderActive ? 'block' : 'hidden' }} ml-4 mt-1 space-y-1">
                <a href="{{ route('vendor.all-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('vendor/all-orders*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-list w-3"></i> All Orders
                </a>

                <a href="{{ route('vendor.pending-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-hourglass-start w-3 text-orange-400"></i> Pending
                </a>

                <a href="{{ route('vendor.processing-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-spinner w-3 text-blue-400"></i> Processing
                </a>

                <a href="{{ route('vendor.on-the-way-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-truck w-3 text-indigo-400"></i> On The Way
                </a>

                <a href="{{ route('vendor.hold-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-pause-circle w-3 text-yellow-500"></i> On Hold
                </a>

                <a href="{{ route('vendor.courier-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-shipping-fast w-3 text-teal-400"></i> Courier
                </a>

                <a href="{{ route('vendor.complete-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-check-circle w-3 text-green-500"></i> Completed
                </a>

                <a href="{{ route('vendor.cancelled-orders') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm">
                    <i class="fas fa-times-circle w-3 text-red-500"></i> Cancelled
                </a>
            </div>
        </div>
       


    </nav>
</aside>
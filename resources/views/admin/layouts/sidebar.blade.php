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

        {{-- Products Dropdown --}}
        @php
            $productActive = request()->is('admin/products*') || request()->is('admin/categories*');
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
                    <i class="fas fa-list w-3"></i> All Products
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-sm {{ request()->is('admin/categories*') ? 'bg-gray-700 font-semibold' : '' }}">
                    <i class="fas fa-tags w-3"></i> Categories
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

        {{-- Settings --}}
        @can('view setting')
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('admin/settings*') ? 'bg-gray-700 font-semibold' : '' }}">
                <i class="fas fa-cog w-4"></i>
                <span>Settings</span>
            </a>
        @endcan

    </nav>
</aside>

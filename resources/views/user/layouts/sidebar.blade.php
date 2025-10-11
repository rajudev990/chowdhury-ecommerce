<aside id="sidebar"
    class="bg-gray-900 text-white flex flex-col fixed h-full w-64 sidebar-transition z-40 
           -translate-x-full md:translate-x-0">

    <!-- Logo / Title -->
    <div class="p-4 flex items-center justify-between border-b border-gray-700">
        <span class="text-xl font-bold">{{ Auth::guard('web')->user()->name ?? 'Admin' }}</span>
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

        <a href="{{ route('wishlist.index') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('wishlist.index') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-heart w-4"></i>
            <span>Wishlist</span>
        </a>

         <a href="{{ route('order.index') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->routeIs('order.index') ? 'bg-gray-700 font-semibold text-white' : '' }}">
            <i class="fas fa-receipt w-4"></i>
            <span>Orders</span>
        </a>



       


    </nav>
</aside>
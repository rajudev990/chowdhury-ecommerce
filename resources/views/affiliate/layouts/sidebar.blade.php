<aside id="sidebar"
    class="bg-gray-900 text-white flex flex-col fixed h-full w-64 sidebar-transition z-40 
           -translate-x-full md:translate-x-0">

    <!-- Logo / Title -->
    <div class="p-4 flex items-center justify-between border-b border-gray-700">
        <span class="text-xl font-bold">{{ Auth::guard('affiliate')->user()->name ?? 'Admin' }}</span>
        <button id="closeSidebar" class="md:hidden text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-2 space-y-2 overflow-y-auto">

        
        <a href="{{ route('affiliate.dashboard') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('affiliate.dashboard') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-home w-4"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('affiliate.offers') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('affiliate.offers') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-home w-4"></i>
            <span>My Offers</span>
        </a>
        
        <a href="{{ route('affiliate.earnings') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('affiliate.earnings') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-home w-4"></i>
            <span>My Earnings</span>
        </a>
        
        <a href="{{ route('affiliate.withdraw') }}"
            class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->is('affiliate.withdraw') ? 'bg-gray-700 font-semibold' : '' }}">
            <i class="fas fa-home w-4"></i>
            <span>Withdraw</span>
        </a>
       


    </nav>
</aside>
<nav id="sidebar">
    <div class="p-3 text-center border-bottom fw-bold">{{ Auth::guard('vendor')->user()->name ?? 'vendor' }}</div>

    <ul class="nav flex-column mt-3">

        {{-- Dashboard --}}

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}" href="{{ route('vendor.dashboard') }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.products.index') ? 'active' : '' }}" href="{{ route('vendor.products.index') }}">
                <i class="fas fa-percent w-3"></i> Product
            </a>
        </li>


         <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.products.commissions') ? 'active' : '' }}" href="{{ route('vendor.products.commissions') }}">
               <i class="fas fa-cogs w-3"></i> Commissions
            </a>
        </li>

         <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.revenue') ? 'active' : '' }}" href="{{ route('vendor.revenue') }}">
                <i class="fas fa-dollar-sign w-3"></i> Revenue
            </a>
        </li>

         <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.withdrawal') ? 'active' : '' }}" href="{{ route('vendor.withdrawal') }}">
              <i class="fas fa-money-check w-4 h-4"></i> Withdrawal
            </a>
        </li>

        @php
        $orderActive = request()->is('vendor/all-orders*') || request()->is('vendor/pending-orders*') || request()->is('vendor/processing-orders*') || request()->is('vendor/on-the-way*') || request()->is('vendor/hold-orders') || request()->is('vendor/courier-orders*') || request()->is('vendor/complete-orders*') || request()->is('vendor/cancelled-orders*');
        @endphp
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $orderActive ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#orderMenu" role="button" aria-expanded="{{ $orderActive ? 'true' : 'false' }}">
                <div><i class="fas fa-shopping-cart me-2"></i> Orders</div>
                <i class="fas fa-chevron-right rotate"></i>
            </a>
            <div class="collapse {{ $orderActive ? 'show' : '' }}" id="orderMenu">
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link {{ request()->is('vendor/all-orders*') ? 'active' : '' }}" href="{{ route('vendor.all-orders') }}">All Orders</a></li>
        
                    <li><a class="nav-link {{ request()->is('vendor/pending-orders*') ? 'active' : '' }}" href="{{ route('vendor.pending-orders') }}">Pending</a></li>
        
                    <li><a class="nav-link {{ request()->is('vendor/processing-orders*') ? 'active' : '' }}" href="{{ route('vendor.processing-orders') }}">Processing</a></li>
        
                    <li><a class="nav-link {{ request()->is('vendor/on-the-way*') ? 'active' : '' }}" href="{{ route('vendor.on-the-way-orders') }}">On The Way</a></li>
        
                    {{--<li><a class="nav-link {{ request()->is('vendor/hold-orders') ? 'active' : '' }}" href="{{ route('vendor/hold-orders') }}">On Hold</a></li>--}}
        
                    <li><a class="nav-link {{ request()->is('vendor/courier-orders*') ? 'active' : '' }}" href="{{ route('vendor.courier-orders') }}">Courier</a></li>
        
                    <li><a class="nav-link {{ request()->is('vendor/complete-orders*') ? 'active' : '' }}" href="{{ route('vendor.complete-orders') }}">Completed</a></li>
        
                    <li><a class="nav-link {{ request()->is('vendor/cancelled-orders*') ? 'active' : '' }}" href="{{ route('vendor.cancelled-orders') }}">Cancelled</a></li>
        
                </ul>
            </div>
        </li>

    </ul>
</nav>
@php

$setting = \App\Models\Setting::first();
@endphp
@php
    use App\Models\Wishlist;
    $wishlistCount = 0;

    if (auth()->check()) {
        $wishlistCount = Wishlist::where('user_id', auth()->id())->count();
    }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard')</title>
    <link rel="icon" href="{{ Storage::url($setting->favicon) }}" type="image/x-icon">
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        /* Sidebar scrollbar styling */
        nav::-webkit-scrollbar {
            width: 6px;
        }

        nav::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-transition {
            transition: all 0.3s ease;
        }
    </style>
    @yield('styles')
</head>


<body class="bg-gray-100">

    <div class="flex h-screen relative">

        <!-- Mobile Overlay -->
        <div id="mobileOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

        <!-- Sidebar -->
        @include('user.layouts.sidebar')

        <!-- Main Content -->
        <div id="mainContent" class="flex-1 flex flex-col transition-all duration-300 md:ml-64">

            <!-- Topbar -->
            <header class="bg-white shadow flex items-center justify-between px-4 py-2">
    <!-- Left Section -->
    <div class="flex items-center space-x-2">
        <!-- Mobile toggle -->
        <button id="mobileToggle" class="md:hidden text-gray-700 text-2xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Desktop toggle -->
        <button id="sidebarToggle" class="hidden md:inline-flex text-gray-700 text-xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Right Section -->
    <div class="flex items-center space-x-4">

         <!-- Browser / Home Icon -->
       <div class="cursor-pointer hover:bg-gray-100 p-1 rounded transition duration-200" 
            onclick="window.location.href='{{ url('/') }}'" 
            title="Go to Home">
            <img src="https://img.icons8.com/ios-filled/24/1e40af/home.png" 
                class="w-6 h-6" 
                alt="Home" />
        </div>

        <!-- Wishlist Icon -->
        <div onclick="goToWishlist()" class="relative cursor-pointer">
            <img src="https://img.icons8.com/ios-filled/24/fa314a/like.png" class="w-6 h-6" />
            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center wishlist-count">
                {{ $wishlistCount ?? 0 }}
            </span>
        </div>

        <!-- Cart Icon -->
        <div onclick="checkOut()" class="relative cursor-pointer">
            <img src="https://img.icons8.com/ios-filled/24/1e40af/shopping-cart.png" class="w-6 h-6" />
            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center cart">
                0
            </span>
        </div>

        <!-- Profile Dropdown -->
        <div class="relative">
            <button id="profileBtn" class="flex items-center space-x-2 focus:outline-none">
                @if(Auth::guard('web')->user()->image)
                <img class="w-8 h-8 rounded-full border-2 border-gray-300" src="{{ Storage::url(Auth::guard('web')->user()->image) }}" alt="Profile">
                @else
                <img class="w-8 h-8 rounded-full border-2 border-gray-300" src="https://i.pravatar.cc/40" alt="Profile">
                @endif
                <span class="hidden md:block font-medium text-gray-700">{{ Auth::guard('web')->user()->name ?? 'Admin' }}</span>
                <i class="fas fa-chevron-down text-gray-600"></i>
            </button>

            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden z-50">
                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">Profile</a>
                <a href="{{ route('user.password.edit') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">Change Password</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>


            <!-- Main Content -->
            <main class="flex-1">
                @yield('content')
            </main>

        </div>
    </div>

    <!-- ========== jQuery Script ========== -->
    <script>
        $(document).ready(function() {
            const sidebar = $('#sidebar');
            const mainContent = $('#mainContent');
            const mobileOverlay = $('#mobileOverlay');

            // Sidebar toggle (Desktop)
            $('#sidebarToggle').on('click', function() {
                if (sidebar.width() > 0) {
                    sidebar.width(0).addClass('overflow-hidden');
                    mainContent.removeClass('md:ml-64').addClass('md:ml-0');
                } else {
                    sidebar.width(256).removeClass('overflow-hidden');
                    mainContent.removeClass('md:ml-0').addClass('md:ml-64');
                }
            });

            // Mobile Sidebar
            $('#mobileToggle').on('click', function() {
                sidebar.css('transform', 'translateX(0)');
                mobileOverlay.removeClass('hidden');
            });

            $('#closeSidebar, #mobileOverlay').on('click', function() {
                sidebar.css('transform', 'translateX(-100%)');
                mobileOverlay.addClass('hidden');
            });

            // Dropdown toggle
            $('.dropdown-btn').on('click', function() {
                const menu = $(this).next('.dropdown-menu');
                menu.slideToggle(200);
                $(this).find('i').toggleClass('rotate-180');
            });

            // Profile dropdown
            $('#profileBtn').on('click', function(e) {
                e.stopPropagation();
                $('#profileDropdown').toggle();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#profileDropdown, #profileBtn').length) {
                    $('#profileDropdown').hide();
                }
            });
        });
    </script>


    @if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @endif
    @if(session('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @endif
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                var itemId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this item?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + itemId).submit();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Not Deleted!',
                            text: 'You have cancelled the deletion.'
                        });
                    }
                });


            });
        });
    </script>

    <script>
        $(document).on('click', '.add-to-wishlist', function(e) {
            e.preventDefault(); // prevent default link behavior

            let icon = $(this);
            let productId = icon.data('id');

            $.ajax({
                url: "{{ route('wishlist.store') }}",
                method: "POST",
                data: {
                    product_id: productId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.status === 'error') {
                        toastr.warning(res.message); // ⚠️ লগইন না থাকলে warning
                        return;
                    }

                    if (res.status === 'added') {
                        toastr.success(res.message); // ✅ Added
                    } 
                    else if (res.status === 'removed') {
                        toastr.info(res.message); // ℹ️ Removed
                    }

                    // 🔁 Reload the page after wishlist update
                    setTimeout(function() {
                        location.reload();
                    }, 100); // 0.5s delay so toastr shows briefly
                },
                error: function() {
                    toastr.error('Please login to add to wishlist.');
                }
            });
        });

        // ✅ Toastr settings
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "2000"
        }
        </script>
        <script>
        function goToWishlist() {
            @if(auth()->guard('web')->check())
            window.location.href = "{{ route('wishlist.index') }}";
            @else
            toastr.warning('Please login to view your wishlist.');
            @endif
        }

        // Toastr settings
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        }
    </script>
    <script>
        function checkOut()
        {
            window.location.href = "{{ route('checkout') }}";
        }
    </script>



    @yield('scripts')
</body>
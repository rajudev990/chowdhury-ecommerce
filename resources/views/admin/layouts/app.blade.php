@php

$setting = \App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="icon" href="{{ Storage::url($setting->favicon) }}" type="image/x-icon">


    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        /* Print */
        /* Hide everything except invoice section when printing */
        @media print {
            body * {
                visibility: hidden;
            }
            #printSection, #printSection * {
                visibility: visible;
            }
            #printSection {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            /* Hide print button */
            #printBtn {
                display: none !important;
            }
        }
    </style>
    @yield('styles')
</head>


<body class="bg-gray-100">

    <div class="flex h-screen relative">

        <!-- Mobile Overlay -->
        <div id="mobileOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div id="mainContent" class="flex-1 flex flex-col transition-all duration-300 md:ml-64">

            <!-- Topbar -->
            <header class="bg-white shadow flex items-center justify-between px-4 py-2">
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


                <!-- Profile Dropdown -->
                <div class="relative">
                    <button id="profileBtn" class="flex items-center space-x-2 focus:outline-none">
                        @if(Auth::guard('admin')->user()->image)
                        <img class="w-8 h-8 rounded-full border-2 border-gray-300" src="{{ Storage::url(Auth::guard('admin')->user()->image) }}" alt="Profile">
                        @else
                        <img class="w-8 h-8 rounded-full border-2 border-gray-300" src="https://i.pravatar.cc/40" alt="Profile">
                        @endif
                        <span class="hidden md:block font-medium">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden z-50">
                        <a href="{{ route('admin.profile.settings') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('admin.change.password') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">Change Password</a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
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
        document.getElementById('printBtn').addEventListener('click', function() {
            // Save original page content
            const originalContent = document.body.innerHTML;

            // Get only the invoice section
            const printSection = document.getElementById('printSection').cloneNode(true);

            // Replace body content with section content
            document.body.innerHTML = '';
            document.body.appendChild(printSection);

            // Remove select box styling and only show selected text
            const selects = document.querySelectorAll('select');
            selects.forEach(function(sel) {
                const span = document.createElement('span');
                span.textContent = sel.options[sel.selectedIndex].text;
                sel.parentNode.replaceChild(span, sel);
            });

            // Trigger print
            window.print();

            // Restore original content after print
            document.body.innerHTML = originalContent;

            // Reload JS scripts to make page functional again
            location.reload();
        });
        </script>


    @yield('script')
</body>
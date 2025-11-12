@php
$setting = \App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Admin Dashboard')</title>
    <link rel="icon" href="{{ Storage::url($setting->favicon) }}" type="image/x-icon">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f5f5f5;
        }

        /* Sidebar */
        /* #sidebar { width: 250px; min-height: 100vh; background-color: #212529; position: fixed; left: 0; top: 0; transition: all 0.3s; z-index:1040; color:#fff; } */
        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #212529;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1040;
            color: #fff;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        #sidebar.collapsed {
            left: -250px;
        }

        #mainContent {
            margin-left: 250px;
            transition: all 0.3s;
        }

        #mainContent.expanded {
            margin-left: 0;
        }

        .nav-link {
            color: #adb5bd;
            transition: 0.2s;
        }

        .nav-link:hover {
            color: #fff;
            background-color: #343a40;
        }

        .nav-link.active {
            color: #fff;
            background-color: #495057;
        }

        .collapse .nav-link {
            padding-left: 1.5rem;
            font-size: 0.9rem;
        }

        #mobileOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1035;
            display: none;
        }

        @media(max-width:768px) {
            #sidebar {
                left: -250px;
            }

            #sidebar.show {
                left: 0;
            }

            #mainContent {
                margin-left: 0;
            }
        }

        /* Rotate collapse arrow */
        .rotate {
            transition: transform 0.3s;
        }

        .rotate.show {
            transform: rotate(90deg);
        }

        .bg-purple {
            background: linear-gradient(to right, #6f42c1, #5a33a5);
        }

        .bg-indigo {
            background: linear-gradient(to right, #6610f2, #5b0fd1);
        }

        .bg-pink {
            background: linear-gradient(to right, #d63384, #c2185b);
        }

        .bg-teal {
            background: linear-gradient(to right, #20c997, #198754);
        }

        .bg-orange {
            background: linear-gradient(to right, #fd7e14, #f76700);
        }

        .bg-gradient-purple {
            background: linear-gradient(to right, #6f42c1, #5a33a5);
        }
    </style>
    @yield('style')
</head>

<body>

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Mobile Overlay -->
    <div id="mobileOverlay"></div>

    <!-- Main Content -->
    <div id="mainContent" class="flex-grow-1 d-flex flex-column">

        <!-- Topbar -->
        <header class="bg-white shadow-sm py-2 px-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <button id="sidebarToggle" class="btn btn-outline-secondary"><i class="fas fa-bars"></i></button>
            </div>

            <div class="d-flex align-items-center gap-3">
                <form method="POST" action="{{ route('admin.currency.update') }}">
                    @csrf
                    <select name="currency" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="৳" {{ $setting->currency == '৳' ? 'selected' : '' }}>BDT (৳)</option>
                        <option value="$" {{ $setting->currency == '$' ? 'selected' : '' }}>USD ($)</option>
                    </select>
                </form>

                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle" src="{{ Auth::guard('admin')->user()->image ? Storage::url(Auth::guard('admin')->user()->image) : 'https://i.pravatar.cc/40' }}" width="30" height="30" alt="Profile">
                        <span class="d-none d-md-inline fw-medium text-dark">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.settings') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.change.password') }}">Change Password</a></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow-1 p-3">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
    @endif


    <script>
        $(document).ready(function() {
            const sidebar = $('#sidebar'),
                overlay = $('#mobileOverlay'),
                main = $('#mainContent');

            $('#sidebarToggle').click(function() {
                if ($(window).width() < 768) {
                    sidebar.toggleClass('show');
                    overlay.toggle();
                } else {
                    sidebar.toggleClass('collapsed');
                    main.toggleClass('expanded');
                }
            });

            overlay.click(function() {
                sidebar.removeClass('show');
                overlay.hide();
            });

            // Rotate arrow for collapse
            document.querySelectorAll('.collapse').forEach(function(collapseEl) {
                collapseEl.addEventListener('show.bs.collapse', function() {
                    this.previousElementSibling.querySelector('.rotate').classList.add('show');
                });
                collapseEl.addEventListener('hide.bs.collapse', function() {
                    this.previousElementSibling.querySelector('.rotate').classList.remove('show');
                });
            });
        });
    </script>
    @yield('script')
</body>

</html>
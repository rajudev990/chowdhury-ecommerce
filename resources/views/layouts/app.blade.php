<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
</head>

<body>

    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')


    <a href="https://wa.me/8801729-345196" target="_blank" class="whatsapp-float text-decoration-none">
        <i class="fab fa-whatsapp"></i>
    </a>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
    <script>
        function toggleCart() {
            document.getElementById("cartSidebar").classList.toggle("active");
        }
    </script>
    <script>
        function removeCartItem(icon) {
            icon.closest(".cart-item").remove();
        }
    </script>


</body>

</html>
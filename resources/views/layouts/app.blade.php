<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('css')
</head>

<body>
    @include('layouts.header')
    <main class="main">
    @yield('content')

    </main>
    @include('layouts.footer')

    @yield('js')
</body>

</html>
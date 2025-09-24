<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Finance Manager')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-white">
    @include('partials.navbar')

    <!--Main Content-->
    <div class="container py-4">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
    </div>
</body>
</html>

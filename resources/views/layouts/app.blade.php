<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Finance Manager')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand font-bold" href="{{ url('/dashboard') }}">Finance Manager</a>
            <div>
                <a class="nav-link text-white" href="{{ route('transactions.index') }}">Transaksi</a>
                @if(session('user'))
                    <span class="text-white me-3">Hi, {{ session('user')->name }}</span>
                    <a class="btn btn-sm btn-light" href="{{ route('logout') }}">Logout</a>
                @else
                    <a class="btn btn-sm btn-light" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-sm btn-warning" href="{{ route('register') }}">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @include('partials.flash')
        @yield('content')
    </main>
</body>
</html>

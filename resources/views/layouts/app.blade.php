<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Finance Manager')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #FF6600;">
        <div class="container">
            <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold">Finance Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('transactions.index') }}" class="nav-link">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link text-danger">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--Main Content-->
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ implode(',', $errors->all()) }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>

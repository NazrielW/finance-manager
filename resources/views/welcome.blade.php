<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome | Finance Manager</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-light">
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <div class="container text-center py-5">
        <h1 class="fw-bold mb-3">Welcome to the Finance Manager Application</h1>
        <p class="lead mb-4">
            This is the welcome page. Please log in to access your dashboard and manage your finances.
        </p>
        <h4 class="mb-4">Don't forget to join us!</h4>

        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4">Register</a>
            </li>
        </ul>
    </div>
</body>
</html>

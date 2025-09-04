<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Finance Manager')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-light">
    @include('partials.navbar')

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome | Finance Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <div class="parallax-sect">
        <img src="" alt="">
    </div>

    <div class="container text-center py-5">
        <h1 class="fw-bold mb-3">Welcome to the Finance Manager Application</h1>
        <p class="lead mb-4">
            This is the welcome page. Please log in to access your dashboard and manage your finances.
        </p>
        <h4 class="mb-4">Don't forget to join us!</h4>

        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="{{ route('login') }}" class="btn-custom px-4">Login</a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('register') }}" class="btn-custom-secondary px-4">Register</a>
            </li>
        </ul>
    </div>

    <div class="cont">
        <div id="about" class="my-5 p-5 text-1xl text-start">
            <h2 class="fw-bold mb-3">About Finance Manager</h2>
            <p class="mb-4">
                Finance Manager is a web application designed to help you manage your personal finances effectively.
                Track your
                income, expenses, and savings all in one place. Our goal is to provide you with the tools you need to
                make informed financial decisions and achieve your financial goals.
            </p>
            <p>Whether you're looking to budget better, save for a big purchase, or simply keep an eye on your spending,
                Finance Manager has you covered.</p>
        </div>
    </div>

    <div class="cont">
        <div id="contact" class="my-5 p-5 text-1xl text-start">
            <h2 class="fw-bold mb-3">Contact Us</h2>
            <p class="mb-4">
                If you have any questions, feedback, or need assistance, please don't hesitate to reach out to us.
                We're here to help you make the most of your experience with Finance Manager.
            </p>
            <p>You can contact us via email at <a href="mailto:ikan">ikan</a> or call us at (123) 456-7890. We look forward to hearing from you!</p>
        </div>
    </div>
    

    @include('partials.footer')
</body>

</html>

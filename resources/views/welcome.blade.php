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

    <div class="rounded-start-1">
        <div class="text-center py-1 content-wrapper">
            <h1 class="fw-bold ">Welcome to The Finance Manager Web!</h1>
            <h2 class="lead fw-bold">Your personal finance management solution.</h2>
            <p class="text-md" id="about">What is Finance Manager?</p>
            <p class="text-md">Finance Manager is a web application designed to help you manage your personal finances
                effectively.
                Track your income, expenses, and savings all in one place. Our goal is to provide you with the tools you
                need to make informed financial decisions and achieve your financial goals.</p>
            <p class="text-md">Whether you're looking to budget better, save for a big purchase, or simply keep an eye
                on
                your spending, Finance Manager has you covered.</p>
        </div>
    </div>

    <div class="text-center">
        <div class="row justify-content-center">
            <div class="col-sm-5 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body pb-5 pt-4">
                        <h5 class="card-title">Join Us!</h5>
                        <p class="card-text">Come make some account, here you can manage your personal finances
                            effectively.Track your income, expenses, and savings all in one place.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title">Come Join Again</h5>
                        <p class="card-text">You can visit me again, whenever you want</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="my-5 p-5 text-1xl text-start content-wrapper">
        <h2 class="fw-bold mb-3">Contact Us</h2>
        <p class="mb-4">
            If you have any questions, feedback, or need assistance, please don't hesitate to reach out to us.
            We're here to help you make the most of your experience with Finance Manager.
        </p>
        <p>You can contact us via email at <a href="mailto:ikan">ikan</a> or call us at +64 1234 1234 2134. We look
            forward to hearing from you!</p>
    </div>


    @include('partials.footer')
</body>

</html>

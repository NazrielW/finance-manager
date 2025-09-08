<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #ff6600;">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold">Finance Manager</a>

        @if (!session()->has('user'))
        <div class="btn-group" role="group">
            <a href="{{ route('login') }}" class="btn-custom group">Login</a>
            <a href="{{ route('register') }}" class="btn-custom group">Register</a>
            <a href="#about" class="btn-custom group">About</a>
            <a href="#contact" class="btn-custom group">Contact</a>
        </div>
        @endif

        @if (session()->has('user')) 
        <div class="dropdown">
            <button class="btn-custom dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-hitem" href="{{ route('transactions.index') }}">Transaction</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-hitem text-danger">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        @endif
    </div>
</nav>
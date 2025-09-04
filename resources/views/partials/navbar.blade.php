<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #FF6600;">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold">Finance Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (session()->has('user')) 
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('transactions.index') }}">Transaction</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        @endif
    </div>
</nav>
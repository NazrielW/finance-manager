<nav class="navbar bg-body-tertiary sticky-top navbar-custom">
    <div class="container-fluid">
        <a href="{{ route('dashboard') }}" class="navbar-brand">Finance Manager</a>
        @if (session()->has('user'))
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end bg-white" tabindex="1" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Finance Manager</h5>
                    
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="off-canvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 p-3">
                    <li class="nav-item">
                        <a href="{{ route('transactions.index') }}" class="nav-link active" aria-current="page">Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{  route('dashboard') }}" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item-dropdown">
                        <a href="" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a href="#about" class="dropdown-item">About</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="text-danger" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>
</nav>
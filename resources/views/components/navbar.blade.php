<nav class="py-2 bg-body-tertiary border-bottom">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="" class="nav-link link-body-emphasis px-2 active"
                    aria-current="page">Home</a></li>
            <li class="nav-item"><a href="" class="nav-link link-body-emphasis px-2">Features</a></li>
            <li class="nav-item"><a href="" class="nav-link link-body-emphasis px-2">Pricing</a></li>
        </ul>
        <ul class="nav">
            @auth
                {{-- User Logged In --}}
                <div class="flex-shrink-0 dropdown">
                    <a href="" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                            class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small shadow" style="">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="">Account Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            @endauth
            @guest
                {{-- User Not Logged In --}}
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link link-body-emphasis px-2">Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link link-body-emphasis px-2">Register</a></li>
            @endguest
        </ul>
    </div>
</nav>

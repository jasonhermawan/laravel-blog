<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark"
    style="width: 280px; height: 100vh; position:fixed; width: 300px">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
                class="nav-link {{ request()->route()->getName() === 'dashboard' ? 'active' : '' }} text-white"
                aria-current="page">
                Create
            </a>
        </li>
        <li>
            <a href="{{ route('dashboard.list') }}"
                class="nav-link {{ request()->route()->getName() === 'dashboard.list' || request()->route()->getName() === 'dashboard.edit' ? 'active' : '' }} text-white">
                My Blogs
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-flex gap-2 align-items-center">
                @if (Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar" width="32"
                        height="32" class="rounded-circle" style="object-fit: cover">
                @else
                    <div class="rounded-circle"
                        style="width: 32px; height: 32px; background-color: #adb5bd; color: #fff; display: flex; justify-content: center; align-items: center; text-transform: uppercase;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
                <strong>{{ Auth::user()->name }}</strong>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="{{ route('account') }}">Account Settings</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>
</div>

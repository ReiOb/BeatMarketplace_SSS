<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
    <div class="container">
        <!-- TITLE FOR THE APPLICATION -->
        <a class="navbar-brand fw-bold" href="{{ route('beats.index') }}">
            Beat Marketplace
        </a>

        <!-- Toggler for mobile and tablets / responsive view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links / buttons for different pages -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-2">
                <!-- Beats -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('beats.index') ? 'active' : '' }}" 
                       href="{{ route('beats.index') }}">
                        Beats
                    </a>
                </li>

                <!-- About -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" 
                       href="{{ route('about') }}">
                        About
                    </a>
                </li>

                <!-- Social -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('social') ? 'active' : '' }}" 
                       href="{{ route('social') }}">
                        Social
                    </a>
                </li>

                @auth
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <!-- Admin Panel (only for admins) -->
                    @if(auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" 
                               href="{{ route('admin.users.index') }}">
                                <i class="bi bi-shield-lock"></i> Admin Panel
                            </a>
                        </li>
                    @endif

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <span class="dropdown-header">{{ Auth::user()->email }}</span>
                            </li>
                            @if(auth()->user()->is_admin)
                                <li>
                                    <span class="dropdown-header text-warning">
                                        <i class="bi bi-shield-check"></i> Administrator
                                    </span>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.show', Auth::user()) }}">
                                    <i class="bi bi-person"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-gear"></i> Settings
                                </a>
                            </li>
                            @if(auth()->user()->is_admin)
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                        <i class="bi bi-shield-lock"></i> Manage Users
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Login/Register (GUEST WITH NO ACCOUNT) -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ms-2" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

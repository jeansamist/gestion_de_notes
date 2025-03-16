<!-- resources/views/partials/navbar.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Gestion des notes</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>

                @auth
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('students') ? 'active' : '' }}" href="/students">Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('subjects') ? 'active' : '' }}" href="/subjects">Subjects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('teachers') ? 'active' : '' }}" href="/teachers">Teachers</a>
                        </li>
                    @endif

                    @if (Auth::user()->role === 'teacher')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('subjects') ? 'active' : '' }}" href="/subjects">Subjects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('students') ? 'active' : '' }}" href="/students">Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('subjects') ? 'active' : '' }}" href="/subjects">Subjects</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <span class="nav-link">Hi, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

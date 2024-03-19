
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary" data-bs-theme="dark"  >
    <div class="container">
        <a class="navbar-brand fw-light" href="/"><span class="fas fa-brain me-1"> </span>Ideas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="/profile">{{ $user->username }} | Profile</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="nav-link" type="submit">Logout</button>
                    </form>

                </li>
            @else
                <li class="nav-item">
                    @if (Route::currentRouteName() != 'login')
                    <a class="nav-link" href="/login">Login</a>
                    @endif

                </li>
                <li class="nav-item">
                    @if (Route::currentRouteName() != 'register')
                    <a class="nav-link" href="/register">Register</a>
                    @endif

                </li>
            @endauth
            </ul>
        </div>
    </div>
</nav>

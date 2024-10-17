<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fs-4" href="{{ route('dashboard') }}">StayWise</a>
            
            <!-- Toggle Button -->
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Sidebar -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <!-- Sidebar Header -->
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">StayWise</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!-- Sidebar Body -->
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item mx-2">
                            <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                        </li>
                        @auth
                        <li class="nav-item mx-2">
                            <a class="nav-link" aria-current="page" href="{{ route('dorm') }}">Dorms</a>
                        </li>
                        <!-- Display Create Post link if the user is an owner -->
                        @if (Auth::user()->role === 'owner')
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('post') }}">Create Post</a>
                        </li>
                        @endif
                        @if (Auth::user()->role === 'renter')
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Status</a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
            </div>

            <!-- Authenticated User Section -->
            @auth
            <div class="d-flex align-items-center">
                <!-- User Dropdown -->
                <div class="dropdown ms-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @else
            <!-- Guest Section -->
            <div class="d-flex align-items-center">
                <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white ms-3">
                    Register
                </a>
                @endif
            </div>
            @endauth
        </div>
    </div>
</nav>

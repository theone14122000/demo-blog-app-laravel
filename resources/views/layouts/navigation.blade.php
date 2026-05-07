<nav x-data="{ open: false }" class="bg-dark border-bottom">

    <div class="container d-flex justify-content-between align-items-center py-2">

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="text-white fw-bold text-decoration-none">
            Dashboard
        </a>

        <!-- Right Side -->
        <div class="d-flex align-items-center gap-3">

            <!-- Username -->
            <span class="text-white fw-semibold">
                {{ Auth::user()->name }}
            </span>

            <!-- Dropdown -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Menu
                </button>

                <ul class="dropdown-menu dropdown-menu-end bg-secondary">

                    <li>
                        <a class="dropdown-item text-white" href="{{ route('profile.show') }}">
                            Profile
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider bg-light">
                    </li>
                    <li>
                        <a href="{{ route('profile.show') }}">Profile</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        </div>
    </div>

</nav>
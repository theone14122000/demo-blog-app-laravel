<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-light">
    <style>

        .sidebar-logout-btn {
            background: transparent;
            transition: 0.3s;
            border-radius: 8px;
            padding: 10px;
        }

        .sidebar-logout-btn:hover {
            background: rgba(255,255,255,0.2);
            padding-left: 15px;
        }

    </style>
    <div class="d-flex min-vh-100">

        <!-- SIDEBAR -->
        @auth

            @if(auth()->user()->is_admin)

                <!-- ADMIN SIDEBAR -->
                <div class="bg-dark text-white p-3"
                    style="width:250px; min-height:100vh;">

                    <h4 class="mb-4">Admin Panel</h4>

                    <ul class="nav flex-column">

                        <li class="nav-item mb-2">
                            <a href="{{ route('dashboard') }}"class="nav-link text-white">
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('posts.index') }}"class="nav-link text-white">
                                Manage Posts
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('blog.index') }}"class="nav-link text-white">
                                Blog
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('profile.show') }}"class="nav-link text-white">
                                Profile
                            </a>
                        </li>

                    </ul>

                </div>

            @else

                <!-- USER SIDEBAR -->
                <div class="bg-primary text-white p-3"
                    style="width:250px; min-height:100vh;">

                    <h4 class="mb-4">User Panel</h4>

                    <ul class="nav flex-column">

                        <li class="nav-item mb-2">
                            <a href="{{ route('blog.index') }}"class="nav-link text-white sidebar-link">
                                Blog
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('profile.show') }}"class="nav-link text-white sidebar-link">
                                My Profile
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('posts.create') }}"class="nav-link text-white sidebar-link">
                                Create Post
                            </a>
                        </li>

                        <li class="nav-item mt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"class="btn w-100 text-start text-white border-0 sidebar-link">
                                    Logout
                                </button>
                            </form>

                        </li>

                    </ul>

                </div>

            @endif

        @endauth


        <!-- MAIN CONTENT -->
        <div class="flex-grow-1">

            <!-- TOP NAVIGATION -->
            @include('layouts.navigation')

            <!-- HEADER -->
            @isset($header)

                <header class="bg-white shadow-sm mb-4">

                    <div class="container py-3">
                        {{ $header }}
                    </div>

                </header>

            @endisset

            <!-- PAGE CONTENT -->
            <main class="container py-4">
                {{ $slot }}
            </main>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>

        .sidebar-link {
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 10px 15px;
        }

        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.2);
            padding-left: 22px;
            color: #fff !important;
        }

    </style>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
            background: #212529;
            position: sticky;
            top: 0;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }
        .sidebar a:hover {
            background: #343a40;
            color: white;
        }
        .sidebar .active {
            background: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>


<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar p-3" style="width: 220px;">

        <h4 class="text-white mb-4">Admin</h4>

        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @endif
        @endauth

        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('posts.index') }}">Posts</a>
            @endif
        @endauth
        <a href="{{ route('profile.show') }}">Profile</a>
        <a href="{{ route('blog.index') }}">View Blog</a>

        <hr class="text-secondary">
            
        
            
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger w-100">Logout</button>
        </form>

    </div>

    <!-- Content -->
    <div class="flex-grow-1 p-4">
        {{ $slot }}
    </div>
</div>

</body>
</html>
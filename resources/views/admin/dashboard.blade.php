<x-admin-layout>

<div class="container">

    <h2 class="mb-4 fw-bold">Dashboard</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 p-3 text-center">
                <h5>Total Posts</h5>
                <h2 class="fw-bold text-primary">{{ $postsCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 p-3 text-center">
                <h5>Total Users</h5>
                <h2 class="fw-bold text-success">{{ $usersCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 p-3 text-center">
                <h5>Total Likes</h5>
                <h2 class="fw-bold text-danger">{{ $likesCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 p-3 text-center">
                <h5>Total Comments</h5>
                <h2 class="fw-bold text-warning">{{ $commentsCount }}</h2>
            </div>
        </div>

    </div>

</div>

</x-admin-layout>
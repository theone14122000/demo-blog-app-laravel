<x-app-layout>

<!--user stats-->
<div class="container mt-4">

    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">

        <div class="d-flex align-items-center gap-4">

            <!-- PROFILE IMAGE -->
            @if($user->avatar)

                <img src="{{ asset('storage/' . $user->avatar) }}"
                     width="120"
                     height="120"
                     class="rounded-circle"
                     style="object-fit:cover;">

            @else

                <img src="https://via.placeholder.com/120"
                     class="rounded-circle">

            @endif

            <!-- USER INFO -->
            <div>

                <h2 class="fw-bold mb-1">
                    {{ $user->name }}
                </h2>

                <p class="text-muted mb-1">
                    {{ $user->email }}
                </p>

                <p class="mt-3">
                    {{ $user->bio ?? 'No bio added yet.' }}
                </p>

                <a href="{{ route('profile.edit') }}"class="btn btn-primary btn-sm">
                    Edit Profile
                </a>

            </div>

        </div>

    </div>

<div class="container mt-4">

    <h2 class="mb-4">My Profile</h2>

    <!-- User Info -->
    <div class="card mb-4 p-3 shadow-sm">
        <h4>{{ $user->name }}</h4>
        <p class="text-muted">{{ $user->email }}</p>
    </div>
<!-- Stats -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm rounded-4">
                <h6>Total Posts</h6>
                <h3>{{ $postsCount }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm rounded-4">
                <h6>Total Likes</h6>
                <h3>{{ $likesCount }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm rounded-4">
                <h6>Total Comments</h6>
                <h3>{{ $commentsCount }}</h3>
            </div>
        </div>

    </div>

    <!-- User Posts -->
    <h4 class="mb-3">My Posts</h4>

    <div class="row">

        @forelse($posts as $post)
            <div class="col-md-6 col-lg-4 mb-4">

                <div class="card h-100 shadow-sm rounded-4">

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                             class="card-img-top"
                             style="height:180px; object-fit:cover;">
                    @endif

                    <div class="card-body d-flex flex-column">

                        <h5>{{ $post->title }}</h5>

                        <p class="text-muted small flex-grow-1">
                            {{ \Illuminate\Support\Str::limit($post->content, 80) }}
                        </p>
                        <a href="{{ route('blog.show', $post->id) }}"
                           class="btn btn-sm btn-primary mt-auto">
                            View
                        </a>
                    </div>
                </div>
                
            </div>
        @empty
            <p>No posts yet.</p>
        @endforelse

         @if(auth()->user() && auth()->user()->is_admin)
                <a href="{{ route('posts.index') }}" class="btn btn-success mt-4">
                    ← Back to Admin
                </a>
            @else
                <a href="{{ route('blog.index') }}" class="btn btn-success mt-4">
                    ← Back to Blog
                </a>
            @endif
    </div>
    
</div>

</x-app-layout>
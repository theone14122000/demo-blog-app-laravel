
<x-admin-layout>

    <div class="container mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">All Posts</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary shadow-sm">
                + Create Post
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <!--  SEARCH BAR -->
        <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                    placeholder="Search posts..."
                    value="{{ request('search') }}">

                <button class="btn btn-primary">
                    Search
                </button>
            </div>
        </form>

        <!-- Posts -->
        <div class="row">

            @foreach($posts as $post)
                <div class="col-md-6 col-lg-3 mb-4">

                    <div class="card h-100 shadow-sm border-0 rounded-4">

                        <!-- Image -->
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}"
                                class="card-img-top rounded-top-4"
                                style="height:180px; object-fit:cover;">
                        @endif

                        <div class="card-body d-flex flex-column">

                            <!-- Title -->
                            <h5 class="fw-bold">
                                {{ $post->title }}
                            </h5>

                            <!-- Content -->
                            <p class="text-muted small flex-grow-1">
                                {{ \Illuminate\Support\Str::limit($post->content, 80) }}
                            </p>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-3">

                                <a href="{{ route('posts.edit', $post->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>

                            <!-- ✅ LIKE BUTTON (FIXED) -->
                            <button class="btn btn-sm btn-outline-danger like-btn" data-post="{{ $post->id }}">
                                 ❤️<span id="likes-count-{{ $post->id }}">
                                        {{ $post->likes->count() }}
                                    </span>
                            </button>

                            <!-- View -->
                            <a href="{{ route('blog.show', $post->id) }}" class="btn btn-sm btn-info mt-2">
                                View
                            </a>

                        </div>
                    </div>

                </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>

</x-admin-layout>
<script>
document.querySelectorAll('.like-btn').forEach(button => {

    button.addEventListener('click', async function () {

        let postId = this.dataset.post;

        let response = await fetch(`/like/${postId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        });

        let data = await response.json();

        document.getElementById(`likes-count-${postId}`)
            .innerText = data.likes_count;
    });

});
setTimeout(() => {

    let alert = document.getElementById('success-alert');

    if (alert) {

        alert.style.display = 'none';

    }

}, 3000);
</script>
<x-app-layout>

    <div class="container mt-4">

        <div class="card shadow-sm border-0 rounded-4 p-4">

            <!-- Image -->
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}"
                     class="img-fluid rounded mb-4"
                     style="max-height:400px; object-fit:cover;">
            @endif

            <!-- Title -->
            <h2 class="fw-bold mb-3">
                {{ $post->title }}
            </h2>

            <!-- Author -->
            <p class="text-muted">
                By: {{ $post->user->name ?? 'Unknown' }}
            </p>

            <!-- Content -->
            <p class="mt-3">
                {{ $post->content }}
            </p>

            <!-- Back Button -->
            @if(auth()->user() && auth()->user()->is_admin)
                <a href="{{ route('posts.index') }}" class="btn btn-success mt-4">
                    ← Back to Admin
                </a>
            @else
                <a href="{{ route('blog.index') }}" class="btn btn-success mt-4">
                    ← Back to Blog
                </a>
            @endif

            <hr class="my-4">
<!--<div style="background:red;color:white;padding:20px;">
    COMMENT FORM SHOULD BE HERE
</div>-->
            <!-- COMMENTS TITLE -->
            <h4 class="mb-3">Comments</h4>

            <!-- COMMENTS CONTAINER -->
            <div id="comments-container">

                @forelse($post->comments as $comment)

                    <div class="mb-3 p-3 border rounded">

                        <strong>
                            {{ $comment->user->name }}
                        </strong>

                        <p class="mb-0 mt-2">
                            {{ $comment->content }}
                        </p>

                        @if(auth()->id() == $comment->user_id)

                            <form method="POST"
                                  action="{{ route('comments.destroy', $comment->id) }}"
                                  class="mt-2">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>

                            </form>

                        @endif

                    </div>

                @empty

                    <p>No comments yet.</p>

                @endforelse

            </div>

            <!-- COMMENT FORM -->
            @auth

                <form id="comment-form" class="mt-4">

                    @csrf

                    <textarea
                        id="comment-content"
                        class="form-control"
                        placeholder="Write a comment..."
                        required
                    ></textarea>

                    <button class="btn btn-primary mt-2">
                        Add Comment
                    </button>

                </form>

            @endauth

        </div>

    </div>

</x-app-layout>

<script>

document.getElementById('comment-form')
.addEventListener('submit', async function(e) {

    e.preventDefault();

    let content =
        document.getElementById('comment-content').value;

    let response = await fetch("{{ route('comments.store') }}", {

        method: 'POST',

        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },

        body: JSON.stringify({
            post_id: {{ $post->id }},
            content: content
        })

    });

    let data = await response.json();

    document.getElementById('comments-container')
    .innerHTML += `

        <div class="mb-3 p-3 border rounded">

            <strong>
                ${data.comment.user.name}
            </strong>

            <p class="mb-0 mt-2">
                ${data.comment.content}
            </p>

        </div>

    `;

    document.getElementById('comment-content').value = '';

});

</script>
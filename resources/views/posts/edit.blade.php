<x-app-layout>
    <div class="container mt-4">

        <h1>Edit Post</h1>

        <form method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control">{{ $post->content }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
        </form>

    </div>
</x-app-layout>
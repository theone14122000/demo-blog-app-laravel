<x-app-layout>
    <div class="container mt-4">

        <h2>Edit Post</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
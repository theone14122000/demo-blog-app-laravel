<x-app-layout>
    <div class="container mt-4">

        <h1>Create Post</h1>
            <!-- Validation Errors -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control"></textarea>
            </div>
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            <button class="btn btn-success">Save</button>
        </form>

    </div>
</x-app-layout>
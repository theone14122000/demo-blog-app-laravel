<?php

namespace App\Http\Controllers;
use App\Http\Resources\SinglePostResource;
use App\Services\PostService;
use App\Http\Resources\PostResource;
use App\Http\Requests\StoreApiPostRequest;
use App\Http\Requests\UpdateApiPostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request; // for the search functionality
use App\Http\Requests\UpdatePostRequest; // for the update validation before we used Request
use App\Http\Requests\StorePostRequest;// for the store validation before we used Request

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(8);
        return view('posts.index', compact('posts'));

    }

    public function publicIndex(Request $request)
    {
        $query = \App\Models\Post::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest()->paginate(8)->withQueryString();

        return view('blog.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

//readmore buttons on the blog page
    public function show(Post $post)
{
    $post->load('user', 'comments.user');

    return view('blog.show', compact('post'));
}

//submit the create form data
    public function store(StorePostRequest $request, PostService $postService)
    {
        $postService->createPost($request);

        if (auth()->user()->is_admin) {

            return redirect()->route('posts.index')
                ->with('success', 'Post created successfully!');
        }

        return redirect()->route('blog.index')
            ->with('success', 'Post created successfully!');
    }
 
 // update the data
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully!');
    }

//delete the form data
    public function destroy(Post $post)
    {
        /*if (
            $post->user_id !== auth()->id()
            && !auth()->user()->is_admin
        ) {
            abort(403);
          }*/
        $this->authorize('delete', $post);    
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }

 


        public function dashboard()
        {
            return view('admin.dashboard', [
                'postsCount' => Post::count(),
                'usersCount' => User::count(),
                'likesCount' => Like::count(),
                'commentsCount' => Comment::count(),
            ]);
        }
        //edit the form data
        public function edit(Post $post)
        {
            $this->authorize('update', $post);
            return view('posts.edit', compact('post'));
        }

 //-------------------API-------------------------
  
        public function apiIndex(Request $request)
        {
            $query = Post::with('user')->latest();

            // Search
            if ($request->search) {
                $query->where('title', 'like', '%' . $request->search . '%');
            }

            $posts = $query->paginate(5);

            return PostResource::collection($posts);
        }

    public function apiShow(Post $post)
    {
        $post->load('user', 'comments.user');

        return new SinglePostResource($post);
    }


    public function apiStore(StoreApiPostRequest $request)
    {

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post
        ], 201);
    }


public function apiUpdate(UpdateApiPostRequest $request, Post $post)
{
    // Only owner can update
    if ($post->user_id !== auth()->id()) {

        return response()->json([
            'message' => 'Unauthorized'
        ], 403);
    }

    $post->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return response()->json([
        'message' => 'Post updated successfully',
        'post' => $post
    ]);
}

public function apiDestroy(Post $post)
{
    // Only owner can delete
    if ($post->user_id !== auth()->id()) {

        return response()->json([
            'message' => 'Unauthorized'
        ], 403);
    }

    $post->delete();

    return response()->json([
        'message' => 'Post deleted successfully'
    ]);
}

}   
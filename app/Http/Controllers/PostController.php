<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

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
    public function store(StorePostRequest $request)
    {

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        if (auth()->user()->is_admin) {

                return redirect()->route('posts.index')
                    ->with('success', 'Post created successfully!');

        }

            return redirect()->route('blog.index')
                ->with('success', 'Post created successfully!');
    }
 
 // update the data
    public function update(Request $request, Post $post)
    {
        if (
            $post->user_id !== auth()->id()
            && !auth()->user()->is_admin
        ) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully!');
    }

//delete the form data
    public function destroy(Post $post)
    {
        if (
            $post->user_id !== auth()->id()
            && !auth()->user()->is_admin
        ) {
            abort(403);
          }
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
            if (
                $post->user_id !== auth()->id()
                && !auth()->user()->is_admin
            ) {
                abort(403);
            }

            return view('posts.edit', compact('post'));
        }

 //-------------------API-------------------------
   /* public function apiIndex()
    {
        $posts = Post::with('user')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $posts
        ]);
    }
    public function apiIndex()
{
    return response()->json(['test' => 'working']);
}
public function apiIndex()
{
    return response()->json([
        'message' => 'API WORKING'
    ]);
}*/
    public function apiIndex()
    {
        $posts = \App\Models\Post::with('user')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $posts
        ]);
    }

    public function apiShow(Post $post)
    {
        $post->load('user', 'comments');

        return response()->json($post);
    }


    public function apiStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => 1,
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post
        ], 201);
    }


}   
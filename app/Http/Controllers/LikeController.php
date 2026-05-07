<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('post_id', $post->id)
            ->first();

        if ($like) {
            $like->delete();

            $liked = false;
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id,
            ]);

            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $post->likes()->count(),
        ]);
    }
    
}

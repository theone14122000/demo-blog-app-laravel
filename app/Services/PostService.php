<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function createPost($request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('posts', 'public');
        }

        return Post::create([

            'title' => $request->title,

            'content' => $request->content,

            'image' => $imagePath,

            'user_id' => auth()->id(),

        ]);
    }
}
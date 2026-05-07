<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        // CREATE COMMENT
        $comment = Comment::create([
            'content' => $request->content,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);

        // LOAD USER RELATIONSHIP
        $comment->load('user');

        // RETURN JSON RESPONSE
        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);

    }

    public function destroy(Comment $comment)
    {

        // SECURITY CHECK
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted!');

    }

}
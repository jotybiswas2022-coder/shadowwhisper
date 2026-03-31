<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Comment;

class PostController extends Controller
{
    public function react(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'type' => 'required|string'
        ]);

        $post = Post::find($request->post_id);

        // anonymous reactions, save type
        $reaction = new Reaction();
        $reaction->post_id = $post->id;
        $reaction->type = $request->type;
        $reaction->save();

        $count = $post->reactions()->count();

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    public function comment(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:500'
        ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json([
            'success' => true,
            'comment' => $comment->comment
        ]);
    }
}
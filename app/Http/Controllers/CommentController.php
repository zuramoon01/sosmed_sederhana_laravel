<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function createComment(Request $request, Post $post)
    {
        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);

        return redirect('/');
    }

    public function editComment(Request $request, Comment $comment)
    {
        Comment::where('id', $comment->id)->update([
            'comment' => $request->comment,
        ]);

        return redirect('/');
    }

    public function deleteComment(Request $request, Comment $comment)
    {
        Comment::destroy($comment->id);

        return redirect('/');
    }
}

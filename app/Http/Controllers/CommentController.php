<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function createComment(Request $request, Post $post)
    {
        DB::beginTransaction();

        try {
            $comment = Comment::create([
                'user_id' => auth()->user()->id,
                'post_id' => $post->id,
                'comment' => $request->comment,
            ]);

            DB::commit();

            return view('single_comment_page', ['comment' => $comment]);
        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th);
        }
    }

    public function editComment(Request $request, Comment $comment)
    {
        DB::beginTransaction();

        try {
            Comment::where('id', $comment->id)->update([
                'comment' => $request->comment,
            ]);

            DB::commit();

            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th);
        }
    }

    public function deleteComment(Request $request, Comment $comment)
    {
        DB::beginTransaction();

        try {
            Comment::destroy($comment->id);

            DB::commit();

            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th);
        }
    }
}

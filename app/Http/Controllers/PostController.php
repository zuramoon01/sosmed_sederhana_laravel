<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        DB::beginTransaction();

        try {
            $post = Post::create([
                'user_id' => auth()->user()->id,
                'post' => $request->post,
            ]);

            DB::commit();

            return view('single_post_page', [
                'post' => $post,
                'comments' => Comment::all(),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th);
        }
    }

    public function editPostPage(Post $post)
    {
        return view('edit_post', [
            'post' => $post
        ]);
    }

    public function editPost(Request $request, Post $post)
    {
        DB::beginTransaction();

        try {
            Post::where('id', $post->id)->update([
                'post' => $request->post,
            ]);

            DB::commit();

            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th);
        }
    }

    public function deletePost(Post $post)
    {
        DB::beginTransaction();

        try {
            Post::destroy($post->id);

            DB::commit();

            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th);
        }
    }
}

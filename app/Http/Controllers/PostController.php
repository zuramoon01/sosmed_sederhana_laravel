<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Post;

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

            return redirect('/');
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

            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'post' => $request->post,
        ]);

        return redirect('/');
    }

    public function editPostPage(Post $post)
    {
        return view('edit_post', [
            'post' => $post
        ]);
    }

    public function editPost(Request $request, Post $post)
    {
        Post::where('id', $post->id)->update([
            'post' => $request->post,
        ]);

        return redirect('/');
    }

    public function deletePost(Post $post)
    {
        Post::destroy($post->id);

        return redirect('/');
    }
}

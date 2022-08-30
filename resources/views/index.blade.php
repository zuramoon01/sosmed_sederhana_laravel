<!DOCTYPE html>
@extends('layouts.layout')

@section('main')
    <main id='home'>
        <div class="title">
            <h1>Welcome {{ auth()->user()->name }}</h1>
            <a href="/logout">Logout</a>
        </div>

        <form action="/post" method="post" class="post-form">
            @csrf
            <textarea name="post" id="post" cols="50" rows="5" placeholder="Your post"></textarea>
            <button type="submit">Post</button>
        </form>

        <h3>Posts</h3>

        <div class="posts">
            @foreach ($posts as $post)
                <div class="single-post">
                    <p>Post by {{ $post->user->name }} :</p>
                    <p class="post-value">{{ $post->post }}</p>

                    @if (auth()->user()->id === $post->user->id)
                        <a href="/post/edit/{{ $post->id }}">edit</a>
                        <a href="/post/delete/{{ $post->id }}">delete</a>
                    @endif

                    {{-- <form action="/comment/{{ $post->id }}" method="post" class="comment-form" id="comment-form"> --}}
                    <form class="comment-form" id="comment-form">
                        @csrf
                        <input type="text" name="comment" placeholder="Your comment">
                        <button type="submit">Comment</button>
                    </form>

                    @if (count($comments->where('post_id', $post->id)) > 0)
                        <h4>Komentar</h4>
                    @endif
                    @foreach ($comments->where('post_id', $post->id) as $comment)
                        <div class="single-comment">
                            <div class="comment-title">
                                <p class='comment-name'>By : <span>{{ $comment->user->name }}</span></p>

                                @if (auth()->user()->id === $comment->user->id)
                                    <div class="action-single-comment ">
                                        <a href="" class="editComment">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                        <a href="/comment/delete/{{ $comment->id }}">
                                            <span class="material-symbols-outlined">delete</span>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            @if (auth()->user()->id === $comment->user->id)
                                {{-- <form action="/comment/edit/{{ $comment->id }}" method="post" class="comment-form"
                                    style="display: none;"> --}}
                                <form class="comment-form">
                                    @csrf
                                    @method('put')
                                    <input type="text" name="comment" placeholder="Your comment">
                                    <button type="submit">Comment</button>
                                </form>
                            @endif

                            <p class="comment-value">{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </main>

    <script>
        const editComment = [...document.querySelectorAll('.editComment')];

        editComment.forEach(element => {
            const actionEditComment = element.parentNode;
            const editCommentValue = element.parentNode.parentNode.parentNode.childNodes[5];
            const formEditComment = element.parentNode.parentNode.parentNode.childNodes[3];

            element.addEventListener('click', (e) => {
                e.preventDefault()

                actionEditComment.style.display = "none";
                editCommentValue.style.display = "none";
                formEditComment.style.display = "flex";
            })
        })

        document.querySelector('#comment-form').addEventListener('submit', (e) => {
            e.preventDefault()
            console.log('success');
        })

        $('#comment-form').submit(function(e) {
            e.preventDefault()
            console.log('success');

            $.ajax({
                url: "{{ url('/comment/edit/$comment->id') }}",
                type: "POST",
                data: $("#comment-form").serialize(),
                success: (result) => {
                    console.log(result);
                }
                error: function(result) {
                    console.log(result);
                }
            })

        })
    </script>
@endsection

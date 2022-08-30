<div class="single-post">
    <p>Post by {{ $post->user->name }} :</p>
    <p class="post-value">{{ $post->post }}</p>

    @if (auth()->user()->id === $post->user->id)
        <a href="/post/edit/{{ $post->id }}">edit</a>
        <a href="/post/delete/{{ $post->id }}">delete</a>
    @endif

    <form class="comment-form create-form-comment" data-post_id="{{ $post->id }}">
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
                <form action="/comment/edit/{{ $comment->id }}" method="post" class="comment-form"
                    style="display: none;">
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

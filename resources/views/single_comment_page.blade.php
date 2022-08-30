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
        <form action="/comment/edit/{{ $comment->id }}" method="post" class="comment-form" style="display: none;">
            @csrf
            @method('put')
            <input type="text" name="comment" placeholder="Your comment">
            <button type="submit">Comment</button>
        </form>
    @endif

    <p class="comment-value">{{ $comment->comment }}</p>
</div>

<div class="comments">
    @foreach ($post->comments as $comment)
        <div class="comment">
            <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->message }}</p>
            <p>Commented on {{ $comment->created_at }}</p>
            <button class="show-replies-button">Reply</button>
            <div class="replies" style="display: none;">
                @foreach ($comment->replies as $reply)
                    <div class="reply">
                        <p><strong>{{ $reply->user->name }}:</strong> {{ $reply->message }}</p>
                        <p>Replied on {{ $reply->created_at }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<script>
    document.querySelectorAll('.show-replies-button').forEach(button => {
        button.addEventListener('click', () => {
            const repliesSection = button.nextElementSibling;
            repliesSection.style.display = repliesSection.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>





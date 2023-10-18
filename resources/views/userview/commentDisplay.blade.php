




<div class="comments">
    @foreach($post->comments as $comment)
        <div class="comment">
            <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->message }}</p>
            <p>Commented on {{ $comment->created_at }}</p>
            <button class="show-replies-button">Reply</button>
            <div class="replies" style="display: none;">
                @foreach($comment->replies as $reply)
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
    // Add a click event listener to the entire comments container
    document.querySelector('.comments').addEventListener('click', function (event) {
        // Check if the clicked element is a "Reply" button
        if (event.target.classList.contains('show-replies-button')) {
            // Find the associated replies section (sibling element)
            const repliesSection = event.target.nextElementSibling;
            
            // Toggle the visibility of the replies section
            if (repliesSection.style.display === 'none' || repliesSection.style.display === '') {
                repliesSection.style.display = 'block';
            } else {
                repliesSection.style.display = 'none';
            }
        }
    });
</script>


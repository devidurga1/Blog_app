
{{--<div class="comments">

    @foreach ($post->comments as $comment)
        <div class="comment">
            {{ $comment->user->name }}:{{ $comment->message }}
            
            {{--<p>Commented on {{ $comment->created_at }}</p>
            <button class="show-replies-button">Reply</button>--}}
            
               {{-- @foreach ($comment->replies as $reply)
                    <div class="reply">
                        {{ $reply->user->name }}:{{ $reply->message }}</textarea>
                       {{-- <p>Replied on {{ $reply->created_at }}</p>--}}
                    {{--</div>
                @endforeach
            
            </div>
        </div>
    @endforeach

</div>--}}




{{--@foreach ($post->comments as $comment)
        <div class="comment">
            <p class="comment1"><strong>{{ $comment->user->name }}:</strong> {{ $comment->message }}</p>
          {{-- this is correct--}}
            <!-- Reply Link -->
           {{-- <button class="show-reply-button">Reply</button>--}}
           {{--<a href="#" class="show-reply-link">Reply</a>
            
            <!-- Reply Form (Initially Hidden) -->
            <div class="reply-form" style="display: none;">
                <form action="{{ route('comments.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="reply_message">Reply:</label>
                        <textarea name="reply_message" id="reply_message" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <button type="submit" class="btn btn-primary">Submit Reply</button>
                </form>
            </div>--}}
            <!-- Display Replies for This Comment -->
           {{-- @foreach ($comment->replies as $reply)
                <div class="reply">
                    <p><strong>{{ $reply->user->name }}:</strong> {{ $reply->message }}</p>
                </div>
            @endforeach
        </div>
    @endforeach
    <a href="#" class="show-reply-link">Reply</a>
            
    <!-- Reply Form (Initially Hidden) -->
    <div class="reply-form" style="display: none;">
        <form action="{{ route('comments.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="reply_message">Reply:</label>
                <input type="text" id="message" name="message" id="name" >
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="btn btn-primary">Submit Reply</button>
        </form>
    </div>

    <!-- Comment Form for the Post -->
    {{--<form action="{{ route('comments.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="message">Add a Comment:</label>
            <textarea name="message" id="message" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>--}}

{{--<script>
    // JavaScript to toggle reply form visibility
    $(document).ready(function() {
        $(".show-reply-link").click(function() {
            $(this).next(".reply-form").slideToggle();
        });
    });
</script>--}}





{{--@foreach($comments as $comment)
<div class="display-comment">
    <strong>{{ $comment->user->name }}</strong>
    <p>{{ $comment->message }}</p>
    <a href="" id="reply"></a>
    <form method="post" action="{{ route('') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="message" class="form-control" />
            <input type="hidden" name="post_id" value="{{ $post_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-primary py-0" style="font-size: 0.8em; float: right;" value="Reply" />
        </div>
    </form>
   {{-- @include('posts.commentsDisplay', ['comments' => $comment->replies])--}}
{{--</div>
@endforeach --}}


@foreach ($comments as $comment)
    <div class="display-comment">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->message }}</p>
        <a href="#" class="reply-link"></a>
        
        <!-- Reply Form -->
        <form method="post" action="{{ route('reply.add') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="message" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-outline-primary py-0" style="font-size: 0.8em;" value="Reply" />
            </div>
        </form>
        
        <!-- Display Replies -->
        @foreach ($comment->replies as $reply)
            <div class="display-reply">
                <strong>{{ $reply->user->name }}</strong>
                <p>{{ $reply->message }}</p>
                <!-- Add your reply styling here -->
            </div>
        @endforeach
    </div>
@endforeach


{{--@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
       <p>Commented on {{ $comment->created_at }}
        by {{ optional($comment->user)->name }}</p>
       {{-- <strong>{{ $comment->user->name }}</strong>--}}
       {{-- <p>{{ $comment->message }}
        <a href="" id="reply"></a>
        
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach--}}




<!-- posts/commentsDisplay.blade.php -->
{{--@foreach ($comments as $comment)
    <div class="comment">
        <p>{{ $comment->message }}</p>
        <p>Commented on {{ $comment->created_at }} by {{ $comment->user->name }}</p>
        <button class="show-replies" data-comment-id="{{ $comment->id }}">Show Replies</button>

        <div class="replies" id="replies-{{ $comment->id }}">
            @foreach ($comment->replies as $reply)
                <div class="reply">
                    <p>{{ $reply->content }}</p>
                    <p>Replied on {{ $reply->created_at }} by {{ $reply->user->name }}</p>
                </div>
            @endforeach
        </div>

        <!-- Recursive rendering of replies -->
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach--}}


{{--@foreach($comments as $comment)
    <div class="comment">
        <p>{{ $comment->message }}</p>
        <p> {{ $comment->created_at }}{{-- by {{ optional($comment->user)->name }}--}}</p>
        {{--@if ($comment->replies->count() > 0)
           {{-- <button class="show-replies">Show Replies</button>--}}
           {{--<div class="replies">
                @foreach($comment->replies as $reply)
                    <div class="reply">
                        <p>{{ $reply->message }}</p>
                        <p>{{ $reply->created_at }}  {{ optional($reply->user)->name }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>--}}



    

    


    
        <!-- Other content on your page -->
    
        <!-- Comments section -->
        <div class="comments">
            <h2>Comments</h2>
            @foreach($post->comments as $comment)
                <div class="comment">
                    <p>{{ $comment->message }}</p>
                    <p>Commented on {{ $comment->created_at }} by {{ $comment->user->name }}</p>
                   {{-- <button class="show-replies">Show Replies</button>--}}
                    <div class="replies">
                        @foreach($comment->replies as $reply)
                            <div class="reply">
                                <p>{{ $reply->message }}</p>
                                <p>Replied on {{ $reply->created_at }} by {{ $reply->user->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    
        <!-- End of comments section -->
    
        <!-- Other content on your page -->

    
    @push('scripts')
    <script>
        $(document).ready(function() {
            // Hide all reply sections initially
            $('.replies').hide();
    
            // Show/hide replies on button click
            $('.show-replies').on('click', function() {
                var replies = $(this).siblings('.replies');
                replies.toggle();
            });
        });
    </script>
    @endpush
    




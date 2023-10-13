
{{--@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
       <p>Commented on {{ $comment->created_at }}
        by {{ optional($comment->user)->name }}</p>
       {{-- <strong>{{ $comment->user->name }}</strong>--}}
        {{--<p>{{ $comment->message }}
        <a href="" id="reply"></a>
        
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach--}}



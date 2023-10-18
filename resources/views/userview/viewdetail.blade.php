@extends('layouts.ap')
@extends('layouts.nav')
@section('content')

   
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('viewall') }}"> Back</a>
            </div>
        </div>
        {{--<div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>--}}
    </div>
</div>


<div class="row mx-auto">
    <div class="center-content"> 
    <div class="col-xs-12 col-sm-12 col-md-12 d-flex align-items-center justify-content-center">
        <div class="form-group text center" >
            <strong>Title:</strong>
            {{ $post->title }}
        </div>
    </div>
   

    
    <div class="col-xs-12 col-sm-12 col-md-12 d-flex align-items-center justify-content-center">
        <div class="form-group text center">
            <strong>author_name:</strong>
            {{ $post->author_name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {{--<strong>Image:</strong>--}}

            <img src="/images/{{ $post->image }}" class="center-image" width="300px">
        </div>
    </div>
    
</div>

<div class="col-xs-12 col-sm-12 col-md-12 d-flex align-items-center justify-content-center">
    <div class="form-group text-center">
        <strong>Content:</strong>
        {{ $post->content}}
    </div>
</div>


{{--<div class="comments">
    <h2>Comments</h2>
    @foreach($post->comments as $comment)
        <div class="comment">
            <p>{{ $comment->content }}</p>
            <p>Commented on {{ $comment->created_at }} by {{ $comment->user->name }}</p>
            <button class="show-replies">Show Replies</button>
            <div class="replies">
                @foreach($comment->replies as $reply)
                    <div class="reply">
                        <p>{{ $reply->content }}</p>
                        <p>Replied on {{ $reply->created_at }} by {{ $reply->user->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>--}}

{{--@foreach($post->comments as $comment)
    <div class="comment">
        <p>{{ $comment->content }}</p>
        <p>Commented on {{ $comment->created_at }} by {{ $comment->user->name }}</p>
    </div>
@endforeach--}}

{{--@foreach($post->comments as $comment)
    <div class="comment">
        <p>{{ $comment->content }}</p>
        <p>Commented on {{ $comment->created_at }} by {{ optional($comment->user)->name }}</p>
    </div>
@endforeach--}}


{{--<h4>Display Comments</h4>
 {{-- @dd($post->comments); --}}
 {{--@include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])--}}
   
<hr />

{{--<h4>Display Comments</h4>
@include('posts.commentsDisplay', ['comments' => $comments, 'post_id' => $post->id])--}}


<div class="col-xs-12 col-sm-12 col-md-12 d-flex align-items-center justify-content-center">
    <div class="form-group text-center">
        <strong>Display Comments:</strong>
        @include('posts.commentsDisplay', ['comments' => $comments, 'post_id' => $post->id])
    </div>
</div>





    {{--<div class="add-comment">
        <button class="add-comment-button">Add Comment</button>
        <form class="comment-form" style="display: none;" action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="body" rows="3" placeholder="Leave a comment" required></textarea>
            <button type="submit">Submit Comment</button>
        </form>
    </div>--}}



<form method="POST" action="{{ route('comments.store') }}">
    @csrf

    <input type="hidden" name="post_id" value="{{ $post->id }}">
    
    <div class="form-group">
        <label for="message">Your Comment</label>
        <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Comment</button>
</form>



{{--this right code --}}
{{--@auth
    <button id="show-comment-form">Add Comment</button>
    <form id="comment-form" style="display: none;" action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="message" rows="4" placeholder="Your comment" required></textarea>
        <button type="submit">Submit Comment</button>
    </form>
@endauth--}}


<!-- JavaScript for toggling replies and comment form -->


@endsection



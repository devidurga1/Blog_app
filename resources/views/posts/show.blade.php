@extends('layouts.ap')

@extends('layouts.sidebar')
@section('content')

   
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            

            <h2> Show Post-Detail</h2>
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
@endsection



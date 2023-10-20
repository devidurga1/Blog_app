@extends('layouts.ap')
@extends('layouts.sidebar')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }





</style>
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
             {{--<h2> Show Post-Detail</h2>--}}
        </div>
        {{--<div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>--}}
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

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

    <div class="col-xs-12 col-sm-12 col-md-12 d-flex align-items-center justify-content-center">
        <div class="form-group text-center">
            <strong>Content:</strong>
            {{ $post->content}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {{--<strong>Image:</strong>--}}

            <img src="/images/{{ $post->image }}" class="center-image" width="300px">
        </div>
    </div>
    
</div>


 
<hr />

<div class="col-xs-12 col-sm-12 col-md-12 d-flex align-items-center justify-content-center">
    
       {{-- @include('posts.commentsDisplay', ['comments' => $comments, 'post_id' => $post->id])--}}
    


    <div class="card-body">
        <h5>Display Comments</h5>
    
        @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])

        <hr />
       </div>
</div>


</div>
</div>
</div>
</div>

@endsection



@extends('layouts.ap')
@include('layouts.sidebar')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
        </div>
    </div>
</div>


<!--@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif-->
<!--<h3>Edit Users</h3>-->
<!--<a href="{{ route('posts.index') }}" class="btn btn-dark mb-2">BACK</a>-->

<form action="{{ route('posts.update' , $post->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">title</label>
        <input type="text" name="title" class="form-control" value="{{$post->title}}" />
        @error('title')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <input type="text" name="content" class="form-control" value="{{$post->content}}" />
        @error('content')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    {{--<div class="form-group">
        <label for="name">Password</label>
        <input type="password" name="password" class="form-control" value="{{$user->password}}" />
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>--}}

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control" placeholder="image">
        <img src="/images/{{ $post->image }}" width="300px">
        @error('image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
       
    <button type="submit" class="btn btn-dark px-4">update post</button>
</form>
@endsection
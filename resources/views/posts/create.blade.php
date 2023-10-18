
@extends('layouts.ap')
@include('layouts.sidebar')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New post</h2>
        </div>
        <div class="pull-right">
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>
   {{-- <div class="form-group">
    
            <label for="author_name">Author Name</label>
            <input type="text" class="form-control" id="author_name" name="author_name" required>
        </div>--}}
        
    
    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" class="form-control">
    </div>
   {{-- <div class="form-group">
        <label>
            <input type="checkbox" name="comments_enabled" value="0"> Enable Comments

        </label>
        
    </div>--}}

    <div class="form-check">
        <input type="checkbox" name="comments_enabled" id="comments_enabled" class="form-check-input" checked>
        <label class="form-check-label" for="comments_enabled">Enable Comments</label>
    </div> 
    <button type="submit" class="btn btn-primary">Create Post</button>
</form>

@endsection
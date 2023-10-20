@extends('layouts.ap')
@extends('layouts.nav')
@section('content')
    <h1>All Posts</h1>
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="Post Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        {{--<p class="card-text">Author: {{ $post->author->name }}</p>--}}
                        <p class="card-text">Total Comments: {{ $post->comments->count() }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('userview.viewdetail', ['id' => $post->id]) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

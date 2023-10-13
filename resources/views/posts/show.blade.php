@extends('layouts.ap')

@extends('layouts.sidebar')
@section('content')

   {{--<div class="container">
        <h2>Posts</h2>
        <table class="table table-bordered" id="posts-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Author</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#posts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('posts.show') !!}',
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            var imagePath = '/images/' + data +
                            '.jpg'; // Adjust the format as needed

                            // Construct the full URL using the asset() function
                            var imageUrl = '{{ asset('') }}' + imagePath;

                            // Generate the HTML for the image tag
                            return '<img src="' + imageUrl + '" alt="Post Image" width="100">';
                        }
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'author',
                        name: 'user.name'
                    },
                ]
            });
        });
    </script>--}}



<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show User</h2>
        </div>
        {{--<div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>--}}
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {{ $post->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Content:</strong>
            {{ $post->content }}
        </div>
    </div>

    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>author_name:</strong>
            {{ $post->author_name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>

            <img src="/images/{{ $post->image }}" width="300px">
        </div>
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


<h4>Display Comments</h4>
  
@include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
   
<hr />

@endsection




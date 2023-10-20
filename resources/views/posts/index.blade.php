@extends('layouts.aapp')
@extends('layouts.sidebar')
@section('content')


{{--<!DOCTYPE html>
<html>
<head>
    <title>Blog_app</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>--}}
    <div class="container">
    <h1  class="d-flex justify-content-center">Posts List <br/></h1>
    <div class="d-flex justify-content-center">
        @can('post-create')
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-2">Create New Post</a>
        @endcan
    </div>
<!-- Search Bar -->
<div class="d-flex justify-content-center">
<div class="mb-3">
    <input type="text" id="search" placeholder="Search...">
    <button id="searchBtn" class="btn btn-primary">Search</button>
</div>
</div>
<div class="d-flex justify-content-center">
<table class="table table-bordered" id="posts-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
           <th> comments_enabled</th>
            <th>Created At</th>
            <th>Action</th>

        </tr>
    </thead>
</table>
</div>
</div>


<script>
    $(document).ready(function() {
        var table = $('#posts-table').DataTable({
            processing: true,
            serverSide: true,
            searching:false,
            ajax: {
                url: '{!! route("posts.index") !!}',
                data: function (d) {
                    d.search = $('#search').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'content', name: 'content' },
                
                {
        data: 'image',
        name: 'image',
        render: function(data, type, full, meta) {
            // Assuming 'image' is the name of the image file in your public folder
            return '<img src="' + '{{ asset("images") }}/' + data + '" alt="Post Image" width="100">';
        }
    },
    { data: 'comments_enabled', name: 'comments_enableds' },

     { data: 'created_at', name: 'created_at' },
          { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // Search functionality
    $('#searchBtn').click(function() {
        table.draw();
    });
});
</script>
@endsection 
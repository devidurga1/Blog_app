<!DOCTYPE html>
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
<body>
    <div class="container">
    <h1>Posts List <br/></h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-2">Create New Role</a>

<!-- Search Bar -->
<div class="mb-3">
    <input type="text" id="search" placeholder="Search...">
    <button id="searchBtn" class="btn btn-primary">Search</button>
</div>

<table class="table table-bordered" id="posts-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Created At</th>
        </tr>
    </thead>
</table>
</div>


</body>

<script>
    $(document).ready(function() {
        var table = $('#posts-table').DataTable({
            processing: true,
            serverSide: true,
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
                { data: 'created_at', name: 'created_at' }
            ]
        });
        // Search functionality
    $('#searchBtn').click(function() {
        table.draw();
    });
});
</script>
</html>
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
    <h1>User List <br/></h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Create New Role</a>
   {{-- <form>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" id="name" placeholder="Enter Name" >
    

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" id="email" placeholder="Enter Email">

        <button type="button" id="search-button">Search</button>

       <button id="search-form" type="submit">Search</button>
    </form>--}}
   {{-- <table class="table table-bordered data-table">--}}

    <form id="search-form">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-4">
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            {{--<div class="col-md-4">
                <label for="role">Role:</label>
                                <select id="role" class="form-control">
                                    <option value="">All</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
            </div>--}}

            <div class="col-md-4">
                <button type="button" id="search-button" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <br>
        <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th >Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>
   
{{--<script type="text/javascript">
  $(document).ready(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
           { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>--}}

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: '{!! route("users.index") !!}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.email = $('input[name=email]').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $('#search-button').on('click', function(e) {
        e.preventDefault();
        table.draw();
    });
});
</script>
{{--<script>
$(function() {
    var dataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('users.index') }}',
            data: function (d) {
                d.name = $('#name').val();
                d.email = $('#email').val();
                d.role = $('#role').val();
            }
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'role.name', name: 'role.name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        dataTable.draw();
    });
});
</script>--}}
</html>
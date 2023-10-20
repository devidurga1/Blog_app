@extends('layouts.aapp')
@extends('layouts.sidebar')
@section('content')  
<div class="d-flex justify-content-center">
<div class="container">
    {{--<div class="row">
        <div class="col-md-100 text-center">--}}
      <h1 class="d-flex justify-content-center">User List <br /></h1>
         <div class="d-flex justify-content-center">
            @can('create-user') 
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Create New User</a>
        @endcan
         </div>
        <form  class="d-flex justify-content-center">
        
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" id="name" placeholder="Enter Name">


            <label for="email">Email:</label>
            <input type="text" id="email" name="email" id="email" placeholder="Enter Email">
            <label for="email">Role:</label>
            <select name="role" id="role">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>

            <button type="button" id="search-button">Search</button>
        </form>



    {{-- this right code   <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>


    <script>
        $(document).ready(function() {
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: '{{ route('users.index') }}',
                    data: function(d) {
                        d.name = $('input[name=name]').val();
                        d.email = $('input[name=email]').val();
                        d.role = $('select[name=role]').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles.name'
                    }, // Add the 'roles' column
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ]
            });
            $('#search-button').on('click', function(e) {
                e.preventDefault();
                table.ajax.reload();
            });
        });
    </script>--}}
    <div class="d-flex justify-content-center">
    <table class="table table-bordered table-center" id="users-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
</div>
</div>

    <script>
        $(document).ready(function() {
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: '{{ route('users.index') }}',
                    data: function(d) {
                        d.name = $('input[name=name]').val();
                        d.email = $('input[name=email]').val();
                        d.role = $('select[name=role]').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles.name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
    
            // Add click event for delete button
            $('#users-table').on('click', '.delete-button', function() {
                var userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    // Perform the delete action when the user confirms
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('users.destroy', ['user' => ':id']) }}'.replace(':id', userId),
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success: function(data) {
                            // Reload the DataTable on success or perform any other action
                            table.ajax.reload();
                        }
                    });
                }
            });
    
            $('#search-button').on('click', function(e) {
                e.preventDefault();
                table.ajax.reload();
            });
        });
    </script>
    




@endsection

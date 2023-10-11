@extends('layouts.aapp')
@extends('layouts.sidebar')

@section('content')
<div class="container">
 <h1>User List <br /></h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Create New User</a>
        <form>

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

        <table class="table table-bordered" id="users-table">
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
    </script>
@endsection

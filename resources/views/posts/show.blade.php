@extends('layouts.app')

@section('content')
    <div class="container">
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
    </script>
@endpush

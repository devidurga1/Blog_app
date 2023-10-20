
@extends('layouts.ap')
@include('layouts.sidebar')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
           {{-- <h2>Create New post</h2>--}}
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

<div class="d-flex justify-content-center">
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
        <label class="form-check-label" for="comments_enabled">
           
        </label>
    </div> 
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
</div>
    
    {{--<script>
        $(document).ready(function() {
            // Check if the checkbox is initially checked
            if ($("#comments_enabled").is(":checked")) {
                $("#comment-form").show();
            }
    
            $(".check").click(function() {
                $("#comments_enabled").prop("checked", true);
                $("#comment-form").show();
            });
    
            $(".uncheck").click(function() {
                $("#comments_enabled").prop("checked", false);
                $("#comment-form").hide();
            });
        });
    </script>--}}
    
    
    
    


<script>
    $(document).ready(function() {
        // Check if the checkbox is initially checked
        if ($("#comments_enabled").is(":checked")) {
            // If checked, show the form
            $("#comment-form").show();
        } else {
            // If not checked, hide the form
            $("#comment-form").hide();
        }

        // Add a change event listener to the checkbox
        $("#enableForm").change(function() {
            if ($(this).is(":checked")) {
                $("#comment-form").show();
            } else {
                $("#comment-form").hide();


            }
        });
    });
</script>
    
    
    
    
    


@endsection
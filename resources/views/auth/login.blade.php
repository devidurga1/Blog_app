
@extends('layouts.adminfapp')
@section('content')


<section class="content">
    <div class="login-box">
    <div class="container-fluid">
    <div class="row">
    
    <div class="col-md-12">
    
    <div class="card card-primary">
    <div class="card-header">

        @if (Session::has('error'))
                    <p class="text-denger">{{Session::get('error')}}</p>
                    @endif
                    @if(Session::has('success'))
                    <p class="text-success">{{Session::get('success ')}}</p>
                    @endIf

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @method('post')
    <h3 class="card-title">Login Form<small></small></h3>
    </div>
    {{--<form id="quickForm">--}}
    <div class="card-body">
    <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
    @if ($errors->has('email'))
 <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    @if ($errors->has('password'))
        <p class="text-danger">{{ $errors->first('password') }}</p>
        @endif
    </div>
    <div class="row">
        <div class="col-8 text-left">
            <a href="{{ route('forget.password.get')}}" class="btn btn-link">Reset Password</a>
        </div>

    {{--<div class="form-group">
        <a href="{{ url('auth/google') }}">
            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
        </a>--}}
        
        </div>
    <div class="form-group mb-0">
        
    <div class="custom-control custom-checkbox">
    {{--<input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">--}}
    <label  for="exampleCheck1">Not a member?  <a href="register">Sign Up Now</a>.</label>
    </div>
    
    </div>
    </div>
    
    <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    </div>
    
    </div>
    
    
    <div class="col-md-6">
    </div>
    
    </div>
    
    </div>
    </div>
    </section>

    @endsection
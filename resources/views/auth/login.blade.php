@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card form-holder">
                <div class="card-body">
                   {{-- <h1>Login</h1>--}}
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
                        <h2>Login Form</h2>
                        <div class="form-group">
                            <i class="fa fa-envelope icon"></i>
                            <input type="email" name="email" class="form-group" placeholder="Email" />
                            @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email' ) }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                        <i class="fa fa-lock icon"></i>
                            <input type="password" name="password" class="form-group" placeholder="Password" />
                            @if($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password' ) }}</p>
                            @endif
                        </div>
                       <div class="row">
                           {{-- <div class="col-8 text-left">
                                <a href="{{ route('forget.password.get')}}" class="btn btn-link">Reset Password</a>
                            </div>--}}
                            <div class="col-4 text-right">
                                <input type="submit" class="btn btn-primary" value="login" />
                            </div>
                            <div class="container signup">
                                <p>Not a member? <a href="register">Sign Up Now</a>.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{--<form action="/action_page.php" style="max-width:500px;margin:auto">
    <h2>Login Form</h2>

    <div class="input-container">
      <i class="fa fa-envelope icon"></i>
      <input class="input-field" type="text" placeholder="Email" name="email">
    </div>
    
    <div class="input-container">
      <i class="fa fa-key icon"></i>
      <input class="input-field" type="password" placeholder="Password" name="psw">
    </div>
  
    <button type="submit" class="btn">Login</button>
  </form>--}}
  

@endsection
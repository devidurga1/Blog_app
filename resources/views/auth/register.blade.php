@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card form-holder">
                <div class="card-body">
                   {{--<h1>Register</h1>--}}
                    @if (Session::has('error'))
                    <p class="text-denger">{{Session::get('error')}}</p>
                    @endif
                    @if(Session::has('success'))
                    <p class="text-success">{{Session::get('message')}}</p>
                    @endif
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        @method('post')

                        <h2>Register Form</h2>
          <div class="form-group">
           <i class="fa fa-user icon"></i>
           <input class="form-group" type="text" placeholder="Username" name="name">
           @if($errors->has('name'))
                            <p class="text-danger">{{ $errors->first( 'name') }}</p>
                            @endif
                  </div>

                  <div class="form-group">
                    <i class="fa fa-envelope icon"></i>
                    <input class="form-group" type="text" placeholder="Email" name="email">
                    @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email' ) }}</p>
                            @endif
                  </div>
                  
                  <div class="form-group">
                    <i class="fa fa-lock icon"></i>
                    <input class="form-group" type="password" placeholder="Password" name="password">
                    @if($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password' ) }}</p>
                            @endif
                  </div>
                  <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    <input class="form-group" type="password" placeholder="Comfirm Your Password" name="password_confirmation">
                    @if($errors->has('password_confirmation'))
                            <p class="text-danger">{{ $errors->first('password_confirmation' ) }}</p>
                            @endif
                  </div>
                  
                        {{--<div class="form-group">
                            <label>Name</label>
                            <input type="name" name="name" class="form-control" placeholder="Name" />
                            @if($errors->has('name'))
                            <p class="text-danger">{{ $errors->first( 'name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" />
                            @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email' ) }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                            @if($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password' ) }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Comfirm Your Password" />
                            @if($errors->has('password_confirmation'))
                            <p class="text-danger">{{ $errors->first('password_confirmation' ) }}</p>
                            @endif
                        </div>--}}
                        {{--<button type="submit" class="btn">Register</button>--}}
                        <input type="submit" class="btn btn-primary" value="Register" />
                        <div class="col-4 text-right">
                            {{--<button type="submit" class="btn">Register</button>--}}
                           {{-- <input type="submit" class="btn btn-primary" value="Register" />--}}
                          {{--<input type="submit" class="btn btn-primary" value="register" />--}}

                        </div>
                        <div class="container signin">
                            <p>Already have an account? <a href="login">Sign in</a>.</p>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

{{--<form action="/action_page.php" style="max-width:500px;margin:auto">
<h2>Register Form</h2>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username" name="usrnm">
  </div>

  <div class="input-container">
    <i class="fa fa-envelope icon"></i>
    <input class="input-field" type="text" placeholder="Email" name="email">
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="psw">
  </div>
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="psw">
  </div>
  
  <button type="submit" class="btn">Register</button>

</form>--}}
@endsection
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
                                    <p class="text-denger">{{ Session::get('error') }}</p>
                                @endif
                                @if (Session::has('success'))
                                    <p class="text-success">{{ Session::get('success ') }}</p>
                                @endIf

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <h3 class="card-title">Register Form<small></small></h3>
                            </div>
                            {{-- <form id="quickForm"> --}}
                            <div class="card-body">


                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Comfirm Your Password">
                                    @if ($errors->has('password_confirmation'))
                                        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-0">

                                    <div class="custom-control custom-checkbox">
                                        {{-- <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1"> --}}
                                        <label for="exampleCheck1">Already have an account? <a href="login">Sign
                                                in</a>.</label>
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

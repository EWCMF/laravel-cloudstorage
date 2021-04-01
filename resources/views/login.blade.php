@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        @csrf
                        <h3 class="text-center text-white">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-white">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-white">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
                        </div>
                        <div class="form-check">
                            <input id="remember" name="remember" class="form-check-input" type="checkbox" @if (old('remember'))
                            checked
                            @endif>
                            <label for="remember" class="text-white form-check-label">Remember me</label>
                        </div>
                        @if (session('status'))
                            <div class="text-danger mt-2">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <input type="submit" name="submit" class="btn btn-primary btn-md my-4" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" action="{{route('register')}}" method="post">
                        @csrf

                        <h3 class="text-center text-white">Register</h3>
                        <div class="form-group">
                            <label for="username" class="text-white">Email:</label><br>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email')}}">

                            @error('email')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-white">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username')}}">

                            @error('username')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-white">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">

                            @error('password')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-white">Repeat password:</label><br>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>

                        <div>
                            <input type="submit" name="submit" class="btn btn-primary btn-md my-4" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

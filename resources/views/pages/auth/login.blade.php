@extends('templates.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-custom.css') }}">
@endsection()
@section('body')
    <div class="auth-page login-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img d-md-block d-none"
                            style="background-image:url({{ asset('images/auth/bg-auth-1.jpg') }})">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div>
                                <h3 class="fw-bold text-md-left text-center">Login</h3>
                            </div>
                            @if (session('message'))
                                @include('includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                            @endif
                            <form action="{{ route('login.process') }}" method="post" class="signin-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="username">Username</label>
                                    <input type="text" class="form-control" placeholder="username or email"
                                        name="username" id="username" value="{{ old('username') }}" />
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="********" name="password"
                                        id="password" />
                                </div>
                                <div class="form-group d-md-flex">
                                    <div>
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                                <div class="form-group text-center mb-0">
                                    <a href="{{ route('forgot-password') }}">Forgot Password</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

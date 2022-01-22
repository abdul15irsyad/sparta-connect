@extends('templates.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-custom.css') }}">
@endsection()
@section('body')
    <div class="auth-page forgot-password-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-6">
                    <div class="wrap d-md-flex">
                        <div class="login-wrap p-4 p-md-5">
                            <div>
                                <h3 class="fw-bold text-md-left text-center">Forgot Password</h3>
                                <p class="text-muted text-md-left text-center small">we will send a link by email to change
                                    your password</p>
                            </div>
                            @if (session('message'))
                                @include('includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                            @endif
                            <form action="{{ route('forgot-password') }}" method="post" class="signin-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="example@email.com" name="email" id="email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback text-lowercase">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary px-3">Send
                                        Email</button>
                                </div>
                                <div class="form-group mb-0">
                                    <a href="{{ route('login') }}">Back to login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

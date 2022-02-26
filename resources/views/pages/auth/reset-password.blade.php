@extends('templates.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-custom.css') }}">
@endsection()
@section('body')
    <div class="auth-page reset-password-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-6">
                    <div class="wrap d-md-flex">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="fw-bold">Reset Password</h3>
                                    <p class="text-muted small"><span>Minimum <b>8 characters</b> and must contain lowercase
                                            letters <b>(a-z)</b>, uppercase <b>(A-Z)</b>, and number <b>(0-9)</b></span></p>
                                </div>
                            </div>
                            <form action="{{ route('reset-password.process') }}" method="post" class="signin-form">
                                @csrf
                                <input type="hidden" name="token" value="{{ old('token', $token->token) }}">
                                <div class="form-group mb-3">
                                    <label class="label" for="new_password">New Password</label>
                                    <input type="password" class="form-control" placeholder="your new password"
                                        name="new_password" id="new_password">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="your new password"
                                        name="confirm_password" id="confirm_password">
                                </div>
                                <div class="form-group text-right mb-0">
                                    <button type="submit" class="btn btn-primary px-3">Save Password</button>
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <a href="{{ route('login') }}">Back to login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

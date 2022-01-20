@extends('admin.templates.master')

@section('body')
<body>
    <div class="container-fluid hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h3>Login <strong>Admin</strong></h3>
                </div>
                <div class="card-body">
                    @if(session('message'))
                    @include('admin.includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                    @endif
                    <form action="{{ route('admin-login') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" placeholder="username or email" value="{{ old('username') }}">
                        </div>
                        <div class="input-group input-password mb-0">
                            <input type="password" class="form-control" name="password" placeholder="********">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-eye btn-show-password" data-toogle="tooltip" title="show"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-lg-6 col-12">
                                <div class="input-group input-password mb-0">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember" name="remember">
                                        <label for="remember">Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="text-right">
                                    <a href="{{ route('admin-forgot-password') }}" class="btn btn-link">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
    </div>
@endsection
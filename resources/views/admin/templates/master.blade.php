<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | Admin {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/sparta-logo.png') }}" sizes="192x192" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin/adminlte/plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/adminlte/dist/css/adminlte.min.css') }} ">
    <!-- Icheck -->
    <link rel="stylesheet" href="{{ asset('admin/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }} ">
    @yield('style')
</head>
@yield('body')

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('admin/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/adminlte/dist/js/adminlte.js') }}"></script>
<!-- Custom Javascript -->
<script src="{{ asset('admin/js/script.js') }}"></script>
@yield('javascript')
</body>

</html>

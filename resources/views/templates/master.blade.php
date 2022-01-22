<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ $meta_description ?? 'Aplikasi untuk menghubungkan angkatan Sparta' }}" />
    <meta property="og:title" content="{{ $title }} | {{ config('app.name') }}" />
    <meta property="og:description"
        content="{{ $meta_description ?? 'Aplikasi untuk menghubungkan angkatan Sparta' }}" />
    <meta property="og:url" content="{{ url('') }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:image" content="{{ asset('images/sparta-logo.jpg') }}" />
    <link rel="icon" href="{{ asset('images/sparta-logo.png') }}" sizes="192x192" />

    <!-- Google Font: Lexend -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;300;400;600;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/bcd59524b0.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('style')
</head>
@yield('body')

<!-- REQUIRED SCRIPTS -->
<!-- Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Custom Javascript -->
<script src="{{ asset('js/script.js') }}"></script>
@yield('javascript')
</body>

</html>

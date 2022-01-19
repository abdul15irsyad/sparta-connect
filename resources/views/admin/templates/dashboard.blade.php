@extends('admin.templates.master')

@section('style')
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('admin/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}} ">
@yield('content-style')
@endsection

@section('body')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        @include('admin.includes.navbar-dashboard')

        @include('admin.includes.sidebar-dashboard')

        @yield('content')

        @include('admin.includes.footer-dashboard')
    </div>
    <!-- ./wrapper -->
    @endsection

    @section('javascript')
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/adminlte/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('admin/adminlte/dist/js/pages/dashboard2.js') }}"></script>
    <script type="text/javascript">
        let defaultDatatables = {
            search: {
                caseInsensitive: false
            },
            order: [1,'asc'],
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 20, 50],
                [5, 10, 20, 50]
            ],
            language: {
                searchPlaceholder: "search here..."
            },
        };
        let defaultDatepicker = {
            autoclose: true,
            format: 'd MM yyyy',
            language: "en",
            startDate: new Date(),
            todayHighlight: true,
            todayBtn: "linked",
        }
    </script>
    @yield('content-javascript')
    @endsection
@extends('admin.templates.master')

@section('style')
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">
    <!-- Component Style -->
    <link rel="stylesheet" href="{{ asset('admin/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/navbar.css') }}">
    @yield('content-style')
@endsection

@section('body')

    <body
        class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-mini-md {{ isset($_COOKIE['sidebar-collapse']) && $_COOKIE['sidebar-collapse'] ? 'sidebar-collapse' : '' }}"
        style="height: auto">
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

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('admin/adminlte/dist/js/pages/dashboard2.js') }}"></script>
        <script type="text/javascript">
            let defaultDatatables = {
                order: [1, 'asc'],
                processing: true,
                serverSide: true,
                responsive: false,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 20, 50],
                    [5, 10, 20, 50]
                ],
                language: {
                    search: "",
                    searchPlaceholder: "search here...",
                },
                fnDrawCallback: function(oSettings) {
                    // disable pagination if there is only one page in datatables
                    if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
                        $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                    } else {
                        $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
                    }
                }
            };
            let datatableDefaultInitComplete = function() {
                initTooltip()
                btnDelete()
            }
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

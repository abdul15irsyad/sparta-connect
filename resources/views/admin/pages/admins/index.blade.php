@extends('admin.templates.dashboard')

@section('content-style')
    <!-- Datatables css -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-print-1.6.5/fh-3.1.8/r-2.2.7/sp-1.2.2/datatables.min.css" />
@endsection

@section('content')
    <div class="content-wrapper admins-index">
        @include('admin.includes.content-header')
        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('message'))
                    @include('admin.includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                @endif
                <div class="card">
                    <div class="card-body">
                        @can('create-admin')
                            <div class="text-md-right text-center mb-3">
                                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary"><i
                                        class="fas fa-fw fa-plus"></i> Create Admin</a>
                            </div>
                        @endcan
                        <table class="table table-striped datatable">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    {{-- <th>Email</th> --}}
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    @canany(['read-admin', 'update-admin', 'delete-admin'])
                                        <th class="action">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        @can('delete-admin')
            @include('admin.includes.modal-delete')
        @endcan
    </div>
@endsection

@section('content-javascript')
    <!-- Moment js -->
    <script src="{{ asset('admin/adminlte/plugins/moment/moment.min.js') }}"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-print-1.6.5/fh-3.1.8/r-2.2.7/sp-1.2.2/datatables.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            let table = $('.datatable').DataTable({
                ...defaultDatatables,
                order: [5, 'desc'],
                ajax: {
                    url: "{{ route('api.admin.admins.datatable') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        authUserId: {{ auth('admin')->user()->id }},
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    // {
                    //     data: 'email',
                    //     name: 'email'
                    // },
                    {
                        data: 'admin_role.name',
                        name: 'admin_role.name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: false,
                        render: (data, type, row) => {
                            let color = data == '1' ? "success" : "danger"
                            let text = data == '1' ? "active" : "inactive"
                            return '<div class="text-center"><span class="text-pill alert-default-' +
                                color + '">' +
                                text + '</span></div>'
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: data => {
                            let date = moment(data)
                            return '<div class="text-center">' + moment.duration(date.diff(
                                moment())).humanize(true) + '</div>'
                        }
                    },
                    @canany(['read-admin', 'update-admin', 'delete-admin'])
                        {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                        },
                    @endcanany
                ],
                initComplete: function() {
                    datatableDefaultInitComplete()
                }
            })
        })
    </script>
@endsection

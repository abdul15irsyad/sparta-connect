@extends('admin.templates.dashboard')

@section('content-style')
    <!-- Datatables css -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-print-1.6.5/fh-3.1.8/r-2.2.7/sp-1.2.2/datatables.min.css" />
@endsection

@section('content')
    <div class="content-wrapper roles-index">
        @include('admin.includes.content-header')
        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('message'))
                    @include('admin.includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                @endif
                <div class="card">
                    <div class="card-body">
                        @can('create-role')
                            <div class="text-md-right text-center mb-3">
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i
                                        class="fas fa-fw fa-plus"></i> Create Role</a>
                            </div>
                        @endcan
                        <table class="table table-striped datatable">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    {{-- <th>Slug</th> --}}
                                    <th class="desc">Description</th>
                                    {{-- <th class="permissions">Permissions</th> --}}
                                    <th>Created at</th>
                                    @canany(['read-role', 'update-role', 'delete-role'])
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
        @can('delete-role')
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
                order: [3, 'desc'],
                ajax: {
                    url: "{{ route('api.admin.roles.datatable') }}",
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
                    // {
                    //     data: 'slug',
                    //     name: 'slug'
                    // },
                    {
                        data: 'desc',
                        name: 'desc',
                        render: data => data && data != '' ? data : 'no description'
                    },
                    // {
                    //     data: 'admin_permissions',
                    //     name: 'admin_permissions',
                    //     orderable: false,
                    //     serachable: false,
                    //     render: data => {
                    //         let pillText = text =>
                    //             '<div class="text-pill text-sm alert-default-success">' + text +
                    //             '</div>'
                    //         if (data.length == 0)
                    //             return '<div class="text-center text-sm">No Permission</div>'
                    //         // max show permission
                    //         let result = '',
                    //             max = 3
                    //         data.forEach((permission, index) => {
                    //             if (index < max) result += pillText(permission
                    //                 .name)
                    //         })
                    //         result += (data.length > max) ? pillText('etc . . .') : ''
                    //         return '<div class="text-center">' + result + '</div>'
                    //     }
                    // },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: data => {
                            let date = moment(data)
                            return '<div class="text-center">' + moment.duration(date.diff(
                                moment())).humanize(true) + '</div>'
                        }
                    },
                    @canany(['read-role', 'update-role', 'delete-role'])
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

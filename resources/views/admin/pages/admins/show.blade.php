@extends('admin.templates.dashboard')

@section('content')
    <div class="content-wrapper admins-show">
        @include('admin.includes.content-header')
        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('message'))
                    @include('admin.includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h2 class="font-weight-bold d-inline-block mr-2 mb-0">{{ $admin_user->name }}</h2>
                            <div class="text-pill alert-default-{{ $admin_user->status ? 'success' : 'danger' }} text-sm">
                                {{ $admin_user->status ? 'active' : 'inactive' }}</div>
                        </div>
                        <span class="text-muted">{{ '@' . $admin_user->username }} ·
                            {{ $admin_user->admin_role->name }}</span>
                        <p class="mb-0 mt-3">
                            <i class="fas fa-fw fa-envelope text-primary"></i> {{ $admin_user->email }}<br>
                            <i class="fas fa-fw fa-calendar-alt text-primary"></i> created at
                            {{ $admin_user->created_at->format('F j, Y') }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <a href="{{ route('admin.admins.index') }}" class="btn btn-transparent"><i
                                        class="fas fa-fw fa-chevron-left"></i> Back</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('admin.admins.edit', ['id' => $admin_user->id]) }}"
                                    class="btn btn-info"><i class="fas fa-fw fa-pen"></i> Edit</a>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-danger btn-delete" data-name="{{ $admin_user->username }}"
                                    data-model="admin"
                                    data-link="{{ route('admin.admins.destroy', ['id' => $admin_user->id]) }}"
                                    data-toggle="modal" data-target=".modal-delete"><i class="fas fa-fw fa-trash-alt"></i>
                                    Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        @include('admin.includes.modal-delete')
    </div>
@endsection()

@extends('admin.templates.dashboard')

@section('content')
    <div class="content-wrapper roles-show">
        @include('admin.includes.content-header')
        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('message'))
                    @include('admin.includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                @endif
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-bold mr-2 mb-0">{{ $role->name }}</h2>
                        <span class="text-muted">{{ $role->slug }} ·
                            {{ $role->desc && $role->desc != '' ? $role->desc : 'no description' }}</span>
                        <p class="mb-0 mt-3">
                            <i class="fas fa-fw fa-calendar-alt text-primary"></i> created at
                            {{ $role->created_at->format('F j, Y') }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-transparent"><i
                                        class="fas fa-fw fa-chevron-left"></i> Back</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('admin.roles.edit', ['id' => $role->id]) }}" class="btn btn-info"><i
                                        class="fas fa-fw fa-pen"></i> Edit</a>
                            </div>
                            @if (!in_array($role->slug, ['super-admin', 'admin']))
                                <div class="col-auto">
                                    <button class="btn btn-danger btn-delete" data-name="{{ $role->name }}"
                                        data-model="role"
                                        data-link="{{ route('admin.roles.destroy', ['id' => $role->id]) }}"
                                        data-toggle="modal" data-target=".modal-delete"><i
                                            class="fas fa-fw fa-trash-alt"></i>
                                        Delete</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        @include('admin.includes.modal-delete')
    </div>
@endsection()

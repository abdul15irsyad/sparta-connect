@extends('admin.templates.dashboard')

@section('content')
    <div class="content-wrapper permissions-edit">
        @include('admin.includes.content-header')
        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('message'))
                    @include('admin.includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                @endif
                <form action="{{ route('admin.permissions.update', ['id' => $permission->id]) }}" method="post"
                    autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-body row">
                            <div class="form-group col-12">
                                <label for="name">Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="eg: Create Admin"
                                        value="{{ old('name', $permission->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback pl-2" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <a href="{{ route('admin.permissions.index') }}"
                                        class="btn btn-transparent">Cancel</a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save
                                        Permission</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </form>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

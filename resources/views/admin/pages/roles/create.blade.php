@extends('admin.templates.dashboard')

@section('content-style')
    <!-- Select2 css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-wrapper roles-create">
        @include('admin.includes.content-header')
        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('message'))
                    @include('admin.includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                @endif
                <form action="{{ route('admin.roles.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="card">
                        <div class="card-body row">
                            <div class="form-group col-12">
                                <label for="name">Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="eg: Administrator" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback pl-2" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="desc">Description</label>
                                <div class="input-group">
                                    <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc"
                                        placeholder="Write role description here..." rows="4">{{ old('desc') }}</textarea>
                                    @error('desc')
                                        <span class="invalid-feedback pl-2" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-transparent">Cancel</a>
                                </div>
                                <div class="col-auto">
                                    <input type="submit" class="btn btn-primary" value="Create Admin">
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

@section('content-javascript')
    <!-- Select2 javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection

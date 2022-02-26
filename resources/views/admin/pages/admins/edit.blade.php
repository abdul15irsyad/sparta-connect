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
    <div class="content-wrapper admins-edit">
        @include('admin.includes.content-header')
        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('message'))
                    @include('admin.includes.alert',['dismissible'=>true,'message'=>session('message'),'type'=>session('type')])
                @endif
                <form action="{{ route('admin.admins.update', ['id' => $admin_user->id]) }}" method="post"
                    autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-body row">
                            <div class="form-group col-lg-6 col-12">
                                <label for="name">Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="eg: John Doe"
                                        value="{{ old('name', $admin_user->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback pl-2" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="username" class="d-block">
                                    Username&nbsp;
                                    <i class="fas fa fw fa-info-circle text-sm text-info" data-toggle="tooltip"
                                        data-placement="top"
                                        title='Minimum 3 characters and only lowercase (a-z), numbers (0-9), or underscore ("_")'></i>
                                </label>
                                <span class="text-sm text-secondary"></span>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" placeholder="eg: johndoe8"
                                        value="{{ old('username', $admin_user->username) }}">
                                    @error('username')
                                        <span class="invalid-feedback pl-2" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" placeholder="eg: example@email.com"
                                        value="{{ old('email', $admin_user->email) }}">
                                    @error('email')
                                        <span class="invalid-feedback pl-2" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="password" class="d-block">
                                    Password&nbsp;
                                    <i class="fas fa fw fa-info-circle text-sm text-info" data-toggle="tooltip"
                                        data-placement="top"
                                        title="Minimum 8 characters and must contain lowercase (a-z), uppercase (A-Z), and numbers (0-9). Leave it empty if you don't want to change password"></i>
                                </label>
                                <div class="input-group input-password">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="********"
                                        value="{{ old('password') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-fw fa-eye btn-show-password" data-toggle="tooltip"
                                                data-placement="top" title="show"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block pl-2" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="confirm_password">Confirm Password</label>
                                <div class="input-group input-password">
                                    <input type="password"
                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                        id="confirm_password" name="confirm_password" placeholder="retype your password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-fw fa-eye btn-show-password" data-toggle="tooltip"
                                                data-placement="top" title="show"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('confirm_password')
                                    <span class="invalid-feedback d-block pl-2" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="role">Role</label>
                                <div class="input-group">
                                    <select class="form-control select2 @error('role') is-invalid @enderror" id="role"
                                        name="role">
                                        @foreach ($admin_roles as $role)
                                            <option value="{{ $role->slug }}"
                                                <?= old('role', $admin_user->admin_role->slug) == $role->slug ? 'selected' : '' ?>>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback pl-2" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="status">Status</label>
                                <div class="input-group">
                                    <select class="form-control select2 @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        @foreach ([['label' => 'Active', 'value' => '1'], ['label' => 'Inactive', 'value' => '0']] as $status)
                                            <option value="{{ $status['value'] }}"
                                                <?= old('status', $admin_user->status) == $status['value'] ? 'selected' : '' ?>>
                                                {{ $status['label'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
                                    <span class="invalid-feedback d-block pl-2" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <a href="{{ url()->previous() != route('admin.admins.index')? route('admin.admins.show', ['id' => $admin_user->id]): route('admin.admins.index') }}"
                                        class="btn btn-transparent">Cancel</a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save
                                        Admin</button>
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
@endsection()

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

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light pr-3">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link btn btn-transparent" href="#" title="Notification">
                <i class="fas fa-bell"></i>
                @if (auth('admin')->user()->unreadNotifications->count() > 0)
                    <span
                        class="badge badge-danger navbar-badge">{{ auth('admin')->user()->unreadNotifications->count() }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-transparent" href="#" title="Settings">
                <i class="fas fa-cog"></i>
            </a>
        </li>
        <li class="nav-item dropdown ml-3">
            <a href="#" class="btn btn-transparent text-secondary text-md" data-toggle="dropdown">
                <img class="img-circle border mr-1 d-none d-md-inline"
                    src="{{ asset('admin/images/default-user.jpg') }}" alt="" height="24">
                <span>{{ auth('admin')->user()->username }} <i class="fas fa-fw fa-chevron-down text-xs"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="#" class="dropdown-item"><i class="fas fa-user fa-fw mr-2"></i>
                    Profile</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item hover-danger" data-toggle="modal" data-target="#modal-logout"><i
                        class="fa-solid fa-fw fa-arrow-right-from-bracket mr-2"></i> Logout</a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<!-- Modal Logout -->
<div class="modal fade modal-logout" id="modal-logout" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logout Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to logout from <b>{{ auth('admin')->user()->username }}</b> account ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent" data-dismiss="modal">Cancel</button>
                <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-logout"><i
                        class="fa-solid fa-fw fa-arrow-right-from-bracket mr-1"></i> Logout</a>
            </div>
        </div>
    </div>
</div>

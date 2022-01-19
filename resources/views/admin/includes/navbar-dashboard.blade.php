<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light pr-3">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link btn btn-transparent" href="#" title="Notification">
                <i class="fas fa-bell"></i>
                @if(auth('web')->user()->unreadNotifications->count()>0)
                <span class="badge badge-danger navbar-badge">{{ auth('web')->user()->unreadNotifications->count() }}</span>
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
                <img class="img-circle border mr-1 d-none d-lg-inline" src="{{ asset('images/default-user.jpg') }}" alt="" height="24">
                <span>{{ auth()->user()->user_username }} <i class="fas fa-fw fa-chevron-down text-xs"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="{{ route('profile') }}" class="dropdown-item"><i class="fas fa-user fa-fw mr-2"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item hover-danger" data-toggle="modal" data-target="#modal-logout"><i class="fas fa-sign-out-alt fa-fw mr-2"></i> Logout</a>
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
                <p>Are you sure want to logout from <b>{{ auth('web')->user()->user_username }}</b> account ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent" data-dismiss="modal">Cancel</button>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-logout"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</div>

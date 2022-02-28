<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('images/sparta-logo.png') }}" alt="Sparta Connect Logo" class="brand-image">
        <span class="brand-text text-white">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#">
            <div class="user-panel pb-2 mt-2 mb-2 d-flex align-items-center">
                <div class="image">
                    <img src="{{ asset('admin/images/default-user.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <span class="text-white d-block">{{ auth('admin')->user()->name }}</span>
                    <span class="text-grey text-sm d-block">{{ auth('admin')->user()->admin_role->name }}</span>
                </div>
            </div>
        </a>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ $sidebar_active == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-fw fa-gauge"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @canany(['read-admin', 'read-role', 'read-permission', 'read-activity-log'])
                    <li
                        class="nav-item {{ in_array($sidebar_active, ['admins', 'roles', 'permissions', 'activity-log'])? 'menu-is-opening menu-open': '' }}">
                        <a href="#"
                            class="nav-link {{ in_array($sidebar_active, ['admins', 'roles', 'permissions', 'activity-log']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Admin Management<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('read-admin')
                                <li class="nav-item">
                                    <a href="{{ route('admin.admins.index') }}"
                                        class="nav-link {{ $sidebar_active == 'admins' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-fw fa-user-cog"></i>
                                        <p>Admins</p>
                                    </a>
                                </li>
                            @endcan
                            @can('read-roles')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link {{ $sidebar_active == 'roles' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-fw fa-cogs"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            @endcan
                            @can('read-permission')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}"
                                        class="nav-link {{ $sidebar_active == 'permissions' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-fw fa-key"></i>
                                        <p>Permissions</p>
                                    </a>
                                </li>
                            @endcan
                            @can('read-activity-log')
                                <li class="nav-item">
                                    <a href="{{ route('admin.activity-log.index') }}"
                                        class="nav-link {{ $sidebar_active == 'activity-log' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-fw fa-wave-square"></i>
                                        <p>Activity Log</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['read-user', 'read-user-activity-log'])
                    <li
                        class="nav-item {{ in_array($sidebar_active, ['users', 'user-activity-log']) ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ in_array($sidebar_active, ['users', 'user-activity-log']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-users"></i>
                            <p>User Management<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('read-user')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="nav-link {{ $sidebar_active == 'users' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-fw fa-users"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            @endcan
                            @can('read-user-activity-log')
                                <li class="nav-item">
                                    <a href="{{ route('admin.user-activity-log.index') }}"
                                        class="nav-link {{ $sidebar_active == 'user-activity-log' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-fw fa-wave-square"></i>
                                        <p>User Activity Log</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                <li class="nav-item mt-4">
                    <a href="{{ route('home') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-house"></i>
                        <p>Sparta Connect</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

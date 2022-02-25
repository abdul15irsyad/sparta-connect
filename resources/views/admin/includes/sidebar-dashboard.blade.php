<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin-dashboard') }}" class="brand-link">
        <img src="{{ asset('images/sparta-logo.png') }}" alt="Sparta Connect Logo" class="brand-image">
        <span class="brand-text text-white">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin-dashboard') }}"
                        class="nav-link {{ $sidebar_active == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ in_array($sidebar_active, ['admins', 'roles', 'permissions', 'activity-log'])? 'menu-is-opening menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ in_array($sidebar_active, ['admins', 'roles', 'permissions', 'activity-log']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Admin Management<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin-admins') }}"
                                class="nav-link {{ $sidebar_active == 'admins' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-roles') }}"
                                class="nav-link {{ $sidebar_active == 'roles' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-permissions') }}"
                                class="nav-link {{ $sidebar_active == 'permissions' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-activity-log') }}"
                                class="nav-link {{ $sidebar_active == 'activity-log' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-wave-square"></i>
                                <p>Activity Log</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mt-4">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-link"></i>
                        <p>Sparta Connect</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

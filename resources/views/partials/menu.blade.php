<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="{{ route("admin.home") }}" class="brand-link">
        <span class="brand-text font-weight-light font-weight-bold">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.principal') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user">
                            
                        </i>
                        <p>
                            <span>{{ trans('cruds.user.title') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.faltas.index") }}" class="nav-link {{ request()->is('admin/faltas') || request()->is('admin/faltas/*') ? 'active' : '' }}">
                        <i class="fas fa-angle-double-down">
                            
                        </i>
                        <p>
                            <span>{{ trans('cruds.faltas.title') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
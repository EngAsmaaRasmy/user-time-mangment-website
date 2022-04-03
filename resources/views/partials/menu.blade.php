<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            @can('dashboard')
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @endcan
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    Permissions
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    Roles
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    Users
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('pharmacy_access')
                <li class="nav-item">
                    <a href="{{ route("admin.pharmacies.index") }}" class="nav-link {{ request()->is('admin/pharmacies') || request()->is('admin/pharmacies/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-school nav-icon">

                        </i>
                        Pharmacies
                    </a>
                </li>
            @endcan
            @can('dataRange_access')
            <li class="nav-item">
                <a href="{{ route("admin.times.index") }}" class="nav-link {{ request()->is('admin/times') || request()->is('admin/times/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-clock nav-icon">

                    </i>
                    Time Tables
                </a>
            </li>
            @endcan
            {{-- @can('dataRange_access')
                <li class="nav-item">
                    <a href="{{ route("admin.times.index") }}" class="nav-link {{ request()->is('admin/times') || request()->is('admin/times/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-clock nav-icon">

                        </i>
                       Add Time Table
                    </a>
                </li>
            @endcan --}}
            @can('dataRange_access')
            <li class="nav-item">
                <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is('admin/events') || request()->is('admin/events/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-clock nav-icon">

                    </i>
                   Events
                </a>
            </li>
        @endcan
        @can('user_calender')
            <li class="nav-item">
                <a href="{{ route("admin.calendar.index") }}" class="nav-link {{ request()->is('admin/calendar') || request()->is('admin/calendar/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-calendar nav-icon">

                    </i>
                    Calendar
                </a>
            </li>
        @endcan
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

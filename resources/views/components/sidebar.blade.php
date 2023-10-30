<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.leads.index') }}" class="nav-link {{ Route::is('admin.leads.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Leads
                </p>
            </a>
        </li>
        <li class="nav-item {{ Route::is('admin.campaigns*') ? 'menu-is-opening' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                    Campaigns
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="{{ Route::is('admin.campaigns*') ? 'display: block;' : '' }}">
                <li class="nav-item">
                    <a href="{{ route('admin.campaigns.create') }}" class="nav-link {{ Route::is('admin.campaigns.create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-success"></i>
                        <p>New Campaign</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.campaigns.ongoing') }}" class="nav-link {{ Route::is('admin.campaigns.ongoing') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-fuchsia"></i>
                        <p>Ongoing Campaigns</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.campaigns.history') }}" class="nav-link {{ Route::is('admin.campaigns.history') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon text-indigo"></i>
                        <p>Campaigns History</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.mailservers') }}" class="nav-link {{ Route::is('admin.mailservers') ? 'active' : '' }}">
                <i class="nav-icon fas fa-external-link-square-alt"></i>
                <p>
                    Sending Servers
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.feeds.index') }}" class="nav-link {{ Route::is('admin.feeds.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-rss-square"></i>
                <p>
                    Imports
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Users
                    <span class="badge badge-info right">{{$userCount}}</span>
                </p>
            </a>
        </li>
    </ul>
</nav>

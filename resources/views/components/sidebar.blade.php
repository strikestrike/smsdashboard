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
        <li class="nav-item">
            <a href="{{ route('admin.campaigns') }}" class="nav-link {{ Route::is('admin.campaigns') ? 'active' : '' }}">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                    Campaigns
                </p>
            </a>
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
            <a href="{{ route('admin.feeds') }}" class="nav-link {{ Route::is('admin.feeds') ? 'active' : '' }}">
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

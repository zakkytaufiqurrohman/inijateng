<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/home">IPPAT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">IP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            @role('admin')
            <li class="nav-item dropdown {{ (request()->is('user*','role*','permission*','master_data*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Master</span></a>
                <ul class="dropdown-menu">
                    <!-- @can('user') -->
                    <li class="{{ (request()->is('user*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.index') }}">User</a></li>
                    <!-- @endcan -->
                    
                    <li class="{{ (request()->is('role*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('role') }}">Role</a></li>
                   
                    <li class="{{ (request()->is('permission*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('permission') }}">Permission</a></li>
                    <li class="{{ (request()->is('master_data*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('master_data') }}">Master Data</a></li>
                   
                </ul>
            </li>
            @endrole
            @role('notaris')
            <li class="nav-item {{ (request()->is('notaris*')) ? 'active' : '' }}">
                <a href="{{ route('notaris.data_diri') }}" class="nav-link"><i class="fas fa-user-circle"></i><span>Data Diri</span></a>
            </li>
            @endrole
            @role('alb')
            <li class="nav-item {{ (request()->is('berkas*')) ? 'active' : '' }}">
                <a href="{{ route('permission') }}" class="nav-link"><i class="fas fa-file-alt"></i><span>Berkas</span></a>
            </li>
            <li class="nav-item {{ (request()->is('berkas*')) ? 'active' : '' }}">
                <a href="{{ route('permission') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>Magang Bersama</span></a>
            </li>
            @endrole
            
            
    </aside>
</div>
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
            {{-- @if(auth()->user()->can('user') || auth()->user()->can('role') || auth()->user()->can('permission'))  --}}
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
            
    </aside>
</div>
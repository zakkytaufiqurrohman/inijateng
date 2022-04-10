<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard"><img src="{{asset('assets/img/logo.png')}}" width="70px" height="70px" alt=""></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">INI</a>
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
            <li class="nav-item {{ (request()->is('profile*')) ? 'active' : '' }}">
                <a href="{{ route('profile') }}" class="nav-link"><i class="fas fa-user-circle"></i><span>{{auth()->user()->name}}</span></a>
            </li>
            @role('notaris')
            <li class="nav-item {{ (request()->is('notaris*')) ? 'active' : '' }}">
                <a href="{{ route('notaris.data_diri') }}" class="nav-link"><i class="fas fa-address-book"></i><span>Data Diri</span></a>
            </li>
            @endrole
            @role('alb')
            <li class="nav-item {{ (request()->is('alb/data_diri*')) ? 'active' : '' }}">
                <a href="{{ route('alb.data_diri') }}" class="nav-link"><i class="fas fa-address-book"></i><span>Data Diri</span></a>
            </li>
            <li class="nav-item {{ (request()->is('alb/berkas*')) ? 'active' : '' }}">
                <a href="{{ route('alb.berkas') }}" class="nav-link"><i class="fas fa-file-alt"></i><span>Berkas</span></a>
            </li>
            <li class="nav-item {{ (request()->is('alb/magang*')) ? 'active' : '' }}">
                <a href="{{ route('alb.magang') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>Magang</span></a>
            </li>
            @endrole
            @role('admin')
            <li class="menu-header">Maber</li>
            <li class="nav-item {{ (request()->is('maber*')) ? 'active' : '' }}">
                <a href="{{ route('maber') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>list Maber</span></a>
            </li>
          
            <!-- bendahara -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Bendahara</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('bendahara_maber*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara_maber.index',0) }}">Belum Terverifikasi</a></li>
                    
                    
                    <li class="{{ (request()->is('bendahara_maber*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara_maber.index',1) }}">Sudah Terverifikasi</a></li>   
                </ul>
            </li>
            <!-- verivikator -->
            <li class="nav-item dropdown {{ (request()->is('verifikasi*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Verifikator</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('verifikasi/maber/1*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[1,0]) }}">Maber 1 (Belum Verifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/1*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[1,1]) }}">Maber 1 (Terverifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/2*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[2,0]) }}">Maber 2 (Belum Verifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/2*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[2,1]) }}">Maber 2 (Terverifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/3*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[3,0]) }}">Maber 3 (Belum Verifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/3*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[3,1]) }}">Maber 3 (Terverifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/4*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[4,0]) }}">Maber 4 (Belum Verifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/4*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[4,1]) }}">Maber 4 (Terverifikasi)</a></li>
                </ul>
            </li>

            <!-- alb -->
            <li class="menu-header">ALB</li>
            <!-- list maber just admin  -->
            <li class="nav-item {{ (request()->is('alb_event*')) ? 'active' : '' }}">
                <a href="{{ route('alb_event') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>list ALB</span></a>
            </li>
            <!-- bendahara -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Bendahara</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('role*')) ? 'active' : '' }}"><a href="{{ route('bendahara_alb.index',0) }}" class="nav-link" href="">Belum Terverifikasi</a></li>
                    
                    
                    <li class="{{ (request()->is('role*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara_alb.index',1) }}">Sudah Terverifikasi</a></li>   
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Verifikator</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('role*')) ? 'active' : '' }}"><a class="nav-link" href="">Belum Terverifikasi</a></li>
                    
                    
                    <li class="{{ (request()->is('role*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('role') }}">SUdah Terverifikasi</a></li>   
                </ul>
            </li>

            <!-- front page -->
            <li class="menu-header">Front Page</li>
            <!-- list maber just admin  -->
            <li class="nav-item {{ (request()->is('berkas*')) ? 'active' : '' }}">
                <a href="{{ route('profile_page') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>Profile</span></a>
            </li>
            @endrole
            
    </aside>
</div>
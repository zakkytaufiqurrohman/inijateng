<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand" style="margin-bottom: 10px;">
            <a href="/dashboard"><img src="{{asset('assets/img/nav.png')}}" width="200px" height="30px" alt=""></a>
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
                <a href="{{ route('profile') }}" class="nav-link"><i class="fas fa-user-circle"></i><span>Profile</span></a>
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
                <a href="{{ route('alb.magang') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>Riwayat Magang</span></a>
            </li>
            @endrole
            <li class="menu-header">Maber</li>

            <li class="nav-item {{ (request()->is('maber*')) ? 'active' : '' }}">
                <a href="{{ route('maber') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>list Maber</span></a>
            </li>
          
            <!-- bendahara -->
            <li class="nav-item dropdown {{ (request()->is('bendahara/maber/*')) ? 'active' : '' }}"">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-bill-alt"></i><span>Bendahara</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('bendahara/maber/0')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara_maber.index',0) }}">Belum Terverifikasi</a></li>
                    
                    
                    <li class="{{ (request()->is('bendahara/maber/1')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara_maber.index',1) }}">Sudah Terverifikasi</a></li>   
                </ul>
            </li>
            <!-- verivikator -->
            <li class="nav-item dropdown {{ (request()->is('verifikasi/maber*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-wrench"></i><span>Verifikator</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('verifikasi/maber/1/0')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[1,0]) }}">Maber 1 (Belum Verifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/1/1')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[1,1]) }}">Maber 1 (Terverifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/2/0')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[2,0]) }}">Maber 2 (Belum Verifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/2/1')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[2,1]) }}">Maber 2 (Terverifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/3/0')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[3,0]) }}">Maber 3 (Belum Verifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/3/1')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[3,1]) }}">Maber 3 (Terverifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/4/0')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[4,0]) }}">Maber 4 (Belum Verifikasi)</a></li>
                    <li class="{{ (request()->is('verifikasi/maber/4/1')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_maber.index',[4,1]) }}">Maber 4 (Terverifikasi)</a></li>
                </ul>
            </li>
    <!-- alb -->
            @if(auth()->user()->can('all') || auth()->user()->can('bendahara_alb') ||  auth()->user()->can('verifikator_alb') )
            <li class="menu-header">ALB</li>
            <!-- list maber just admin  -->
            @if(auth()->user()->can('all'))
            <li class="nav-item {{ (request()->is('alb_event*')) ? 'active' : '' }}">
                <a href="{{ route('alb_event') }}" class="nav-link"><i class="fas fa-user-graduate	"></i><span>list ALB</span></a>
            </li>
            @endif
            <!-- bendahara -->
            @if(auth()->user()->can('all') || auth()->user()->can('bendahara_alb'))
            <li class="nav-item dropdown {{ (request()->is('bendahara/alb/*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-bill-alt"></i><span>Bendahara</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('bendahara/alb/0')) ? 'active' : '' }}"><a href="{{ route('bendahara_alb.index',0) }}" class="nav-link" href="">Belum Terverifikasi</a></li>
                    
                    
                    <li class="{{ (request()->is('bendahara/alb/1')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara_alb.index',1) }}">Sudah Terverifikasi</a></li>   
                </ul>
            </li>
            @endif
            @if(auth()->user()->can('all') || auth()->user()->can('verifikator_alb'))
            <li class="nav-item dropdown {{ (request()->is('verifikasi/alb*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-wrench"></i><span>Verifikator</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('verifikasi/alb/0')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_alb.index',0) }}">Belum Terverifikasi</a></li>
                    
                    
                    <li class="{{ (request()->is('verifikasi/alb/1')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('verifikasi_alb.index',1) }}">Sudah Terverifikasi</a></li>   
                </ul>
            </li>
            @endif
            @if(auth()->user()->can('all'))
            <li class="nav-item dropdown {{ (request()->is('nilai/alb*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-wrench"></i><span>Penilaian</span></a>
                <ul class="dropdown-menu">
                  
                    <li class="{{ (request()->is('nilai/alb/0')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('nilai.index',0) }}">Belum Dinilai</a></li>
                    
                    
                    <li class="{{ (request()->is('nilai/alb/1')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('nilai.index',1) }}">Sudah Dinilai</a></li>   
                </ul>
            </li>
            @endif

        @endif
            <li class="menu-header">Laporan</li>
            <li class="nav-item {{ (request()->is('laporan*')) ? 'active' : '' }}">
                <a href="{{ route('laporan.transaksi') }}" class="nav-link"><i class="fas fa-newspaper"></i><span>Lap Transaksi</span></a>
            </li>
            <li class="nav-item {{ (request()->is('preview_riwayat*')) ? 'active' : '' }}">
                <a href="{{ route('preview_riwayat.index') }}" class="nav-link"><i class="fas fa-history"></i><span>Preview Ttmb & Riwayat</span></a>
            </li>

            <!-- front page -->
            <li class="menu-header">Front Page</li>
            <!-- list maber just admin  -->
            <li class="nav-item {{ (request()->is('berkas*')) ? 'active' : '' }}">
                <a href="{{ route('profile_page') }}" class="nav-link"><i class="fas fa-user-cog"></i><span>Profile</span></a>
            </li>            
    </aside>
</div>
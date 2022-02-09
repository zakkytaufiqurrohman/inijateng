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
            @if(auth()->user()->can('user') || auth()->user()->can('role') || auth()->user()->can('permission'))
            <li class="nav-item dropdown {{ (request()->is('user*','role*','permission*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Master</span></a>
                <ul class="dropdown-menu">
                    @can('user')
                    <li class="{{ (request()->is('user*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.index') }}">User</a></li>
                    @endcan
                    @can('role')
                    <li class="{{ (request()->is('role*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('role') }}">Role</a></li>
                    @endcan
                    @can('permission')
                    <li class="{{ (request()->is('permission*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('permission') }}">Permission</a></li>
                    @endcan
                </ul>
            </li>
            @endif
            @if(auth()->user()->can('mesin') || auth()->user()->can('sparepart') || auth()->user()->can('waktuNotif'))
            <li class="nav-item dropdown {{ (request()->is('mesin*','sparepart*','setting*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>Setting</span></a>
                <ul class="dropdown-menu">
                    @can('mesin')
                    <li class="{{ (request()->is('mesin*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('mesin') }}">Mesin</a></li>
                    @endcan
                    @can('sparepart')
                    <li class="{{ (request()->is('sparepart*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('sparepart') }}">Sparepart</a></li>
                    @endcan
                    @can('waktuNotif')
                    <li class="{{ (request()->is('setting')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('setting') }}">Waktu Notif</a></li>
                    @endcan
                    <li class="{{ (request()->is('setting/slack_logistik*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('setting.slack_logistik') }}">Slack Logistik</a></li>
                </ul>
            </li>
            @endif
            @if(auth()->user()->can('transaksiAwal') || auth()->user()->can('transaksi'))
            <li class="nav-item dropdown {{ (request()->is('transaksi*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-highlighter"></i><span>Transaksi</span></a>
                <ul class="dropdown-menu">
                    @can('transaksiAwal')
                    <li class="{{ (request()->is('transaksi_awal')) ? 'active' : '' }}"><a class="nav-link" href="{{route('transaksi_awal')}}">Transaksi Awal</a></li>
                    @endcan
                    @can('transaksi')
                    <li class="{{ (request()->is('transaksi')) ? 'active' : '' }}"><a class="nav-link" href="{{route('transaksi')}}">Transaksi</a></li>
                    @endcan
                </ul>
            </li>
            @endif
            @if(auth()->user()->can('butuhPerbaikan') || auth()->user()->can('historyPerbaikan'))
            <li class="nav-item dropdown {{ (request()->is('laporan/perbaikan*','laporan/history_perbaikan*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fax"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    @can('butuhPerbaikan')
                    <li class="{{ (request()->is('laporan/perbaikan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan.butuh_perbaikan') }}">Butuh Perbaikan</a></li>
                    @endcan
                    @can('historyPerbaikan')
                    <li class="{{ (request()->is('laporan/history_perbaikan*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan.history_perbaikan') }}">History Perbaikan</a></li>
                    @endcan
                </ul>
            </li>
            @endif
    </aside>
</div>
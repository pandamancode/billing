<ul class="px-nav-content">
    <li class="px-nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('home.index') }}"><i class="px-nav-icon fa fa-home"></i><span
                class="px-nav-label">Dashboard</span></a>
    </li>
    <li class="px-nav-item {{ request()->is('jadwal*') ? 'active' : '' }}">
        <a href="{{ route('jadwal.index') }}"><i class="px-nav-icon fa fa-calendar-o"></i>
            <span class="px-nav-label">Jadwal Ujian</span>
        </a>
    </li>
    <li class="px-nav-item {{ request()->is('riwayat*') ? 'active' : '' }}">
        <a href="{{ route('riwayat.index') }}"><i class="px-nav-icon fa fa-history"></i>
            <span class="px-nav-label">Riwayat Ujian</span>
        </a>
    </li>
</ul>
    
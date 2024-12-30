<ul class="px-nav-content">
    <li class="px-nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('home.index') }}"><i class="px-nav-icon fa fa-home"></i><span
                class="px-nav-label">Dashboard</span></a>
    </li>

    <li class="px-nav-item {{ request()->is('category*') ? 'active' : '' }}">
        <a href="{{ route('category.index') }}"><i class="px-nav-icon fa fa-tags"></i>
            <span class="px-nav-label">Category</span>
        </a>
    </li>

    <li class="px-nav-item {{ request()->is('product*') ? 'active' : '' }}">
        <a href="{{ route('product.index') }}"><i class="px-nav-icon fa fa-cubes"></i>
            <span class="px-nav-label">Product</span>
        </a>
    </li>
    
    <li class="px-nav-item {{ request()->is('rent*') ? 'active' : '' }}">
        <a href="{{ route('rent.index') }}"><i class="px-nav-icon fa fa-fax"></i>
            <span class="px-nav-label">Rent</span>
        </a>
    </li>

    <li class="px-nav-item {{ request()->is('laporan*') ? 'active' : '' }}">
        <a href="#"><i class="px-nav-icon fa fa-print"></i>
            <span class="px-nav-label">Laporan</span>
        </a>
    </li>
    

</ul>
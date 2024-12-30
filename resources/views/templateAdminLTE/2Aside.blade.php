<nav class="px-nav px-nav-left">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
        <span class="px-nav-toggle-arrow"></span>
        <span class="navbar-toggle-icon"></span>
        <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>
    @if (Auth::user()->level == 'admin')
        @include('templateAdminLTE.sidebar.admin')
    @else
        @include('templateAdminLTE.sidebar.operator')
    @endif
</nav>

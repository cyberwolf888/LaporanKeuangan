<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item @if (Route::currentRouteName() === 'dashboard') active open @endif start">
        <a href="{{ url('/dirut') }}" class="nav-link">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
        </a>

    </li>
    <li class="heading">
        <h3 class="uppercase">Manage Data</h3>
    </li>
    <li class="nav-item @if (Route::currentRouteName() === 'pasar') active @endif">
        <a href="{{ url('/dirut/pasar') }}" class="nav-link">
            <i class="icon-diamond"></i>
            <span class="title">Pasar</span>
        </a>
    </li>
    <li class="nav-item  @if (Route::currentRouteName() === 'dagang') active @endif">
        <a href="{{ url('/dirut/dagang') }}" class="nav-link">
            <i class="icon-puzzle"></i>
            <span class="title">Dagang</span>
        </a>
    </li>
    <li class="nav-item @if (str_is('pegawai*', Route::currentRouteName())) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-notebook"></i>
            <span class="title">Pegawai</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="{{ url('/dirut/pegawai/dirut') }}" class="nav-link ">
                    <span class="title">Dirut</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('/dirut/pegawai/operator') }}" class="nav-link ">
                    <span class="title">Operator</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('/dirut/pegawai/petugas') }}" class="nav-link ">
                    <span class="title">Petugas</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item  @if (Route::currentRouteName() === 'tarif') active @endif">
        <a href="{{ url('/dirut/tarif') }}" class="nav-link">
            <i class="icon-basket"></i>
            <span class="title">Tarif</span>
        </a>
    </li>
    <li class="heading">
        <h3 class="uppercase">Features</h3>
    </li>
    <li class="nav-item @if (str_is('laporan*', Route::currentRouteName())) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-layers"></i>
            <span class="title">Reports</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="{{ url('/dirut/laporan/keuangan') }}" class="nav-link ">
                    <span class="title">Keuangan</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('/dirut/laporan/dagang') }}" class="nav-link ">
                    <span class="title">Dagang</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="heading">
        <h3 class="uppercase">Settings</h3>
    </li>
    <li class="nav-item  @if (Route::currentRouteName() === 'profile') active @endif">
        <a href="javascript:;" class="nav-link">
            <i class="icon-user"></i>
            <span class="title">Profile</span>
        </a>
    </li>
    <li class="nav-item  ">
        <a href="{{ url('/logout') }}" class="nav-link">
            <i class="icon-settings"></i>
            <span class="title">Logout</span>
        </a>
    </li>
</ul>
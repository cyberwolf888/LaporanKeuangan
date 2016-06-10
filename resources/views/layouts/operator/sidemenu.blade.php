<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item @if (Route::currentRouteName() === 'dashboard') active open @endif start">
        <a href="{{ url('/operator') }}" class="nav-link">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
        </a>

    </li>
    <li class="heading">
        <h3 class="uppercase">Manage Data</h3>
    </li>
    <li class="nav-item @if (Route::currentRouteName() === 'pasar') active @endif">
        <a href="{{ url('/operator/pasar') }}" class="nav-link">
            <i class="icon-diamond"></i>
            <span class="title">Pasar</span>
        </a>
    </li>
    <li class="nav-item @if (Route::currentRouteName() === 'komoditas') active @endif">
        <a href="{{ url('/operator/komoditas') }}" class="nav-link">
            <i class="icon-social-dropbox"></i>
            <span class="title">Komoditas</span>
        </a>
    </li>
    <li class="nav-item  @if (Route::currentRouteName() === 'dagang') active @endif">
        <a href="{{ url('/operator/dagang') }}" class="nav-link">
            <i class="icon-puzzle"></i>
            <span class="title">Dagang</span>
        </a>
    </li>
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link">
            <i class="icon-notebook"></i>
            <span class="title">Petugas</span>
        </a>
    </li>
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-pointer"></i>
            <span class="title">Maps</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="maps_google.html" class="nav-link ">
                    <span class="title">Google Maps</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="maps_vector.html" class="nav-link ">
                    <span class="title">Vector Maps</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="heading">
        <h3 class="uppercase">Features</h3>
    </li>
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-layers"></i>
            <span class="title">Reports</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="layout_blank_page.html" class="nav-link ">
                    <span class="title">Keuangan</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="layout_language_bar.html" class="nav-link ">
                    <span class="title">Dagang</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="heading">
        <h3 class="uppercase">Settings</h3>
    </li>
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-user"></i>
            <span class="title">User</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="page_user_profile_1.html" class="nav-link ">
                    <i class="icon-user"></i>
                    <span class="title">Profile 1</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="page_user_profile_1_account.html" class="nav-link ">
                    <i class="icon-user-female"></i>
                    <span class="title">Profile 1 Account</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-settings"></i>
            <span class="title">System</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="page_system_coming_soon.html" class="nav-link " target="_blank">
                    <span class="title">Coming Soon</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="page_system_404_1.html" class="nav-link ">
                    <span class="title">404 Page 1</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="page_system_404_2.html" class="nav-link " target="_blank">
                    <span class="title">404 Page 2</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="page_system_404_3.html" class="nav-link " target="_blank">
                    <span class="title">404 Page 3</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="page_system_500_1.html" class="nav-link ">
                    <span class="title">500 Page 1</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="page_system_500_2.html" class="nav-link " target="_blank">
                    <span class="title">500 Page 2</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-folder"></i>
            <span class="title">Multi Level Menu</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i> Item 1
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="indexb212.html?p=dashboard-2" target="_blank" class="nav-link">
                            <i class="icon-user"></i> Arrow Toggle
                            <span class="arrow nav-toggle"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-power"></i> Sample Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-paper-plane"></i> Sample Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-star"></i> Sample Link 1</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-camera"></i> Sample Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-link"></i> Sample Link 2</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-pointer"></i> Sample Link 3</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="indexb212.html?p=dashboard-2" target="_blank" class="nav-link">
                    <i class="icon-globe"></i> Arrow Toggle
                    <span class="arrow nav-toggle"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-tag"></i> Sample Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-pencil"></i> Sample Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-graph"></i> Sample Link 1</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon-bar-chart"></i> Item 3 </a>
            </li>
        </ul>
    </li>
    <li class="nav-item  ">
        <a href="{{ url('/logout') }}" class="nav-link">
            <i class="icon-settings"></i>
            <span class="title">Logout</span>
        </a>
    </li>
</ul>
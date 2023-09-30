<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <h3><b> Florateria</b></h3>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav" class="mt-2">

                <li class="sidebar-item mb-2">
                    <a class="sidebar-link {{ request()->is('index*') ? 'active' : '' }}" href="{{ route('index') }}"
                        aria-expanded="false">
                        <span>
                            <i class='bx bxs-dashboard'></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item mb-2">
                    <a class="sidebar-link {{ request()->is('player-data*') ? 'active' : '' }}"
                        href="{{ route('player-data') }}" aria-expanded="false">
                        <span>
                            <i class='bx bxs-user'></i>
                        </span>
                        <span class="hide-menu">Player Data</span>
                    </a>
                </li>
                <li class="sidebar-item mb-2">
                    <a class="sidebar-link {{ request()->is('plants-data*') ? 'active' : '' }}"
                        href="{{ route('plants-data') }}" aria-expanded="false">
                        <span>
                            <i class='bx bxs-leaf'></i>
                        </span>
                        <span class="hide-menu">Plants Data</span>
                    </a>
                </li>
                <li class="sidebar-item mb-2">
                    <a class="sidebar-link {{ request()->is('card-data*') ? 'active' : '' }}"
                        href="{{ route('card-data') }}" aria-expanded="false">
                        <span>
                            <i class='bx bxs-hdd'></i>
                        </span>
                        <span class="hide-menu">Card Inventory</span>
                    </a>
                </li>
                <li class="sidebar-item mb-2">
                    <a class="sidebar-link {{ request()->is('nfc*') ? 'active' : '' }}" href="{{ route('nfc') }}"
                        aria-expanded="false">
                        <span>
                            <i class='bx bxs-hdd'></i>
                        </span>
                        <span class="hide-menu">NFC</span>
                    </a>
                </li>

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

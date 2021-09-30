<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(auth()->user()->role == 'master')
                <li class="nav-item">
                    <a href="{{ route('office.index') }}"
                        class="nav-link {{ (request()->is('office*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Perusahaan
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role == 'master' || auth()->user()->role == 'super-admin')
                <li class="nav-item">
                    <a href="{{ route('farm.index') }}" class="nav-link {{ (request()->is('farm*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Peternakan
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item {{ (request()->is('animal*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('animal*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-horse"></i>
                        <p>
                            Ternak
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->role == 'master' || auth()->user()->role == 'super-admin' || auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('animal-category.index') }}" class="nav-link {{ (request()->is('animal-category*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('animal-data.index') }}" class="nav-link {{ (request()->is('animal-data*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->role == 'master' || auth()->user()->role == 'super-admin')
                <li class="nav-item {{ (request()->is('user*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('user*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @if(auth()->user()->role == 'master')
                        <li class="nav-item">
                            <a href="{{ route('user-all.index') }}" class="nav-link {{ (request()->is('user-all*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Semua</p>
                            </a>
                        </li>
                        @endif --}}
                        <li class="nav-item">
                            <a href="{{ route('user-office.index') }}" class="nav-link {{ (request()->is('user-office*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perusahaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user-farm.index') }}" class="nav-link {{ (request()->is('user-farm*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peternakan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->

    <a href="#" class="brand-link">
        <div class="row">
            <div class="col-md-4">
                @if (auth()->user()->role == 'master')
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="LOGO" style="width:80px; height:80px;">
            </div>
            <div class="col-md-8">
                <span class="brand-text font-weight-light" style="white-space: normal;">Master</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                @if (auth()->user()->role == 'super-admin')
                <img src="{{ $office_code = App\Models\Office::where('code', auth()->user()->code)->pluck('logo')->first() }}"
                    alt="LOGO" style="width:80px; height:80px;">

            </div>
            <div class="col-md-8">
                <span class="brand-text font-weight-light"
                    style="white-space: normal;">{{ $office_code = App\Models\Office::where('code', auth()->user()->code)->pluck('name')->first() }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'operator')
                <img src="{{ $office_code = App\Models\Farm::where('code', auth()->user()->code)->pluck('logo')->first() }}"
                    alt="LOGO" style="width:80px; height:80px;">
            </div>
            <div class="col-md-8">
                <span class="brand-text font-weight-light"
                    style="white-space: normal;">{{ $office_code = App\Models\Farm::where('code', auth()->user()->code)->pluck('name')->first() }}</span>
                @endif
            </div>
        </div>
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
                @if(auth()->user()->role == 'super-admin')
                <li class="nav-item {{ (request()->is('office*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('office*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Perusahaan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('office.edit', App\Models\Office::where('code', auth()->user()->code)->pluck('id')->first()) }}"
                                class="nav-link {{ (request()->is('office/*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('officepics.index', App\Models\Office::where('code', auth()->user()->code)->pluck('code')->first()) }}"
                                class="nav-link {{ (request()->is('officepics*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gallery</p>
                            </a>
                        </li>
                    </ul>
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
                <li class="nav-item {{ (request()->is('category*') || request()->is('data*') || request()->is('peristiwa*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('category*') || request()->is('data*')) || request()->is('peristiwa*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-horse"></i>
                        <p>
                            Ternak
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->role == 'master' || auth()->user()->role == 'super-admin' ||
                        auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ (request()->is('category*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('data.index') }}"
                                class="nav-link {{ (request()->is('data*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('peristiwa.index') }}"
                                class="nav-link {{ (request()->is('peristiwa*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peristiwa</p>
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
                            <a href="{{ route('user-all.index') }}" class="nav-link
                        {{ (request()->is('user-all*')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Semua</p>
                        </a>
                </li>
                @endif --}}
                <li class="nav-item">
                    <a href="{{ route('user-office.index') }}"
                        class="nav-link {{ (request()->is('user-office*')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Perusahaan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user-farm.index') }}"
                        class="nav-link {{ (request()->is('user-farm*')) ? 'active' : '' }}">
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
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ asset('/') }}index3.html" class="brand-link">
    <img src="{{ asset('/') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('/') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="@admin {{ route('admin.dashboard') }} @else {{ route('teknisi.dashboard') }} @endadmin" class="nav-link {{ $activePage == 'dashboard' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
              <span class="right badge badge-danger">@admin Admin @else Teknisi @endadmin</span>
            </p>
          </a>
        </li>
        @admin
          <li class="nav-item {{ $activePage == 'wilayah' || $activePage == 'kategori' || $activePage == 'teknisi' || $activePage == 'pelanggan' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $activePage == 'wilayah' || $activePage == 'kategori' || $activePage == 'teknisi' || $activePage == 'pelanggan' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.wilayah.index') }}" class="nav-link {{ $activePage == 'wilayah' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wilayah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ $activePage == 'kategori' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.teknisi.index') }}" class="nav-link {{ $activePage == 'teknisi' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teknisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pelanggan.index') }}" class="nav-link {{ $activePage == 'pelanggan' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
            </ul>
          </li>
        @endadmin
        <li class="nav-item">
          <a href="{{ route('admin.user.index') }}" class="nav-link {{ $activePage == 'user' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              User
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="@admin {{ route('admin.keluhan') }} @else {{ route('teknisi.keluhan') }} @endadmin" class="nav-link {{ $activePage == 'keluhan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Keluhan
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
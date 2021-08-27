    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(auth()->user()->hasRole('admin'))
           <li class="nav-item">
            <a href="{{ route('dashboard-admin') }}" class="nav-link {{ Request::url() == url('/dashboard-admin') ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/akun-admin') }}" class="nav-link {{ Request::url() == url('/akun-admin') ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Data Admin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/akun-dokter') }}" class="nav-link {{ Request::url() == url('/akun-dokter') ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-user-md"></i>
              <p>Data Dokter</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/akun-user') }}" class="nav-link {{ Request::url() == url('/akun-user') ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Data User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/laporan-konsultasi') }}" class="nav-link {{ Request::url() == url('/laporan-konsultasi') ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Laporan Konsultasi</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ url('/logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
               <p> Keluar</p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
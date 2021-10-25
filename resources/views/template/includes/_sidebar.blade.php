    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="font-size: 18px;">
          <li class="nav-header" style="font-weight: bold;">MENU</li>
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
              <i class="nav-icon fas fa-clipboard"></i>
              <p>Laporan Konsultasi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/ubah-password') }}" class="nav-link {{ Request::url() == url('/ubah-password') ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>Ubah Password</p>
            </a>
          </li>
          @endif
          @if(auth()->user()->hasRole('dokter'))
            <li class="nav-item">
              <a href="{{ route('dashboard-dokter') }}" class="nav-link {{ Request::url() == url('/dashboard-dokter') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/gejala') }}" class="nav-link {{ Request::url() == url('/gejala') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-heartbeat"></i>
                <p>Daftar Gejala</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/penyakit') }}" class="nav-link {{ Request::url() == url('/penyakit') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-disease"></i>
                <p>Daftar Penyakit</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/aturan') }}" class="nav-link {{ Request::url() == url('/aturan') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>Aturan</p>
              </a>
            </li>
            <li class="nav-header" style="font-weight: bold; margin-top: -20px; margin-left: -10px;">SETTING</li>
            <li class="nav-item">
              <a href="{{ url('/profile-dokter') }}/{{ Auth::user()->id }}/edit" class="nav-link {{ Request::url() == url('/profile-dokter') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-address-card"></i>
                <p>Ubah Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/ubah-password') }}" class="nav-link {{ Request::url() == url('/ubah-password') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>Ubah Password</p>
              </a>
            </li>
          @endif
          @if(auth()->user()->hasRole('user'))
            <li class="nav-item">
              <a href="{{ route('dashboard-user') }}" class="nav-link {{ Request::url() == url('/dashboard-user') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tentang') }}" class="nav-link  {{ Request::url() == url('/tentang') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-scroll"></i>
                <p>Tentang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/konsultasi') }}" class="nav-link {{ Request::url() == url('/konsultasi') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-check-circle"></i>
                <p>Konsultasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/riwayat-diagnosa') }}" class="nav-link {{ Request::url() == url('/riwayat-diagnosa') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-book-medical"></i>
                <p>Riwayat Diagnosa</p>
              </a>
            </li>
            <li class="nav-header" style="font-weight: bold; margin-top: -20px; margin-left: -10px;">SETTING</li>
            <li class="nav-item">
              <a href="{{ url('/profile') }}/{{ Auth::user()->id }}/edit" class="nav-link {{ Request::url() == url('/profile') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-address-card"></i>
                <p>Ubah Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/ubah-password') }}" class="nav-link {{ Request::url() == url('/ubah-password') ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>Ganti Password</p>
              </a>
            </li>
          @endif
      </nav>
      <!-- /.sidebar-menu -->
    </div>
<nav class="main-header navbar navbar-expand navbar-dark border-bottom-0" style="background-color: #2a3f54; color: white; font-family: 'Roboto', sans-serif;">
    <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <div class="col-md-8">
    <ul class="navbar-nav mt-3">
      <li class="nav-item">
        <h4><marquee>Sistem Pakar Diagnosa Penyakit Kulit</marquee></h4>
      </li>
    </ul>
  </div>
    
  <div class="col-md-3">
    <ul class="navbar-nav">
      @if(auth()->user()->hasRole('admin'))
      <li class="nav-item ml-auto">
        <a href="{{ route('keluar') }}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"> Logout</i>
        </a>
      </li>
      @endif
      @if(auth()->user()->hasRole('dokter'))
      <li class="nav-item ml-auto">
        <a href="{{ route('keluar') }}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"> Logout</i>
        </a>
      </li>
      @endif
      @if(auth()->user()->hasRole('user'))
      <li class="nav-item ml-auto">
        <a href="{{ route('keluar') }}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"> Logout</i>
        </a>
      </li>
      @endif
    </ul>
  </div>
</nav>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      @if(auth()->user()->hasRole('admin'))
      <li class="nav-item dropdown">
          <h3 style="margin-top: 3px; margin-right:5px;">Hallo, Admin</h3>
      </li>
      @endif
      @if(auth()->user()->hasRole('dokter'))
      <li class="nav-item dropdown">
          <h3 style="margin-top: 3px; margin-right:5px;">Hallo, Dokter</h3>
      </li>
      @endif
      @if(auth()->user()->hasRole('user'))
      <li class="nav-item dropdown">
          <h3 style="margin-top: 3px; margin-right:5px;">Hallo, User</h3>
      </li>
      @endif
    </ul>
  </nav>
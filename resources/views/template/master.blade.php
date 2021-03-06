<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Roboto -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
  <!-- DataTables Responsive -->
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.min.css">
  <!-- DataTables Fixed Header -->
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.bootstrap.min.css">
  <!-- Css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  @yield('header')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
    @include('template.includes._navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #fff; font-family: sans-serif;">
    <!-- Brand Logo -->
    @if(auth()->user()->hasRole('admin'))
    <a href="{{ route('dashboard-admin') }}" class="brand-link" style="background-color: #2a3f54; color:#fff;">
      <img src="{{ asset('admin/logo-kemkes.png') }}"
          alt="AdminLTE Logo"
          class="image img-circle"
          width="50px"
          height="45px"
          >
      <span class="brand-text font-weight-light" style="font-size: 24px;">{{ auth()->user()->nama }}</span>
    </a>
    @endif
    @if(auth()->user()->hasRole('dokter'))
    <a href="{{ route('dashboard-dokter') }}" class="brand-link" style="background-color: #2a3f54; color:#fff;">
      <img src="{{ getDokterFoto() }}"
          alt="Dokter Image"
          class="image img-circle"
          width="50px"
          height="45px"
          >
      <span class="brand-text font-weight-light">{{ auth()->user()->nama }}</span>
    </a>
    @endif
    @if(auth()->user()->hasRole('user'))
    <a href="{{ route('dashboard-user') }}" class="brand-link p-2" style="background-color: #2a3f54; color:#fff;">
      <img src="{{ getUserFoto() }}"
           alt="User Image"
           class="img-circle elevation-2 mr-2"
           width="65px"
           height="65px">
      <span class="brand-text font-weight-light">{{ auth()->user()->nama }}</span>
    </a>
    @endif
    <!-- Sidebar -->
    @include('template.includes._sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #fff;">
    <!-- Content Header  -->
     @yield('header-content')

    <!-- Main content -->
    <section class="content">
     @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    @include('template.includes._footer')
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/assets/dist/js/demo.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('datepicker/js/bootstrap-datepicker.js') }}"></script>
@yield('footer')
</body>
</html>

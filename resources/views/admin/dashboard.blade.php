@extends('template.master')

@section('tittle', 'Dashboard Admin')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Dashboard</h3>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                <span class="info-box-icon bg-primary">
                    <i class="nav-icon fas fa-user-shield"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">Admin</span>
                    <span class="info-box-number">{{ $admin }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fas fa-user-md"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Dokter</span>
                    <span class="info-box-number">{{ $dokter }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fas fa-users"></i></span>

                 <div class="info-box-content">
                    <span class="info-box-text">User</span>
                    <span class="info-box-number">{{ $user }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h3 class="card-title">User Konsultasi</h3>
                    </div>
                    <div class="card-body">
                        <!-- Jumlah Semua Konsultasi User Perbulan -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h3 class="card-title">User Konsultasi</h3>
                    </div>
                    <div class="card-body">
                        <!-- Jumlah Semua Konsultasi User -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
<script type="script/javascript"
></script>

@endsection

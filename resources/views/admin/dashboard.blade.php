@extends('template.master')

@section('tittle', 'Dashboard Admin')

@section('header')
    <style>
        #chartCount{
            font-size: 32px;
        }
    </style>
@endsection


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
                    <span class="info-box-number">{{ jumlahAdmin() }}</span>
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
                    <span class="info-box-number">{{ jumlahDokter() }}</span>
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
                    <span class="info-box-number">{{ jumlahUser() }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card callout callout-info">
                    <div class="card-body">
                        <!-- Jumlah Semua Konsultasi User -->
                        <div id="chartCount" class="text-center">
                            <h4>Total Konsultasi</h4>
                            <p>{{ jumlahKonsultasi() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Jumlah Semua Konsultasi User Perbulan -->
                        <div id="chartCountMouth">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('chartCountMouth', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Konsultasi Perbulan'
        },
        xAxis: {
            categories:{!! $bulan !!},
        },
        yAxis: {
            title: {
                text: 'Jumlah Konsultasi'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Jumlah Konsultasi',
            data: {!! $jumlah_konsultasi !!}
        }]
    });
</script>
@endsection

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
                    <div class="card-body">
                        <!-- Jumlah Semua Konsultasi User Perbulan -->
                        <div id="chartCountMouth">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Jumlah Semua Konsultasi User -->
                        <div id="chartCount">
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
            text: 'Jumlah Konsultasi Perbulan'
        },
        xAxis: {
            categories:{!! $bulan !!},
        },
        yAxis: {
            title: {
                text: 'Jumlah User Konsultasi'
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
            name: 'Bulan',
            data: {!! $jumlah_konsultasi !!}
        }]
    });

    Highcharts.chart('chartCount', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Browser market shares in January, 2018'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Chrome',
                y: 61.41,
                sliced: true,
                selected: true
            }, {
                name: 'Internet Explorer',
                y: 11.84
            }, {
                name: 'Firefox',
                y: 10.85
            }, {
                name: 'Edge',
                y: 4.67
            }, {
                name: 'Safari',
                y: 4.18
            }, {
                name: 'Other',
                y: 7.05
            }]
        }]
    });
</script>
@endsection

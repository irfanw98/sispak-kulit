@extends('template.master')

@section('tittle', 'Dashboard User')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/backend/user/dashboard/style.css') }}">
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
           <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="konsultasi" class="text-center">
                            <h4>Total Konsultasi</h4>
                            <p>{{ jumlahKonsultasiId() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chartCountKonsultasi">
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
       Highcharts.chart('chartCountKonsultasi', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Konsultasi Perbulan'
        },
        xAxis: {
            categories: {!! $bulan !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Konsultasi'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Bulan',
            data: {!! $jumlah_konsultasi !!}
        }]
    });
</script>
@endsection

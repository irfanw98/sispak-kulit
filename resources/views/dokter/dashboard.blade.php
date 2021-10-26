@extends('template.master')

@section('tittle', 'Dashboard Dokter')

@section('header')
    <style>    
        #gejala{
            font-size: 32px;
        }
        #penyakit {
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
        <div class="col-md-6">
            <div class="card callout callout-info">
                <div class="card-body">
                    <div id="gejala" class="text-center">
                        <h4>Total Gejala</h4>
                        <p>{{ jumlahGejala() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card callout callout-info">
                <div class="card-body">
                    <div id="penyakit" class="text-center">
                        <h4>Total Penyakit</h4>
                        <p>{{ jumlahPenyakit() }}</p>
                    </div>
                </div>
            </div>
        </div>
   </div>
</section>
@endsection

@section('footer')
@endsection

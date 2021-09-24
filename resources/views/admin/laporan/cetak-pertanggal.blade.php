
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan Konsultasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome-free/css/all.min.css')  }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/adminlte.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <style>
     @media print {
        body {
            -webkit-print-color-adjust: exact;
        }
     }
    .vendorListHeading th {
        background-color: #1a4567 !important;
        color: white !important;   
    }
  </style>
</head>
<body>
<div class="container">
    <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
        <div class="col-12">
            <h2 class="page-header">
            <img src="{{ asset('image/kemkes.png') }}" width="200px">
            </h2>
        </div>
        <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row text-center">
            <div class="col-lg-12">
                <h3 style="margin-top: 20px; font-weight:bold;">
                    Laporan Konsultasi<br>
                    Sistem Pakar Penyakit Kulit<hr>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>Laporan Konsultasi Tanggal: {{ date('d-m-Y') }}</p>
            </div>
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-bordered nowrap">
            <thead>
                <tr>
                    <th style="text-align: center; background-color: #90ee90 !important;" width="10%">No</th>
                    <th style="text-align: center; background-color: #90ee90 !important;" width="20%">Tanggal Konsultasi</th>
                    <th style="background-color: #90ee90 !important;" width="30%">Nama</th>
                    <th style="background-color: #90ee90 !important;" width="40%">Diagnosa Penyakit</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $laporan)
                <tr>
                    <td style="text-align: center;" width="10%">{{ $loop->iteration }}</td>
                    <td style="text-align: center;" width="15%">{{ $laporan->created_at }}</td>
                    <td width="30%">{{ $laporan->user->nama }}</td>
                    <td width="40%">{{ $laporan->penyakit->nama }}</td>
                </tr>
                @empty
                <tr>
                    <td style="text-align: center;" colspan="4">Tidak Ada Data Laporan Konsultasi</td>
                </tr>
                @endforelse
            </tbody>
            </table>
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</div>

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>

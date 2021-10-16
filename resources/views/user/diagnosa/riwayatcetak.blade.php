
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
        <!-- info row -->
        <div class="row text-center">
            <div class="col-lg-12">
                <h3 style="margin-top: 20px; font-weight:bold;">
                    Riwayat Diagnosa Penyakit Kulit
                </h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="container">
                <table class="table table-bordered table-striped  nowrap" cellspacing="0" style="width: 100%">
                   <div class="col-md-12 mt-2">
                       @foreach($diagnosas as $diagnosa)
                       <tbody>
                           <tr>
                               <td>Tanggal Konsultasi</td>
                               <td>{{ $diagnosa->created_at }}</td>
                           </tr>
                           <tr>
                               <td>Nama Lengkap</td>
                               <td>{{ $diagnosa->user->nama }}</td>
                           </tr>
                           <tr>
                               <td>Diagnosa Penyakit</td>
                               <td>{{ $diagnosa->penyakit->nama }}</td>
                           </tr>
                           <tr>
                               <td>Deskripsi</td>
                               <td>{{ $diagnosa->penyakit->deskripsi }}</td>
                           </tr>
                           <tr>
                               <td>Solusi</td>
                               <td>{{ $diagnosa->penyakit->solusi }}</td>
                           </tr>
                       </tbody>
                       @endforeach
                   </div>
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

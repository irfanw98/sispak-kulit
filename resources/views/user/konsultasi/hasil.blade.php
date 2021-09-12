@extends('template.master')

@section('tittle', 'konsultasi')

@section('header')
    <style>
        .grad {
            background-image: linear-gradient(to right, #4e54c8, #8f94fb);
            height: 4px;
            border-radius: 20px;
        }
        .gradModal {
            background-image: linear-gradient(to bottom, #4e54c8, #8f94fb);
            height: 4px;
            border-radius: 20px;
        }
        .checks {
          margin: 10px;
        }
        .proses{
          margin-top: 5px;
          margin-left: 10px;
        }
    </style>
@endsection

@section('content')
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Hasil Diagnosa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
 </section>
 <section class="content">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <div class="card">
                    <div class="grad">
                    </div>
                    <div class="card-body">
                      <h4 class="title-konsultasi">Hasil Diagnosa Penyakit Kulit Berdasarkan Gejala</h4>
                      <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped  nowrap" cellspacing="0" style="width: 100%">
                                <div class="col-md-12 mt-3">
                                    <tbody>
                                        <tr>
                                            <td>Nama Penyakit</td>
                                            <td>{{ $penyakit->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td>{{ $penyakit->Deskripsi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $penyakit->Solusi }}</td>
                                        </tr>
                                    </tbody>
                                </div>
                            </table> 
                        </div>
                      </div>
                      <a href="" type="button" class="btn btn-outline-success"><i class="fas fa-angle-double-right"></i>Konsultasi</a>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

@section('footer')
<script type="text/javascript">
 
</script>
@endsection

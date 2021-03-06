@extends('template.master')

@section('tittle', 'hasil')

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
                  <h4 class="title-gejala">Gejala Yang Anda Pilih</h4>
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
                      <table class="table table-bordered table-striped  nowrap" cellspacing="0" style="width: 50%">
                        <thead>
                          <tr>
                            <th style="text-align: center;">Kode Gejala</th>
                            <th>Nama Gejala</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($gejalas as $gejala)
                          <tr>
                            <td style="text-align: center;">{{ $gejala->gejala_kode }}</td>
                            <td>{{ $gejala->gejala->nama }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <h4 class="title-konsultasi mt-2">Hasil Diagnosa Penyakit Kulit Berdasarkan Gejala</h4>
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
                        <table class="table table-bordered table-striped  nowrap" cellspacing="0" style="width: 100%">
                          <tbody>
                            <tr>
                                <td style="font-weight: bold;">Nama</td>
                                <td>{{ $user->nama }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Nama Penyakit</td>
                                <td>{{ $penyakit->nama }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Deskripsi</td>
                                <td>{{ $penyakit->deskripsi }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Solusi</td>
                                <td>{{ $penyakit->solusi }}</td>
                            </tr>
                          </tbody>
                        </table> 
                    </div>
                  </div>
                  <a href="{{ route('konsultasi.index') }}" type="button" class="btn btn-outline-primary"><i class="fas fa-angle-double-left"></i> Konsultasi Lagi</a>
                  <a href="{{ route('riwayat-diagnosa.index') }}" type="button" class="btn btn-outline-success"> Lihat Riwayat <i class="fas fa-angle-double-right"></i></a>
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

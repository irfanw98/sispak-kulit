@extends('template.master')

@section('tittle', 'konsultasi')

@section('header')
<link rel="stylesheet" href="{{ asset('css/backend/user/konsultasi/style.css') }}">
@endsection

@section('content')
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item" style="font-weight: bold;"><a href="{{ route('dashboard-user') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" style="font-weight: bold;">Konsultasi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
 </section>
 <section class="content mt-2">
  <div class="wrapper">
    <div class="tittle text-center">
        <h4>Pilih Gejala Penyakit Yang Anda Rasakan</h4>
    </div>
    <div class="pencarian">
      <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 col-lg-6">
          <form action="{{ route('konsultasi.index') }}">
            <div class="input-group mb-3" style="margin-top: -20px;">
              <input type="text" class="form-control" placeholder="Cari gejala..." name="pencarian" value="{{ request('pencarian') }}">
              <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="card-body">
        <form action="{{ route('konsultasi.store') }}" method="POST">
        @csrf
          <div class="row">
          @if($gejalas->count() > 0)
            @foreach($gejalas as $gejala)
            <div class="col-sm-12 col-md-3 col-lg-3 d-flex justify-content-center">
              <label class="option_item">
                <input type="checkbox" class="checkbox" name="gejala[]" value="{{ $gejala->kode_gejala }}">
                <div class="option_inner gejala">
                  <div class="tickmark"></div>
                  <div class="kode_gejala">{{ $gejala->kode_gejala }}</div>
                  <div class="name">{{ $gejala->nama }}</div>
                </div>
              </label>
            </div>
            @endforeach
          @else
            <div class="col-sm-12 col-md-12 col-lg-12 text-center search">
              <img src="{{ asset('image/pencarian.svg') }}" alt="pencarian">
              <h4>Pencarian tidak ditemukan</h4>
            </div>
          @endif
            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end mt-3 pr-3">
             {{ $gejalas->links() }}   
            </div>
          </div>
          <div class="row justify-content-center">
            <button type="submit" class="btn proses mt-5 mb-2">Proses <i class="fas fa-angle-double-right"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('footer')
<script type="text/javascript">
</script>
@endsection

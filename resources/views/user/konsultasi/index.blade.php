@extends('template.master')

@section('tittle', 'konsultasi')

@section('header')
<link rel="stylesheet" href="{{ asset('css/backend/user/style.css') }}">
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
              <li class="breadcrumb-item active">Konsultasi</li>
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

    <div class="container">
      <div class="card-body">
        <div class="row">
        <!-- Foreach disini -->
          <div class="col-sm-12 col-md-3 col-lg-3">
            <label class="option_item">
              <input type="checkbox" class="checkbox" name="gejala[]" value="">
              <div class="option_inner gejala">
                <div class="tickmark"></div>
                <div class="name">Gatal - gatal</div>
              </div>
            </label>
          </div>
          <div class="col-sm-12 col-md-3 col-lg-3">
            <label class="option_item">
              <input type="checkbox" class="checkbox" name="gejala[]" value="">
              <div class="option_inner gejala">
                <div class="tickmark"></div>
                <div class="name">Kulit Kering</div>
              </div>
            </label>
          </div>
          <div class="col-sm-12 col-md-3 col-lg-3">
            <label class="option_item">
              <input type="checkbox" class="checkbox" name="gejala[]" value="">
              <div class="option_inner gejala">
                <div class="tickmark"></div>
                <div class="name">Kulit Ruam</div>
              </div>
            </label>
          </div>
          <div class="col-sm-12 col-md-3 col-lg-3">
            <label class="option_item">
              <input type="checkbox" class="checkbox" name="gejala[]" value="">
              <div class="option_inner gejala">
                <div class="tickmark"></div>
                <div class="name">Kulit Luka</div>
              </div>
            </label>
          </div>
          <div class="col-sm-12 col-md-3 col-lg-3">
            <label class="option_item">
              <input type="checkbox" class="checkbox" name="gejala[]" value="">
              <div class="option_inner gejala">
                <div class="tickmark"></div>
                <div class="name">Kulit Berminyak</div>
              </div>
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-outline-info proses ml-2 mt-2">Proses <i class="fas fa-angle-double-right"></i></button>
      </div>
    </div>
  </div>


























        <!-- <div class="row">
            <div class="col-md-12 table-responsive">
                <div class="card">
                    <div class="grad">
                    </div>
                    <div class="card-body">
                      <h4 class="title-konsultasi">Pilih Gejala Penyakit Yang Anda Rasakan</h4>
                      <form action="{{ route('konsultasi.store') }}" method="post" class="konsultasi">
                        @csrf
                        @foreach($gejalas as $gejala)
                        <div class="row">
                          <div class="col-md-12">
                            <input type="checkbox" name="gejala[]" class="checks" value="{{ $gejala->kode_gejala }}">{{ $gejala->nama }}
                          </div>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-outline-primary proses"><i class="fas fa-angle-double-right"></i> Proses</button>
                      </form>
                    </div>
                </div>
            </div>
        </div> -->
</section>
@endsection

@section('footer')
<script type="text/javascript">
  // $(document).on('click', '.proses', function(e) {
  //   e.preventDefault();
  //   let form = $('.konsultasi')[0];
  //   const formData = new FormData(form);
  //   const namaGejala = $(this).attr('nama-gejala');

  //   swal({
  //     title: "Yakin?",
  //     text: `Gejala Yang Anda Rasakan Itu Benar?`,
  //     icon: "warning",
  //     buttons: true,
  //     dangerMode: true,
  //   })
  //   .then((result) => {
      // console.log(result);
      // if(result) {
      //   $.ajax({
      //     headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //     },
      //     url:'{{ route("konsultasi.store") }}',
      //     method: 'POST',
      //     data: formData,
      //     processData: false, // Important!
      //     contentType: false,
      //     cache: false,
      //     success: function(response) {
      //       window.location.href = "diagnosa";
      //     }
      //   })
      // }
  //   })
  // })
</script>
@endsection

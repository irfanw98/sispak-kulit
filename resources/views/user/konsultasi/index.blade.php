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
              <li class="breadcrumb-item active">Konsultasi</li>
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
        </div>
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

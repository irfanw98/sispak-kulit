@extends('template.master')

@section('tittle', 'Profile')

@section('header')
    <style>
        .grad {
            background-color: #117a8b;
            height: 4px;
            border-radius: 20px;
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
                <li class="breadcrumb-item"><a href="{{ route('dashboard-dokter') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">My Profile</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
<form action="" method="POST" class="formEdit" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-12 table-responsive">
            <div class="card">
                <div class="grad">
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <input type="hidden" name="kode" id="kode" value="{{ $dokter->kode_dokter }}">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 text-center">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <img src="{{ getDokterFoto() }}" alt="foto" width="200px" class="mb-2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 ml-5">
                            <input type="file" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8 mt-4">
                        <div class="form-group">
                            <label for="nama">Nama </label>
                            <input type="text" name="nama" class="form-control" id="nama" value="{{ $dokter['nama'] }}">
                        </div>
                            <div class="form-group">
                            <label for="email">E-mail </label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $dokter['email'] }}">
                        </div>
                            <button type="submit" class="btn btn-primary editButton">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</section>
@endsection

@section('footer')
<script>
$(document).on('click', '.editButton', function(e) {
    e.preventDefault();
    const form_id = $('input[id=kode]').val();
    let form = $('.formEdit')[0];
    const formData = new FormData(form);

    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `{{ url('/profile-dokter/${form_id}') }}`,
        method: 'POST',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success: function(response) {
            swal({
                title: "Sukses!",
                text: "Profile berhasil diubah!",
                icon: "success",
                timer: 2000,
                buttons: false,
            })
            location.reload(); 
        },
        error: function(response) {
            console.log(response);
        }
    })
    
})

</script>
@endsection

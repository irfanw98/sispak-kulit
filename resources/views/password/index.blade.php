@extends('template.master')

@section('tittle', 'dokter')

@section('header')
    <style>
        .grad {
            background-color: #117a8b;
            height: 4px;
            border-radius: 20px;
        }
        .gradModal {
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
              <li class="breadcrumb-item">
                @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('dashboard-admin') }}">Dashboard</a>
                @endif
                @if(auth()->user()->hasRole('dokter'))
                <a href="{{ route('dashboard-dokter') }}">Dashboard</a>
                @endif
                @if(auth()->user()->hasRole('user'))
                <a href="{{ route('dashboard-user') }}">Dashboard</a>
                @endif
              </li>
              <li class="breadcrumb-item active">Ubah Password</li>
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
                    <form action="" method="POST" autocomplete="off" class="border p-3 rounded formPassword">
                        @csrf
                        <div class=" row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_lama">Password Lama :</label>
                                    <input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="Masukkan Password Lama">

                                    <span class="text-danger" id="password_lamaErr"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password Baru :</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Baru">

                                    <span class="text-danger" id="passwordErr"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password Baru :</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru">

                                    <span class="text-danger" id="password_confirmationErr"></span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ubahPassword">Simpan</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

@section('footer')
<script type="text/javascript">
$(document).on('click', '.ubahPassword', function(e) {
    e.preventDefault();
    let form = $('.formPassword')[0];
    const formData = new FormData(form);

    //Validasi form input
    $('#password_lamaErr').addClass('d-none');
    $('#passwordErr').addClass('d-none');
    $('#password_confirmationErr').addClass('d-none');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('ubah-password.store') }}",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(response) {         
            swal({
                title: "Sukses!",
                text: "Password baru berhasil disimpan!",
                icon: "success",
                timer: 2000,
                buttons: false,
            })

            $('#password_lama').removeClass('is-invalid');
            $('#password').removeClass('is-invalid');
            $('#password_confirmation').removeClass('is-invalid');

            $('.formPassword').trigger('reset');//Reset inputan form
        },
        error: function(data) {
            let errors = data.responseJSON;
            if ($.isEmptyObject(errors) == false) {
                $.each(errors.errors, function(key,value) {
                    let errID = '#' + key + 'Err';
                    $('#password_lama').removeClass('is-valid');
                    $('#password_lama').addClass('is-invalid');
                    $('#password').removeClass('is-valid');
                    $('#password').addClass('is-invalid');
                    $('#password_confirmation').removeClass('is-valid');
                    $('#password_confirmation').addClass('is-invalid');
                    $(errID).removeClass('d-none');
                    $(errID).text(value);
                })
            } 
        }
    })
})
</script>
@endsection

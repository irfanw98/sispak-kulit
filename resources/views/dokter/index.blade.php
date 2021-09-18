@extends('template.master')

@section('tittle', 'dokter')

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
              <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Akun-Dokter</li>
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
                    <a href="" name="addDokter" class="btn btn-primary mb-3 p-2 addDokter"  role="button" style="color: white;"><i class="fa fa-plus-square"></i> TAMBAH</a>
                    <a href="{{ route('sampah-dokter') }}" class="btn btn-warning mb-3 p-2 " style="color: white;"><i class="fa fa-trash-restore"></i> SAMPAH</a>
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="40%">Nama</th>
                                    <th width="30%">Username</th>
                                    <th style="text-align: center;" width="10%">Aksi</th>
                                </tr>
                            </thead>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

<!-- Modal Detail  -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<!-- Modal Create  -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

@section('footer')
<script type="text/javascript">
    $(document).ready(function(){
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/akun-dokter') }}",
                type: "GET",
                dataType: "JSON"
            },
            columns: [
                {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
                },
                {
                data: 'nama',
                name: 'nama'
                },
                {
                data: 'username',
                name: 'username'
                },
                {
                data: 'Aksi',
                name: 'Aksi'
                }
            ]
        })
    })

    $(document).on('click', '.dokterDetail', function(e) {
        e.preventDefault();
        const kode_dokter = $(this).attr('detail-kode');

        $.ajax({
            url:  `{{ url('/akun-dokter/${kode_dokter}') }}`,
            method: 'GET',
            success: function(result) {
                $('#detailModal').modal('show');
                $('#detailModal').find('.modal-body').html(result);
            }
        })
    })

    $(document).on('click', '.addDokter', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: "{{ url('/akun-dokter/create') }}",
            method: "GET",
            success: function(result) {
                $('#createModal').modal('show');
                $('#createModal').find('.modal-body').html(result);
            }
        })

    })

    $(document).on('click', '.saveButton', function(e) {
        e.preventDefault();
        let form = $('.formInsert')[0];
        const formData = new FormData(form);
        
        $('#namaError').addClass('d-none');
        $('#usernameError').addClass('d-none');
        $('#emailError').addClass('d-none');
        $('#fotoError').addClass('d-none');

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('akun-dokter') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "JSON",
            success: function(result) {
                $('.formInsert').trigger('reset');
                $('#createModal').modal('hide');
                $("#datatable").DataTable().ajax.reload();

                swal({
                    title: "Sukses!",
                    text: "Dokter berhasil ditambahkan!",
                    icon: "success",
                    timer: 2000,
                    buttons: false,
                })
            },
            error: function(data) {
                let errors = data.responseJSON;
                if ($.isEmptyObject(errors) == false) {
                    $.each(errors.errors, function(key,value) {
                        let errID = '#' + key + 'Error';
                        $('#nama').removeClass('is-valid');
                        $('#nama').addClass('is-invalid');
                        $('#username').removeClass('is-valid');
                        $('#username').addClass('is-invalid');
                        $('#email').removeClass('is-valid');
                        $('#email').addClass('is-invalid');
                        $('#foto').removeClass('is-valid');
                        $('#foto').addClass('is-invalid');
                        $(errID).removeClass('d-none');
                        $(errID).text(value);
                    })
                } 
            }
        })

    })

    $(document).on('click', '.cancelButton', function(e) {
        e.preventDefault();
        $('.formInsert').trigger('reset'); 

        $('#namaError').addClass('d-none');
        $('#usernameError').addClass('d-none');
        $('#emailError').addClass('d-none');
        $('#fotoError').addClass('d-none');

        $('#nama').removeClass('is-invalid');
        $('#username').removeClass('is-invalid');
        $('#email').removeClass('is-invalid');
        $('#foto').removeClass('is-invalid');
    })

    $(document).on('click', '.dokterUbah', function(e) {
        e.preventDefault();
        const dokterId = $(this).attr('ubah-kode');
        
        $.ajax({
            url: `{{ url('/akun-dokter/${dokterId}/edit') }}`,
            method: "GET",
            success: function(result) {
                $('#editModal').modal('show');
                $('#editModal').find('.modal-body').html(result);
            }
        })
    })

    $(document).on('click', '.editButton', function(e) {
        e.preventDefault();
        const form_id = $('input[id=kode]').val();
        let form = $('.formEdit')[0];
        const formData = new FormData(form);

        $('#namaError').addClass('d-none');
        $('#usernameError').addClass('d-none');
        $('#emailError').addClass('d-none');
        $('#fotoError').addClass('d-none');
        
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `{{ url('/akun-dokter/${form_id}') }}`,
            method: 'POST',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            dataType: 'JSON',
            success: function(response) {
                $('.formEdit').trigger('reset');
                $('#editModal').modal('hide');
                $("#datatable").DataTable().ajax.reload();

                swal({
                    title: "Sukses!",
                    text: "Dokter berhasil diubah!",
                    icon: "success",
                    timer: 2000,
                    buttons: false,
                })
            },
            error: function(data) {
                let errors = data.responseJSON;
                if ($.isEmptyObject(errors) == false) {
                    $.each(errors.errors, function(key,value) {
                        let errID = '#' + key + 'Error';
                        $('#nama').removeClass('is-valid');
                        $('#nama').addClass('is-invalid');
                        $('#username').removeClass('is-valid');
                        $('#username').addClass('is-invalid');
                        $('#email').removeClass('is-valid');
                        $('#email').addClass('is-invalid');
                        $('#foto').removeClass('is-valid');
                        $('#foto').addClass('is-invalid');
                        $(errID).removeClass('d-none');
                        $(errID).text(value);
                    })
                } 
            }
        })
    })

    $(document).on('click', '.dokterDelete', function(e) {
        e.preventDefault();
        const kodeDokter = $(this).attr('delete-kode');
        const namaDokter = $(this).attr('dokterNama');
        
        swal({
            title: "Yakin?",
            text: `Data dokter ${namaDokter} akan dihapus?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((result) => {
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `{{ url('/akun-dokter/${kodeDokter}') }}`,
                    type:"POST",
                    data: {
                        '_method': 'DELETE',
                        'id': kodeDokter,
                    },
                    success: function(response) {
                        $('#datatable').DataTable().ajax.reload();

                        swal({
                            title: "Sukses!",
                            text: `Data dokter ${namaDokter} berhasil dihapus!`,
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        })
                    }
                })
            }
        })
    })
</script>
@endsection

@extends('template.master')

@section('tittle', 'admin')

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
              <li class="breadcrumb-item active">Akun-Admin</li>
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
                    <a href="" name="addAdmin" class="btn btn-primary mb-3 p-2 addAdmin"  role="button" style="color: white;"><i class="fa fa-plus-square"></i> TAMBAH</a>
                    <a href="{{ url('/akun-admin/sampah') }}" class="btn btn-warning mb-3 p-2 " style="color: white;"><i class="fa fa-trash-restore"></i> SAMPAH</a>
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="40%">Nama</th>
                                    <th width="30%">Username</th>
                                    <th style="text-align: center;" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <!-- <tbody>
                                <tr>
                                    <td style="text-align: center;">1</td>
                                    <td>Admin</td>
                                    <td>adminsispak98</td>
                                    <td style="text-align: center;">
                                        <a href="#" class="btn btn-info adminEdit" id="" role="button" edit-id=""><i class="fa fa-edit"></i> UBAH</a>
                                        <a href="#" class="btn btn-danger adminEdelete" role="button" delete-id="" sma=""><i class="fa fa-trash"></i> HAPUS</a>
                                    </td>
                            </tbody> -->
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Modal Tambah -->
<div class="modal fade" id="addModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                 <div class="gradModal">
                </div>
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" autocomplete="off" class="formInsert">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama :</label>
                                <input type="text" class="form-control" id="nama" name="nama">

                                <span class="text-danger" id="namaError"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username :</label>
                                <input type="text" class="form-control" id="username" name="username">

                                <span class="text-danger" id="usernameError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" id="email" name="email">

                                <span class="text-danger" id="emailError"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary saveButton">SIMPAN</button>
                <button type="button" class="btn btn-outline-danger cancelButton"data-dismiss="modal">BATAL</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/akun-admin') }}",
                type: "GET",
                dataType: "JSON"
            },
            columns: [{
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
        });
    });

    //TAMBAH DATA 
    $('.addAdmin').on('click', function(e) {
        e.preventDefault();
        $('#addModal').modal('show');//Menampilkan modal 
    })

    $('.saveButton').on('click', function(e) {
        e.preventDefault();
        let form = $('.formInsert')[0]; //Get form input
        const formData = new FormData(form);

        //Validasi form input
        $('#namaError').addClass('d-none');
        $('#usernameError').addClass('d-none');
        $('#emailError').addClass('d-none');
    
        $.ajax({
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('akun-admin') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "JSON",
            success: function(result) {
                $('.formInsert').trigger('reset');//Reset inputan form
                $('#addModal').modal('hide');//Tutup Modal
                $("#datatable").DataTable().ajax.reload();//Reload Datatable

                swal({
                  title: "Sukses!",
                  text: "Admin berhasil ditambahkan!",
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
                        $(errID).removeClass('d-none');
                        $(errID).text(value);
                    })
                } 
            }
        })
    })

    $('.cancelButton').on('click', function(e) {
        e.preventDefault();
        $('.formInsert').trigger('reset'); //reset form input

        $('#namaError').addClass('d-none');//reset validasi form input
        $('#usernameError').addClass('d-none');
        $('#emailError').addClass('d-none');

        $('#nama').removeClass('is-invalid');
        $('#username').removeClass('is-invalid');
        $('#email').removeClass('is-invalid');

    })

    //HAPUS DATA
    $(document).on('click', '.adminDelete', function(e) {
        e.preventDefault();
        const adminId = $(this).attr('delete-id');
        const adminNama = $(this).attr('adminNama');
        const url = `akun-admin/${adminId}`;
        
        swal({
                title: "Yakin?",
                text: `Data admin ${adminNama} akan dihapus?`,
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
                        url:url,
                        type:"POST",
                        data: {
                            '_method': 'DELETE',
                            'id': adminId,
                        },
                        success: function(response) {
                             $('#datatable').DataTable().ajax.reload();

                            swal({
                                title: "Sukses!",
                                text: `Data admin ${adminNama} berhasil dihapus!`,
                                icon: "success",
                                timer: 2000,
                                buttons: false,
                            })
                        }
                    })
                }
            }) 
            .catch()
    })
    
</script>
@endsection

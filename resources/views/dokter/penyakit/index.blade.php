@extends('template.master')

@section('tittle', 'penyakit')

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
              <li class="breadcrumb-item"><a href="{{ route('dashboard-dokter') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Penyakit</li>
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
                        <a href="" name="addPenyakit" class="btn btn-primary mb-3 p-2 addPenyakit"  role="button" style="color: white;"><i class="fa fa-plus-square"></i> TAMBAH</a>
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="20%">Kode Penyakit</th>
                                    <th width="50%">Nama Penyakit</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="gradModal">
            </div>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="gradModal">
            </div>
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
                url: "{{ url('penyakit') }}",
                method: "GET",
                dataType: "JSON"
                },
                columns : [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                    },
                    {
                    data: 'kode_penyakit',
                    name: 'kode_penyakit'
                    },
                    {
                    data: 'nama',
                    name: 'nama'
                    },
                    {
                    data: 'Aksi',
                    name: 'Aksi'
                }]
            })
    })

    //DETAIL
    $(document).on('click', '.penyakitDetail', function(e) {
        e.preventDefault();
        const kodePenyakit = $(this).attr('detail-kode');
        
        $.ajax({
            url: `{{ url('/penyakit/${kodePenyakit}') }}`,
            method: "GET",
            success: function(result) {
                $('#detailModal').modal('show');
                $('#detailModal').find('.modal-body').html(result);
            }
        })
    })
    
    //TAMBAH DATA
    $(document).on('click', '.addPenyakit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url : "{{ route('penyakit.create') }}",
            method : "GET",
            success : function(result) {
                $('#createModal').modal('show');
                $('#createModal').find('.modal-body').html(result);
            }
        })
    })

    $(document).on('click', '.saveButton', function(e) {
        e.preventDefault();
        let form = $('.formInsert')[0];
        const formData = new FormData(form);

        //Validasi form input
        $('#namaError').addClass('d-none');
        $('#deskripsiError').addClass('d-none');
        $('#solusiError').addClass('d-none');

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('penyakit.store') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "JSON",
            success: function(response) {
                $('.formInsert').trigger('reset');//Reset inputan form
                $('#createModal').modal('hide');//Tutup Modal
                $("#datatable").DataTable().ajax.reload();//Reload Datatable

                swal({
                    title: "Sukses!",
                    text: "Penyakit berhasil ditambahkan!",
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
                        $('#deskripsi').removeClass('is-valid');
                        $('#deskripsi').addClass('is-invalid');
                        $('#solusi').removeClass('is-valid');
                        $('#solusi').addClass('is-invalid');
                        $(errID).removeClass('d-none');
                        $(errID).text(value);
                    })
                } 
            }
        })
    })

    //UBAH DATA
    $(document).on('click', '.ubahPenyakit', function(e) {
        e.preventDefault();
        const kodePenyakit = $(this).attr('ubah-kode');
        
        $.ajax({
            url: `{{ url('/penyakit/${kodePenyakit}/edit') }}`,
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
        $('#deskripsiError').addClass('d-none');
        $('#solusiError').addClass('d-none');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `{{ url('/penyakit/${form_id}') }}`,
            method: 'POST',
            processData: false, // Important!
            contentType: false,
            cache: false,
            data: formData,
            dataType: 'JSON',
            success: function(response) {
                $('.formEdit').trigger('reset');//Reset inputan form
                $('#editModal').modal('hide');//Tutup Modal
                $("#datatable").DataTable().ajax.reload();//Reload Datatable

                swal({
                    title: "Sukses!",
                    text: "Penyakit berhasil diubah!",
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
                            $('#deskripsi').removeClass('is-valid');
                            $('#deskripsi').addClass('is-invalid');
                            $('#solusi').removeClass('is-valid');
                            $('#solusi').addClass('is-invalid');
                            $(errID).removeClass('d-none');
                            $(errID).text(value);
                        })
                    } 
            }
        })
    })

    //HAPUS DATA
    $(document).on('click', '.hapusPenyakit', function(e){
        e.preventDefault();
        const kodePenyakit = $(this).attr('delete-kode');
        const namaPenyakit = $(this).attr('namaPenyakit');
        
        swal({
            title: "Yakin?",
            text: `Data penyakit ${namaPenyakit} akan dihapus?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((result) => {
            if(result) {
                $.ajax({
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `{{ url('/penyakit/${kodePenyakit}') }}`,
                    type:"POST",
                    data: {
                        multi: null,
                        '_method': 'DELETE',
                        'id': kodePenyakit,
                    },
                    success: function(response){
                        $('#datatable').DataTable().ajax.reload();

                        swal({
                            title: "Sukses!",
                            text: `Data penyakit ${namaPenyakit} berhasil dihapus!`,
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

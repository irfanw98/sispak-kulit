@extends('template.master')

@section('tittle', 'gejala')

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
              <li class="breadcrumb-item active">Gejala</li>
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
                    <a href="" name="addGejala" class="btn btn-primary mb-3 p-2 addGejala"  role="button" style="color: white;"><i class="fa fa-plus-square"></i> TAMBAH</a>
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="40%">Kode Gejala</th>
                                    <th width="30%">Nama Gejala</th>
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

@section('footer')
<script type="text/javascript">
    $(document).ready(function(){   
            $('#datatable').DataTable({
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                        url: "{{ url('/gejala') }}",
                        method: "GET",
                        dataType: "JSON"
                        },
                        columns : [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                            },
                            {
                            data: 'kode_gejala',
                            name: 'kode_gejala'
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

    //TAMBAH GEJALA
    $(document).on('click', '.addGejala', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: "{{ route('gejala.create') }}",
            method: "GET",
            success: function(result) {
                $('#createModal').modal('show');
                $('#createModal').find('.modal-body').html(result);
            }
        })
    })

    $(document).on('click', '.saveButton', function(e) {
        e.preventDefault();
        let form = $('.formInsert')[0]; //Get form input
        const formData = new FormData(form);
        
        //Validasi form input
        $('#namaError').addClass('d-none');

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('gejala') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "JSON",
            success: function(result) {
                    $('.formInsert').trigger('reset');//Reset inputan form
                    $('#createModal').modal('hide');//Tutup Modal
                    $("#datatable").DataTable().ajax.reload();//Reload Datatable

                swal({
                    title: "Sukses!",
                    text: "Gejala berhasil ditambahkan!",
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
                        $(errID).removeClass('d-none');
                        $(errID).text(value);
                        })
                } 
            }
        })
    })

    $(document).on('click', '.cancelButton', function(e) {
        e.preventDefault();
        $('.formInsert').trigger('reset'); //reset form input
        $('#namaError').addClass('d-none');//reset validasi form input
        $('#nama').removeClass('is-invalid');
    })
</script>
@endsection

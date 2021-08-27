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
                     <a href="{{ url('/akun-user/sampah') }}" class="btn btn-warning mb-3 p-2 " style="color: white;"><i class="fa fa-trash-restore"></i> SAMPAH</a>
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="30%">Nama</th>
                                    <th width="40%">Email</th>
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

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/akun-user') }}",
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
                data: 'email',
                name: 'email'
                },
                {
                data: 'Aksi',
                name: 'Aksi'
            }]
        })
    })

    //HAPUS DATA
    $(document).on('click', '.userDelete',  function(e){
        e.preventDefault();
        const idUser = $(this).attr('delete-id');
        const namaUser = $(this).attr('userNama');
        
        swal({
            title: "Yakin?",
            text: `Data user ${namaUser} akan dihapus?`,
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
                    url: `{{ url('/akun-user/${idUser}') }}`,
                    type:"POST",
                    data: {
                        '_method': 'DELETE',
                        'id': idUser,
                    },
                    success: function(response) {
                       $('#datatable').DataTable().ajax.reload();

                        swal({
                            title: "Sukses!",
                            text: `Data user ${namaUser} berhasil dihapus!`,
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
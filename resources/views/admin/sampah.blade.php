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
             <a href="{{ url('/akun-admin') }}" class="btn btn-default p-2"><i class="fas fa-arrow-circle-left"></i> KEMBALI</a>
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
                        <a href="" class="btn btn-outline-danger mb-3 p-2 hapus"><i class="fa fa-trash"></i> HAPUS SEMUA</a>
                        <a href="" class="btn btn-outline-info mb-3 p-2 pulihkan"><i class="fas fa-undo-alt"></i> PULIHKAN SEMUA</a>
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
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
                url: "{{ route('sampah-admin') }}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'Aksi',
                    name: 'Aksi'
                }
            ],
            'columnDefs': [{
                "targets": [0,3], // your case first column
                "className": "text-center",
            }],
        })
    })

    $(document).on('click', '.pulihkan', function(e) {
        e.preventDefault()
        swal({
            title: "Yakin?",
            text: `Data semua admin akan dipulihkan kembali?`,
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
                    url: '{{ route("pulihkan-admin") }}',
                    type:"POST",
                    data: {
                        '_method': 'GET',
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data semua admin berhasil dipulihkan!`,
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        })
                        $('#datatable').DataTable().ajax.reload()
                    }
                })
            }
        })
    })

    $(document).on('click', '.adminPulihkan', function(e) {
        e.preventDefault()
        const adminId = $(this).attr('pulihkan-id')
        const namaAdmin = $(this).attr('pulihkanName')

        swal({
            title: "Yakin?",
            text: `Data admin ${namaAdmin} akan dipulihkan kembali?`,
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
                    url: '{{ route("pulihkan-admin") }}/' + adminId,
                    type: 'POST',
                    data: {
                        '_method': 'GET',
                        'id': adminId
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data admin ${namaAdmin} berhasil dipulihkan!`,
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        })
                        $('#datatable').DataTable().ajax.reload()
                    }
                })
            }
        })
    })

    $(document).on('click', '.hapus', function(e){
        e.preventDefault()
        swal({
            title: "Yakin?",
            text: `Data semua admin dihapus permanen?`,
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
                    url:"{{ route('hapus-admin') }}",
                    type:"POST",
                    data: {
                        '_method': 'DELETE',
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data semua admin berhasil dihapus permanen!`,
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        })
                        $("#datatable").DataTable().ajax.reload()
                    }
                })
            }
        })
    })
    
    $(document).on('click', '.deleteSampah', function(e) {
        e.preventDefault();
        const hapusId = $(this).attr('deleteId');
        const hapusNama = $(this).attr('deleteName');
        
        swal({
            title: "Yakin?",
            text: `Data admin ${hapusNama} akan dihapus permanen?`,
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
                    url:'{{ route("hapus-admin") }}/'+hapusId,
                    type:"POST",
                    data: {
                        '_method': 'DELETE',
                        'id': hapusId,
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data admin ${hapusNama} berhasil dihapus permanen!`,
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        })
                        $("#datatable").DataTable().ajax.reload()
                    }
                })
            }
        })
    })
</script>
@endsection
@extends('template.master')

@section('tittle', 'Laporan Konsultasi')

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
              <a href="{{ route('laporan-konsultasi.index') }}" class="btn btn-default p-2"><i class="fas fa-arrow-circle-left"></i> KEMBALI</a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Sampah Laporan</li>
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
                                    <th width="10%">No</th>
                                    <th width="20%">Tanggal</th>
                                    <th width="40%">Nama User</th>
                                    <th width="40%">Nama Penyakit</th>
                                    <th width="10%">Aksi</th>
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
    $(document).ready(function(){
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('sampah-laporan') }}",
                type: "GET",
                dataType: "JSON"
            },
            columns: [
                {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
                },
                {
                data: 'created_at',
                name: 'created_at'
                },
                {
                data: 'User',
                name: 'User.nama'
                },
                {
                data: 'Penyakit',
                name: 'Penyakit.nama'
                },
                {
                data: 'Aksi',
                name: 'Aksi'
                }
            ],
            'columnDefs': [{
                "targets": [0,1,4], // your case first column
                "className": "text-center",
                "width": "5%"
            }],
        })
    })

    $(document).on('click', '.pulihkan', function(e) {
        e.preventDefault()
        swal({
            title: "Yakin?",
            text: `Data semua laporan konsultasi akan dipulihkan kembali?`,
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
                    url: '{{ route("pulihkan-laporan") }}',
                    type:"POST",
                    data: {
                        '_method': 'GET',
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data semua laporan konsultasi berhasil dipulihkan!`,
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

    $(document).on('click', '.konsultasiPulihkan', function(e) {
        e.preventDefault()
        const idPulihkan = $(this).attr('pulihkan-id')
        const userKonsultasi = $(this).attr('user-konsultasi')
        
        swal({
            title: "Yakin?",
            text: `Data laporan konsultasi ${userKonsultasi} akan dipulihkan kembali?`,
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
                    url: '{{ route("pulihkan-laporan") }}/' +idPulihkan,
                    type:"POST",
                    data: {
                        '_method': 'GET',
                        'id': idPulihkan
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data laporan konsultasi ${userKonsultasi} berhasil dipulihkan!`,
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

    $(document).on('click', '.hapus', function(e) {
        e.preventDefault()
        swal({
            title: "Yakin?",
            text: `Data semua laporan konsultasi akan dihapus permanen?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((result) => {
            if(result){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("hapus-laporan") }}',
                    type:"POST",
                    data: {
                        '_method': 'DELETE',
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data semua laporan konsultasi berhasil dihapus permanen!`,
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

    $(document).on('click', '.konsultasiDelete', function(e) {
        e.preventDefault()
        const idKonsultasi = $(this).attr('delete-konsultasi')
        const userKonsultasi = $(this).attr('user-konsultasi')
        
        swal({
            title: "Yakin?",
            text: `Data laporan konsultasi ${userKonsultasi} akan dihapus permanen?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((result) => {
            if(result){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("hapus-laporan") }}/'+idKonsultasi,
                    type:"POST",
                    data: {
                        '_method': 'DELETE',
                        'id': idKonsultasi,
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data laporan konsultasi ${userKonsultasi} berhasil dihapus permanen!`,
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
</script>
@endsection

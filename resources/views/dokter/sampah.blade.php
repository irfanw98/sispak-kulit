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
            <a href="{{ url('/akun-dokter') }}" class="btn btn-default p-2"><i class="fas fa-arrow-circle-left"></i> KEMBALI</a>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-dokter') }}">Dashboard</a></li>
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
                    <a href="" class="btn btn-outline-danger mb-3 p-2 hapus"><i class="fa fa-trash"></i> HAPUS SEMUA</a>
                    <a href="" class="btn btn-outline-info mb-3 p-2 pulihkan"><i class="fas fa-undo-alt"></i> PULIHKAN SEMUA</a>
                    <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama</th>
                                <th width="30%">Email</th>
                                <th style="text-align: center;" width="30%">Aksi</th>
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
                url: "{{ route('sampah-dokter') }}",
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
            text: `Data semua dokter akan dipulihkan kembali?`,
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
                    url: '{{ route("pulihkan-dokter") }}',
                    type:"POST",
                    data: {
                        '_method': 'GET',
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data semua dokter berhasil dipulihkan!`,
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

    $(document).on('click', '.dokterPulihkan', function(e) {
        e.preventDefault()
        const dokterId = $(this).attr('pulihkan-id')
        const pulihkanNama = $(this).attr('pulihkanName')
        
        swal({
            title: "Yakin?",
            text: `Data dokter ${pulihkanNama} akan dipulihkan kembali?`,
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
                    url: '{{ route("pulihkan-dokter") }}/' + dokterId,
                    type: 'POST',
                    data: {
                        '_method': 'GET',
                        'id': dokterId
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data dokter ${pulihkanNama} berhasil dipulihkan!`,
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
            text: `Data semua dokter dihapus permanen?`,
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
                    url: "{{ route('hapus-dokter') }}",
                    type:"POST",
                    data: {
                        '_method': 'DELETE',
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data semua dokter berhasil dihapus permanen!`,
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
        e.preventDefault()
        const hapusId = $(this).attr('deleteId')
        const hapusNama = $(this).attr('deleteName')
        
        swal({
            title: "Yakin?",
            text: `Data dokter ${hapusNama} akan dihapus permanen?`,
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
                    url: '{{ route("hapus-dokter") }}/'+hapusId,
                    type:"POST",
                    data: {
                        '_method': 'DELETE',
                        'id': hapusId,
                    },
                    success: function(response) {
                        swal({
                            title: "Sukses!",
                            text: `Data dokter ${hapusNama} berhasil dihapus permanen!`,
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
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
                        <a href="" class="btn btn-danger mb-3 p-2 hapus" style="color: white;"><i class="fa fa-trash"></i> HAPUS SEMUA</a>
                        <a href="{{ route('pulihkan-dokter') }}" class="btn btn-success mb-3 p-2 " style="color: white;"><i class="fas fa-undo-alt"></i> PULIHKAN SEMUA</a>
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="20%">Nama</th>
                                    <th width="30%">Email</th>
                                    <th style="text-align: center;" width="40%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($users->count() > 0)
                                @foreach($users as $user)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('pulihkan-dokter', [$user->id]) }}" class="btn  btn-info"><i class="fa fa-edit"></i> PULIHKAN</a>
                                        <a href="" class="btn  btn-danger deleteSampah" deleteId = "{{ $user->id }}" deleteName ="{{ $user->nama }}"><i class="fa fa-edit"></i> HAPUS</a>
                                    </td>
                                    @endforeach
                            @else
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak Ada Data</td>
                                    </tr>
                            @endif
                            </tbody>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
<script type="text/javascript">
    //DELETE ALL
    $(document).on('click', '.hapus', function(e) {
        e.preventDefault();
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
                        location.reload();
                    }
                })
            }
        })
    })

    //DELETE BY ID
    $(document).on('click', '.deleteSampah', function(e) {
        e.preventDefault();
        const hapusId = $(this).attr('deleteId');
        const hapusNama = $(this).attr('deleteName');
        
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
                        location.reload();
                    }
                })
            }
        })
    })
</script>
@endsection
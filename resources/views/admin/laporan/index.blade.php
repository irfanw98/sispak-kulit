@extends('template.master')

@section('tittle', 'Laporan Konsultasi')

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
      <div class="container">
        <div class="row mb-3">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Laporan Konsultasi</li>
            </ol>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    Jika ingin mencetak semua laporan konsultasi, tidak perlu input tanggal. Langsung klik tombol "cetak".
                </div>
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
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tglawal">Dari Tanggal :</label>
                                <input type="date" name="tglawal" id="tglawal" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tglakhir">Sampai Tanggal :</label>
                                <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="" onclick="this.href='{{ url('/laporan-konsultasi/cetak') }}'+ '/' +document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" target="_blank" style="margin-top: 28px;" class="btn btn-outline-info p-2"><i class="fas fa-print"></i> CETAK</a>
                            </div>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('sampah-laporan') }}" class="btn btn-warning sampahLaporan mb-3 p-2 " style="color: white;"><i class="fa fa-trash-restore"></i> SAMPAH</a>
                            <a href="" target="_blank" class="btn btn-outline-success mb-3 p-2 float-lg-right"><i class="fas fa-file-excel"></i> EXCEL</a>
                            <a href="" target="_blank" class="btn btn-outline-danger mb-3 mr-2 p-2 float-lg-right"><i class="fas fa-file-pdf"></i> PDF</a>
                        </div>
                    </div>
                        <table id="datatable" class="table table-bordered  table-striped nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" width="10%">No</th>
                                    <th style="text-align: center;" width="20%">Tanggal</th>
                                    <th width="40%">Nama User</th>
                                    <th width="40%">Nama Penyakit</th>
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
    $(document).ready(function(){
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('laporan-konsultasi.index') }}",
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
                "targets": [0,1], // your case first column
                "className": "text-center",
                "width": "5%"
            }],
        })


    })

    $(document).on('click', '.diagnosaDelete', function(e) {
        e.preventDefault();
        const idKonsultasi = $(this).attr('delete-konsultasi');
        const userKonsultasi = $(this).attr('user-konsultasi');
        
        swal({
            title: "Yakin?",
            text: `Data Laporan konsultasi ${userKonsultasi} akan dihapus?`,
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
                    url: `{{ url('/laporan-konsultasi/${idKonsultasi}') }}`,
                    type:"POST",
                    data: {
                        multi: null,
                        '_method': 'DELETE',
                        'id': idKonsultasi,
                    },
                    success: function(response){
                        swal({
                            title: "Sukses!",
                            text: `Data laporan konsutasi ${userKonsultasi} berhasil dihapus!`,
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        })

                        $('#datatable').DataTable().ajax.reload();
                    }
                })
            }
        })
    })
</script>
@endsection

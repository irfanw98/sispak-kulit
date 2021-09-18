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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Laporan Konsultasi</li>
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
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" width="10%">No</th>
                                    <th style="text-align: center;" width="20%">Tanngal</th>
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
</script>
@endsection

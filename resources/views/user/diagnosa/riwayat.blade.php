@extends('template.master')

@section('tittle', 'riwayat diagnosa')

@section('header')
<link rel="stylesheet" href="{{ asset('css/backend/user/riwayat/style.css') }}">
@endsection

@section('content')
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item" style="font-weight: bold;"><a href="{{ route('dashboard-user') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" style="font-weight: bold;">Riwayat Diagnosa</li>
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

                    <a href="{{ route('export-pdf')}}" class="btn btn-danger mb-3 p-2"><i class="fas fa-file-pdf"></i> export PDF</a>
                      
                    <table id="datatable" class="table table-bordered  table-striped nowrap" cellspacing="0" style="width: 100%;">
                      <thead>
                        <tr>
                          <th width="5%">No</th>
                          <th width="10%">Tanggal</th>
                          <th width="20%">Nama</th>
                          <th width="30%">Diagnosa Penyakit</th>
                          <th width="5%">Aksi</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
   
        </div>
    </div>
</div>

@section('footer')
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      stateSave: true,
      ajax: {
        url: "{{ route('riwayat-diagnosa.index') }}",
        method: "GET",
        dataType: "JSON"
      },
      columns : [
        {
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
        },
        {
          data: 'created_at',
          name: 'created_at'
        },
        {
          data: 'User',
          name: 'User.nama',
        },
        {
          data: 'Penyakit',
          name: 'Penyakit.nama',
        },
        {
          data: 'Aksi',
          name: 'Aksi',
        }
      ],
      'columnDefs': [{
        "targets": [0,1,4], // your case first column
        "className": "text-center",
      }],
    })
  })

  $(document).on('click', '.diagnosaDetail', function(e) {
    e.preventDefault();
    const idDiagnosa = $(this).attr('detail-diagnosa');
    
    $.ajax({
      url: `{{ url('/riwayat-diagnosa/${idDiagnosa}') }}`,
      method: 'GET',
      success: function(result) {
        $('#detailModal').modal('show');
        $('#detailModal').find('.modal-content').html(result);
      }
    })
  })
</script>
@endsection

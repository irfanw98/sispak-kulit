@extends('template.master')

@section('tittle', 'riwayat diagnosa')

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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Riwayat Diagnosa</li>
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
                      
                    <table id="datatable" class="table table-bordered  table-striped nowrap" cellspacing="0" style="width: 100%">
                      <thead>
                        <tr>
                          <th style="text-align: center;" width="10%">No</th>
                          <th width="40%">Nama Lengkap</th>
                          <th width="40%">Diagnosa Penyakit</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="gradModal">
            </div>
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
        "targets": 0, // your case first column
        "className": "text-center",
        "width": "4%"
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
        $('#detailModal').find('.modal-body').html(result);
      }
    })
  })
</script>
@endsection

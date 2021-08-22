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
                    <a href="" name="addDokter" class="btn btn-primary mb-3 p-2 addDokter"  role="button" style="color: white;"><i class="fa fa-plus-square"></i> TAMBAH</a>
                    <a href="#" class="btn btn-warning mb-3 p-2 " style="color: white;"><i class="fa fa-trash-restore"></i> SAMPAH</a>
                        <table id="datatable" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="40%">Nama</th>
                                    <th width="30%">Username</th>
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
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
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
                         responsive: true,
                         processing: true,
                         serverSide: true,
                         ajax: {
                                 url: "{{ url('/akun-dokter') }}",
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
                                data: 'username',
                                name: 'username'
                                },
                                {
                                data: 'Aksi',
                                name: 'Aksi'
                        }]
                })
        })

        //Detail Dokter
        $(document).on('click', '.dokterDetail', function(e) {
            e.preventDefault();
            const kode_dokter = $(this).attr('detail-kode');
            
            $.ajax({
                url:  `{{ url('/akun-dokter/${kode_dokter}') }}`,
                method: 'GET',
                success: function(result) {
                    $('#detailModal').modal('show');
                    $('#detailModal').find('.modal-body').html(result);
                }
            })
        })
</script>
@endsection

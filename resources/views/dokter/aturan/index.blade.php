@extends('template.master')

@section('tittle', 'aturan')

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
              <li class="breadcrumb-item"><a href="{{ route('dashboard-dokter') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Aturan</li>
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
                            <a href="" name="addAturan" class="btn btn-primary mb-3 p-2 addAturan"  role="button" style="color: white;"><i class="fa fa-plus-square"></i> TAMBAH</a>
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Kode Penyakit</th>
                                    <th width="30%">Nama Penyakit</th>
                                    <th width="30%">Daftar Gejala</th>
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

<!-- Modal Create  -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="gradModal">
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"></h5>
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
                url: "{{ url('aturan') }}",
                method: "GET",
                dataType: "JSON"
                },
                columns : [
                    {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                    },
                    {
                    data: 'kode_penyakit',
                    name: 'kode_penyakit'
                    },
                    {
                    data: 'nama',
                    name: 'nama'
                    },
                    {
                    data: 'gejala[- ].kode_gejala',
                    name: 'gejala[- ].kode_gejala',
                    },
                    {
                    data: 'Aksi',
                    name: 'Aksi'
                }]
            })
    })

    //TAMBAH DATA
    $(document).on('click', '.addAturan', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: "{{ route('aturan.create') }}",
            method: "GET",
            success: function(result) {
                $('#createModal').modal('show');
                $('#createModal').find('.modal-body').html(result);
            }
        })
    })

    $(document).on('click', '.saveButton', function(e) {
        e.preventDefault();
        let form = $('.formInsert')[0];
        const formData = new FormData(form);

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('aturan.store') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "JSON",
            success: function(response) {
                console.log(response);
            }
        })
    })
</script>
@endsection

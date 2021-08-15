@extends('template.master')

@section('tittle', 'admin')

@section('header')
    <style>
        .grad {
            background-image: linear-gradient(to right, #4e54c8, #8f94fb);
            height: 4px;
            border-radius: 20px;
        }
        /* .adminAdd {
            margin-left: 90%;
        } */
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
                   <button name="adminAdd" class="btn btn-sm btn-primary mb-3 p-2 adminAdd"><i class="fa fa-plus-square"></i> TAMBAH</button>
                    <table id="example" class="table table-bordered  table-striped  nowrap" cellspacing="0" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;" width="10%">No</th>
                                <th width="40%">Nama</th>
                                <th width="30%">Username</th>
                                <th style="text-align: center;" width="30%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td>Admin</td>
                                <td>adminsispak98</td>
                                <td style="text-align: center;">
                                    <a href="#" class="btn btn-info adminEdit" id="" role="button" edit-id=""><i class="fa fa-edit"></i> UBAH</a>
                                    <a href="#" class="btn btn-danger adminEdelete" role="button" delete-id="" sma=""><i class="fa fa-trash"></i> HAPUS</a>
                                </td>
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
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
        });
    });
</script>
@endsection

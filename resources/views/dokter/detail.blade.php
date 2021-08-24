<div class="container">
    <div class="row">
        <div class="col-md-12">
            <center class="mt-3">
                <img src="{{ asset('storage/dokter') }}/{{  $dokter->foto }}" width="200px" class="img-thumbnail">
            </center>
        </div>
    </div>
    <div class="row">
     <table class="table table-bordered table-striped  nowrap" cellspacing="0" style="width: 100%">
            <div class="col-md-12 mt-3">
                <tbody>
                    <tr>
                        <td>Kode Dokter</td>
                        <td> {{ $dokter->kode_dokter }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>{{ $dokter->nama }}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>{{ $dokter->username }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $dokter->email }}</td>
                    </tr>
                </tbody>
            </div>
     </table>    
    </div>
     <div class="row">
        <div class="col-lg-12 ">
            <div class="d-flex align-items-end flex-column bd-highlight mb-3">
                <div class="p-2 bd-highlight">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i> TUTUP</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <table class="table table-bordered table-striped  nowrap" cellspacing="0" style="width: 100%">
            <div class="col-md-12 mt-2">
                <tbody>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>{{ $diagnosa->user->nama }}</td>
                    </tr>
                    <tr>
                        <td>Diagnosa Penyakit</td>
                        <td>{{ $diagnosa->penyakit->nama }}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>{{ $diagnosa->penyakit->deskripsi }}</td>
                    </tr>
                    <tr>
                        <td>Solusi</td>
                        <td>{{ $diagnosa->penyakit->solusi }}</td>
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
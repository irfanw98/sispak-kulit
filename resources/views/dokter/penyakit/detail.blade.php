<div class="container">
    <div class="row">
     <table class="table table-bordered table-striped  nowrap" cellspacing="0" style="width: 100%">
            <div class="col-md-12">
                <tbody>
                    <tr>
                        <td>Kode Penyakit</td>
                        <td> {{ $penyakit->kode_penyakit }}</td>
                    </tr>
                    <tr>
                        <td>Nama Penyakit</td>
                        <td>{{ $penyakit->nama }}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>{{ $penyakit->deskripsi }}</td>
                    </tr>
                    <tr>
                        <td>Solusi</td>
                        <td>{{ $penyakit->solusi }}</td>
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
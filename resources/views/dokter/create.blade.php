<form action="" method="post" autocomplete="off" class="formInsert" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="kode_dokter">

            <div class="form-group">
                <label for="nama">Nama :</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="kode_dokter" id="kode_dokter">

            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="foto">Upload foto :</label>
                <input type="file" id="foto" name="foto">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary saveButton">SIMPAN</button>
        <button type="button" class="btn btn-outline-danger cancelButton"data-dismiss="modal">BATAL</button>
    </div>
</form>
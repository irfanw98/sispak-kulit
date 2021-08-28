<form action="" method="post" autocomplete="off"  class="formEdit">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="kode">Kode Gejala</label>
                <input type="text" class="form-control" name="kode" id="kode" value="{{ $gejala->kode_gejala }}" readonly="readonly" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="nama">Nama Gejala :</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $gejala->nama }}">

                <span class="text-danger" id="namaError"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary editButton">SIMPAN</button>
        <button type="button" class="btn btn-outline-danger cancelButton"data-dismiss="modal">BATAL</button>
    </div>
</form>
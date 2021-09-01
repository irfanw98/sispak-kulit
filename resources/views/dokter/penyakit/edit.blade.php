<form action="" method="post" autocomplete="off"  class="formEdit">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="kode">Kode Penyakit</label>
                <input type="text" class="form-control" name="kode" id="kode" value="{{ $penyakit->kode_penyakit }}" readonly="readonly" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="nama">Nama Penyakit :</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $penyakit->nama }}">

                <span class="text-danger" id="namaError"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="deskripsi">Deskripsi :</label>
                <textarea name="deskripsi" class="form-control"id="deskripsi" cols="10" rows="8">{{ $penyakit->deskripsi }}</textarea>

                <span class="text-danger" id="deskripsiError"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="solusi">Solusi :</label>
                <textarea name="solusi" class="form-control" id="solusi" cols="10" rows="8">{{ $penyakit->solusi }}</textarea>

                <span class="text-danger" id="solusiError"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary editButton">SIMPAN</button>
        <button type="button" class="btn btn-outline-danger cancelButton"data-dismiss="modal">BATAL</button>
    </div>
</form>
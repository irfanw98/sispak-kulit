<form action="" method="post" autocomplete="off"  class="formEdit" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="kode">Kode Dokter</label>
                <input type="text" class="form-control" name="kode" id="kode" value="{{ $dokter->kode_dokter }}" readonly="readonly" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama">Nama :</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $dokter->nama }}">

                <span class="text-danger" id="namaError"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $dokter->username }}">

                <span class="text-danger" id="usernameError"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $dokter->email }}">

                <span class="text-danger" id="emailError"></span>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="form-group">
                <img src="{{ asset('storage/dokter') }}/{{ $dokter->foto }}" width="200px" class="mb-2">
            </div>
        </div>
        <div class="col-md-6">
                <label for="foto">Upload foto baru :</label>
                <input type="file" id="foto" name="foto">
                <span class="text-danger" id="fotoError"></span>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary editButton">SIMPAN</button>
        <button type="button" class="btn btn-outline-danger cancelButton"data-dismiss="modal">BATAL</button>
    </div>
</form>
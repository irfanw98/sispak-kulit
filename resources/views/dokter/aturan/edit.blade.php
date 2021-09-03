<form action="" method="post" autocomplete="off" class="formEdit">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <select name="penyakit" class="form-control">
                    <option selected="" disabled="">-- PILIH PENYAKIT --</option>
                    @foreach($data as $penyakit)
                        <option value="{{ $penyakit->kode_penyakit }}" @if ($penyakit->kode_penyakit == $penyakit->gejala->penyakit_kode) SELECTED @endif>{{ $penyakit->kode_penyakit }} - {{ $penyakit->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="daftar_gejala">Daftar Gejala</label>
                <select name="daftar_gejala[]" class="select2multiple form-control" id="daftar_gejala" multiple>
                    <!-- <option selected="" disabled="">-- PILIH GEJALA --</option> -->
                    @foreach($gejalas as $gejala)
                        <option value="{{ $gejala->kode_gejala }}" @if ($gejala->kode_gejala == $data->kode_gejala) SELECTED @endif>{{ $gejala->kode_gejala }} - {{ $gejala->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary saveButton">SIMPAN</button>
        <button type="button" class="btn btn-outline-danger cancelButton"data-dismiss="modal">BATAL</button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2multiple').select2();
    })
</script>
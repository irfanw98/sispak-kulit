<form action="" method="post" autocomplete="off" class="formEdit">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="kode" id="kode" value="{{ $penyakit->kode_penyakit }}">

            <div class="form-group">
                <label for="nama">Penyakit :</label>
                <input type="text" class="form-control " name="nama" id="nama" value="{{ $penyakit->kode_penyakit }} - {{ $penyakit->nama }}" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="gejala">Pilih Gejala</label>
                <select name="gejala[]" class="gejala multiple form-control" multiple="multiple">
                    @foreach($gejalas as $gejala)
                        <option value="{{ $gejala->kode_gejala }}"
                            @foreach($penyakit->gejala as $aturan)
                                @if($aturan->kode_gejala  == $gejala->kode_gejala) selected @endif
                            @endforeach
                        >{{ $gejala->kode_gejala}} - {{ $gejala->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary editButton">SIMPAN</button>
        <button type="button" class="btn btn-outline-danger cancelButton"data-dismiss="modal">BATAL</button>
    </div>
</form>

<style>
    .select2-container--default .select2-selection--multiple 
    .select2-selection__rendered 
    .select2-selection__choice {
    background-color: #4e54c8;
    border-color: #4e54c8;
    color: #fff;
    padding: 7px;
    padding-left: 40px;
    }
     .select2-container--default .select2-selection--multiple 
    .select2-selection__rendered 
    .select2-selection__choice
    .select2-selection__choice__remove{
    border-right: 1px solid #aaa;
    height: 40px;
    padding: 7px;
    color: #aaa;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('.gejala').select2();
    })
</script>
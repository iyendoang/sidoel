<script>
    $(document).ready(function() {
        $('#ibu_dom_statusalamat').on("select2:select", function(e) {
            var ibu_dom_statusalamat = $(this).val();
            console.log($(this).val());
            if (ibu_dom_statusalamat == 1) {
                $('#id_ibu_dom_provinsi').show(700);
                $('#idxs_ibu_dom_provinsi').hide(600);
                $('#ibu_dom_provinsi').removeAttr("disabled", true).removeAttr("readonly", true);
                $('#ibu_dom_kota').removeAttr("disabled", true).removeAttr("readonly", true);
                $('#ibu_dom_kecamatan').removeAttr("disabled", true).removeAttr("readonly", true);
                $('#ibu_dom_kelurahan').removeAttr("disabled", true).removeAttr("readonly", true);
                $('#ibu_dom_alamat').removeAttr("disabled", true).removeAttr("readonly", true);
                $('#ibu_dom_rt').removeAttr("disabled", true).removeAttr("readonly", true);
                $('#ibu_dom_rw').removeAttr("disabled", true).removeAttr("readonly", true);
                $('#ibu_dom_kodepos').removeAttr("disabled", true).removeAttr("readonly", true);
                $('#idx_ibu_dom_provinsi').attr("disabled", true);
                $('#idx_ibu_dom_kota').attr("disabled", true);
                $('#idx_ibu_dom_kecamatan').attr("disabled", true);
                $('#idx_ibu_dom_kelurahan').attr("disabled", true);
                $('#idx_ibu_dom_alamat').attr("disabled", true);
                $('#idx_ibu_dom_rt').attr("disabled", true);
                $('#idx_ibu_dom_rw').attr("disabled", true);
                $('#idx_ibu_dom_kodepos').attr("disabled", true);
            } else {
                $('#id_ibu_dom_provinsi').hide(600);
                $('#idxs_ibu_dom_provinsi').show(700);
                $('#ibu_dom_provinsi').attr("disabled", true);
                $('#ibu_dom_kota').attr("disabled", true);
                $('#ibu_dom_kecamatan').attr("disabled", true);
                $('#ibu_dom_kelurahan').attr("disabled", true);
                $('#ibu_dom_alamat').attr("disabled", true);
                $('#ibu_dom_rt').attr("disabled", true);
                $('#ibu_dom_rw').attr("disabled", true);
                $('#ibu_dom_kodepos').attr("disabled", true);
                $('#idx_ibu_dom_provinsi').removeAttr("disabled", true).attr("readonly", true);
                $('#idx_ibu_dom_kota').removeAttr("disabled", true).attr("readonly", true);
                $('#idx_ibu_dom_kecamatan').removeAttr("disabled", true).attr("readonly", true);
                $('#idx_ibu_dom_kelurahan').removeAttr("disabled", true).attr("readonly", true);
                $('#idx_ibu_dom_alamat').removeAttr("disabled", true).attr("readonly", true);
                $('#idx_ibu_dom_rt').removeAttr("disabled", true).attr("readonly", true);
                $('#idx_ibu_dom_rw').removeAttr("disabled", true).attr("readonly", true);
                $('#idx_ibu_dom_kodepos').removeAttr("disabled", true).attr("readonly", true);
            }
        });
    });
</script>
<div id="idxs_ibu_dom_provinsi" class="row" style="display: none;">
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ibu_dom_provinsi">Provinsi</label>
            <input type="text" id="idx_ibu_dom_provinsi" class="form-control" placeholder="Nama Jalan dan Nomor" name="ibu_dom_provinsi" value="<?= $f_siswa_act['siswa_kk_provinsi'] ?>" />

        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ibu_dom_kota">Kabupaten/Kota</label>
            <input type="text" id="idx_ibu_dom_kota" class="form-control" placeholder="Nama Jalan dan Nomor" name="ibu_dom_kota" value="<?= $f_siswa_act['siswa_kk_kota'] ?>" />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ibu_dom_kecamatan">Kecamatan</label>
            <input type="text" id="idx_ibu_dom_kecamatan" class="form-control" placeholder="Nama Jalan dan Nomor" name="ibu_dom_kecamatan" value="<?= $f_siswa_act['siswa_kk_kecamatan'] ?>" />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ibu_dom_kelurahan">Kelurahan</label>
            <input type="text" id="idx_ibu_dom_kelurahan" class="form-control" placeholder="Nama Jalan dan Nomor" name="ibu_dom_kelurahan" value="<?= $f_siswa_act['siswa_kk_kelurahan'] ?>" />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label" for="ibu_dom_alamat">Nama Jalan dan Nomor</label>
            <input type="text" id="idx_ibu_dom_alamat" class="form-control" placeholder="Nama Jalan dan Nomor" name="ibu_dom_alamat" value="<?= $f_siswa_act['siswa_kk_alamat'] ?>" />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <label class="form-label" for="ibu_dom_rt">RT / RW</label>
        <div class="input-group mb-1">
            <input type="text" class="form-control" id="idx_ibu_dom_rt" name="ibu_dom_rt" placeholder="RT" value="<?= $f_siswa_act['siswa_kk_rt'] ?>" />
            <input type="text" class="form-control" id="idx_ibu_dom_rw" name="ibu_dom_rw" placeholder="RW" value="<?= $f_siswa_act['siswa_kk_rw'] ?>" />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ibu_dom_kodepos">Kode Pos</label>
            <input type="text" id="idx_ibu_dom_kodepos" class="form-control" name="ibu_dom_kodepos" placeholder="Kode Pos" value="<?= $f_siswa_act['siswa_kk_kodepos'] ?>" />
        </div>
    </div>
</div>
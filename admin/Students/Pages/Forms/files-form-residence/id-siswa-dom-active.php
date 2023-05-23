<div id="id_siswa_dom_provinsi" class="row">
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="siswa_dom_provinsi">Provinsi</label>
            <input type="text" id="siswa_dom_provinsi" class="form-control" placeholder="Provinsi" name="siswa_dom_provinsi" value="<?= $f_siswa_act['siswa_dom_provinsi'] ?>" readonly />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="siswa_dom_kota">Kabupaten/Kota</label>
            <input type="text" id="siswa_dom_kota" class="form-control" placeholder="Kabupaten/Kota" name="siswa_dom_kota" value="<?= $f_siswa_act['siswa_dom_kota'] ?>" readonly />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="siswa_dom_kecamatan">Kecamatan</label>
            <input type="text" id="siswa_dom_kecamatan" class="form-control" placeholder="Kecamatan" name="siswa_dom_kecamatan" value="<?= $f_siswa_act['siswa_dom_kecamatan'] ?>" readonly />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="siswa_dom_kelurahan">Kelurahan</label>
            <input type="text" id="siswa_dom_kelurahan" class="form-control" placeholder="Kelurahan" name="siswa_dom_kelurahan" value="<?= $f_siswa_act['siswa_dom_kelurahan'] ?>" readonly />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label" for="siswa_dom_alamat">Nama Jalan dan Nomor</label>
            <input type="text" id="siswa_dom_alamat" class="form-control" placeholder="Nama Jalan dan Nomor" name="siswa_dom_alamat" value="<?= $f_siswa_act['siswa_dom_alamat'] ?>" readonly />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <label class="form-label" for="siswa_dom_rt">RT / RW</label>
        <div class="input-group mb-1">
            <input type="text" class="form-control" id="siswa_dom_rt" name="siswa_dom_rt" placeholder="RT" value="<?= $f_siswa_act['siswa_dom_rt'] ?>" readonly />
            <input type="text" class="form-control" id="siswa_dom_rw" name="siswa_dom_rw" placeholder="RW" value="<?= $f_siswa_act['siswa_dom_rw'] ?>" readonly />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="siswa_dom_kodepos">Kode Pos</label>
            <input type="text" id="siswa_dom_kodepos" class="form-control" name="siswa_dom_kodepos" placeholder="Kode Pos" value="<?= $f_siswa_act['siswa_dom_kodepos'] ?>" readonly />
        </div>
    </div>
</div>
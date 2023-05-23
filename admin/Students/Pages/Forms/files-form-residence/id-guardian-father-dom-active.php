<div id="id_wali_dom_provinsi" class="row">
    <div class="col-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="alert-body">
                <i data-feather="user" class="me-50"></i>
                <span> Alamat Wali sama dengan <code>Ayah</code>, anda tidak bisa mengubahnya</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
<div class="row" style="display: none;">
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ayah_dom_provinsi">Provinsi</label>
            <select class="select2 form-select" id="ayah_died_dom_provinsi" name="wali_dom_provinsi" data-placeholder="Provinsi" readonly="readonly">
                <option value="0">Pilih</option>
            </select>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ayah_dom_kota">Kabupaten/Kota</label>
            <select class="select2 form-select" id="ayah_died_dom_kota" name="wali_dom_kota" data-placeholder="Kabupaten/Kota" readonly="readonly">
                <option value="0">Pilih</option>
            </select>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ayah_dom_kecamatan">Kecamatan</label>
            <select class="select2 form-select" id="ayah_died_dom_kecamatan" name="wali_dom_kecamatan" data-placeholder="Kecamatan" readonly="readonly">
                <option value="0">Pilih</option>
            </select>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ayah_dom_kelurahan">Kelurahan</label>
            <select class="select2 form-select" id="ayah_died_dom_kelurahan" name="wali_dom_kelurahan" data-placeholder="Kelurahan" readonly="readonly">
                <option value="0">Pilih</option>
            </select>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label" for="ayah_dom_alamat">Nama Jalan dan Nomor</label>
            <input type="text" id="ayah_died_dom_alamat" class="form-control" placeholder="Nama Jalan dan Nomor" name="wali_dom_alamat" value="0" readonly />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <label class="form-label" for="ayah_dom_rt">RT / RW</label>
        <div class="input-group mb-1">
            <input type="text" class="form-control" id="ayah_died_dom_rt" name="wali_dom_rt" placeholder="RT" value="0" readonly />
            <input type="text" class="form-control" id="ayah_died_dom_rw" name="wali_dom_rw" placeholder="RW" value="0" readonly />
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="mb-1">
            <label class="form-label" for="ayah_dom_kodepos">Kode Pos</label>
            <input type="text" id="ayah_died_dom_kodepos" class="form-control" name="wali_dom_kodepos" placeholder="Kode Pos" value="0" readonly />
        </div>
    </div>
</div>
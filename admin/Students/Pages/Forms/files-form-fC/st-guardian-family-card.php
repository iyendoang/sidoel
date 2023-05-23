<div class="card-header border-bottom">
    <h4 class="card-title">Data Wali</h4>
</div>
<div class="card-body">
    <div class="row mt-2">
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="siswa_wali_hubungan">Wali</label>
                <select class="select2 form-select" id="siswa_wali_hubungan" name="siswa_wali_hubungan" data-placeholder="Hubungan dengan Siswa">
                    <?php foreach ($statuswalihubungan as $code => $val) {  ?>
                        <?php if ($f_siswa_act['siswa_wali_hubungan'] == $code) { ?>
                            <option value="<?= $code ?>" selected><?= $val ?> </option>
                        <?php  } else { ?>
                            <option value="<?= $code ?>"><?= $val ?> </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_nama">Nama Wali</label>
                <input type="text" id="wali_kk_nama" class="form-control" placeholder="Nama Wali" name="wali_kk_nama" value="<?= $f_siswa_act['wali_kk_nama'] ?>" />
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_wn">Kewarganegaraan</label>
                <select class="select2 form-select" id="wali_kk_wn" name="wali_kk_wn" data-placeholder="Kewarganegaraan">
                    <?php foreach ($kewarganegaraan as $val) { ?>
                        <?php if ($f_siswa_act['wali_kk_wn'] == $val) { ?>
                            <option value="<?= $val ?>" selected><?= $val ?> </option>
                        <?php  } else { ?>
                            <option value="<?= $val ?>"><?= $val ?> </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_nik">NIK/Kitas</label>
                <input type="text" id="wali_kk_nik" class="form-control" name="wali_kk_nik" placeholder="NIK/Kitas" value="<?= $f_siswa_act['wali_kk_nik'] ?>" />
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_tempat">Tempat Lahir</label>
                <input type="text" id="wali_kk_tempat" class="form-control" name="wali_kk_tempat" placeholder="Tempat Lahir" value="<?= $f_siswa_act['wali_kk_tempat'] ?>" />
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_tgllahir">Tgl. Lahir</label>
                <input type="text" id="wali_kk_tgllahir" class="form-control flatpickr-basic" name="wali_kk_tgllahir" placeholder="Tgl. Lahir" value="<?= $f_siswa_act['wali_kk_tgllahir'] ?>" />
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_pendidikan">Pendidikan</label>
                <select class="select2 form-select" id="wali_kk_pendidikan" name="wali_kk_pendidikan" data-placeholder="Pendidikan">
                    <?php foreach ($pendidikan as $val) { ?>
                        <?php if ($f_siswa_act['wali_kk_pendidikan'] == $val) { ?>
                            <option value="<?= $val ?>" selected><?= $val ?> </option>
                        <?php  } else { ?>
                            <option value="<?= $val ?>"><?= $val ?> </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_pekerjaan">Pekerjaan</label>
                <select class="select2 form-select" id="wali_kk_pekerjaan" name="wali_kk_pekerjaan" data-placeholder="Pekerjaan">
                    <?php foreach ($pekerjaan as $code => $val) {  ?>
                        <?php if ($f_siswa_act['wali_kk_pekerjaan'] == $code) { ?>
                            <option value="<?= $code ?>" selected><?= $val ?> </option>
                        <?php  } else { ?>
                            <option value="<?= $code ?>"><?= $val ?> </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_penghasilan">Penghasilan</label>
                <select class="select2 form-select" id="wali_kk_penghasilan" name="wali_kk_penghasilan" data-placeholder="Penghasilan">
                    <?php foreach ($penghasilan as $val) { ?>
                        <?php if ($f_siswa_act['wali_kk_penghasilan'] == $val) { ?>
                            <option value="<?= $val ?>" selected><?= $val ?> </option>
                        <?php  } else { ?>
                            <option value="<?= $val ?>"><?= $val ?> </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="wali_kk_hp">No. HP</label>
                <input type="text" id="wali_kk_hp" class="form-control" name="wali_kk_hp" placeholder="No. HP" value="<?= $f_siswa_act['wali_kk_hp'] ?>" />
            </div>
        </div>
        <div class="text-end mt-2">
            <button type="submit" class="btn btn-primary me-1">Simpan</button>
            <button type="reset" class="btn btn-outline-secondary">Batal</button>
        </div>
    </div>
</div>
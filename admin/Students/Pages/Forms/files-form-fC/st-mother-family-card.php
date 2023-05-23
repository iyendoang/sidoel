<div class="card-header border-bottom">
    <h4 class="card-title">Data Ibu</h4>
</div>
<div class="card-body">
    <div class="row mt-2">
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="ibu_kk_nama">Nama Ibu</label>
                <input type="text" id="ibu_kk_nama" class="form-control" placeholder="Nama Ibu" name="ibu_kk_nama" value="<?= $f_siswa_act['ibu_kk_nama'] ?>" />
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="ibu_kk_status">Status Ibu</label>
                <select class="select2 form-select" id="ibu_kk_status" name="ibu_kk_status" data-placeholder="Status Ibu">
                    <option value="">Pilih</option>
                    <?php foreach ($statushidup as $code => $val) {  ?>
                        <?php if ($f_siswa_act['ibu_kk_status'] == $code) { ?>
                            <option value="<?= $code ?>" selected><?= $val ?> </option>
                        <?php  } else { ?>
                            <option value="<?= $code ?>"><?= $val ?> </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="id_ibu_kk_status">
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="ibu_kk_wn">Kewarganegaraan</label>
                <select class="select2 form-select" id="ibu_kk_wn" name="ibu_kk_wn" data-placeholder="Kewarganegaraan">
                    <option value="">Pilih</option>
                    <?php foreach ($kewarganegaraan as $val) { ?>
                        <?php if ($f_siswa_act['ibu_kk_wn'] == $val) { ?>
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
                <label class="form-label" for="ibu_kk_nik">NIK/Kitas</label>
                <input type="text" id="ibu_kk_nik" class="form-control" name="ibu_kk_nik" placeholder="NIK/Kitas" value="<?= $f_siswa_act['ibu_kk_nik'] ?>" />
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="ibu_kk_tempat">Tempat Lahir</label>
                <input type="text" id="ibu_kk_tempat" class="form-control" name="ibu_kk_tempat" placeholder="Tempat Lahir" value="<?= $f_siswa_act['ibu_kk_tempat'] ?>" />
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="ibu_kk_tgllahir">Tgl. Lahir</label>
                <input type="date" id="ibu_kk_tgllahir" class="form-control flatpickr-basic" name="ibu_kk_tgllahir" placeholder="Tgl. Lahir" value="<?= $f_siswa_act['ibu_kk_tgllahir'] ?>" />
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="mb-1">
                <label class="form-label" for="ibu_kk_pendidikan">Pendidikan</label>
                <select class="select2 form-select" id="ibu_kk_pendidikan" name="ibu_kk_pendidikan" data-placeholder="Pendidikan">
                    <option value="">Pilih</option>
                    <?php foreach ($pendidikan as $val) { ?>
                        <?php if ($f_siswa_act['ibu_kk_pendidikan'] == $val) { ?>
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
                <label class="form-label" for="ibu_kk_pekerjaan">Pekerjaan</label>
                <select class="select2 form-select" id="ibu_kk_pekerjaan" name="ibu_kk_pekerjaan" data-placeholder="Pekerjaan">
                    <option value="">Pilih</option>
                    <?php foreach ($pekerjaan as $code => $val) {  ?>
                        <?php if ($f_siswa_act['ibu_kk_pekerjaan'] == $code) { ?>
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
                <label class="form-label" for="ibu_kk_penghasilan">Penghasilan</label>
                <select class="select2 form-select" id="ibu_kk_penghasilan" name="ibu_kk_penghasilan" data-placeholder="Penghasilan">
                    <option value="">Pilih</option>
                    <?php foreach ($penghasilan as $val) { ?>
                        <?php if ($f_siswa_act['ibu_kk_penghasilan'] == $val) { ?>
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
                <label class="form-label" for="ibu_kk_hp">No. HP</label>
                <input type="text" id="ibu_kk_hp" class="form-control" name="ibu_kk_hp" placeholder="No. HP" value="<?= $f_siswa_act['ibu_kk_hp'] ?>" />
            </div>
        </div>
    </div>
</div>
<div class="card-header border-bottom">
    <h4 class="card-title">Data Ayah</h4>
</div>
<div class="card-body">
    <div class="row mt-2">
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="ayah_kk_nama">Nama Ayah</label>
                <input type="text" id="ayah_kk_nama" class="form-control" placeholder="Nama Ayah" name="ayah_kk_nama" value="<?= $f_siswa_act['ayah_kk_nama'] ?>" />
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="ayah_kk_status">Status Ayah</label>
                <select class="select2 form-select" id="ayah_kk_status" name="ayah_kk_status" data-placeholder="Status Ayah">
                    <?php foreach ($statushidup as $code => $val) {  ?>
                        <?php if ($f_siswa_act['ayah_kk_status'] == $code) { ?>
                            <option value="<?= $code ?>" selected><?= $val ?> </option>
                        <?php  } else { ?>
                            <option value="<?= $code ?>"><?= $val ?> </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <?php if ($f_siswa_act['ayah_kk_status'] != 0) { ?>
        <div class="row" id="id_ayah_kk_status" style="display: none;">
            <div class="col-md-3 col-12">
                <div class="mb-1">
                    <label class="form-label" for="ayah_kk_wn">Kewarganegaraan</label>
                    <select class="select2 form-select" id="ayah_kk_wn" name="ayah_kk_wn" data-placeholder="Kewarganegaraan">
                        <?php foreach ($kewarganegaraan as $val) { ?>
                            <?php if ($f_siswa_act['ayah_kk_wn'] == $val) { ?>
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
                    <label class="form-label" for="ayah_kk_nik">NIK/Kitas</label>
                    <input type="text" id="ayah_kk_nik" class="form-control" name="ayah_kk_nik" placeholder="NIK/Kitas" value="<?= $f_siswa_act['ayah_kk_nik'] ?>" />
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="mb-1">
                    <label class="form-label" for="ayah_kk_tempat">Tempat Lahir</label>
                    <input type="text" id="ayah_kk_tempat" class="form-control" name="ayah_kk_tempat" placeholder="Tempat Lahir" value="<?= $f_siswa_act['ayah_kk_tempat'] ?>" />
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="mb-1">
                    <label class="form-label" for="ayah_kk_tgllahir">Tgl. Lahir</label>
                    <input type="date" id="ayah_kk_tgllahir" class="form-control flatpickr-basic" name="ayah_kk_tgllahir" placeholder="Tgl. Lahir" value="<?= $f_siswa_act['ayah_kk_tgllahir'] ?>" />
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="mb-1">
                    <label class="form-label" for="ayah_kk_pendidikan">Pendidikan</label>
                    <select class="select2 form-select" id="ayah_kk_pendidikan" name="ayah_kk_pendidikan" data-placeholder="Pendidikan" required>
                        <?php foreach ($pendidikan as $val) { ?>
                            <?php if ($f_siswa_act['ayah_kk_pendidikan'] == $val) { ?>
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
                    <label class="form-label" for="ayah_kk_pekerjaan">Pekerjaan</label>
                    <select class="select2 form-select" id="ayah_kk_pekerjaan" name="ayah_kk_pekerjaan" data-placeholder="Pekerjaan">
                        <?php foreach ($pekerjaan as $code => $val) {  ?>
                            <?php if ($f_siswa_act['ayah_kk_pekerjaan'] == $code) { ?>
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
                    <label class="form-label" for="ayah_kk_penghasilan">Penghasilan</label>
                    <select class="select2 form-select" id="ayah_kk_penghasilan" name="ayah_kk_penghasilan" data-placeholder="Penghasilan">
                        <?php foreach ($penghasilan as $val) { ?>
                            <?php if ($f_siswa_act['ayah_kk_penghasilan'] == $val) { ?>
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
                    <label class="form-label" for="ayah_kk_hp">No. HP</label>
                    <input type="text" id="ayah_kk_hp" class="form-control" name="ayah_kk_hp" placeholder="No. HP" value="<?= $f_siswa_act['ayah_kk_hp'] ?>" />
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="row" id="id_ayah_kk_status">
            <div class="col-md-3 col-12">
                <div class="mb-1">
                    <label class="form-label" for="ayah_kk_wn">Kewarganegaraan</label>
                    <select class="select2 form-select" id="ayah_kk_wn" name="ayah_kk_wn" data-placeholder="Kewarganegaraan">
                        <?php foreach ($kewarganegaraan as $val) { ?>
                            <?php if ($f_siswa_act['ayah_kk_wn'] == $val) { ?>
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
                    <label class="form-label" for="ayah_kk_nik">NIK/Kitas</label>
                    <input type="text" id="ayah_kk_nik" class="form-control" name="ayah_kk_nik" placeholder="NIK/Kitas" value="<?= $f_siswa_act['ayah_kk_nik'] ?>" required />
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="mb-1">
                    <label class="form-label" for="ayah_kk_tempat">Tempat Lahir</label>
                    <input type="text" id="ayah_kk_tempat" class="form-control" name="ayah_kk_tempat" placeholder="Tempat Lahir" value="<?= $f_siswa_act['ayah_kk_tempat'] ?>" required />
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="mb-1">
                    <label class="form-label" for="ayah_kk_tgllahir">Tgl. Lahir</label>
                    <input type="date" id="ayah_kk_tgllahir" class="form-control flatpickr-basic" name="ayah_kk_tgllahir" placeholder="Tgl. Lahir" value="<?= $f_siswa_act['ayah_kk_tgllahir'] ?>" required />
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="mb-1">
                    <label class="form-label" for="ayah_kk_pendidikan">Pendidikan</label>
                    <select class="select2 form-select" id="ayah_kk_pendidikan" name="ayah_kk_pendidikan" data-placeholder="Pendidikan" required>
                        <?php foreach ($pendidikan as $val) { ?>
                            <?php if ($f_siswa_act['ayah_kk_pendidikan'] == $val) { ?>
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
                    <label class="form-label" for="ayah_kk_pekerjaan">Pekerjaan</label>
                    <select class="select2 form-select" id="ayah_kk_pekerjaan" name="ayah_kk_pekerjaan" data-placeholder="Pekerjaan">
                        <?php foreach ($pekerjaan as $code => $val) {  ?>
                            <?php if ($f_siswa_act['ayah_kk_pekerjaan'] == $code) { ?>
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
                    <label class="form-label" for="ayah_kk_penghasilan">Penghasilan</label>
                    <select class="select2 form-select" id="ayah_kk_penghasilan" name="ayah_kk_penghasilan" data-placeholder="Penghasilan">
                        <?php foreach ($penghasilan as $val) { ?>
                            <?php if ($f_siswa_act['ayah_kk_penghasilan'] == $val) { ?>
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
                    <label class="form-label" for="ayah_kk_hp">No. HP</label>
                    <input type="text" id="ayah_kk_hp" class="form-control" name="ayah_kk_hp" placeholder="No. HP" value="<?= $f_siswa_act['ayah_kk_hp'] ?>" />
                </div>
            </div>
        </div>
    <?php } ?>
</div>
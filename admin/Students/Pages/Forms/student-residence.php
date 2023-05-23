<?php include 'Students/Pages/Forms/nav-tab-student.php' ?>
<?php if ($f_siswa_act['siswa_wali_hubungan'] == '') { ?>
    <!-- Error page-->
    <div class="misc-wrapper">

        <div class="misc-inner p-2 p-sm-3">
            <div class="text-center">
                <a class="btn btn-primary mb-2 btn-sm-block" href="?pg=students-family-card&id=<?= enkripsi($f_siswa['siswa_id']) ?>">Kembali ke Kartu Keluarga</a>
                <h2 class="mb-1">Data Wali Belum Lengkap 🕵🏻‍♀️</h2>
                <p class="mb-2">Oops! 😖 Lengkapi data wali di Tab Kartu keluarga terlebih dahulu.</p>
                <img class="img-fluid" src="../app-assets/images/pages/error.svg" alt="Error page" />
            </div>
        </div>
    </div>
    <!-- / Error page-->
<?php } else { ?>
    <div class="card">
        <form class="form" id="FormEditResidence">
            <div class=" card-header border-bottom">
                <h4 class="card-title">Domisili</h4>
            </div>
            <div class="card-body">
                <div class="row mt-2">
                    <input type="hidden" name="siswa_id" id="siswa_id" value="<?= $f_siswa_act['siswa_id'] ?>">
                    <div class=" col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_dom_statusrumah">Status Rumah</label>
                            <select class="select2 form-select" id="siswa_dom_statusrumah" name="siswa_dom_statusrumah" data-placeholder="Status Rumah">
                                <?php foreach ($statustinggal as $val) { ?>
                                    <?php if ($f_siswa_act['siswa_dom_statusrumah'] == $val) { ?>
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
                            <label class="form-label" for="siswa_dom_jarak">Jarak ke Madrasah</label>
                            <select class="select2 form-select" id="siswa_dom_jarak" name="siswa_dom_jarak" data-placeholder="Jarak ke Madrasah">
                                <?php foreach ($jarak as $val) { ?>
                                    <?php if ($f_siswa_act['siswa_dom_jarak'] == $val) { ?>
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
                            <label class="form-label" for="siswa_dom_waktu">Waktu Tempuh</label>
                            <select class="select2 form-select" id="siswa_dom_waktu" name="siswa_dom_waktu" data-placeholder="Waktu Tempuh">
                                <?php foreach ($waktu as $val) { ?>
                                    <?php if ($f_siswa_act['siswa_dom_waktu'] == $val) { ?>
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
                            <label class="form-label" for="siswa_dom_transportasi">Transportasi</label>
                            <select class="select2 form-select" id="siswa_dom_transportasi" name="siswa_dom_transportasi" data-placeholder="Transportasi">
                                <?php foreach ($transportasi as $val) { ?>
                                    <?php if ($f_siswa_act['siswa_dom_transportasi'] == $val) { ?>
                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                    <?php  } else { ?>
                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_dom_statusalamat">Alamat Siswa</label>
                            <select class="select2 form-select" id="siswa_dom_statusalamat" name="siswa_dom_statusalamat" data-placeholder="Alamat Siswa">
                                <?php if ($f_siswa_act['siswa_dom_statusalamat'] == '1') { ?>
                                    <option value="1">Berbeda dengan Kartu Keluarga</option>
                                <?php } elseif ($f_siswa_act['siswa_dom_statusalamat'] == '2') { ?>
                                    <option value="2">Sama dengan Kartu Keluarga</option>
                                <?php } else { ?>
                                <?php } ?>
                                <option value="1">Berbeda dengan Kartu Keluarga</option>
                                <option value="2">Sama dengan Kartu Keluarga</option>
                            </select>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#siswa_dom_statusalamat').on("select2:select", function(e) {
                            var siswa_dom_statusalamat = $(this).val();
                            console.log($(this).val());
                            if (siswa_dom_statusalamat == 1) {
                                $('#id_siswa_dom_provinsi').show(700);
                                $('#idxs_siswa_dom_provinsi').hide(600);
                                $('#siswa_dom_provinsi').removeAttr("disabled", true).removeAttr("readonly", true);
                                $('#siswa_dom_kota').removeAttr("disabled", true).removeAttr("readonly", true);
                                $('#siswa_dom_kecamatan').removeAttr("disabled", true).removeAttr("readonly", true);
                                $('#siswa_dom_kelurahan').removeAttr("disabled", true).removeAttr("readonly", true);
                                $('#siswa_dom_alamat').removeAttr("disabled", true).removeAttr("readonly", true);
                                $('#siswa_dom_rt').removeAttr("disabled", true).removeAttr("readonly", true);
                                $('#siswa_dom_rw').removeAttr("disabled", true).removeAttr("readonly", true);
                                $('#siswa_dom_kodepos').removeAttr("disabled", true).removeAttr("readonly", true);
                                $('#idx_siswa_dom_provinsi').attr("disabled", true);
                                $('#idx_siswa_dom_kota').attr("disabled", true);
                                $('#idx_siswa_dom_kecamatan').attr("disabled", true);
                                $('#idx_siswa_dom_kelurahan').attr("disabled", true);
                                $('#idx_siswa_dom_alamat').attr("disabled", true);
                                $('#idx_siswa_dom_rt').attr("disabled", true);
                                $('#idx_siswa_dom_rw').attr("disabled", true);
                                $('#idx_siswa_dom_kodepos').attr("disabled", true);
                            } else {
                                $('#id_siswa_dom_provinsi').hide(600);
                                $('#idxs_siswa_dom_provinsi').show(700);
                                $('#siswa_dom_provinsi').attr("disabled", true);
                                $('#siswa_dom_kota').attr("disabled", true);
                                $('#siswa_dom_kecamatan').attr("disabled", true);
                                $('#siswa_dom_kelurahan').attr("disabled", true);
                                $('#siswa_dom_alamat').attr("disabled", true);
                                $('#siswa_dom_rt').attr("disabled", true);
                                $('#siswa_dom_rw').attr("disabled", true);
                                $('#siswa_dom_kodepos').attr("disabled", true);
                                $('#idx_siswa_dom_provinsi').removeAttr("disabled", true).attr("readonly", true);
                                $('#idx_siswa_dom_kota').removeAttr("disabled", true).attr("readonly", true);
                                $('#idx_siswa_dom_kecamatan').removeAttr("disabled", true).attr("readonly", true);
                                $('#idx_siswa_dom_kelurahan').removeAttr("disabled", true).attr("readonly", true);
                                $('#idx_siswa_dom_alamat').removeAttr("disabled", true).attr("readonly", true);
                                $('#idx_siswa_dom_rt').removeAttr("disabled", true).attr("readonly", true);
                                $('#idx_siswa_dom_rw').removeAttr("disabled", true).attr("readonly", true);
                                $('#idx_siswa_dom_kodepos').removeAttr("disabled", true).attr("readonly", true);
                            }
                        });
                    });
                </script>
                <?php include 'Students/Pages/Forms/files-form-residence/id-siswa-dom-active-x.php' ?>
                <?php include 'Students/Pages/Forms/files-form-residence/id-siswa-dom-active.php' ?>
            </div>
            <div class="card-header border-bottom">
                <h4 class="card-title">Alamat Ayah</h4>
            </div>
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-12 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="ayah_dom_statusalamat">Alamat Ayah</label>
                            <?php if ($f_siswa_act['ayah_kk_status'] == '0') { ?>
                                <select class="select2 form-select" id="ayah_dom_statusalamat" name="ayah_dom_statusalamat" data-placeholder="Alamat Ayah">
                                    <?php if ($f_siswa_act['ayah_dom_statusalamat'] == '1') { ?>
                                        <option value="1">Berbeda dengan Kartu Keluarga</option>
                                    <?php } elseif ($f_siswa_act['ayah_dom_statusalamat'] == '2') { ?>
                                        <option value="2">Sama dengan Kartu Keluarga</option>
                                    <?php } else { ?>
                                    <?php } ?>
                                    <option value="1">Berbeda dengan Kartu Keluarga</option>
                                    <option value="2">Sama dengan Kartu Keluarga</option>
                                </select>
                            <?php } else { ?>
                                <select class="select2 form-select" id="ayah_dom_statusalamat" name="ayah_dom_statusalamat" data-placeholder="Alamat Ayah" readonly="readonly">
                                    <option value="3">Tidak bisa di ubah</option>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if ($f_siswa_act['ayah_kk_status'] == '0') { ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-father-dom-active-x.php' ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-father-dom-active.php' ?>
                <?php } else { ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-father-dom-died.php' ?>
                <?php } ?>
            </div>
            <div class="card-header border-bottom">
                <h4 class="card-title">Alamat Ibu</h4>
            </div>
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-12 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="ibu_dom_statusalamat">Alamat ibu</label>
                            <?php if ($f_siswa_act['ibu_kk_status'] == '0') { ?>
                                <select class="select2 form-select" id="ibu_dom_statusalamat" name="ibu_dom_statusalamat" data-placeholder="Alamat ibu">
                                    <?php if ($f_siswa_act['ibu_dom_statusalamat'] == '1') { ?>
                                        <option value="1">Berbeda dengan Kartu Keluarga</option>
                                    <?php } elseif ($f_siswa_act['ibu_dom_statusalamat'] == '2') { ?>
                                        <option value="2">Sama dengan Kartu Keluarga</option>
                                    <?php } else { ?>
                                    <?php } ?>
                                    <option value="1">Berbeda dengan Kartu Keluarga</option>
                                    <option value="2">Sama dengan Kartu Keluarga</option>
                                </select>
                            <?php } else { ?>
                                <select class="select2 form-select" id="ibu_dom_statusalamat" name="ibu_dom_statusalamat" data-placeholder="Alamat ibu" readonly="readonly">
                                    <option value="3">Tidak bisa di ubah</option>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if ($f_siswa_act['ibu_kk_status'] == '0') { ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-mother-dom-active-x.php' ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-mother-dom-active.php' ?>
                <?php } else { ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-mother-dom-died.php' ?>
                <?php } ?>
            </div>
            <div class="card-header border-bottom">
                <h4 class="card-title">Alamat Wali</h4>
            </div>
            <div class="card-body">
                <div class="row mt-2">
                    <input type="hidden" name="siswa_wali_hubungan" value="<?= $f_siswa_act['siswa_wali_hubungan'] ?>">
                    <div class="col-md-12 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="wali_dom_statusalamat">Alamat Wali</label>
                            <?php if ($f_siswa_act['siswa_wali_hubungan'] == 3) { ?>
                                <select class="select2 form-select" id="wali_dom_statusalamat" name="wali_dom_statusalamat" data-placeholder="Alamat Wali">
                                    <?php if ($f_siswa_act['wali_dom_statusalamat'] == '1') { ?>
                                        <option value="1">Berbeda dengan Kartu Keluarga</option>
                                    <?php } elseif ($f_siswa_act['wali_dom_statusalamat'] == '2') { ?>
                                        <option value="2">Sama dengan Kartu Keluarga</option>
                                    <?php } else { ?>
                                    <?php } ?>
                                    <option value="1">Berbeda dengan Kartu Keluarga</option>
                                    <option value="2">Sama dengan Kartu Keluarga</option>
                                </select>
                            <?php } else { ?>
                                <select class="select2 form-select" id="wali_dom_statusalamat" name="wali_dom_statusalamat" data-placeholder="Alamat Wali" readonly="readonly">
                                    <option value="4">Sama dengan status wali
                                        <?php if ($f_siswa_act['siswa_wali_hubungan'] == 1) { ?>
                                            Ayah
                                        <?php } else { ?>
                                            Ibu
                                        <?php } ?>
                                    </option>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if ($f_siswa_act['siswa_wali_hubungan'] == 1) { ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-guardian-father-dom-active.php' ?>
                <?php } elseif ($f_siswa_act['siswa_wali_hubungan'] == 2) { ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-guardian-mother-dom-active.php' ?>
                <?php } else { ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-guardian-dom-active-x.php' ?>
                    <?php include 'Students/Pages/Forms/files-form-residence/id-guardian-dom-active.php' ?>
                <?php } ?>
                <div class="text-end mt-2">
                    <button type="submit" class="btn btn-primary me-1">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary">Batal</button>
                </div>
            </div>
        </form>
    </div>
    <script src="Students/js/students-residence.js"></script>
<?php } ?>
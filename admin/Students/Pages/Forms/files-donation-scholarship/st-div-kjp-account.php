<div class="col-12">
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Data Bantuan KJP</h4>
        </div>
        <form id="FormSiswaKJP" method="post">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-8 col-12">
                        <input type="hidden" class="form-control" name="siswa_id" readonly value="<?= $f_siswa_act['siswa_id'] ?>" />

                        <div class="mb-1">
                            <label class="form-label" for="siswa_kjp_namarek">Nama Siswa</label>
                            <input type="text" class="form-control" readonly value="<?= $e_siswa['siswa_nama'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kjp_status">Apakah Penerima KJP</label>
                            <select class="select2 form-select" id="siswa_kjp_status" name="siswa_kjp_status" data-placeholder="Apakah Penerima KJP">
                                <option value=''>---Pilih---</option>";
                                <?php foreach ($statuspenerima as $code => $val) {  ?>
                                    <?php if ($f_siswa_act['siswa_kjp_status'] == $code) { ?>
                                        <option value="<?= $code ?>" selected><?= $val ?> </option>
                                    <?php  } else { ?>
                                        <option value="<?= $code ?>"><?= $val ?> </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="id_formKjpRow">
                    <div class="col-md-8 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kjp_namarek">Nama di Rekening KJP Lengkap & QQ</label>
                            <input type="text" id="siswa_kjp_namarek" class="form-control" name="siswa_kjp_namarek" placeholder="Nama di Rekening KJP Lengkap & QQ" readonly value="<?= $f_siswa_act['siswa_kjp_namarek'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kjp_norek">Nomor Rekening KJP</label>
                            <input type="text" id="siswa_kjp_norek" class="form-control" name="siswa_kjp_norek" placeholder="Nomor Rekening KJP" readonly value="<?= $f_siswa_act['siswa_kjp_norek'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kjp_bankcab">Bank Cabang</label>
                            <input type="text" id="siswa_kjp_bankcab" class="form-control" name="siswa_kjp_bankcab" placeholder="Bank Cabang" readonly value="<?= $f_siswa_act['siswa_kjp_bankcab'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kjp_nomoratm">Nomor Kartu KJP</label>
                            <input type="text" id="siswa_kjp_nomoratm" class="form-control" placeholder="Nomor Kartu KJP" name="siswa_kjp_nomoratm" readonly value="<?= $f_siswa_act['siswa_kjp_nomoratm'] ?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-end mt-2">
                        <button type="submit" class="btn btn-primary me-1">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary">Batal</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php if ($f_siswa_act['siswa_kjp_status'] == '1') { ?>
    <div class="card card-transaction" id="id_fileKjpRow">
        <div class="card-header px-3 border-bottom">
            <h4 class="card-title">File KJP <code>Kartu Jakarta Pintar</code></h4>
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
        </div>
        <div class="row mt-2">
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kjp-account.php' ?>
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kjp-guardian-identity.php' ?>
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kjp-atm-card.php' ?>
        </div>
    </div>
<?php } else { ?>
    <div class="card card-transaction" id="id_fileKjpRow" style="display: none;">
        <div class="card-header px-3 border-bottom">
            <h4 class="card-title">File KJP <code>Kartu Jakarta Pintar</code></h4>
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
        </div>
        <div class="row mt-2">
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kjp-account.php' ?>
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kjp-guardian-identity.php' ?>
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kjp-atm-card.php' ?>
        </div>
    </div>
<?php } ?>
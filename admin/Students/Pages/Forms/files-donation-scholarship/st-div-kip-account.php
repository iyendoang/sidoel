<div class="col-12">
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Data Bantuan KIP</h4>
        </div>
        <form id="FormSiswaKIP" method="post">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-8 col-12">
                        <input type="hidden" class="form-control" name="siswa_id" readonly value="<?= $f_siswa_act['siswa_id'] ?>" />

                        <div class="mb-1">
                            <label class="form-label" for="siswa_kip_namarek">Nama Siswa</label>
                            <input type="text" class="form-control" readonly value="<?= $e_siswa['siswa_nama'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kip_status">Apakah Penerima KIP</label>
                            <select class="select2 form-select" id="siswa_kip_status" name="siswa_kip_status" data-placeholder="Apakah Penerima KIP">
                                <!-- <option value=''>---Pilih---</option>"; -->
                                <?php foreach ($statuspenerima as $code => $val) {  ?>
                                    <?php if ($f_siswa_act['siswa_kip_status'] == $code) { ?>
                                        <option value="<?= $code ?>" selected><?= $val ?> </option>
                                    <?php  } else { ?>
                                        <option value="<?= $code ?>"><?= $val ?> </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="id_formKipRow">
                    <div class="col-md-8 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kip_namarek">Nama di Rekening KIP</label>
                            <input type="text" id="siswa_kip_namarek" class="form-control" name="siswa_kip_namarek" placeholder="Nama di Rekening KIP" readonly value="<?= $f_siswa_act['siswa_kip_namarek'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kip_norek">Nomor Rekening KIP</label>
                            <input type="text" id="siswa_kip_norek" class="form-control" name="siswa_kip_norek" placeholder="Nomor Rekening KIP" readonly value="<?= $f_siswa_act['siswa_kip_norek'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kip_bankcab">Bank Cabang</label>
                            <input type="text" id="siswa_kip_bankcab" class="form-control" name="siswa_kip_bankcab" placeholder="Bank Cabang" readonly value="<?= $f_siswa_act['siswa_kip_bankcab'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kip_nomoratm">Nomor Kartu KIP</label>
                            <input type="text" id="siswa_kip_nomoratm" class="form-control" placeholder="Nomor Kartu KIP" name="siswa_kip_nomoratm" readonly value="<?= $f_siswa_act['siswa_kip_nomoratm'] ?>" />
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
<?php if ($f_siswa_act['siswa_kip_status'] == '1') { ?>
    <div class="card card-transaction" id="id_fileKipRow">
        <div class="card-header px-3 border-bottom">
            <h4 class="card-title">File KIP <code>Kartu Indonesia Pintar</code></h4>
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
        </div>
        <div class="row mt-2">
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kip-account.php' ?>
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kip-guardian-identity.php' ?>
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kip-atm-card.php' ?>
        </div>
    </div>
<?php } else { ?>
    <div class="card card-transaction" id="id_fileKipRow" style="display: none;">
        <div class="card-header px-3 border-bottom">
            <h4 class="card-title">File KIP <code>Kartu Indonesia Pintar</code></h4>
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
        </div>
        <div class="row mt-2">
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kip-account.php' ?>
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kip-guardian-identity.php' ?>
            <?php include 'Students/Pages/Forms/files-donation-scholarship/st-file-kip-atm-card.php' ?>
        </div>
    </div>
<?php } ?>
<?php include 'Students/Pages/Forms/nav-tab-student.php' ?>

<div class="card p-0 m-0">
    <div class="card-header border-bottom">
        <h5 class="card-title">Akta Kelahiran <?= ucwords(strtolower($e_siswa['siswa_nama'])) ?></h5>
    </div>
    <div class="card-body my-2 py-50">
        <form class="form form-block" id="formEditCertificateOfBirth" method="post" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="siswa_id" id="siswa_id" value="<?= $f_siswa_act['siswa_id'] ?>">
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_akta_nama">Nama di Akta</label>
                        <input type="text" id="siswa_akta_nama" class="form-control" placeholder="Nama di Akta" name="siswa_akta_nama" value="<?= $f_siswa_act['siswa_akta_nama'] ?>" />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_akta_nik">NIK</label>
                        <input type="text" id="siswa_akta_nik" class="form-control" placeholder="NIK" name="siswa_akta_nik" value="<?= $f_siswa_act['siswa_akta_nik'] ?>" />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_akta_tempat">Tempat Lahir</label>
                        <input type="text" id="siswa_akta_tempat" class="form-control" placeholder="Tempat Lahir" name="siswa_akta_tempat" value="<?= $f_siswa_act['siswa_akta_tempat'] ?>" />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_akta_tgllahir">Tgl. Lahir</label>
                        <input type="text" id="siswa_akta_tgllahir" class="form-control flatpickr-basic" name="siswa_akta_tgllahir" placeholder="Tgl. Lahir" value="<?= $f_siswa_act['siswa_akta_tgllahir'] ?>" />
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_akta_ayah">Nama Ayah</label>
                        <input type="text" id="siswa_akta_ayah" class="form-control" name="siswa_akta_ayah" placeholder="Nama Ayah" value="<?= $f_siswa_act['siswa_akta_ayah'] ?>" />
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_akta_ibu">Nama Ibu</label>
                        <input type="text" id="siswa_akta_ibu" class="form-control" name="siswa_akta_ibu" placeholder="Nama Ibu" value="<?= $f_siswa_act['siswa_akta_ibu'] ?>" />
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="file_akta_siswa">Upload Akte Kelahiran /
                            <a href="../<?= $f_siswa_act['file_akta_siswa'] ?>"><span class="">Lihat File</span></a>
                        </label>
                        <input class="form-control" type="hidden" id="file_akta_siswalama" name="file_akta_siswalama" value="<?= $f_siswa_act['file_akta_siswa'] ?>" />
                        <input class="form-control" type="file" id="file_akta_siswa" name="file_akta_siswa" />
                    </div>
                </div>
                <div class="text-end mt-2">
                    <button type="submit" class="btn btn-primary me-1 btn-simpan">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary btn-batal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="Students/js/student-certificate-of-birth.js"></script>

<?php include 'Students/Pages/Forms/nav-tab-student.php' ?>

<div class="col-12">
    <div class="card">
        <form class="form" id="form-FormSiswaKK">
            <div class="card-header border-bottom">
                <h4 class="card-title">Kartu Keluarga</h4>
            </div>
            <div class="card-body">
                <div class="row mt-2">
                    <input type="hidden" name="siswa_id" id="siswa_id" value="<?= $f_siswa_act['siswa_id'] ?>">
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_nomor">No. KK</label>
                            <input type="text" id="siswa_kk_nomor" class="form-control" placeholder="No. KK" name="siswa_kk_nomor" value="<?= $f_siswa_act['siswa_kk_nomor'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_kepala">Nama Kepala Keluarga</label>
                            <input type="text" id="siswa_kk_kepala" class="form-control" placeholder="Nama Kepala Keluarga" name="siswa_kk_kepala" value="<?= $f_siswa_act['siswa_kk_kepala'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <label class="form-label" for="siswa_kk_rt">RT / RW</label>
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" id="siswa_kk_rt" name="siswa_kk_rt" placeholder="RT" value="<?= $f_siswa_act['siswa_kk_rt'] ?>" />
                            <input type="text" class="form-control" id="siswa_kk_rw" name="siswa_kk_rw" placeholder="RW" value="<?= $f_siswa_act['siswa_kk_rw'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-9 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_alamat">Nama Jalan dan Nomor</label>
                            <input type="text" id="siswa_kk_alamat" class="form-control" placeholder="Nama Jalan dan Nomor" name="siswa_kk_alamat" value="<?= $f_siswa_act['siswa_kk_alamat'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_kodepos">Kode Pos</label>
                            <input type="text" id="siswa_kk_kodepos" class="form-control" name="siswa_kk_kodepos" placeholder="Kode Pos" value="<?= $f_siswa_act['siswa_kk_kodepos'] ?>" />
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_provinsi">Provinsi</label>
                            <input type="text" id="siswa_kk_provinsi" class="form-control" name="siswa_kk_provinsi" placeholder="Kode Pos" value="<?= $f_siswa_act['siswa_kk_provinsi'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_kota">Kabupaten/Kota</label>
                            <input type="text" id="siswa_kk_kota" class="form-control" name="siswa_kk_kota" placeholder="Kode Pos" value="<?= $f_siswa_act['siswa_kk_kota'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_kecamatan">Kecamatan</label>
                            <input type="text" id="siswa_kk_kecamatan" class="form-control" name="siswa_kk_kecamatan" placeholder="Kode Pos" value="<?= $f_siswa_act['siswa_kk_kecamatan'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_kelurahan">Kelurahan</label>
                            <input type="text" id="siswa_kk_kelurahan" class="form-control" name="siswa_kk_kelurahan" placeholder="Kode Pos" value="<?= $f_siswa_act['siswa_kk_kelurahan'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_nama">Nama Siswa di KK</label>
                            <input type="text" id="siswa_kk_nama" class="form-control" name="siswa_kk_nama" placeholder="Nama Siswa di KK" value="<?= $f_siswa_act['siswa_kk_nama'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_wn">Kewarganegaraan</label>
                            <select class="select2 form-select" id="siswa_kk_wn" name="siswa_kk_wn" data-placeholder="Kewarganegaraan">
                                <option value="<?= $f_siswa_act['siswa_kk_wn'] ?>"><?= $f_siswa_act['siswa_kk_wn'] ?></option>
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_nik">NIK/Kitas</label>
                            <input type="text" id="siswa_kk_nik" class="form-control" name="siswa_kk_nik" placeholder="NIK/Kitas" value="<?= $f_siswa_act['siswa_kk_nik'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_tempat">Tempat Lahir</label>
                            <input type="text" id="siswa_kk_tempat" class="form-control" name="siswa_kk_tempat" placeholder="Tempat Lahir" value="<?= $f_siswa_act['siswa_kk_tempat'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_tgllahir">Tgl. Lahir</label>
                            <input type="text" id="siswa_kk_tgllahir" class="form-control flatpickr-basic" name="siswa_kk_tgllahir" placeholder="Tgl. Lahir" value="<?= $f_siswa_act['siswa_kk_tgllahir'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <label class="form-label" for="siswa_kk_anakke">Anak Ke / Jmlh Saudara</label>
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" id="siswa_kk_anakke" name="siswa_kk_anakke" placeholder="Anak Ke" value="<?= $f_siswa_act['siswa_kk_anakke'] ?>" />
                            <input type="text" class="form-control" id="siswa_kk_jmlsaudara" name="siswa_kk_jmlsaudara" placeholder="Jmlh Saudara" value="<?= $f_siswa_act['siswa_kk_jmlsaudara'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="siswa_kk_darah">Gol. Darah</label>
                            <select class="select2 form-select" id="siswa_kk_darah" name="siswa_kk_darah" data-placeholder="Gol. Darah">
                                <option value="<?= $f_siswa_act['siswa_kk_darah'] ?>"><?= $f_siswa_act['siswa_kk_darah'] ?></option>
                                <?php foreach ($gol_darah as $val) { ?>
                                    <?php if ($f_siswa_act['siswa_kk_darah'] == $val) { ?>
                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                    <?php  } else { ?>
                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'Students/Pages/Forms/files-form-fC/st-father-family-card.php' ?>
            <?php include 'Students/Pages/Forms/files-form-fC/st-mother-family-card.php' ?>
            <?php include 'Students/Pages/Forms/files-form-fC/st-guardian-family-card.php' ?>
        </form>
        <?php include 'Students/Pages/Forms/files-form-fC/st-file-family-card.php' ?>
    </div>
</div>
<script src="Students/js/students-family-card.js"></script>
<script src="Students/js/students-family-card-files.js"></script>


<?php include 'Students/Pages/Forms/nav-tab-student.php' ?>

<div class="card p-0 m-0">
    <div class="card-header border-bottom">
        <h5 class="card-title text-capitalize">Update Aktivitas <?= ucfirst(strtolower($e_siswa['siswa_nama'])) ?></h5>
        <div class="row">
            <div class="col-md-3 kelas_nama"></div>
            <div class="col-md-3 lembaga_status"></div>
            <div class="col-md-3 lembaga_kec"></div>
            <div class="col-md-3 tingkat_deskripsi"></div>
        </div>
    </div>
    <div class="card-body my-2 py-50">
        <form id="formEditActivity" method="post">
            <div class="row">
                <input type="hidden" id="siswa_id" class="form-control" name="siswa_id" value="<?= $e_siswa['siswa_id'] ?>" />
                <div class="col-md-12 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_nama">Nama Lengkap Siswa</label>
                        <input type="text" id="siswa_nama" class="form-control" placeholder="Nama Lengkap Siswa" name="siswa_nama" value="<?= $e_siswa['siswa_nama'] ?>" />
                        <div class="invalid-feedback">Please enter your name.</div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_nis">
                            NIS Lokal
                            <span class="badge bg-danger">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="jika ingin melakukan update NIS Lokal Silahkan Lakukan Update di Aplikasi RDM anda">
                                    <i data-feather='alert-circle'></i>
                                </a>
                            </span>
                        </label>
                        <input type="text" class="form-control" placeholder="NIS Lokal" value="<?= $e_siswa['siswa_nis'] ?>" disabled readonly />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_nisn">NISN RDM</label>
                        <input type="text" id="siswa_nisn" class="form-control" placeholder="NISN" name="siswa_nisn" value="<?= $e_siswa['siswa_nisn'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_tempat">Tempat Lahir</label>
                        <input type="text" id="siswa_tempat" class="form-control" placeholder="Tempat Lahir" name="siswa_tempat" value="<?= $e_siswa['siswa_tempat'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_tgllahir">Tanggal Lahir</label>
                        <input type="text" id="siswa_tgllahir" class="form-control flatpickr-basic" placeholder="Tanggal Lahir" name="siswa_tgllahir" value="<?= $e_siswa['siswa_tgllahir'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="tingkat_nama">Tingkat
                            <span class="badge bg-warning">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="jika ingin melakukan update Tingkat Silahkan Lakukan Update di Aplikasi RDM anda">
                                    <i data-feather='alert-circle'></i>
                                </a>
                            </span>
                        </label>
                        <input disabled type="text" id="tingkat_nama" class="form-control" placeholder="Tingkat" name="tingkat_nama" value="<?= $e_tingkat['tingkat_nama'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="kelas_nama">Rombel
                            <span class="badge bg-info">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="jika ingin melakukan update Rombel Silahkan Lakukan Update di Aplikasi RDM anda">
                                    <i data-feather='alert-circle'></i>
                                </a>
                            </span>
                        </label>
                        <input disabled type="text" id="kelas_nama" class="form-control" placeholder="Rombel" name="kelas_nama" value="<?= $e_kelas['kelas_nama'] ?>" />
                    </div>
                </div>

                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="jurusan_nama">Jurusan
                            <span class="badge bg-secondary">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="jika ingin melakukan update Jurusan Silahkan Lakukan Update di Aplikasi RDM anda">
                                    <i data-feather='alert-circle'></i>
                                </a>
                            </span>
                        </label>
                        <input disabled type="text" id="jurusan_nama" class="form-control" placeholder="Jurusan" name="jurusan_nama" value="<?= $e_jurusan['jurusan_nama'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_gender">Jenis Kelamin</label>
                        <div class="demo-inline-spacing ">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="siswa_gender" id="siswa_genderL" value="L" <?php if ($e_siswa['siswa_gender'] == 'L') echo 'checked' ?>>
                                <label class="form-check fw-bolder-label" for="siswa_genderL">Lak-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="siswa_gender" id="siswa_genderP" value="P" <?php if ($e_siswa['siswa_gender'] == 'P') echo 'checked' ?>>
                                <label class="form-check fw-bolder-label" for="siswa_genderP">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_act_hobi">Hobi</label>
                        <select class="select2 form-select" id="siswa_act_hobi" name="siswa_act_hobi" data-placeholder="Hobi">
                            <option value=''>---Pilih---</option>";
                            <?php foreach ($hobi as $val) { ?>
                                <?php if ($f_siswa_act['siswa_act_hobi'] == $val) { ?>
                                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                                <?php  } else { ?>
                                    <option value='<?= $val ?>'><?= $val ?> </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_act_cita">Cita-cita</label>
                        <select class="select2 form-select" id="siswa_act_cita" name="siswa_act_cita" data-placeholder="Cita-cita">
                            <option value=''>---Pilih---</option>";
                            <?php foreach ($cita as $val) { ?>
                                <?php if ($f_siswa_act['siswa_act_cita'] == $val) { ?>
                                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                                <?php  } else { ?>
                                    <option value='<?= $val ?>'><?= $val ?> </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_act_abk">Kebutuhan Khusus</label>
                        <select class="select2 form-select" id="siswa_act_abk" name="siswa_act_abk" data-placeholder="Kebutuhan Khusus">
                            <option value='<?= $f_siswa_act['siswa_act_abk'] ?>'>---Pilih---</option>";
                            <?php foreach ($keb_khusus as $val) { ?>
                                <?php if ($f_siswa_act['siswa_act_abk'] == $val) { ?>
                                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                                <?php  } else { ?>
                                    <option value='<?= $val ?>'><?= $val ?> </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_act_disability">Disabilitas</label>
                        <select class="select2 form-select" id="siswa_act_disability" name="siswa_act_disability" data-placeholder="Disabilitas">
                            <option value='<?= $f_siswa_act['siswa_act_disability'] ?>'>---Pilih---</option>";
                            <?php foreach ($keb_disabilitas as $val) { ?>
                                <?php if ($f_siswa_act['siswa_act_disability'] == $val) { ?>
                                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                                <?php  } else { ?>
                                    <option value='<?= $val ?>'><?= $val ?> </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_telpon">No. Handphone</label>
                        <input type="text" id="siswa_telpon" class="form-control" name="siswa_telpon" placeholder="No. Handphone" value="<?= $e_siswa['siswa_telpon'] ?>" />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label fw-bolder" for="siswa_act_email">Email</label>
                        <input type="text" id="siswa_act_email" class="form-control" name="siswa_act_email" placeholder="Email" value="<?= $f_siswa_act['siswa_act_email'] ?>" />
                    </div>
                </div>
                <div class="text-end mt-2">
                    <button type="submit" id="saveForm" class="btn btn-primary me-1 submit">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="Students/js/student-activity.js"></script>
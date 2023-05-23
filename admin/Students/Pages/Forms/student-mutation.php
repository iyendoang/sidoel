<?php
$e_siswa = fetch($koneksi, 'e_siswa', ['siswa_id' => dekripsi($_GET['id'])]);
$f_siswa_act = fetch($koneksi, 'f_siswa_act', ['siswa_id' => $e_siswa['siswa_id']]);
$e_tahunajaran = fetch($koneksi, 'e_tahunajaran', ['tahunajaran_id' => $e_siswa['siswa_tahun_mutasi']]);
$e_semester = fetch($koneksi, 'e_semester', ['semester_id' => $e_siswa['siswa_semester_mutasi']]);
$e_tingkat = fetch($koneksi, 'e_tingkat', ['tingkat_id' => $e_siswa['tingkat_id']]);
$e_kelas = fetch($koneksi, 'e_kelas', ['kelas_id' => $e_siswa['kelas_id']]);
$e_jurusan = fetch($koneksi, 'e_jurusan', ['jurusan_id' => $e_kelas['jurusan_id']]);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Edit Data Mutasi</h4>
            </div>
            <div class="card-body">
                <form class="form" id="editMutation">
                    <div class="row mt-2">
                        <input type="hidden" name="siswa_id" id="siswa_id" value="<?= $e_siswa['siswa_id'] ?>">
                        <input type="hidden" name="tahunajaran_id" id="tahunajaran_id" value="<?= $e_siswa['siswa_tahun_mutasi'] ?>">
                        <input type="hidden" name="semester_id" id="semester_id" value="<?= $e_siswa['siswa_semester_mutasi'] ?>">
                        <input type="hidden" name="siswa_mutasi_kelaslama" id="kelas_id" value="<?= $e_siswa['kelas_id'] ?>">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="siswa_nama">Siswa Mutasi</label>
                                <input type="text" id="siswa_nama" class="form-control"  placeholder="Siswa Mutasi" value="<?= $e_siswa['siswa_nama'] ?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="siswa_tahun_mutasi">Tahun Mutasi</label>
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" id="siswa_tahun_mutasi" value="<?= $e_tahunajaran['tahunajaran_nama'] ?>" disabled />
                                <input type="text" class="form-control" id="siswa_semester_mutasi" value="<?= $e_semester['semester_nama'] ?>" disabled />
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="siswa_mutasi_kelaslama">Kelas yang ditinggalkan</label>
                                <input type="text" class="form-control" id="siswa_mutasi_kelaslama" name="kelas_id" value="<?= $e_tingkat['tingkat_nama'] ?>-<?= $e_kelas['kelas_nama'] ?> <?= $e_jurusan['jurusan_nama'] ?>" disabled />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="siswa_mutasi_alasan">Alasan Mutasi</label>
                                <select class="select2 form-select" id="siswa_mutasi_alasan" name="siswa_mutasi_alasan" data-placeholder="Mutasi Ke">
                                    <?php foreach ($alasan_mutasi as $code => $val) {  ?>
                                        <?php if ($f_siswa_act['siswa_mutasi_alasan'] == $code) { ?>
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
                                <label class="form-label" for="siswa_mutasi_tgl">Tanggal Mutasi</label>
                                <input type="text" id="siswa_mutasi_tgl" class="form-control flatpickr-basic" name="siswa_mutasi_tgl" placeholder="Tanggal Mutasi" value="<?= $f_siswa_act['siswa_mutasi_tgl'] ?>" />
                            </div>
                        </div>
                       
                        <div class="col-md-3 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="siswa_mutasi_ke">Mutasi Ke</label>
                                <select class="select2 form-select" id="siswa_mutasi_ke" name="siswa_mutasi_ke" data-placeholder="Mutasi Ke">
                                    <?php if ($t_lembaga['jenjang_id'] == '2') { ?>
                                        <option value="<?= $f_siswa_act['siswa_mutasi_ke'] ?>"><?= $f_siswa_act['siswa_mutasi_ke'] ?></option>
                                        <option value="MI">MI</option>
                                        <option value="SD">SD</option>
                                        <option value="PAKET A">PAKET A</option>
                                        <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                                    <?php } elseif ($t_lembaga['jenjang_id'] == '3') { ?>
                                        <option value="<?= $f_siswa_act['siswa_mutasi_ke'] ?>"><?= $f_siswa_act['siswa_mutasi_ke'] ?></option>
                                        <option value="MTS">MTS</option>
                                        <option value="SMP">SMP</option>
                                        <option value="PAKET B">PAKET B</option>
                                        <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                                    <?php } elseif ($t_lembaga['jenjang_id'] == '4') { ?>
                                        <option value="<?= $f_siswa_act['siswa_mutasi_ke'] ?>"><?= $f_siswa_act['siswa_mutasi_ke'] ?></option>
                                        <option value="MA">MA</option>
                                        <option value="SMA">SMA</option>
                                        <option value="PAKET C">PAKET C</option>
                                        <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                                    <?php  } else { ?>
                                        <option value="<?= $f_siswa_act['siswa_mutasi_ke'] ?>"><?= $f_siswa_act['siswa_mutasi_ke'] ?></option>
                                        <option value="RA">RA</option>
                                        <option value="TK">TK</option>
                                        <option value="PAUD">PAUD</option>
                                        <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="siswa_mutasi_namasekolah">Nama Sekolah Lanjutan</label>
                                <input type="text" id="siswa_mutasi_namasekolah" class="form-control" name="siswa_mutasi_namasekolah" placeholder="Nama Sekolah Lanjutan" value="<?= $f_siswa_act['siswa_mutasi_namasekolah'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="siswa_mutasi_kestatus">Status Lanjutan</label>
                                <select class="select2 form-select" id="siswa_mutasi_kestatus" name="siswa_mutasi_kestatus" data-placeholder="Status Lanjutan">
                                    <?php foreach ($statusSekolah as $val) {  ?>
                                        <?php if ($f_siswa_act['siswa_mutasi_kestatus'] == $val) { ?>
                                            <option value="<?= $val ?>" selected><?= $val ?></option>
                                        <?php  } else { ?>
                                            <option value="<?= $val ?>"><?= $val ?> </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="siswa_mutasi_npsnsekolah">NPSN Sekolah
                                    Lanjutan</label>
                                <input type="text" id="siswa_mutasi_npsnsekolah" class="form-control" name="siswa_mutasi_npsnsekolah" placeholder="NPSN Sekolah Lanjutan" value="<?= $f_siswa_act['siswa_mutasi_npsnsekolah'] ?>" />
                            </div>
                        </div>
                        <div class="text-end mt-2">
                            <button type="submit" class="btn btn-primary me-1">Simpan</button>
                            <a href="?pg=students-mutations" class="btn btn-outline-secondary">Batal</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="Students/js/students-mutations.js"></script>r
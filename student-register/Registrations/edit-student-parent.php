<?php
$ppdb_tahunajaran = fetch($koneksi, 'e_tahunajaran', ['tahunajaran_id' => $t_ppdbregist['tahunajaran_id']]);
$ppdb_jurusan = fetch($koneksi, 't_ppdbjurusan', ['ppdbjurusan_id' => $t_ppdbregist['ppdbjurusan_id']]);
?>
<section id="basic-horizontal-layouts">
    <?php include 'Registrations/Components/Navbar.php' ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title text-uppercase">Update Ortu/Wali <?= ucfirst(strtolower($t_ppdbregist['ppdbregist_name'])) ?></h6>
                    <div class="row">
                        <div class="col-md-3 kelas_nama"></div>
                        <div class="col-md-3 lembaga_status"></div>
                        <div class="col-md-3 lembaga_kec"></div>
                        <div class="col-md-3 tingkat_deskripsi"></div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="updateParentForm" class="form form-horizontal" method="POST">
                        <input type="hidden" name="ppdbregist_id" id="ppdbregist_id" value="<?= $t_ppdbregist['ppdbregist_id']; ?>">
                        <div class="row">
                            <div class="divider divider-end-center">
                                <div class="divider-text"><code>Data Ayah</code></div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbayah_name">Nama Ayah</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbayah_name" name="ppdbayah_name" class="form-control" placeholder="Nama Ayah" value="<?= $t_ppdbregist['ppdbayah_name']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbayah_status">Status Ayah</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbayah_status" name="ppdbayah_status" data-placeholder="Pilih Status Ayah">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($statushidup as $code => $val) {  ?>
                                                <?php if ($t_ppdbregist['ppdbayah_status'] == $code) { ?>
                                                    <option value="<?= $code ?>" selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value="<?= $code ?>"><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($t_ppdbregist['ppdbayah_status'] !== 0) { ?>
                            <div class="row" id="id_ppdbayah_status" style="display: none;">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_wn">Warga</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbayah_wn" name="ppdbayah_wn" data-placeholder="Pilih Warga Negara">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($kewarganegaraan as $val) { ?>
                                                    <?php if ($t_ppdbregist['ppdbayah_wn'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_nik">NIK / KITAS</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbayah_nik" name="ppdbayah_nik" class="form-control" placeholder="NIK / KITAS" value="<?= $t_ppdbregist['ppdbayah_nik']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_tempat">Tempat lahir</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbayah_tempat" name="ppdbayah_tempat" class="form-control" placeholder="Tempat lahir" value="<?= $t_ppdbregist['ppdbayah_tempat']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_tgllahir">Tgl lahir</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbayah_tgllahir" name="ppdbayah_tgllahir" class="form-control flatpickr-basic" placeholder="Tgl lahir" value="<?= $t_ppdbregist['ppdbayah_tgllahir']; ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_pendidikan">Pendidikan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbayah_pendidikan" name="ppdbayah_pendidikan" data-placeholder="Pilih Pendidikan Ayah">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($pendidikan as $val) { ?>
                                                    <?php if ($f_siswa_act['ppdbayah_pendidikan'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_pekerjaan">Pekerjaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbayah_pekerjaan" name="ppdbayah_pekerjaan" data-placeholder="Pilih Pekerjaan Ayah">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($pekerjaan as $code => $val) {  ?>
                                                    <?php if ($t_ppdbregist['ppdbayah_pekerjaan'] == $code) { ?>
                                                        <option value="<?= $code ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $code ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_penghasilan">Penghasilan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbayah_penghasilan" name="ppdbayah_penghasilan" data-placeholder="Pilih Penghasilan Ayah">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($penghasilan as $val) { ?>
                                                    <?php if ($f_siswa_act['ppdbayah_penghasilan'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_nohp">Nomor HP Ayah</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbayah_nohp" name="ppdbayah_nohp" class="form-control" placeholder="Nomor HP Ayah" value="<?= $t_ppdbregist['ppdbayah_nohp']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="row" id="id_ppdbayah_status">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_wn">Warga</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbayah_wn" name="ppdbayah_wn" data-placeholder="Pilih Warga Negara">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($kewarganegaraan as $val) { ?>
                                                    <?php if ($t_ppdbregist['ppdbayah_wn'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_nik">NIK / KITAS</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbayah_nik" name="ppdbayah_nik" class="form-control" placeholder="NIK / KITAS" value="<?= $t_ppdbregist['ppdbayah_nik']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_tempat">Tempat lahir</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbayah_tempat" name="ppdbayah_tempat" class="form-control" placeholder="Tempat lahir" value="<?= $t_ppdbregist['ppdbayah_tempat']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_tgllahir">Tgl lahir</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbayah_tgllahir" name="ppdbayah_tgllahir" class="form-control flatpickr-basic" placeholder="Tgl lahir" value="<?= $t_ppdbregist['ppdbayah_tgllahir']; ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_pendidikan">Pendidikan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbayah_pendidikan" name="ppdbayah_pendidikan" data-placeholder="Pilih Pendidikan Ayah">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($pendidikan as $val) { ?>
                                                    <?php if ($f_siswa_act['ppdbayah_pendidikan'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_pekerjaan">Pekerjaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbayah_pekerjaan" name="ppdbayah_pekerjaan" data-placeholder="Pilih Pekerjaan Ayah">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($pekerjaan as $code => $val) {  ?>
                                                    <?php if ($t_ppdbregist['ppdbayah_pekerjaan'] == $code) { ?>
                                                        <option value="<?= $code ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $code ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_penghasilan">Penghasilan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbayah_penghasilan" name="ppdbayah_penghasilan" data-placeholder="Pilih Penghasilan Ayah">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($penghasilan as $val) { ?>
                                                    <?php if ($f_siswa_act['ppdbayah_penghasilan'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbayah_nohp">Nomor HP Ayah</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbayah_nohp" name="ppdbayah_nohp" class="form-control" placeholder="Nomor HP Ayah" value="<?= $t_ppdbregist['ppdbayah_nohp']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="divider divider-end-center">
                                <div class="divider-text"><code>Data Ibu</code></div>
                            </div>
                            <input type="hidden" name="ppdbregist_id" id="ppdbregist_id" value="<?= $t_ppdbregist['ppdbregist_id']; ?>">
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbibu_name">Nama Ibu</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbibu_name" name="ppdbibu_name" class="form-control" placeholder="Nama Ibu" value="<?= $t_ppdbregist['ppdbibu_name']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbibu_status">Status Ibu</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbibu_status" name="ppdbibu_status" data-placeholder="Pilih Status Ibu">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($statushidup as $code => $val) {  ?>
                                                <?php if ($t_ppdbregist['ppdbibu_status'] == $code) { ?>
                                                    <option value="<?= $code ?>" selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value="<?= $code ?>"><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($t_ppdbregist['ppdbibu_status'] != 0) { ?>
                            <div class="row" id="id_ppdbibu_status" style="display: none;">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_wn">Warga</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbibu_wn" name="ppdbibu_wn" data-placeholder="Pilih Warga Negara">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($kewarganegaraan as $val) { ?>
                                                    <?php if ($t_ppdbregist['ppdbibu_wn'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_nik">NIK / KITAS</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbibu_nik" name="ppdbibu_nik" class="form-control" placeholder="NIK / KITAS" value="<?= $t_ppdbregist['ppdbibu_nik']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_tempat">Tempat lahir</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbibu_tempat" name="ppdbibu_tempat" class="form-control" placeholder="Tempat lahir" value="<?= $t_ppdbregist['ppdbibu_tempat']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_tgllahir">Tgl lahir</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbibu_tgllahir" name="ppdbibu_tgllahir" class="form-control flatpickr-basic" placeholder="Tgl lahir" value="<?= $t_ppdbregist['ppdbibu_tgllahir']; ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_pendidikan">Pendidikan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbibu_pendidikan" name="ppdbibu_pendidikan" data-placeholder="Pilih Pendidikan Ibu">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($pendidikan as $val) { ?>
                                                    <?php if ($f_siswa_act['ppdbibu_pendidikan'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_pekerjaan">Pekerjaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbibu_pekerjaan" name="ppdbibu_pekerjaan" data-placeholder="Pilih Pekerjaan Ibu">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($pekerjaan as $code => $val) {  ?>
                                                    <?php if ($t_ppdbregist['ppdbibu_pekerjaan'] == $code) { ?>
                                                        <option value="<?= $code ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $code ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_penghasilan">Penghasilan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbibu_penghasilan" name="ppdbibu_penghasilan" data-placeholder="Pilih Penghasilan Ibu">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($penghasilan as $val) { ?>
                                                    <?php if ($f_siswa_act['ppdbibu_penghasilan'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_nohp">Nomor HP Ibu</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbibu_nohp" name="ppdbibu_nohp" class="form-control" placeholder="Nomor HP Ibu" value="<?= $t_ppdbregist['ppdbibu_nohp']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="row" id="id_ppdbibu_status">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_wn">Warga</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbibu_wn" name="ppdbibu_wn" data-placeholder="Pilih Warga Negara">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($kewarganegaraan as $val) { ?>
                                                    <?php if ($t_ppdbregist['ppdbibu_wn'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_nik">NIK / KITAS</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbibu_nik" name="ppdbibu_nik" class="form-control" placeholder="NIK / KITAS" value="<?= $t_ppdbregist['ppdbibu_nik']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_tempat">Tempat lahir</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbibu_tempat" name="ppdbibu_tempat" class="form-control" placeholder="Tempat lahir" value="<?= $t_ppdbregist['ppdbibu_tempat']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_tgllahir">Tgl lahir</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbibu_tgllahir" name="ppdbibu_tgllahir" class="form-control flatpickr-basic" placeholder="Tgl lahir" value="<?= $t_ppdbregist['ppdbibu_tgllahir']; ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_pendidikan">Pendidikan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbibu_pendidikan" name="ppdbibu_pendidikan" data-placeholder="Pilih Pendidikan Ibu">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($pendidikan as $val) { ?>
                                                    <?php if ($f_siswa_act['ppdbibu_pendidikan'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_pekerjaan">Pekerjaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbibu_pekerjaan" name="ppdbibu_pekerjaan" data-placeholder="Pilih Pekerjaan Ibu">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($pekerjaan as $code => $val) {  ?>
                                                    <?php if ($t_ppdbregist['ppdbibu_pekerjaan'] == $code) { ?>
                                                        <option value="<?= $code ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $code ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_penghasilan">Penghasilan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="ppdbibu_penghasilan" name="ppdbibu_penghasilan" data-placeholder="Pilih Penghasilan Ibu">
                                                <option value="">--pilih--</option>
                                                <?php foreach ($penghasilan as $val) { ?>
                                                    <?php if ($f_siswa_act['ppdbibu_penghasilan'] == $val) { ?>
                                                        <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                    <?php  } else { ?>
                                                        <option value="<?= $val ?>"><?= $val ?> </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-uppercase" for="ppdbibu_nohp">Nomor HP Ibu</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ppdbibu_nohp" name="ppdbibu_nohp" class="form-control" placeholder="Nomor HP Ibu" value="<?= $t_ppdbregist['ppdbibu_nohp']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="divider divider-end-center">
                            <div class="divider-text"><code>Data Wali</code></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_status">Status Wali</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbwali_status" name="ppdbwali_status" data-placeholder="Pilih Status Wali">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($statuswalihubungan as $code => $val) {  ?>
                                                <?php if ($t_ppdbregist['ppdbwali_status'] == $code) { ?>
                                                    <option value="<?= $code ?>" selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value="<?= $code ?>"><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_name">Nama Wali</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbwali_name" name="ppdbwali_name" class="form-control" placeholder="Nama Wali" value="<?= $t_ppdbregist['ppdbwali_name']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_wn">Warga</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbwali_wn" name="ppdbwali_wn" data-placeholder="Pilih Warga Negara">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($kewarganegaraan as $val) { ?>
                                                <?php if ($t_ppdbregist['ppdbwali_wn'] == $val) { ?>
                                                    <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value="<?= $val ?>"><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_nik">NIK / KITAS</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbwali_nik" name="ppdbwali_nik" class="form-control" placeholder="NIK / KITAS" value="<?= $t_ppdbregist['ppdbwali_nik']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_tempat">Tempat lahir</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbwali_tempat" name="ppdbwali_tempat" class="form-control" placeholder="Tempat lahir" value="<?= $t_ppdbregist['ppdbwali_tempat']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_tgllahir">Tgl lahir</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbwali_tgllahir" name="ppdbwali_tgllahir" class="form-control flatpickr-basic" placeholder="Tgl lahir" value="<?= $t_ppdbregist['ppdbwali_tgllahir']; ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_pendidikan">Pendidikan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbwali_pendidikan" name="ppdbwali_pendidikan" data-placeholder="Pilih Pendidikan Wali">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($pendidikan as $val) { ?>
                                                <?php if ($f_siswa_act['ppdbwali_pendidikan'] == $val) { ?>
                                                    <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value="<?= $val ?>"><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_pekerjaan">Pekerjaan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbwali_pekerjaan" name="ppdbwali_pekerjaan" data-placeholder="Pilih Pekerjaan Wali">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($pekerjaan as $code => $val) {  ?>
                                                <?php if ($t_ppdbregist['ppdbwali_pekerjaan'] == $code) { ?>
                                                    <option value="<?= $code ?>" selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value="<?= $code ?>"><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_penghasilan">Penghasilan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbwali_penghasilan" name="ppdbwali_penghasilan" data-placeholder="Pilih Penghasilan Wali">
                                            <option value="">--pilih--</option>
                                            <?php foreach ($penghasilan as $val) { ?>
                                                <?php if ($f_siswa_act['ppdbwali_penghasilan'] == $val) { ?>
                                                    <option value="<?= $val ?>" selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value="<?= $val ?>"><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbwali_nohp">Nomor HP Wali</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbwali_nohp" name="ppdbwali_nohp" class="form-control" placeholder="Nomor HP Wali" value="<?= $t_ppdbregist['ppdbwali_nohp']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <a href="javascript:history.back()" class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </a>
                            <button type="submit" class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="Registrations/scripts.js"></script>
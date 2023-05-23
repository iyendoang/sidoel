<?php
$ppdb_tahunajaran = fetch($koneksi, 'e_tahunajaran', ['tahunajaran_id' => $t_ppdbregist['tahunajaran_id']]);
$ppdb_jurusan = fetch($koneksi, 't_ppdbjurusan', ['ppdbjurusan_id' => $t_ppdbregist['ppdbjurusan_id']]);
?>
<section id="basic-horizontal-layouts">
    <?php include 'Registrations/Components/Navbar.php' ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="card-title text-uppercase">Update data <?= ucfirst(strtolower($t_ppdbregist['ppdbregist_name'])) ?></h6>
                    <div class="row">
                        <div class="col-md-3 kelas_nama"></div>
                        <div class="col-md-3 lembaga_status"></div>
                        <div class="col-md-3 lembaga_kec"></div>
                        <div class="col-md-3 tingkat_deskripsi"></div>
                    </div>
                </div>
                <div class="card-body my-2 py-50">
                    <form id="updateRegistrationsForm" class="form form-horizontal">
                        <div class="row">
                            <input type="hidden" name="ppdbregist_id" id="ppdbregist_id" value="<?= $t_ppdbregist['ppdbregist_id']; ?>">
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="tahunajaran_idedit">Tahun Daftar</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="tahunajaran_id" id="tahunajaran_idedit" data-placeholder="Pilih Tahun Ajaran" disabled>
                                            <option value="<?= $ppdb_tahunajaran['tahunajaran_id']; ?>"><?= $ppdb_tahunajaran['tahunajaran_nama']; ?></option>
                                            <?php
                                            $query = "SELECT * FROM e_tahunajaran ORDER BY tahunajaran_id DESC";
                                            $results = $koneksi->prepare($query);
                                            $results->execute();
                                            $result = $results->get_result();
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <option value="<?= $row['tahunajaran_id']; ?>"><?= $row['tahunajaran_nama']; ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbjurusan_idedit">Gelombang</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="ppdbjurusan_id" id="ppdbjurusan_idedit" data-placeholder="Pilih Tahun Ajaran" disabled>
                                            <option value="<?= $ppdb_jurusan['ppdbjurusan_id']; ?>"><?= $ppdb_jurusan['ppdbjurusan_name']; ?></option>
                                            <?php
                                            $query = "SELECT * FROM t_ppdbjurusan ORDER BY ppdbjurusan_id DESC";
                                            $results = $koneksi->prepare($query);
                                            $results->execute();
                                            $result = $results->get_result();
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <option value="<?= $row['ppdbjurusan_id']; ?>"><?= $row['ppdbjurusan_name']; ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_number">NO Registrasi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_number" class="form-control" name="ppdbregist_number" placeholder="Nomor Registrasi" value="<?= $t_ppdbregist['ppdbregist_number']; ?>" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_nisn">NISN</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_nisn" name="ppdbregist_nisn" class="form-control" placeholder="NISN" value="<?= $t_ppdbregist['ppdbregist_nisn']; ?>" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_name">Nama Calon</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_name" name="ppdbregist_name" class="form-control" placeholder="Nama Calon" value="<?= $t_ppdbregist['ppdbregist_name']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_gender">Jenis Kelamin</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="demo-inline-spacing ">
                                            <div class="form-check form-check-inline me-3">
                                                <input class="form-check-input" type="radio" name="ppdbregist_gender" id="ppdbregist_genderL" value="L" <?php if ($t_ppdbregist['ppdbregist_gender'] == 'L') echo 'checked' ?>>
                                                <label class="form-check fw-bolder-label" for="ppdbregist_genderL">Lak-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline me-3">
                                                <input class="form-check-input" type="radio" name="ppdbregist_gender" id="ppdbregist_genderP" value="P" <?php if ($t_ppdbregist['ppdbregist_gender'] == 'P') echo 'checked' ?>>
                                                <label class="form-check fw-bolder-label" for="ppdbregist_genderP">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_tempat">Tempat lahir</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_tempat" name="ppdbregist_tempat" class="form-control" placeholder="Tempat lahir" value="<?= $t_ppdbregist['ppdbregist_tempat']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_tgllahir">Tgl lahir</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_tgllahir" name="ppdbregist_tgllahir" class="form-control" placeholder="Tgl lahir" value="<?= $t_ppdbregist['ppdbregist_tgllahir']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_nokk">NO KK</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_nokk" name="ppdbregist_nokk" class="form-control" placeholder="NO KK" value="<?= $t_ppdbregist['ppdbregist_nokk']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_nik">NO NIK</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_nik" name="ppdbregist_nik" class="form-control" placeholder="NO NIK" value="<?= $t_ppdbregist['ppdbregist_nik']; ?>"  />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_anakke">Anak Ke-</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_anakke" name="ppdbregist_anakke" class="form-control" placeholder="Anak Ke-" value="<?= $t_ppdbregist['ppdbregist_anakke']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_saudara">Jml Saudara</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_saudara" name="ppdbregist_saudara" class="form-control" placeholder="Jml Saudara" value="<?= $t_ppdbregist['ppdbregist_saudara']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_hobi">Hobi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbregist_hobi" name="ppdbregist_hobi" data-placeholder="Pilih Hobi">
                                            <option value=''>---Pilih---</option>";
                                            <?php foreach ($hobi as $val) { ?>
                                                <?php if ($t_ppdbregist['ppdbregist_hobi'] == $val) { ?>
                                                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value='<?= $val ?>'><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_cita">Cita-cita</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbregist_cita" name="ppdbregist_cita" data-placeholder="Pilih Cita-cita">
                                            <option value=''>---Pilih---</option>";
                                            <?php foreach ($cita as $val) { ?>
                                                <?php if ($t_ppdbregist['ppdbregist_cita'] == $val) { ?>
                                                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value='<?= $val ?>'><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_nohp">NO HP</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_nohp" name="ppdbregist_nohp" class="form-control" placeholder="NO HP" value="<?= $t_ppdbregist['ppdbregist_nohp']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="javascript:history.back()" class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </a>
                                <button type="submit" data-id="<?= $t_ppdbregist['password']; ?>" class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="Registrations/scripts.js"></script>
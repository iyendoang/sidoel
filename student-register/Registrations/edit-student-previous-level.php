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
                    <h6 class="card-title text-uppercase">Update Alamat <?= ucfirst(strtolower($t_ppdbregist['ppdbregist_name'])) ?></h6>
                    <div class="row">
                        <div class="col-md-3 kelas_nama"></div>
                        <div class="col-md-3 lembaga_status"></div>
                        <div class="col-md-3 lembaga_kec"></div>
                        <div class="col-md-3 tingkat_deskripsi"></div>
                    </div>
                </div>
                <div class="card-body my-2 py-50">
                    <form id="updatePreviousForm" class="form form-horizontal">
                        <div class="row">
                            <input type="hidden" name="ppdbregist_id" id="ppdbregist_id" value="<?= $t_ppdbregist['ppdbregist_id']; ?>">
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_stt">Jenjang Asal</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbasal_jenjang" name="ppdbasal_jenjang" data-placeholder="Jenjang Asal">
                                            <option value="<?php echo $t_ppdbregist['ppdbasal_jenjang']; ?>"><?php echo $t_ppdbregist['ppdbasal_jenjang']; ?></option>
                                            <?php
                                            $t_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_lembaga LIMIT 1"));
                                            $query = mysqli_query($koneksi, "SELECT * FROM t_jenjangbefore WHERE jenjang_id = $t_lembaga[jenjang_id]");
                                            while ($j_before = mysqli_fetch_array($query)) {
                                            ?>
                                                <option value="<?php echo $j_before['jenjangbefore_alias']; ?>"><?php echo $j_before['jenjangbefore_alias']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbasal_status">Status</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbasal_status" name="ppdbasal_status" data-placeholder="Status">
                                            <option value="<?= $t_ppdbregist['ppdbasal_status'] ?>"><?= $t_ppdbregist['ppdbasal_status'] ?>
                                            </option>
                                            <option value="Negeri">Negeri</option>
                                            <option value="Swasta">Swasta</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbasal_npsn">NPSN Asal</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbasal_npsn" name="ppdbasal_npsn" class="form-control" placeholder="NPSN Asal" value="<?= $t_ppdbregist['ppdbasal_npsn']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbasal_sekolah">Sekolah Asal</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbasal_sekolah" name="ppdbasal_sekolah" class="form-control" placeholder="Nama Sekolah Asal" value="<?= $t_ppdbregist['ppdbasal_sekolah']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbasal_kota">Kota Sekolah</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbasal_kota" name="ppdbasal_kota" class="form-control" placeholder="Kota Sekolah" value="<?= $t_ppdbregist['ppdbasal_kota']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbasal_tahun">Tahun Lulus</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbasal_tahun" name="ppdbasal_tahun" data-placeholder="Pilih Tahun lulus">
                                            <option value='<?= $t_ppdbregist['ppdbasal_tahun'] ?>'><?= $t_ppdbregist['ppdbasal_tahun'] ?></option>";
                                            <?php
                                            $year = date('Y');
                                            $min = $year - 5;
                                            $max = $year;
                                            for ($i = $max; $i >= $min; $i--) {
                                                echo '<option value=' . $i . '>' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbasal_noujian">Nomor Ujian</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbasal_noujian" name="ppdbasal_noujian" class="form-control" placeholder="Nomor Ujian" value="<?= $t_ppdbregist['ppdbasal_noujian']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbasal_noijazah">No Seri Ijazah</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbasal_noijazah" name="ppdbasal_noijazah" class="form-control" placeholder="Nomor Seri Ijazah" value="<?= $t_ppdbregist['ppdbasal_noijazah']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="javascript:history.back()" class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </a>
                                <button type="submit" data-id="<?= $t_ppdbregist['password']; ?>" class="btn btn-success btn-next">
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
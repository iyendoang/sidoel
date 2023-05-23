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
                    <form id="updateAddressForm" class="form form-horizontal">
                        <div class="row">
                            <input type="hidden" name="ppdbregist_id" id="ppdbregist_id" value="<?= $t_ppdbregist['ppdbregist_id']; ?>">
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_stt">Status</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbregist_stt" name="ppdbregist_stt" data-placeholder="Pilih Status Tempat Tinggal">
                                            <option value=''>---Pilih---</option>";
                                            <?php foreach ($statustinggal as $val) { ?>
                                                <?php if ($t_ppdbregist['ppdbregist_stt'] == $val) { ?>
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
                                        <label class="col-form-label text-uppercase" for="ppdbregist_prov">Provinsi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_prov" name="ppdbregist_prov" class="form-control" placeholder="Provinsi" value="<?= $t_ppdbregist['ppdbregist_prov']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_kota">Kota</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_kota" name="ppdbregist_kota" class="form-control" placeholder="Kota" value="<?= $t_ppdbregist['ppdbregist_kota']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_kec">Kecamatan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_kec" name="ppdbregist_kec" class="form-control" placeholder="Kecamatan" value="<?= $t_ppdbregist['ppdbregist_kec']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_kel">Kelurahan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_kel" name="ppdbregist_kel" class="form-control" placeholder="Kelurahan" value="<?= $t_ppdbregist['ppdbregist_kel']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_alamat">Alamat</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="ppdbregist_alamat" name="ppdbregist_alamat" rows="3" placeholder="Alamat Pendaftar"><?= $t_ppdbregist['ppdbregist_alamat']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_rt">RT / RW</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" id="ppdbregist_rt" name="ppdbregist_rt" class="form-control" placeholder="RT" value="<?= $t_ppdbregist['ppdbregist_rt']; ?>" />
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" id="ppdbregist_rw" name="ppdbregist_rw" class="form-control" placeholder="RW" value="<?= $t_ppdbregist['ppdbregist_rw']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_kodepos">Kode Pos</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ppdbregist_kodepos" name="ppdbregist_kodepos" class="form-control" placeholder="Kode Pos" value="<?= $t_ppdbregist['ppdbregist_kodepos']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label text-uppercase" for="ppdbregist_jarak">Jarak Tempuh</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbregist_jarak" name="ppdbregist_jarak" data-placeholder="Pilih Jarak Tempuh">
                                            <option value=''>---Pilih---</option>";
                                            <?php foreach ($jarak as $val) { ?>
                                                <?php if ($t_ppdbregist['ppdbregist_jarak'] == $val) { ?>
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
                                        <label class="col-form-label text-uppercase" for="ppdbregist_transportasi">Transportasi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" id="ppdbregist_transportasi" name="ppdbregist_transportasi" data-placeholder="Pilih Transportasi">
                                            <option value=''>---Pilih---</option>";
                                            <?php foreach ($transportasi as $val) { ?>
                                                <?php if ($t_ppdbregist['ppdbregist_transportasi'] == $val) { ?>
                                                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                                                <?php  } else { ?>
                                                    <option value='<?= $val ?>'><?= $val ?> </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
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
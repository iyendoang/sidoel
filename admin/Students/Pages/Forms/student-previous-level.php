<?php include 'Students/Pages/Forms/nav-tab-student.php' ?>
<?php
$t_jenjangbefore = fetch($koneksi, 't_jenjangbefore', ['jenjangbefore_id' => $f_siswa_act['siswa_ijz_asal']]);
?>
<div class="card p-0 m-0">
    <div class="card-header border-bottom">
        <h5 class="card-title">Jenjang Sebelumnya <?= ucwords(strtolower($e_siswa['siswa_nama'])) ?></h5>
    </div>
    <div class="card-body my-2 py-50">
        <form class="form form-block" id="formEditPreviousLevel" method="post" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" id="siswa_nama" name="siswa_nama" value="<?= $e_siswa['siswa_nama'] ?>">
                <input type="hidden" id="siswa_id" name="siswa_id" value="<?= $f_siswa_act['siswa_id'] ?>">
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_asal">Sekolah Asal </label>
                        <select class="select2 form-select" id="siswa_ijz_asal" name="siswa_ijz_asal" data-placeholder="Sekolah Asal">
                            <option value="<?php echo $f_siswa_act['siswa_ijz_asal']; ?>"><?php echo $f_siswa_act['siswa_ijz_asal']; ?></option>
                            <?php
                            $t_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_lembaga LIMIT 1"));
                            $query = mysqli_query($koneksi, "SELECT * FROM t_jenjangbefore WHERE jenjang_id = $t_lembaga[jenjang_id]");
                            while ($j_before = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?php echo $j_before['jenjangbefore_alias']; ?>"><?php echo $j_before['jenjangbefore_alias']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_statusasal">Status</label>
                        <select class="select2 form-select" id="siswa_ijz_statusasal" name="siswa_ijz_statusasal" data-placeholder="Status">
                            <option value="<?= $f_siswa_act['siswa_ijz_statusasal'] ?>"><?= $f_siswa_act['siswa_ijz_statusasal'] ?>
                            </option>
                            <option value="Negeri">Negeri</option>
                            <option value="Swasta">Swasta</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_npsnasal">NPSN</label>
                        <input type="text" id="siswa_ijz_npsnasal" class="form-control" placeholder="NPSN" name="siswa_ijz_npsnasal" value="<?= $f_siswa_act['siswa_ijz_npsnasal'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_sekolahasal">Nama Sekolah</label>
                        <input type="text" id="siswa_ijz_sekolahasal" class="form-control" name="siswa_ijz_sekolahasal" placeholder="Nama Sekolah" value="<?= $f_siswa_act['siswa_ijz_sekolahasal'] ?>" />

                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_kotaasal">Kabupaten/Kota</label>
                        <input type="text" id="siswa_ijz_kotaasal" class="form-control" name="siswa_ijz_kotaasal" placeholder="Kabupaten/Kota" value="<?= $f_siswa_act['siswa_ijz_kotaasal'] ?>" />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_nama">Nama Siswa Di Ijazah</label>
                        <input type="text" id="siswa_ijz_nama" class="form-control" name="siswa_ijz_nama" placeholder="Nama Siswa Di Ijazah" value="<?= $f_siswa_act['siswa_ijz_nama'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_nisn">NISN</label>
                        <input type="text" id="siswa_ijz_nisn" class="form-control" name="siswa_ijz_nisn" placeholder="NISN" value="<?= $f_siswa_act['siswa_ijz_nisn'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_tempat">Tempat Lahir</label>
                        <input type="text" id="siswa_ijz_tempat" class="form-control" name="siswa_ijz_tempat" placeholder="Tempat Lahir" value="<?= $f_siswa_act['siswa_ijz_tempat'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_tgllahir">Tgl. Lahir</label>
                        <input type="text" id="siswa_ijz_tgllahir" class="form-control flatpickr-basic" name="siswa_ijz_tgllahir" placeholder="Tgl. Lahir" value="<?= $f_siswa_act['siswa_ijz_tgllahir'] ?>" />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_namaortu">Nama Orgtua di Ijazah</label>
                        <input type="text" id="siswa_ijz_namaortu" class="form-control" name="siswa_ijz_namaortu" placeholder="Nama Orgtua di Ijazah" value="<?= $f_siswa_act['siswa_ijz_namaortu'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_noujian">Nomor Ujian</label>
                        <input type="text" id="siswa_ijz_noujian" class="form-control" name="siswa_ijz_noujian" placeholder="Nomor Ujian" value="<?= $f_siswa_act['siswa_ijz_noujian'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_noseri">No. Seri Ijazah</label>
                        <input type="text" id="siswa_ijz_noseri" class="form-control" name="siswa_ijz_noseri" placeholder="No. Seri Ijazah" value="<?= $f_siswa_act['siswa_ijz_noseri'] ?>" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="siswa_ijz_thnlulus">Tahun Lulus</label>
                        <select class="select2 form-select" id="siswa_ijz_thnlulus" name="siswa_ijz_thnlulus" data-placeholder="Pilih Tahun">
                            <option value='<?= $f_siswa_act['siswa_ijz_thnlulus'] ?>'><?= $f_siswa_act['siswa_ijz_thnlulus'] ?></option>";
                            <?php
                            $year = date('Y');
                            $min = $year - 30;
                            $max = $year;
                            for ($i = $max; $i >= $min; $i--) {
                                echo '<option value=' . $i . '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="file_ijz_siswa">Upload Ijazah /
                            <a target="_blank" href="../<?= $f_siswa_act['file_ijz_siswa'] ?>"><span class="">Lihat File</span></a>
                        </label>
                        <input class="form-control" type="hidden" id="file_ijz_siswalama" name="file_ijz_siswalama" value="<?= $f_siswa_act['file_ijz_siswa'] ?>" />
                        <input class="form-control" type="file" id="file_ijz_siswa" name="file_ijz_siswa" />
                    </div>
                </div>
                <div class="mt-2 text-end">
                    <button type="submit" class="btn btn-primary me-1 btn-simpan">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary btn-batal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="Students/js/student-previous-level.js"></script>
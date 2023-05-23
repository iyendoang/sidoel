    <div class="col-12">
        <!-- profile -->
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Profile Details</h4>
            </div>
            <div class="card-body py-2 my-25">
                <!-- form -->
                <form class="form" id="form-edit_istitution_detail" method="post">
                    <input type="hidden" class="form-control" name="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>" />
                    <div class="row">
                        <div class="col-12">
                            <h4 class="">
                                <i data-feather="home" class="font-medium-4 mr-25"></i>
                                <span class="align-middle">Informasi Lembaga</span>
                            </h4>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_nama">Nama Madrasah</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="lembaga_nama" class="form-control" name="lembaga_nama" placeholder="Nama Madrasah" value="<?= $t_lembaga['lembaga_nama'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_nsm">Nomor Statistik Madrasah (NSM)</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="lembaga_nsm" class="form-control" name="lembaga_nsm" placeholder="Nomor Statistik Madrasah (NSM)" value="<?= $t_lembaga['lembaga_nsm'] ?>" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_npsn">Nomor Pokok Sekolah Nasional</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="lembaga_npsn" class="form-control" name="lembaga_npsn" placeholder="Nomor Pokok Sekolah Nasional" value="<?= $t_lembaga['lembaga_npsn'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="jenjang_id">Jenjang Madrasah</label>
                                <select class="select2 form-select" id="jenjang_id" name="jenjang_id">
                                    <option value="<?= $t_jenjang['jenjang_id'] ?>"><?= $t_jenjang['jenjang_nama'] ?></option>
                                    <?php
                                    $sql = mysqli_query($koneksi, "SELECT * FROM t_jenjang") or die(mysqli_error($koneksi));
                                    while ($s_jenjang = mysqli_fetch_array($sql)) {
                                    ?>
                                        <option value="<?php echo $s_jenjang['jenjang_id'] ?>"><?php echo $s_jenjang['jenjang_nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_status">Status</label>
                                <select class="select2 form-control" id="lembaga_status" name="lembaga_status" data-placeholder="Status Lembaga">
                                    <option value="<?= $t_lembaga['lembaga_status'] ?>"><?= $t_lembaga['lembaga_status'] ?>
                                    </option>
                                    <option value="Negeri">Negeri</option>
                                    <option value="Swasta">Swasta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label for="lembaga_no_siop">Nomor SIOP</label>
                                <input id="lembaga_no_siop" type="text" class="form-control" value="<?= $t_lembaga['lembaga_no_siop'] ?>" name="lembaga_no_siop" placeholder="Nomor SiOP" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label for="lembaga_tgl_siop">Tanggal SIOP</label>
                                <input id="lembaga_tgl_siop" type="text" class="form-control flatpickr-basic" name="lembaga_tgl_siop" placeholder="YYYY-MM-DD" value="<?= $t_lembaga['lembaga_tgl_siop'] ?>" id="lembaga_tgl_siop" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_siopstatus">Masa Berlaku SIOP</label>
                                <select class="select2 form-control" id="lembaga_siopstatus" name="lembaga_siopstatus" data-placeholder="Masa Berlaku SIOP Lembaga">
                                    <option value="<?= $t_lembaga['lembaga_siopstatus'] ?>">
                                        <?php if ($t_lembaga['lembaga_siopstatus'] == 1) { ?>
                                            <span class="badge badge-warning">Tanpa Masa Berlaku</span>
                                        <?php } elseif ($t_lembaga['lembaga_siopstatus'] == 2) { ?>
                                            <span class="badge badge-primary">Ada Masa Berlaku</span>
                                        <?php } else { ?>
                                            <span class="badge badge-info">Kosong</span>
                                        <?php } ?>
                                    </option>
                                    <option value="1">Tanpa Masa Berlaku</option>
                                    <option value="2">Ada Masa Berlaku</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label for="lembaga_siop_end">Tanggal Habis SIOP</label>
                                <input type="date" id="lembaga_siop_end" name="lembaga_siop_end" class="form-control" placeholder="YYYY-MM-DD" value="<?= $t_lembaga['lembaga_siop_end'] ?>" readonly />
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#lembaga_siopstatus').on("select2:select", function(e) {
                                    var lembaga_siopstatus = $(this).val();
                                    console.log($(this).val());
                                    if (lembaga_siopstatus == '2') {
                                        $('#lembaga_siop_end').attr('readonly', false);
                                    } else {
                                        $('#lembaga_siop_end').attr('readonly', true);
                                    }
                                });
                            });
                        </script>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_akre">Status Akreditasi</label>
                                <select class="select2 form-control" id="lembaga_akre" name="lembaga_akre" data-placeholder="Status Akreditasi">
                                    <option value="<?= $t_lembaga['lembaga_akre'] ?>">
                                        <?php if ($t_lembaga['lembaga_akre'] == '0') { ?>
                                            <span class="badge badge-warning">Belum Terakreditasi</span>
                                        <?php } else { ?>
                                            <?= $t_lembaga['lembaga_akre'] ?> <?php } ?>
                                    </option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="0">Belum Terakreditasi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_nilai_akre">Nilai Akreditasi</label>
                                <input type="text" id="lembaga_nilai_akre" class="form-control" name="lembaga_nilai_akre" placeholder="Nilai Akreditasi" value="<?= $t_lembaga['lembaga_nilai_akre'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label for="lembaga_tgl_akre">Tanggal Akreditasi</label>
                                <input type="date" id="lembaga_tgl_akre" name="lembaga_tgl_akre" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" value="<?= $t_lembaga['lembaga_tgl_akre'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_tgl_akre_end">Masa Berlaku Akreditasi s.d</label>
                                <input type="date" id="lembaga_tgl_akre_end" name="lembaga_tgl_akre_end" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" value="<?= $t_lembaga['lembaga_tgl_akre_end'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_no_akre">Nomor Akreditasi</label>
                                <input type="text" id="lembaga_no_akre" class="form-control" name="lembaga_no_akre" placeholder="Nomor Akreditasi" value="<?= $t_lembaga['lembaga_no_akre'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_thnberdiri">Tahun Berdiri</label>
                                <select class='select2 form-control' id="lembaga_thnberdiri" name='lembaga_thnberdiri' data-placeholder="Tahun Berdiri">
                                    <option value='<?= $t_lembaga['lembaga_thnberdiri'] ?>'><?= $t_lembaga['lembaga_thnberdiri'] ?></option>";
                                    <?php
                                    $year = date('Y');
                                    $min = $year - 100;
                                    $max = $year;
                                    for ($i = $max; $i >= $min; $i--) {
                                        echo '<option value=' . $i . '>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_npwp">NPWP Madrasah / Yayasan</label>
                                <input style="text-transform: uppercase;" class="form-control" type="text" id="lembaga_npwp" name="lembaga_npwp" placeholder="NPWP Madrasah / Yayasan" value="<?= $t_lembaga['lembaga_npwp'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_link_rdm">Link Raport Digital MAdrasah (RDM) </label>
                                <input type="text" id="lembaga_link_rdm" class="form-control" name="lembaga_link_rdm" placeholder="Website" value="<?= $t_lembaga['lembaga_link_rdm'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-12 mt-1 mb-1 text-center">
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </form>
                <!--/ form -->
            </div>
        </div>
    </div>
    <script src="Institution/institution.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<?php
$t_ppdbperiode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM t_ppdbperiode"));
?>
<div class="content-body">
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title text-uppercase fw-bolder">Data Pendaftar</h4>
        </div>
        <div class="card-datatable table-responsive">
            <?php
            $res_jur_query = mysqli_query($koneksi, "SELECT * FROM t_ppdbjurusan WHERE ppdbjurusan_actived=1");
            $res_jur = mysqli_fetch_array($res_jur_query);
            if (!empty($res_jur)) {
                if (isset($res_jur['ppdbjurusan_kuota'])) {
                    $q_jur = mysqli_query($koneksi, "SELECT * FROM t_ppdbregist WHERE ppdbjurusan_id='$res_jur[ppdbjurusan_id]'");
                    $cek_jur = mysqli_num_rows($q_jur);
                    if ($cek_jur >= $res_jur['ppdbjurusan_kuota']) {
            ?>
                        <div class="row m-1">
                            <div class="alert alert-danger" role="alert">
                                <div class="alert-body"><strong>Penting...!</strong> Kuota pendaftaran sudah habis silahkan buatkan <strong>"Gelombang Baru"</strong> atau edit kuota lama agar bisa menerima siswa baru.</div>
                            </div>
                        </div>
                    <?php
                    } elseif (!$cek_jur) {
                    ?>
                        <div class="row m-1">
                            <div class="alert alert-danger" role="alert">
                                <div class="alert-body"><strong>Error...!</strong> Data Gelombang tidak memiliki kuota yang ditentukan.</div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="row m-1">
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-body"><strong>Error...!</strong> Data Gelombang tidak memiliki kuota yang ditentukan.</div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="row m-1">
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-body"><strong>Error...!</strong> Data Gelombang Belum DIaktifkan.</div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="row g-1 mb-md-1 m-1">
                <div class="col-md-5">
                    <label class="form-label" for="filterSelect">Tahun Periode Pendaftaran</label>
                    <select class="form-control" name="tahunajaran_id" id="filterSelect" data-placeholder="Pilih Tahun Periode Pendaftaran">
                        <option value="">Pilih Tahun Pendaftaran</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="filterSelect">Reset</label><br>
                    <button type="button" id="reloadButton" class="btn btn-icon btn-outline-primary">
                        <i data-feather='refresh-cw'></i>
                    </button>
                </div>
                <div class="col-md-6 text-end">
                    <label class="form-label" for="filterSelect">Cetak Laporan PDF/Excel</label>
                    <br>
                    <div class="btn-group dropstart">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuExcel" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="me-25" data-feather='printer'></i>xls
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuExcel">
                            <?php
                            $sql = mysqli_query($koneksi, "SELECT * FROM t_ppdbperiode a 
                        LEFT JOIN e_tahunajaran b ON a.tahunajaran_id = b.tahunajaran_id
                        ORDER BY a.tahunajaran_id DESC") or die(mysqli_error($koneksi));
                            while ($t_ppdbperiode = mysqli_fetch_array($sql)) {
                            ?>
                                <a href="Registrations/Components/XlsRegister.php?thn_id=<?= $t_ppdbperiode['tahunajaran_id']; ?>" class="dropdown-item"><?= $t_ppdbperiode['tahunajaran_nama']; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="btn-group dropstart">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuPDF" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="me-25" data-feather='printer'></i>PDF
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuPDF">
                            <?php
                            $sql = mysqli_query($koneksi, "SELECT * FROM t_ppdbperiode a 
                        LEFT JOIN e_tahunajaran b ON a.tahunajaran_id = b.tahunajaran_id
                        ORDER BY a.tahunajaran_id DESC") or die(mysqli_error($koneksi));
                            while ($t_ppdbperiode = mysqli_fetch_array($sql)) {
                            ?>
                                <a onclick="printPDF(<?= $t_ppdbperiode['tahunajaran_id']; ?>)" class="dropdown-item" href="#"><?= $t_ppdbperiode['tahunajaran_nama']; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <table id="datatables-regist" class="datatables-regist table text-dark">
                <thead class="table-success ">
                    <tr class="text-center ">
                        <th></th>
                        <th>NO. Reg / GEL</th>
                        <th>Nama / TTL</th>
                        <th>NO Identitas</th>
                        <th>Contact/JK</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="createRegistrations" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 pb-2">
                    <div class="text-center mb-2">
                        <h3 class="mb-1">Tambah Data Pendaftar</h3>
                    </div>
                    <form id="createRegistrationsForm" class="row" onsubmit="return false">
                        <div class="col-12 mb-1">
                            <label class="form-label" for="tahunajaran_id">Tahun Ajaran</label>
                            <select class="form-control select2" name="tahunajaran_id" id="tahunajaran_id" data-placeholder="Pilih Tahun Ajaran">
                                <option value="">Pilih Periode PPDB</option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbjurusan_id">Tahun Gelombang Daftar</label>
                            <select class="form-control select2" name="ppdbjurusan_id" id="ppdbjurusan_id" data-placeholder="Pilih Tahun Gelombang Daftar">
                                <option value="">Pilih Gelombang / Jurusan</option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_name">Pendaftar Nama</label>
                            <input type="text" id="ppdbregist_name" name="ppdbregist_name" class="form-control" placeholder="Pendaftar Nama" autofocus data-msg="Please enter Pendaftar Nama" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_gender">Jenis Kelamin</label>
                            <select class="form-control select2" name="ppdbregist_gender" id="ppdbregist_gender" data-placeholder="Pilih Jenis Kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_nisn">Pendaftar NISN</label>
                            <input type="text" id="ppdbregist_nisn" name="ppdbregist_nisn" class="form-control" placeholder="Pendaftar NISN" autofocus data-msg="Please enter Pendaftar NISN" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_tempat">Pendaftar Tempat Lahir</label>
                            <input type="text" id="ppdbregist_tempat" name="ppdbregist_tempat" class="form-control" placeholder="Pendaftar Tempat Lahir" autofocus data-msg="Please enter Pendaftar Tempat Lahir" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_tgllahir">Pendaftar Tgl Lahir</label>
                            <input type="text" id="ppdbregist_tgllahir" name="ppdbregist_tgllahir" class="form-control flatpickr-basic" placeholder="Pendaftar Tgl Lahir" autofocus data-msg="Please enter Pendaftar Tgl Lahir" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_nokk">Pendaftar No KK</label>
                            <input type="text" id="ppdbregist_nokk" name="ppdbregist_nokk" class="form-control" placeholder="Pendaftar No KK" autofocus data-msg="Please enter Pendaftar No KK" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_nik">Pendaftar NIK</label>
                            <input type="text" id="ppdbregist_nik" name="ppdbregist_nik" class="form-control" placeholder="Pendaftar NIK" autofocus data-msg="Please enter Pendaftar NIK" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_nohp">Pendaftar No HP</label>
                            <input type="text" id="ppdbregist_nohp" name="ppdbregist_nohp" class="form-control" placeholder="Pendaftar No HP" autofocus data-msg="Please enter Pendaftar No HP" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="password">Pendaftar Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Pendaftar Password" autofocus data-msg="Please enter Pendaftar Password" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="password_confirm">Confirm Password</label>
                            <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Confirm Password" autofocus data-msg="Please enter Confirm Password" />
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Tambah Registrations</button>
                            <button type="button" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<iframe id="loadFrameRegisters" src="" style="display:none;"></iframe>
<script src="Registrations/scripts.js"></script>
<script>
    function printPDF(tahunajaran_id) {
        var frame = document.getElementById('loadFrameRegisters');
        var printUrl = "Registrations/Components/PrintRegister.php?tahunajaran_id=" + tahunajaran_id;
        frame.src = printUrl;
        frame.style.display = "block";
        frame.onload = function() {
            var result = false;
            try {
                result = this.contentWindow.print();
                frame.style.display = "none";
            } catch (e) {
                console.error("Kesalahan saat mencetak: " + e);
                frame.style.display = "none";
            }
            if (result) {
                setTimeout(function() {
                    frame.style.display = "none";
                    frame.src = "";
                }, 1000);
            }
        };
    }
</script>
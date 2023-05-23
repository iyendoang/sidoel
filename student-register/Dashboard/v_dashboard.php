<?php
$query = "SHOW COLUMNS FROM t_ppdbregist";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    die("Query execution failed: " . mysqli_error($koneksi));
}
$totalColumns = mysqli_num_rows($result);
$columnsFilled = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $columnValeu = $row['Field'];
    $query = "SELECT COUNT(*) AS columnCount FROM t_ppdbregist WHERE ppdbregist_nisn = '$t_ppdbregist[ppdbregist_nisn]' AND $columnValeu IS NOT NULL";
    $columnResult = mysqli_query($koneksi, $query);
    $columnRow = mysqli_fetch_assoc($columnResult);
    $columnCount = $columnRow['columnCount'];
    if ($columnCount > 0) {
        $columnsFilled++;
    }
}
$columnsEmpty = $totalColumns - $columnsFilled;
mysqli_close($koneksi);
?>
<div class="content-header">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mt-3 mb-2" src="../app-assets/images/sidoel/avatar7.png" height="180" width="180" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4><strong><?= $t_ppdbregist['ppdbregist_name']; ?></strong></h4>
                                <?php if ($t_ppdbregist['ppdbregist_actived'] == 1) { ?>
                                    <span class="badge bg-light-success text-capitalize">Sudah dkonfirmasi</span>
                                <?php } else { ?>
                                    <span class="badge bg-light-danger text-capitalize">Belum dkonfirmasi</span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around my-2 pt-75">
                        <?php if ($totalColumns == $columnsFilled) { ?>
                            <div class="d-flex align-items-start me-2">
                                <span class="badge bg-light-success p-75 rounded">
                                    <i data-feather="check" class="font-medium-2"></i>
                                </span>
                                <div class="ms-75">
                                    <h4 class="mb-0"><?= $columnsFilled; ?></h4>
                                    <small>Sudah terisi</small>
                                </div>
                            </div>
                        <?php  } else { ?>
                            <div class="d-flex align-items-start me-2">
                                <span class="badge bg-light-danger p-75 rounded">
                                    <i data-feather="x" class="font-medium-2"></i>
                                </span>
                                <div class="ms-75">
                                    <h4 class="mb-0"><?= $columnsFilled; ?></h4>
                                    <small>Sudah terisi</small>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($totalColumns == $columnsFilled) { ?>
                            <div class="d-flex align-items-start">
                                <span class="badge bg-light-success p-75 rounded">
                                    <i data-feather="check" class="font-medium-2"></i>
                                </span>
                                <div class="ms-75">
                                    <h4 class="mb-0"><?= $columnsEmpty; ?></h4>
                                    <small>Belum terisi</small>
                                </div>
                            </div>
                        <?php  } else { ?>
                            <div class="d-flex align-items-start">
                                <span class="badge bg-light-danger p-75 rounded">
                                    <i data-feather="x" class="font-medium-2"></i>
                                </span>
                                <div class="ms-75">
                                    <h4 class="mb-0"><?= $columnsEmpty; ?></h4>
                                    <small>Belum terisi</small>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="info-container">
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body text-capitalize">
                                <h4 class="fw-bolder border-bottom">Data Diri</h4>
                            </div>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Tahun:</span>
                                <span class="text-capitalize"><?= $e_tahunajaran['tahunajaran_nama']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Gelombang:</span>
                                <span class="text-capitalize"><?= $t_ppdbjurusan['ppdbjurusan_name']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Nomor Regist:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_number']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Nomor NISN:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_nisn']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Nama Lengkap:</span>
                                <span class="text-capitalize"><strong><?= $t_ppdbregist['ppdbregist_name']; ?></strong></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Jenis kelamin:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_gender']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Tempat lahir:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_tempat']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Tanggal lahir:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_tgllahir']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Nomor KK:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_nokk']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Nomor NIK:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_nik']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">ANak Ke:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_anakke']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Jumlah Saudara:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_saudara']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Hobi:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_hobi']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Cita-cita:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_cita']; ?></span>
                            </li>
                            <li class="mb-75">
                                <span class="text-capitalize" class="fw-bolder me-25">Nomor HP:</span>
                                <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_nohp']; ?></span>
                            </li>
                        </ul>
                        <a href="?pg=edit-student-regist" class="btn btn-primary w-100 mb-75">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Progress Isian data</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <!-- <li>
                                <a data-action="close"><i data-feather="x"></i></a>
                            </li> -->
                            <li>
                                <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <?php if ($totalColumns == $columnsFilled) { ?>
                            <div class="progress progress-bar-success mb-2">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $columnsFilled; ?>" aria-valuemin="<?= $columnsFilled; ?>" aria-valuemax="<?= $totalColumns; ?>" style="width: <?= number_format($columnsFilled / $totalColumns * 100); ?>%">
                                    <?= number_format($columnsFilled / $totalColumns * 100); ?> %
                                </div>
                            </div>
                            <div class="alert alert-success" role="alert">
                                <div class="alert-body text-capitalize">selamat datang <strong><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_name'])); ?></strong> Anda telah melengkapi data.</div>
                            </div>
                        <?php  } else { ?>
                            <div class="progress progress-bar-danger mb-2">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $columnsFilled; ?>" aria-valuemin="<?= $columnsFilled; ?>" aria-valuemax="<?= $totalColumns; ?>" style="width: <?= number_format($columnsFilled / $totalColumns * 100); ?>%">
                                    <?= number_format($columnsFilled / $totalColumns * 100); ?> %
                                </div>
                            </div>
                            <div class="alert alert-danger" role="alert">
                                <div class="alert-body text-capitalize">selamat datang <strong><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_name'])); ?></strong> Silahkan lengkapi data anda.</div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="info-container col-md-6 col-12">
                                <div class="alert alert-primary" role="alert">
                                    <div class="alert-body text-capitalize">
                                        <h4 class="fw-bolder border-bottom">Data Ayah</h4>
                                    </div>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Nama ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_name'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Status ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_status'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Kewarganegaraan ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_wn'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">kitas / NIK ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_nik'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Tempat lahir ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_tempat'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Pendidikan ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_pendidikan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Pekerjaan ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_pekerjaan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Penghasilan ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_penghasilan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Nomor HP ayah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbayah_nohp'])); ?></span>
                                    </li>
                                </ul>
                                <a href="?pg=edit-student-parent" class="btn btn-primary w-100 mb-75">
                                    Edit
                                </a>
                                <div class="alert alert-primary" role="alert">
                                    <div class="alert-body text-capitalize">
                                        <h4 class="fw-bolder border-bottom">Data Ibu</h4>
                                    </div>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Nama ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_name'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Status ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_status'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Kewarganegaraan ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_wn'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">kitas / NIK ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_nik'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Tempat lahir ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_tempat'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Pendidikan ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_pendidikan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Pekerjaan ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_pekerjaan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Penghasilan ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_penghasilan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Nomor HP ibu:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbibu_nohp'])); ?></span>
                                    </li>
                                </ul>
                                <a href="?pg=edit-student-parent" class="btn btn-primary w-100 mb-75">
                                    Edit
                                </a>
                                <div class="alert alert-primary" role="alert">
                                    <div class="alert-body text-capitalize">
                                        <h4 class="fw-bolder border-bottom">Data Wali</h4>
                                    </div>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Nama wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_name'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Status wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_status'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Kewarganegaraan wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_wn'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">kitas / NIK wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_nik'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Tempat lahir wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_tempat'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Pendidikan wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_pendidikan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Pekerjaan wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_pekerjaan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Penghasilan wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_penghasilan'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Nomor HP wali:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbwali_nohp'])); ?></span>
                                    </li>
                                </ul>
                                <a href="?pg=edit-student-parent" class="btn btn-primary w-100 mb-75">
                                    Edit
                                </a>
                            </div>
                            <div class="info-container col-md-6 col-12">
                                <div class="alert alert-primary" role="alert">
                                    <div class="alert-body text-capitalize">
                                        <h4 class="fw-bolder border-bottom">Alamat</h4>
                                    </div>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Status tinggal:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_stt'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Provinsi:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_prov'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Kota:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_kota'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Kecamatan:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_kec'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Kelurahan:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_kel'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Jalan:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_alamat'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">RT / RW:</span>
                                        <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_rt'] . ' / ' . $t_ppdbregist['ppdbregist_rt']; ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Kodepos:</span>
                                        <span class="text-capitalize"><?= $t_ppdbregist['ppdbregist_kodepos']; ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Jarak tempuh:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_jarak'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Tranportasi:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_transportasi'])); ?></span>
                                    </li>
                                    <a href="?pg=edit-student-address" class="btn btn-primary w-100 mb-75">
                                        Edit
                                    </a>
                                </ul>
                                <div class="alert alert-primary" role="alert">
                                    <div class="alert-body text-capitalize">
                                        <h4 class="fw-bolder border-bottom">Sekolah Asal</h4>
                                    </div>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Jenjang:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbasal_jenjang'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Status:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbasal_status'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">NPSN:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbasal_npsn'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Nama Sekolah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbasal_sekolah'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Kota:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbasal_kota'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">Tahun:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbasal_tahun'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">No Ujian:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbasal_noujian'])); ?></span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="text-capitalize" class="fw-bolder me-25">No Ijazah:</span>
                                        <span class="text-capitalize"><?= ucfirst(strtolower($t_ppdbregist['ppdbasal_noijazah'])); ?></span>
                                    </li>
                                    <a href="?pg=edit-student-previous-level" class="btn btn-primary w-100 mb-75">
                                        Edit
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
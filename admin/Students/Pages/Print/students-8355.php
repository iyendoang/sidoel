<?php
require("../../../../config/database.php");
// require("../../../../config/config.function.php");
require("../../../../config/functions.crud.php");
require("../../../../config/function.php");
// echo "<link rel='stylesheet' href='../assets/css/cetak.min.css'>";
$tingkat_id               = $_POST['tingkat_id'];
$post_tglcetak            = $_POST['post_tglcetak'];
$tahunajaran = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_tahunajaran where tahunajaran_status = 1"));
$thn_id = $tahunajaran['tahunajaran_id'];
$querysetting = mysqli_query($koneksi, "SELECT * 
FROM e_lembaga el
JOIN t_lembaga ml ON el.lembaga_nsm=ml.lembaga_nsm");
$setting = mysqli_fetch_array($querysetting);
$student_query = mysqli_query($koneksi, "SELECT * FROM e_siswa a 
JOIN e_kelas b ON a.kelas_id=b.kelas_id 
JOIN f_siswa_act c ON a.siswa_id=c.siswa_id 
JOIN e_tingkat d ON b.tingkat_id=d.tingkat_id 
WHERE a.kelas_id != '-1' 
AND a.tingkat_id = '$tingkat_id' 
AND a.siswa_alasan_mutasi IS NULL 
AND b.tahunajaran_id= '$thn_id' 
AND a.siswa_alasan_mutasi IS NULL");
$row_tingkat = mysqli_fetch_array($student_query);
$jumlahData = mysqli_num_rows($student_query);
$sql_jum_lk = mysqli_query($koneksi, "SELECT * FROM e_siswa a 
JOIN e_kelas b ON a.kelas_id=b.kelas_id 
JOIN f_siswa_act c ON a.siswa_id=c.siswa_id 
JOIN e_tingkat d ON b.tingkat_id=d.tingkat_id 
WHERE a.kelas_id != '-1' 
AND a.tingkat_id = '$tingkat_id' 
AND a.siswa_gender ='L'
AND a.siswa_alasan_mutasi IS NULL 
AND b.tahunajaran_id= '$thn_id' 
AND a.siswa_alasan_mutasi IS NULL");
$sum_lk = mysqli_num_rows($sql_jum_lk);
$sql_jum_pr = mysqli_query($koneksi, "SELECT * FROM e_siswa a 
JOIN e_kelas b ON a.kelas_id=b.kelas_id 
JOIN f_siswa_act c ON a.siswa_id=c.siswa_id 
JOIN e_tingkat d ON b.tingkat_id=d.tingkat_id 
WHERE a.kelas_id != '-1' 
AND a.tingkat_id = '$tingkat_id' 
AND a.siswa_gender ='P'
AND a.siswa_alasan_mutasi IS NULL 
AND b.tahunajaran_id= '$thn_id' 
AND a.siswa_alasan_mutasi IS NULL");
$sum_pr = mysqli_num_rows($sql_jum_pr);
if ($jumlahData == 0) {
    echo "<span style='font-size:30; color:red'>Tidak ada Peserta";
    echo mysqli_error($koneksi);
    die;
}
$jumlahn = '25';
$n = ceil($jumlahData / $jumlahn);

$nomer = 1;
// $date = date_create($m_tglcetak);

?>

<?php for ($i = 1; $i <= $n; $i++) : ?>
    <?php
    $mulai = $i - 1;
    $batas = ($mulai * $jumlahn);
    $startawal = $batas;
    $batasakhir = $batas + $jumlahn;
    ?>



    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="SIDOEL APP">
        <meta name="author" content="HD FKMTs">
        <meta name="theme-color" content="#317EFB" />
        <meta name="keyword" content="Sistem data operator elektronik">
        <title>8355 | <?= $setting['lembaga_nama']; ?></title>

        <link rel="stylesheet" href="../../../../app-assets/cetak/cetak_dnt_kemenag.min.css">

        <style>
            .kartu td {
                font-size: 11px;

            }

            .kartu tr td:first-child {
                padding-left: 10px;
            }

            .page .watermark {
                content: "";

                background: url("//pdakmi.kemenag.go.id/assets/images/kemenag.png");
                opacity: 0.1;
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
                width: 450px;
                height: 450px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 11;

            }

            table.page_header {
                width: 100%;
                border: none;
                background-color: #DDFFE6;
                border-bottom: solid 1mm #AAAADD;
                padding-left: 2mm;
                padding-right: 2mm
            }

            table.page_header1 {
                width: 100%;
                border: none;
                background-color: #ffffff;
                padding-left: 2mm;
                padding-right: 2mm
            }

            table.page_footer {
                width: 100%;
                border: none;
                background-color: #DDFFE6;
                border-top: solid 1mm #AAAADD;
                padding-left: 2mm;
                padding-right: 2mm
            }

            #watermark {
                background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='240px' width='700px'><text transform='translate(20, 200) rotate(-20)' stroke='rgb(194,179,179,0.82)' fill='rgb(255,255,255,0)' font-size='40'>DATA SEMENTARA</text></svg>");
                display: block;
                position: absolute;
                top: 0%;
                left: 10px;
                height: 21cm;
                width: 29.7cm;
                z-index: 8;
                text-align: center;
                white-space: nowrap;
            }
        </style>

    </head>

    <body onload='window.print()'>
        <div id="chart"></div>
        <?php if ($i == $n) : ?>
            <div class="page">
                <div class="watermark"></div>
                <table width="100%" class="page_header1">
                    <tbody>
                        <tr>
                            <td width='150' class="info_madrasah">
                                <span style="font-weight: bold;">NAMA MADRASAH</span></span> <br>
                                <span>NSM / NSS</span> <br>
                                <span>NPSN</span> <br>
                                <span>ALAMAT</span> <br>
                                <span>KECAMATAN</span> <br>
                                <span>KOTA / KABUPATEN</span> <br>
                            </td>
                            <td width='10' class="info_madrasah">
                                <span style="font-weight: bold;">:</span> <br>
                                <span>:</span> <br>
                                <span>:</span> <br>
                                <span>:</span> <br>
                                <span>:</span> <br>

                            </td>
                            <td width='500' class="info_madrasah">
                                <span style="font-weight: bold;"><?= $setting['lembaga_nama']; ?></span> <br>
                                <span><?= $setting['lembaga_nsm']; ?></span> <br>
                                <span><?= $setting['lembaga_npsn']; ?></span> <br>
                                <span><?= ucwords(strtolower(ucwords(strtolower($setting['lembaga_alamat'])))); ?></span> <br>
                                <span><?= ucwords(strtolower(ucwords(strtolower($setting['lembaga_kec'])))); ?></span> <br>
                                <span><?= ucwords(strtolower(ucwords(strtolower($setting['lembaga_kota'])))); ?></span> <br>
                            </td>
                            <td width='100'><img src='../../../../app-assets/images/sidoel/kemenag.png' width='80'></td>
                            <td style="text-align:center " width='600'>
                                <strong class="f12">
                                    DAFTAR NAMA SISWA MADRASAH <br>
                                    KANWIL KEMENAG PROVINSI DKI JAKARTA<br>
                                    <?= $setting['lembaga_nama'] ?><br>
                                    TAHUN PELAJARAN <?= $tahunajaran['tahunajaran_nama'] ?>
                                </strong>
                                <!-- logo  -->
                            <td style="text-align:center" width='100'>
                                <span style="font-weight: bold; color: #F78308;" class="f14">FORMAT</span> <br>
                                <img src='../../../../app-assets/images/sidoel/logo_8355.png' width='100'>
                                <span style="font-weight: bold; " class="f12">TINGKAT</span> <br>
                                <span style="font-weight: bold;" class="f21"><?= $row_tingkat['tingkat_nama']; ?></span> <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <center style="z-index: index 10;">
                    <table class="it-grid it-cetak" width="100%">
                        <br>
                        <table class="it-grid it-cetak" width="100%">
                            <tbody>
                                <tr style="height:30px; text-align:center;">
                                    <th>No.</th>
                                    <th>Nama Peserta Didik </th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>L/P</th>
                                    <th>Tempat Tgl Lahir </th>
                                    <th>Nama Ayah </th>
                                    <th>Nama Ibu </th>
                                    <?php if ($setting['jenjang_id'] != '2') { ?>
                                        <th>NO SERI IJAZAH </th>
                                    <?php } else { ?>
                                        <th>NIK </th>
                                    <?php } ?>
                                    <th>Kelas</th>
                                </tr>
                                <?php
                                $student_query = mysqli_query($koneksi, "SELECT * FROM e_siswa a 
                                JOIN e_kelas b ON a.kelas_id=b.kelas_id 
                                JOIN f_siswa_act c ON a.siswa_id=c.siswa_id 
                                JOIN e_tingkat d ON b.tingkat_id=d.tingkat_id 
                                WHERE a.kelas_id != '-1'
                                AND a.tingkat_id = '$tingkat_id' 
                                AND a.siswa_alasan_mutasi IS NULL 
                                AND b.tahunajaran_id= '$thn_id' 
                                AND a.siswa_alasan_mutasi IS NULL 
                                ORDER BY b.kelas_id ASC, a.siswa_nama 
                                LIMIT $batas,$jumlahn");
                                while ($row_siswa = mysqli_fetch_array($student_query)) :
                                ?>
                                    <tr>
                                        <td width="4%" align="center" style="font-size:10px;"><?= $nomer ?></td>
                                        <td width="250" style="font-size:10px;">
                                            <?= ucwords(strtolower($row_siswa['siswa_nama'])) ?>
                                        </td>
                                        <td width="40" align="center" style="font-size:10px;"><?= $row_siswa['siswa_nis'] ?></td>
                                        <td width="80" align="center" style="font-size:10px;"><?= $row_siswa['siswa_nisn'] ?></td>
                                        <td width="30" align="center" style="font-size:10px;"><?= $row_siswa['siswa_gender'] ?></td>
                                        <td width="220" style="font-size:10px;"><?= ucwords(strtolower($row_siswa['siswa_tempat'])) ?>, <?= ucwords(strtolower(tgl_indo($row_siswa['siswa_tgllahir']))) ?></td>
                                        <td width="220" style="font-size:10px;"><?= ucwords(strtolower($row_siswa['nama_ayah'])) ?></td>
                                        <td width="220" style="font-size:10px;"><?= ucwords(strtolower($row_siswa['nama_ibu'])) ?></td>
                                        <?php if ($setting['jenjang_id'] != '2') { ?>
                                            <td width="130" align="center" style="font-size:10px;"><?= $row_siswa['siswa_ijz_noseri'] ?></td>
                                        <?php } else { ?>
                                            <td width="130" align="center" style="font-size:10px;"><?= $row_siswa['siswa_kk_nik'] ?></td>
                                        <?php } ?>
                                        <td width="30" align="center" style="font-size:10px;"><?= $row_siswa['tingkat_nama'] ?>-<?= $row_siswa['kelas_nama'] ?></td>
                                    </tr>
                                    <?php
                                    $nomer++;
                                    $jlhhdr = ($nomer - 1);
                                    ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <br>
                        <br><br>
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width="250" style="vertical-align: bottom;">
                                        <table style="border:1px solid black">
                                            <tbody>
                                                <tr style="background-color: #F78308;">
                                                    <th style="text-align: center; color: white;" colspan="2">CATATAN</th>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;Dibuat 4 (empat) rangkap :</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;1. 1 (satu) lembar untuk seksi Penmad Kab/Kota</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;2. 1 (satu) lembar untuk Pengawas</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;3. 1 (satu) lembar untuk Sub Rayon</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;4. 1 (satu) lembar untuk Arsip Madrasah</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: right;"><b>NPSN <?= $setting['lembaga_npsn']; ?></b>&nbsp;</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="vertical-align: bottom;">
                                        <b><u>REKAP JUMLAH SISWA</u></b><br><br>
                                        <table style="border:1px solid black">
                                            <tbody>
                                                <tr>
                                                    <td>Laki-laki</td>
                                                    <td>:</td>
                                                    <td align="right"><?= $sum_lk ?> orang</td>
                                                </tr>
                                                <tr>
                                                    <td>Perempuan</td>
                                                    <td>:</td>
                                                    <td align="right"><?= $sum_pr ?> orang</td>
                                                </tr>
                                                <tr style="border-top:1px solid black">
                                                    <td>Total Peserta</td>
                                                    <td>:</td>
                                                    <td align="right"><?= $jlhhdr ?> orang</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td align="center" width="250">
                                        <br>
                                        Pengawas Madrasah<br><br><br><br><br>
                                        <nip><?= strtoupper($setting['lembaga_pengawas']) ?></nip>
                                        <br><br>&nbsp;&nbsp;&nbsp;&nbsp;NIP. <?= strtoupper($setting['lembaga_nip_pengawas']) ?><nip></nip>
                                    </td>
                                    <td align="center" width="250">
                                        <?= ucwords(strtolower($setting['lembaga_kota'])) ?>, <?= tgl_indo($post_tglcetak); ?><br>
                                        Kepala Madrasah<br><br><br><br><br>
                                        <nip><?= strtoupper($setting['lembaga_kamad']) ?></nip>
                                        <br><br>&nbsp;&nbsp;&nbsp;&nbsp;NIP. <?= strtoupper($setting['lembaga_nip_kamad']) ?><nip></nip>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <br>
                        <br><br>
                        <div class="footer">
                            <table width="100%" height="5">
                                <tbody>
                                    <tr>
                                        <td width="25px" style="border:1px solid black"></td>
                                        <td width="5px">&nbsp;</td>
                                        <td style="border:1px solid black;font-weight:bold;font-size:14px;text-align:center;">KEMENTERIAN AGAMA KOTA JAKARTA BARAT</td>
                                        <td width="5px">&nbsp;</td>
                                        <td width="25px" style="border:1px solid black"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </center>
            </div>
            <?php break; ?>
        <?php endif; ?>
        <div class="page">
            <div class="watermark"></div>
            <table width="100%" class="page_header1">
                <tbody>
                    <tr>
                        <td width='150' class="info_madrasah">
                            <span style="font-weight: bold;">NAMA MADRASAH</span></span> <br>
                            <span>NSM / NSS</span> <br>
                            <span>NPSN</span> <br>
                            <span>ALAMAT</span> <br>
                            <span>KECAMATAN</span> <br>
                            <span>KOTA / KABUPATEN</span> <br>
                        </td>
                        <td width='10' class="info_madrasah">
                            <span style="font-weight: bold;">:</span> <br>
                            <span>:</span> <br>
                            <span>:</span> <br>
                            <span>:</span> <br>
                            <span>:</span> <br>

                        </td>
                        <td width='500' class="info_madrasah">
                            <span style="font-weight: bold;"><?= $setting['lembaga_nama']; ?></span> <br>
                            <span><?= $setting['lembaga_nsm']; ?></span> <br>
                            <span><?= $setting['lembaga_npsn']; ?></span> <br>
                            <span><?= ucwords(strtolower(ucwords(strtolower($setting['lembaga_alamat'])))); ?></span> <br>
                            <span><?= ucwords(strtolower(ucwords(strtolower($setting['lembaga_kec'])))); ?></span> <br>
                            <span><?= ucwords(strtolower(ucwords(strtolower($setting['lembaga_kota'])))); ?></span> <br>
                        </td>
                        <td width='100'><img src='../../../../app-assets/images/sidoel/kemenag.png' width='80'></td>
                        <td style="text-align:center " width='600'>
                            <strong class="f12">
                                DAFTAR NAMA SISWA MADRASAH <br>
                                KANWIL KEMENAG PROVINSI DKI JAKARTA<br>
                                <?= $setting['lembaga_nama'] ?><br>
                                TAHUN PELAJARAN <?= $tahunajaran['tahunajaran_nama'] ?>
                            </strong>
                            <!-- logo  -->
                        <td style="text-align:center" width='100'>
                            <span style="font-weight: bold; color: #F78308;" class="f14">FORMAT</span> <br>
                            <img src='../../../../app-assets/images/sidoel/logo_8355.png' width='100'>
                            <span style="font-weight: bold; " class="f12">TINGKAT</span> <br>
                            <span style="font-weight: bold;" class="f21"><?= $row_tingkat['tingkat_nama']; ?></span> <br>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <center style="z-index: index 10;">
                <table class="it-grid it-cetak" width="100%">
                    <tbody>
                        <tr style="height:30px; text-align:center;">
                            <th>No.</th>
                            <th>Nama Peserta Didik </th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>L/P</th>
                            <th>Tempat Tgl Lahir </th>
                            <th>Nama Ayah </th>
                            <th>Nama Ibu </th>
                            <?php if ($setting['jenjang_id'] != '2') { ?>
                                <th>NO SERI IJAZAH </th>
                            <?php } else { ?>
                                <th>NIK </th>
                            <?php } ?>
                            <th>Kelas</th>
                        </tr>
                        <?php
                        $student_query = mysqli_query($koneksi, "SELECT * FROM e_siswa a 
                                JOIN e_kelas b ON a.kelas_id=b.kelas_id 
                                JOIN f_siswa_act c ON a.siswa_id=c.siswa_id 
                                JOIN e_tingkat d ON b.tingkat_id=d.tingkat_id 
                                WHERE a.kelas_id != '-1'
                                AND a.tingkat_id = '$tingkat_id' 
                                AND a.siswa_alasan_mutasi IS NULL 
                                AND b.tahunajaran_id= '$thn_id' 
                                AND a.siswa_alasan_mutasi IS NULL 
                                ORDER BY b.kelas_id ASC, a.siswa_nama 
                                LIMIT $batas,$jumlahn");
                        while ($row_siswa = mysqli_fetch_array($student_query)) :
                        ?>
                            <tr>
                                <td width="4%" align="center" style="font-size:10px;"><?= $nomer ?></td>
                                <td width="250" style="font-size:10px;">
                                    <?= ucwords(strtolower($row_siswa['siswa_nama'])) ?>
                                </td>
                                <td width="40" align="center" style="font-size:10px;"><?= $row_siswa['siswa_nis'] ?></td>
                                <td width="80" align="center" style="font-size:10px;"><?= $row_siswa['siswa_nisn'] ?></td>
                                <td width="30" align="center" style="font-size:10px;"><?= $row_siswa['siswa_gender'] ?></td>
                                <td width="220" style="font-size:10px;"><?= ucwords(strtolower($row_siswa['siswa_tempat'])) ?>, <?= ucwords(strtolower(tgl_indo($row_siswa['siswa_tgllahir']))) ?></td>
                                <td width="220" style="font-size:10px;"><?= ucwords(strtolower($row_siswa['nama_ayah'])) ?></td>
                                <td width="220" style="font-size:10px;"><?= ucwords(strtolower($row_siswa['nama_ibu'])) ?></td>
                                <?php if ($setting['jenjang_id'] != '2') { ?>
                                    <td width="130" align="center" style="font-size:10px;"><?= $row_siswa['siswa_ijz_noseri'] ?></td>
                                <?php } else { ?>
                                    <td width="130" align="center" style="font-size:10px;"><?= $row_siswa['siswa_kk_nik'] ?></td>
                                <?php } ?>
                                <td width="30" align="center" style="font-size:10px;"><?= $row_siswa['tingkat_nama'] ?>-<?= $row_siswa['kelas_nama'] ?></td>
                            </tr>
                            <?php
                            $nomer++;
                            $jlhhdr = ($nomer - 1);
                            ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <br>
                <br><br>
                <div class="footer">
                    <table width="100%" height="5">
                        <tbody>
                            <tr>
                                <td width="25px" style="border:1px solid black"></td>
                                <td width="5px">&nbsp;</td>
                                <td style="border:1px solid black;font-weight:bold;font-size:14px;text-align:center;">KEMENTERIAN AGAMA KOTA JAKARTA BARAT</td>
                                <td width="5px">&nbsp;</td>
                                <td width="25px" style="border:1px solid black"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </center>
        </div>
    <?php endfor; ?>
    </body>

    </html>
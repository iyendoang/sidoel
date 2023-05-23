<?php
session_start();
require "../../../../config/database.php";
require "../../../../config/function.php";
require "../../../../config/functions.crud.php";
include "../../../../app-assets/phpqrcode/qrlib.php";

?>

<!DOCTYPE html>
<html>
<!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta charset='UTF-8'>
    <title>Cetak Kartu Pelajar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../../../../app-assets/cetak/cetak-id-card.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <style>
        .kartu td {
            font-size: 11px;

        }

        .kartu tr td:first-child {
            padding: auto;
        }

        .main {
            display: grid;
            grid-template-areas: "a a";
            grid-gap: 15px;
            padding: 12px;
            padding-left: 29px;
            background-color: white;
            grid-auto-rows: auto;
            width: 19.4cm;
        }

        .GFG {
            background-image: url('../../../../app-assets/cetak/template/t1.png');
            background-size: 8.6cm 5.4cm;
            text-align: center;
            font-size: 35px;
            /* border: solid black; */
            padding: 5px;
            height: 5.4cm;
            width: 8.6cm;
        }

        .grid-container-header {
            display: grid;
            grid-template-columns: auto auto;
            padding: 5px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            font-size: 30px;
            text-align: center;
        }
    </style>


</head>


<div class="page">
    <center style="z-index: index 10;">
        <div class="watermark"></div>
        <?php
        $t_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_lembaga"));
        $e_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_lembaga"));
        $siswa_id = $_POST['siswa_id'];
        $sel_siswa_id = count($siswa_id);
        $no = 0;

        for ($query = 0; $query < $sel_siswa_id; $query++) {
            $result = mysqli_query($koneksi, "SELECT * FROM e_siswa a
                LEFT JOIN f_siswa_act b ON a.siswa_id = b.siswa_id
                WHERE a.siswa_id='$siswa_id[$query]
                '");
            $no++;
            while ($e_siswa = mysqli_fetch_array($result)) {
                $halaman = '/app/qrcodekartupelajar.php';
                $tempdir = "../../../../tmp/students-qr-code/"; //Nama folder tempat menyimpan file qrcode
                if (!file_exists($tempdir)) //Buat folder bername temp
                    mkdir($tempdir);
                //isi qrcode jika di scan
                $codeContents = $t_lembaga['lembaga_link_rdm'] . $halaman . '?' . 'id=' . enkripsi($e_siswa['siswa_nis']);
                //simpan file kedalam temp
                //nilai konfigurasi Frame di bawah 4 tidak direkomendasikan
                QRcode::png($codeContents, $tempdir . $e_siswa['siswa_nis'] . '.png', QR_ECLEVEL_M, 4);
                $no++;
                // var_dump($e_siswa);
        ?>
                <div class="main">
                    <p style="display:none;"><?= $no; ?></p>
                    <div class="GFG">
                        <p class="text" style="display: none ;"><?= $no ?></p>
                        <table width="315" height="60" class="kop-kartu">
                            <tbody>
                                <tr>
                                    <td style="width:80px;"><img src="../../../../../<?= $e_lembaga['lembaga_foto']; ?>" height="40"></td>
                                    <td align="center" valign="top" style="font-weight:bold;  color:white;  padding-top:6px;padding-bottom:6px;">
                                        <span style="font-size:7pt;">KEMENTERIAN AGAMA KOTA <?= ucwords(strtoupper($t_lembaga['lembaga_kota'])) ?></span><br>
                                        <span style="font-size: 9pt; color:yellow;"><?= $t_lembaga['lembaga_nama']; ?></span><br>
                                        <span style="font-size:6pt;">NPSN: <?= $t_lembaga['lembaga_npsn']; ?> | NSM: <?= $t_lembaga['lembaga_nsm']; ?></span> <br>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table width="315" height="5" class="kop-kartu">
                            <tbody>
                                <tr>

                                    <td style="text-align: center;" colspan="4" class="fw-bold"><span style=" color:darkgreen; font-size:9pt;">KARTU PELAJAR</span></td>
                                </tr>
                                <tr>
                                    <td rowspan="7" style="width:80px;">
                                        <div style="width: 1.5cm; height: 2.2cm; border: 1px solid #ccc; text-align: center; margin:5px;">
                                        <img alt="" src="../../Models/zip-photo-siswa/<?= $e_siswa['siswa_nis'] ?>.jpg" style="width: 1.5cm; height: 2.1cm;">

                                        </div>
                                        <!-- <div style="width: 1.5cm; height: 2.2cm; border: 1px solid #ccc; text-align: center; margin:5px;">
                                            <br>
                                            <br>
                                          
                                            Foto 2x3

                                        </div> -->
                                        
                                    </td>
                                    <td style="text-align: left;" colspan="3" class="fw-bold"><span style=" color:#000000; font-size:7pt;"></span></td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;" class="fw-ok" width="80">Nama</td>
                                    <td valign="top">:</td>
                                    <td style="text-align: left;" class="fw-bold" width="300"><?= ucwords(strtoupper($e_siswa['siswa_nama'])) ?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;" class="fw-ok" width="80">NIS / NISN</td>
                                    <td valign="top">:</td>
                                    <td style="text-align: left;" class="fw-ok" width="300"><?= $e_siswa['siswa_nis'] ?> / <?= $e_siswa['siswa_nisn']; ?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;" class="fw-ok" width="80">NIK</td>
                                    <td valign="top">:</td>
                                    <td style="text-align: left;" class="fw-ok" width="300"><?= $e_siswa['siswa_kk_nik'] ?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;" class="fw-ok" width="80">TTL</td>
                                    <td valign="top">:</td>
                                    <td style="text-align: left;" class="fw-ok" width="300"><?= ucwords(strtolower($e_siswa['siswa_tempat'])); ?>, <?= tgl_indo($e_siswa['siswa_tgllahir']) ?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;" class="fw-ok" width="80">Gender</td>
                                    <td valign="top">:</td>
                                    <td style="text-align: left;" class="fw-ok" width="300"><?php if ($e_siswa['siswa_gender'] == 'L') { ?> Laki Laki <?php } else { ?> Perempuan <?php } ?></td>
                                </tr>
                                <tr>

                                    <td valign="top" style="text-align: left;" class="fw-ok" width="80">Alamat</td>
                                    <td valign="top" style="vertical-align: top;">:</td>
                                    <td style="text-align: left; font-size:6pt;" width="300"><?= ucwords(strtolower($e_siswa['siswa_alamat'])) ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table height="10" class="kop-kartu">
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="GFG">
                        <table width="315" height="30" class="kop-kartu">
                            <tbody>
                                <tr>
                                    <td rowspan="2" style="width:80px;"><img src="../../../../../<?= $e_lembaga['lembaga_foto']; ?>" height="40"></td>
                                    <td align="center" valign="top" style="font-weight:bold; color:white; padding-top:6px;">
                                        <span style="font-size: 9pt; color:yellow;"><?= $t_lembaga['lembaga_nama']; ?></span><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="color:white; ">
                                        <div>
                                            <i style="font-size:5pt;">
                                                Alamat : <?= ucwords(strtolower($t_lembaga['lembaga_alamat'])); ?> Kel. <?= ucwords(strtolower($t_lembaga['lembaga_kel'])); ?>
                                                Kec. <?= ucwords(strtolower($t_lembaga['lembaga_kec'])); ?> <?= ucwords(strtolower($t_lembaga['lembaga_kota'])); ?> <?= $t_lembaga['lembaga_kodepos']; ?> Telp. <?= $t_lembaga['lembaga_kamad_notelp']; ?>
                                            </i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table height="8"></table>

                        <table width="315">
                            <tbody>
                                <tr>
                                    <td style="text-align: left;" width="20"></td>
                                    <td colspan="2" style="text-align: left;">
                                        <ol>
                                            <li style="font-size:7.5pt;">Kartu pelajar ini berlaku selama masih menjadi siswa</li>
                                            <li style="font-size:7.5pt;">Dilarang merusak kartu pelajar</li>
                                            <li style="font-size:7.5pt;">Pembuatan kartu pelajar baru akan dikenakan biaya</li>
                                            <li style="font-size:7.5pt;">Jika menemukan mohon dikembalikan ke pihak sekolah</li>
                                        </ol>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table height="6"></table>
                        <table width="315" height="50">
                            <tbody>
                                <tr>
                                    <td style="text-align: center;" width="150"><img alt="QR image" src="../../../../tmp/students-qr-code/<?= $e_siswa['siswa_nis'] ?>.png" width="50px"></td>
                                    <td width="90"></td>
                                    <td valign="top" style="width:280px; font-size:8pt;">

                                        <?= ucwords(strtolower($t_lembaga['lembaga_kota'])); ?>, <?= tgl_indo($t_lembaga['L_tglkartupelajar']); ?> <br>
                                        Kepala Madrasah<br><br>
                                        <b><?= $t_lembaga['lembaga_kamad']; ?></b><br>
                                        <b>NIP. <?= $t_lembaga['lembaga_nip_kamad']; ?></b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        <?php }
        } ?>
    </center>
</div>

</html>
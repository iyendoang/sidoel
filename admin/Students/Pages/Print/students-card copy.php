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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <style>
        @media all {
            .page-break {
                display: none;
            }
        }

        @media print {
            .page-break {
                display: block;
                page-break-before: always;
                height: 0;
                margin: 0;
                border-top: none;
                font-family: Arial;
                position: relative;
                border-bottom: 1px solid #000;
            }
        }

        body,
        p,
        a,
        span,
        td {
            font-size: 9pt;
            font-family: Arial;
        }

        body {
            margin-left: 2em;
            margin-right: 2em;
        }

        .page {
            height: 947px;
            padding-top: 5px;
            page-break-after: always;
            font-family: Arial;
            position: relative;
            border-bottom: 1px solid #000;
        }
    </style>


</head>

<!-- <body onload='window.print()' class="page" style="font-family: arial;font-size: 11px;position:absolute;"> -->

<body class="page" style="font-family: arial;font-size: 11px;position:absolute;">
    <?php
    $t_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_lembaga"));
    $e_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_lembaga"));
    $siswa_id = $_POST['siswa_id'];
    $sel_siswa_id = count($siswa_id);
    $no = 0;
    for ($query = 0; $query < $sel_siswa_id; $query++) {
        $result = mysqli_query($koneksi, "SELECT * FROM e_siswa WHERE siswa_id='$siswa_id[$query]'");
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
    ?>
            <div class="page" style="width: 750px;height: 230;margin: 0px;">
                <img style="position: absolute;padding-left: 0px;padding-top: 0px;" class="img-responsive img" alt="Responsive image" src="../../../../<?= $t_lembaga['L_templatekartu'] ?>" width="750px" height="230">
                <img style="position: absolute;padding-left:30px;margin-top: -240px;" class="img-responsive img" alt="Responsive image" src="../../../../../<?= $e_lembaga['lembaga_foto'] ?>" width="40px">
                <p class="hidden" style="display: none;"><?= $no ?></p>
                <p style="position: absolute;padding-left: 100px;padding-top: 10px; color:#ffffff; font-size:9pt;">YAYASAN SAFINATUL HUSNA</p>
                <p style="position: absolute;padding-left: 100px;padding-top: 20px; color:#ffffff; font-size:11pt;"><b><?= $t_lembaga['lembaga_nama']; ?></b></p>
                <p style="position: absolute;padding-left: 100px;padding-top: 40px; color:yellow; font-size:7pt;">
                    <?= $t_lembaga['lembaga_alamat']; ?>
                    <?= $t_lembaga['lembaga_kota']; ?>
                    <?= $t_lembaga['lembaga_provinsi']; ?>
                </p>
                <img style="position: absolute;padding-left:420px;margin-top: -240px;" class="img-responsive img" alt="Responsive image" src="../../../../../<?= $e_lembaga['lembaga_foto'] ?>" width="40px">
                <p class="hidden" style="display: none;"><?= $no ?></p>
                <p style="position: absolute;padding-left: 470px;padding-top: 10px; color:#ffffff; font-size:9pt;">YAYASAN SAFINATUL HUSNA</p>
                <p style="position: absolute;padding-left: 470px;padding-top: 20px; color:#ffffff; font-size:11pt;"><b><?= $t_lembaga['lembaga_nama']; ?></b></p>
                <p style="position: absolute;padding-left: 470px;padding-top: 40px; color:yellow; font-size:7pt;">
                    <?= $t_lembaga['lembaga_alamat']; ?>
                    <?= $t_lembaga['lembaga_kota']; ?>
                    <?= $t_lembaga['lembaga_provinsi']; ?>
                </p>
                <p style="position: relative;padding-left: 140px;padding-top: 65px; "><b>KARTU PELAJAR</b></p>
                <?php if ($e_siswa['siswa_foto'] == null) { ?>
                    <div style=" border: 2px solid black;width: 20mm;height: 27mm;text-align: center;position: absolute;margin-left: 10px;margin-top: -12px;"><span><br><br><br><br></div>
                <?php } else { ?>
                    <img style="border: 1px solid #ffffff;position: absolute;margin-left: 10px;margin-top: -12px;" src="../../../../<?= $e_siswa['siswa_foto'] ?>" width="80px">
                <?php } ?>
                <img style="position: absolute;padding-left: 420px;margin-top: 60px;" class="img-responsive img" alt="QR image" src="../../../../tmp/students-qr-code/<?= $e_siswa['siswa_nis'] ?>.png" width="50px">
                <table width="50%" style="margin-top: -12px;padding-left: 91px; position: relative;font-family: arial;font-size: 9px; word-break: break-all;">
                    <tr>
                        <td width="29%">Nama</td>
                        <td>:</td>
                        <td style=""><b><?= $e_siswa['siswa_nama'] ?></b></td>
                    </tr>
                    <tr>
                        <td>NIS Lokal</td>
                        <td>:</td>
                        <td><?= $e_siswa['siswa_nis'] ?></td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td><?= $e_siswa['siswa_nisn'] ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td><?= $e_siswa['siswa_tempat'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><?= $e_siswa['siswa_tgllahir'] ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td><?php if ($e_siswa['siswa_gender'] == 'L') { ?> Laki Laki <?php } else { ?> Perempuan <?php } ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="color: #ffffff;">:</td>
                        <td></td>
                    </tr>
                </table>
                <!-- <p style="padding-left: 10px;font-size: 7px; margin-top: 2px; font-family: 'Montserrat', sans-serif; position: absolute;">Email: <?= $t_lembaga['lembaga_email'] ?> | Telp. <?= $t_lembaga['lembaga_notelp'] ?> <br>Website: <?= $t_lembaga['lembaga_web'] ?></p> -->
                </p>
                <p style="position: absolute;padding-left: 570px;margin-top: -90px;font-size: 9px; font-family: arial;">
                    <?= $t_lembaga['lembaga_provinsi'] ?>, <?= tgl_indo($t_lembaga['L_tglkartupelajar']) ?> </p>
                <p style="position: absolute;padding-left: 570px;margin-top: -80px;font-size: 9px; font-family: arial;;">Mengetahui, <br>Kepala Madrasah</p>
                <p style="position: absolute;padding-left: 570px;margin-top: -40px;font-size: 9px; font-family: arial;;"><b><u><?= $t_lembaga['lembaga_kamad'] ?></u></b><br>NIP. <?= $t_lembaga['lembaga_nip_kamad'] ?></p>
                <img style="position: absolute;padding-left: 540px;margin-top: -70px;" class="img-responsive img" alt="Responsive image" src="../../../../<?= $t_lembaga['lembaga_filestempel'] ?>" width="70px">
                <img style="position: absolute; padding-left: 580px;margin-top: -75px;" class="img-responsive img" alt="Responsive image" src="../../../../<?= $t_lembaga['lembaga_filettdkamad'] ?>" width="70px">
                <br><br>
                <?php if (($no % 8) == 0) : ?>
            </div>
            <div class="page" style="page-break-before:always;width: 750px;height: 230;margin: 0px;">
            <?php endif; ?>
</body>

</html>
<?php }
    } ?>
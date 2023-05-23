<?php ob_start();
require "../../../../config/database.php";
require "../../../../config/function.php";
require "../../../../config/functions.crud.php";
include "../../../../app-assets/phpqrcode/qrlib.php";
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$querysetting = mysqli_query($koneksi, "SELECT * 
FROM e_lembaga a
JOIN t_lembaga b ON a.lembaga_nsm=b.lembaga_nsm");
$setting = mysqli_fetch_array($querysetting);
$t_ppdbregist = fetch($koneksi, 't_ppdbregist', ['ppdbregist_id' => dekripsi($_GET['id'])]);
$halaman = '/app/qrcodekartupelajar.php';
$tempdir = "../../../../tmp/ppdb-qr-code/"; //Nama folder tempat menyimpan file qrcode
if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);
//isi qrcode jika di scan
$codeContents = $setting['lembaga_link_rdm'] . $halaman . '?' . 'id=' . enkripsi($t_ppdbregist['ppdbregist_number']);
//simpan file kedalam temp
//nilai konfigurasi Frame di bawah 4 tidak direkomendasikan
QRcode::png($codeContents, $tempdir . $t_ppdbregist['ppdbregist_number'] . '.png', QR_ECLEVEL_M, 4);

$e_tahunajaran = fetch($koneksi, 'e_tahunajaran', ['tahunajaran_id' => $t_ppdbregist['tahunajaran_id']]);
$tahun1 = date('Y');
$tahun2 = date('Y') + 1;

?>

<style>
    #hed1 {
        font-family: Arial, Helvetica, sans-serif;
        padding: 0px;
        background: #999;
    }
</style>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>

<HEAD>
    <title>FORMULIR <?= $t_ppdbregist['ppdbregist_name'] ?></title>
    <META NAME="Generator" CONTENT="EditPlus">
    <META NAME="Author" CONTENT="">
    <META NAME="Keywords" CONTENT="">
    <META NAME="Description" CONTENT="">
    <style type="text/css">
        body {
            background: #fff;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px
        }

        tr {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            border-collapse: collapse;
            padding: 0px;
            page-break-inside: avoid;
            page-break-after: auto;
        }

        tab.td {
            font-family: Verdana;
            font-size: 10px;
            border-collapse: collapse;
            padding-left: 5px;
        }

        input,
        textarea {
            margin: 1px;
            font-size: 11px;
            font-family: Verdana;
            color: #000000;
            background-color: #FFFFFF;

        }

        option,
        select {
            margin: 1px;
            font-size: 11px;
            font-family: Verdana;
            color: #000000;
            background-color: #FFFFFF;
        }

        a,
        a:link,
        a:visited,
        a:active {
            color: black;
            font-weight: bold;
            font-family: Verdana;
            font-size: 11px;
            text-decoration: none;
        }

        a:hover {
            color: red;
            font-weight: bold;
            font-family: Verdana;
            font-size: 11px;
            text-decoration: none;
        }

        A.headerlink {
            margin: 1px;
            font-size: 11px;
            font-family: Verdana;
            color: #FFFFFF;

        }

        .page-portrait {
            position: relative;
            width: 21cm;
            margin: 0.5cm auto;
            padding: 1cm;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            -webkit-box-sizing: initial;
            -moz-box-sizing: initial;
            box-sizing: initial;

        }

        .but {
            cursor: pointer;
            border: outset 1px #ccc;
            background: #999;
            color: #666;
            font-weight: bold;
            padding: 1px 2px;
            background: url(formbg.gif) repeat-x left top;
        }

        .disabled {
            background: #c0c0c0;
            padding: 1px 2px;
            color: #000000;
        }

        .textboxred {
            color: #000000;
            padding: 1px 2px;
            background-color: #FB4678;
        }

        .header {
            border: outset 2px #000000;
            color: #000000;
            font-weight: bold;
            padding: 1px 2px;
            background: url(formbg.gif) left top;
            border-collapse: collapse;
            font-size: 12px;
        }

        .header1 {
            font-size: 15px;
            font-weight: bold;
        }

        .header2 {
            font-family: Arial;
            font-size: 22px;
            font-weight: bold;
        }

        .header3 {
            font-family: Arial;
            font-size: 14px;
        }

        .headerpesan {
            border: outset 1px #ccc;
            background: #999;
            color: #FFFFFF;
            font-weight: bold;
            padding: 1px 2px;
            background: url(formbg2agreen.gif) repeat-x left top;
            border-collapse: collapse;
            font-size: 12px;
        }

        .headerlong {
            border: outset 2px #000000;
            font-weight: bold;
            padding: 1px 2px;
            background: url(formbg.gif) repeat-x left top;
            border-collapse: collapse;
            font-size: 12px;
        }

        .headerlink2 {
            cursor: pointer;
            border: outset 1px #ccc;
            background: #999;
            color: #fcf300;
            font-weight: bold;
            padding: 1px 2px;
            background: url(formbg2.gif) repeat-x left top;
            border-collapse: collapse;
            font-size: 12px;

        }

        .headerlink2active {
            cursor: pointer;
            border: outset 1px #ccc;
            background: #999;
            color: #fcf300;
            font-weight: bold;
            padding: 1px 2px;
            background: url(formbg2a.gif) repeat-x left top;
            border-collapse: collapse;
            font-size: 12px;

        }

        .tab {
            font-family: Verdana;
            font-size: 11px;
            background-color: #FFFFFF;
            color: #000000;
            border: groove 2px #000000;
            border-collapse: collapse;
        }

        .tab1 {
            font-family: Verdana;
            font-size: 12px;
            background-color: #FFFFFF;
            color: #000000;
            border: outset 2px #000000;
            border-collapse: collapse;
        }

        .tab01 {
            font-family: Verdana;
            font-size: 12px;
            background-color: #FFFFFF;
            color: #000000;
            border: outset 2px #000000;
            border-collapse: collapse;

        }

        .red {
            font-family: Verdana;
            font-size: 12px;
            color: #FF0000;
            background-color: #FFFFFF;
            border: outset 2px #000000;
            border-collapse: collapse;
        }

        .tab2 {
            font-family: Verdana;
            font-size: 11px;
            background-color: #FFFFFF;
            color: #000000;
            border: outset 2px #000000;
            border-collapse: collapse;
            border-right: none;
        }

        .tab3 {
            font-family: Verdana;
            font-size: 12px;
            color: #000000;
            background-color: #FFFFFF;
            border: outset 2px #000000;
            border-collapse: collapse;
            border-left: none;
        }


        .headerlongar {
            border: outset 2px #000000;
            font-weight: bold;
            padding: 1px 2px;
            background: url(formbg.gif) repeat-x left top;
            border-collapse: collapse;
            font-size: 14.0pt;
            line-height: 105%;
            font-family: Times New Roman;
            mso-ascii-font-family: Calibri;
            mso-ascii-theme-font: minor-latin;
            mso-hansi-font-family: Calibri;
            mso-hansi-theme-font: minor-latin;
            mso-bidi-font-family: "Times New Roman";
            mso-bidi-theme-font: minor-bidi;
        }


        .tabar {
            color: #000000;
            background-color: #FFFFFF;
            border: groove 2px #000000;
            border-collapse: collapse;
            font-size: 14.0pt;
            line-height: 105%;
            font-family: Times New Roman;
            mso-ascii-font-family: Calibri;
            mso-ascii-theme-font: minor-latin;
            mso-hansi-font-family: Calibri;
            mso-hansi-theme-font: minor-latin;
            mso-bidi-font-family: "Times New Roman";
            mso-bidi-theme-font: minor-bidi;
        }

        .tabar1 {
            font-family: Verdana;
            font-size: 12px;
            color: #000000;
            background-color: #FFFFFF;
            border: outset 2px #000000;
            border-collapse: collapse;
        }

        .redar {
            font-family: Verdana;
            font-size: 12px;
            color: #FF0000;
            background-color: #FFFFFF;
            border: outset 2px #000000;
            border-collapse: collapse;
        }

        .tabar2 {
            font-family: Verdana;
            font-size: 11px;
            color: #000000;
            background-color: #FFFFFF;
            border: outset 2px #000000;
            border-collapse: collapse;
            border-right: none;
        }

        .tabar3 {
            font-family: Verdana;
            font-size: 12px;
            color: #000000;
            background-color: #FFFFFF;
            border: outset 2px #000000;
            border-collapse: collapse;
            border-left: none;
        }

        .ttd {
            font-family: Verdana;
            font-size: 12px;
            color: #000000;
            background-color: #FFFFFF;
            border: none;
            border-collapse: collapse;
        }

        .h {
            background-color: #565656;
            border-collapse: collapse;
            color: #FFFFFF;
            font-weight: bold;
        }

        .back_table {
            background-image: url(../images/bktablelong.jpg);
            background-repeat: no-repeat;
        }

        .tab_kelas {
            background-color: #FFFFFF;
            border-bottom-style: none;
        }

        .miring {
            border-bottom-style: none;
            font-style: italic;
        }

        .brown {
            color: #663333;
        }

        .ukuran {
            width: 135px;
        }

        .ukuranemail {
            width: 150px;
        }

        .Ukuranketerangan {
            height: 40px;
            width: 200px;
        }

        .text_merah {
            background: #FFFFFF;
            padding: 1px 2px;
            color: #FF0000;
        }

        input,
        textarea,
        select {
            border: 1px solid #333333;
            padding: 1px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        div.page {
            page-break-before: always;
        }

        .style1 {
            font-size: 12px;
            font-weight: bold;
            color: #FFFFFF
        }

        .style6 {
            font-size: 12px;
            font-weight: bold;
        }

        .style13 {
            font-size: 18px;
        }

        .style14 {
            color: #FFFFFF
        }

        header {
            position: fixed;
            top: 25%;
            left: 0px;
            width: 100%;
            height: 100%;
            opacity: .1;

        }

        header img {
            width: 8cm;
            height: 8cm;
        }

        #watermark {
            display: block;
            position: fixed;
            top: -10%;
            left: 105px;
            transform: rotate(-45deg);
            transform-origin: 50% 50%;
            opacity: .15;
            font-family: Verdana;
            font-size: 20px;
            color: #76fd4a;
            width: 480px;
            text-align: center;
            white-space: nowrap;

        }

        @media print {
            body {
                background: #fff;
                font-family: 'Times New Roman', Times, serif;
                font-size: 12pt
            }

            .page {
                page-break-before: always;
            }

            .page-portrait {
                width: 21cm;
                max-height: 29.7cm;
                padding-top: 1cm;
                padding-bottom: 1cm;
                padding-right: 1.5cm;
                padding-left: 2cm;
                margin: 0cm;
                box-shadow: none;

            }

            .footer {
                bottom: 0.7cm;
                left: 0.7cm;
                right: 0.7cm
            }
        }
    </style>
</HEAD>

<BODY>
    <div class="page-portrait">
        <table width="100%" class="page_header1">
            <tbody>
                <tr>
                    <td style="width:75px;padding-bottom:4px;"><img src="../../../../../<?= $setting['lembaga_foto'] ?> " height="90px"></td>
                    <td>
                        <center>
                            <span class="header1">KEMENTERIAN AGAMA JAKARTA BARAT</span><br>
                            <span class="header2"><?= $setting['lembaga_nama'] ?></span><br>
                            <span style=" text-transform: capitalize;" class="header3"><i>NSM <?= $setting['lembaga_nsm'] ?> / NPSN <?= $setting['lembaga_npsn'] ?><br>
                                    <?= $setting['lembaga_alamat'] ?> Kec. <?= $setting['lembaga_kec'] ?>, Kota <?= $setting['lembaga_kota'] ?> - <?= $setting['lembaga_provinsi'] ?> </i></span>
                        </center>
                    </td>
                    <td style="width:75px;padding-bottom:4px;"></td>
                </tr>
            </tbody>
        </table>

        <table background="#000000" border="2" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                </td>
            </tr>
        </table>

        <table width="60%" align="center" border="0">
            <tr>
                <td>
                    <br>
                    <div align="center" class="style13">
                        <b>FORMULIR PENDAFTARAN SISWA BARU TAHUN PELAJARAN <?= $e_tahunajaran['tahunajaran_nama'] ?></b>
                    </div>
                    <br>
                </td>
            </tr>
        </table>
        <table width="80%" border="0">
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    1.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    No. Registrasi
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_number'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    2.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    ppdbregist_NISN
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_nisn'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    3.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    No. KK
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_nokk'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    4.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    NIK
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_nik'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    5.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Nama Peserta Didik
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_name'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    6.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Jenis Kelamin
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?php if ($t_ppdbregist['ppdbregist_gender'] == 'L') { ?> Laki Laki <?php } else { ?> Perempuan <?php } ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    7.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Tmp / Tanggal Lahir
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt; text-transform: capitalize;'>
                    <span><?= ucfirst(strtolower($t_ppdbregist['ppdbregist_tempat'])) ?></span>, <?php echo tgl_indo("$t_ppdbregist[ppdbregist_tgllahir]"); ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    8.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Agama
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    ISLAM
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    9.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Nomor Handphone
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_nohp'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    10.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Anak Ke
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_anakke'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    11.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Jumlah Saudara
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_saudara'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    12.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Hobi
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_hobi']; ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    13.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Status Tempat Tinggal
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_stt'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    14.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Provinsi
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_prov'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    15.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Kota
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_kota'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    16.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Kecamatan
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_kec'] ?>
                </td>

            </tr>

            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    17.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Kelurahan
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_kel'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    18.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Alamat
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_alamat'] ?> Rt/Rw <?= $t_ppdbregist['ppdbregist_rt'] ?> / <?= $t_ppdbregist['ppdbregist_rw'] ?> Kodepos : <?= $t_ppdbregist['ppdbregist_kodepos'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    19.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Jarak Tempuh Kesekolah
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_jarak'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    20.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Transportasi
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbregist_transportasi'] ?>
                </td>

            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    21.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Identitas Ayah
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>


                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    a. Status Ayah
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?php if ($t_ppdbregist['ppdbayah_status'] == '0') { ?> Masih Hidup <?php } else { ?> Sudah Meninggal / Tidak DIketahui <?php } ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    b. Nama
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbayah_name'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    c. NIK
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbayah_nik'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    d. Tempat Lahir
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbayah_tempat'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    e. Tanggal Lahir
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbayah_tgllahir'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    f. Pendidikan
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbayah_pendidikan'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    g. Pekerjaan
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbayah_pekerjaan'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    h. Penghasilan
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbayah_penghasilan'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    i. No Hp
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbayah_nohp'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    22.
                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    Identitas Ibu
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>


                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    a. Status Ibu
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?php if ($t_ppdbregist['ppdbibu_status'] == '0') { ?> Masih Hidup <?php } else { ?> Sudah Meninggal / Tidak DIketahui <?php } ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    b. Nama
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbibu_name'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    c. NIK
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbibu_nik'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    d. Tempat Lahir
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbibu_tempat'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    e. Tanggal Lahir
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbibu_tgllahir'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    f. Pendidikan
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbibu_pendidikan'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    g. Pekerjaan
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbibu_pekerjaan'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    h. Penghasilan
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbibu_penghasilan'] ?>
                </td>
            </tr>
            <tr>
                <td width="1%" valign="top" style='font-size:11.0pt;'>

                </td>
                <td width="40%" style='font-size:11.0pt;' valign="top">
                    i. No Hp
                </td>
                </td>
                <td width="1%" valign="top" style='font-size:11.0pt;'>
                    :
                </td>
                <td width="60%" style='font-size:11.0pt;'>
                    <?= $t_ppdbregist['ppdbibu_nohp'] ?>
                </td>
            </tr>
        </table>
        <table>

            <tr>
                <td colspan="5" width="30%" valign="left" style="font-size:11.0pt;">

                    <b><i><u>Berkas Persyaratan</u></i></b>
                    <li style="font-size: 9pt;">FC Akte Kelahiran 2 Lembar</li>
                    <li style="font-size: 9pt;">FC Kartu Keluarga 2 Lembar</li>
                    <li style="font-size: 9pt;">FC Ijazah dan SKL 2 Lembar</li>
                    <li style="font-size: 8pt;">FC KTP wali dan Buku Rek KJP (Jika Penerima) 2 Lembar</li>
                </td>
              
                <td width="30%" valign="top" style='font-size:11.0pt;padding-left: 40px;'>
                    <span style="white-space: nowrap;">
                        <?= $setting['lembaga_kec'] ?>, </span> <br>
                    <span style="white-space: nowrap;">
                        Kepala Madrasah</span> <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <u style="white-space: nowrap;font-weight: bold;"></u><br>

                    <span style="white-space: nowrap;">
                        <?= $setting['lembaga_kamad'] ?></span>
                </td>
                <td colspan="3" width="10%" valign="bottom">
                    <div style=" display:inline-block;float: right;width: 27mm;">
                        <img alt="QR image" class="img" src="../../../../tmp/ppdb-qr-code/<?= $t_ppdbregist['ppdbregist_number'] ?>.png" width="100px" style="width: 30mm; background-color: white; color: black;">
                    </div>
                </td>
            </tr>

        </table>



    </div>
</BODY>


</HTML>
<?php
session_start();
require "../../../../config/database.php";
require "../../../../config/function.php";
require "../../../../config/functions.crud.php";
include "../../../../app-assets/phpqrcode/qrlib.php";

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="Pangkalan Data Ujian Madrasah">
  <meta name="author" content="Kementerian Agama">
  <meta name="theme-color" content="#317EFB" />
  <meta name="keyword" content="akmi, pangkalan data, mts,ma,mi,madrasah">
  <title>KARTU UJIAN MADRASAH</title>
  <link rel="apple-touch-icon" sizes="57x57" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="https://pdum.kemenag.go.id/assets/images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="https://pdum.kemenag.go.id/assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="https://pdum.kemenag.go.id/assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="https://pdum.kemenag.go.id/assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://pdum.kemenag.go.id/assets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="https://pdum.kemenag.go.id/assets/images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="https://pdum.kemenag.go.id/assets/images/favicon/ms-icon-144x144.png">


  <link rel="icon" type="image/png" href="https://pdum.kemenag.go.id/assets/images/favicon/ms-icon-144x144.png">
  <link rel="stylesheet" href="../../../../app-assets/cetak/cetak.min.css">
  <style>
    .kartu td {
      font-size: 11px;

    }

    .kartu tr td:first-child {
      padding-left: 10px;
    }
  </style>

</head>
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

    <body>
      <div id="chart"></div>

      <div class="page">
        <div class="watermark"></div>

        <table style=" margin-bottom:10px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th colspan=3 align=center>DATA INDUK DIRI SISWA</th>
          </tr>
          <tr>
            <td width="85">Nama </td>
            <td width="*"><strong style="font-size: 12pt;"><?= ucwords($e_siswa['siswa_nama']); ?></strong></td>
            <td rowspan="7" width="150" style="background-color: white;" align='center'>
              <img alt="" src="../../Models/zip-photo-siswa/<?= $e_siswa['siswa_nis'] ?>.jpg" height="210" width="150">
            </td>
            
        
          </tr>
          <tr>
            <td>NIS Lokal</td>
            <td><strong style="font-size: 11pt;"><?= $e_siswa['siswa_nis']; ?></strong></td>
          </tr>
          <tr>
            <td>NISN</td>
            <td><strong style="font-size: 11pt;"><?= $e_siswa['siswa_nisn']; ?></strong></td>
          </tr>
          <tr>
            <td>Tempat, Tgl Lahir</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['siswa_tempat'])); ?>, <?= tgl_indo($e_siswa['siswa_tgllahir']); ?></td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td><?php if ($e_siswa['siswa_gender'] == 'L') { ?> Laki Laki <?php } else { ?> Perempuan <?php } ?></td>
          </tr>
          <tr>
            <td>No. Telepon</td>
            <td><?= $e_siswa['siswa_telpon']; ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><?= $e_siswa['siswa_act_email']; ?></td>
          </tr>
        </table>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="49%">
          <tr>
            <th>1</th>
            <th colspan="2" align="left">DATA KEPENDUDUKAN SISWA</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nama SISWA di KK</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['siswa_kk_nama'])); ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">No. KK</td>
            <td width="*"><?= $e_siswa['siswa_kk_nomor']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Kepala Keluarga</td>
            <td width="*"><?= $e_siswa['siswa_kk_kepala']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Kewarganegaraan</td>
            <td width="*"><?= $e_siswa['siswa_kk_wn']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">NIK/Kitas</td>
            <td width="*"><?= $e_siswa['siswa_kk_nik']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Tempat, Tgl Lahir</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['siswa_kk_tempat'])); ?>, <?= $e_siswa['siswa_kk_tgllahir']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Anak Ke</td>
            <td width="*"><?= $e_siswa['siswa_kk_anakke']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Jml Saudara</td>
            <td width="*"><?= $e_siswa['siswa_kk_jmlsaudara']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Gol. Darah</td>
            <td width="*"><?= $e_siswa['siswa_kk_darah']; ?></td>
          </tr>
        </table>
        <table style=" margin-bottom:10px;" class="it-grid it-cetak" width="49%">
          <tr>
            <th>2</th>
            <th colspan="2" align="left">DATA AYAH</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nama Ayah</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['ayah_kk_nama'])); ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Status Ayah</td>
            <td width="*"><?= $e_siswa['ayah_kk_status']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Kewarganegaraan</td>
            <td width="*"><?= $e_siswa['ayah_kk_wn']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">NIK/Kitas</td>
            <td width="*"><?= $e_siswa['ayah_kk_nik']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Tempat, Tgl Lahir</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['ayah_kk_tempat'])); ?>, <?= $e_siswa['ayah_kk_tgllahir']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Pendidikan</td>
            <td width="*"><?= $e_siswa['ayah_kk_nik']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Pekerjaan</td>
            <td width="*"><?= $e_siswa['ayah_kk_pekerjaan']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Penghasilan</td>
            <td width="*"><?= $e_siswa['ayah_kk_penghasilan']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">No. Telepon</td>
            <td width="*"><?= $e_siswa['ayah_kk_hp']; ?></td>
          </tr>
        </table>

        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="49%">
          <tr>
            <th>3</th>
            <th colspan="2" align="left">DATA IBU</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nama Ibu</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['ibu_kk_nama'])); ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Status Ibu</td>
            <td width="*"><?= $e_siswa['ibu_kk_status']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Kewarganegaraan</td>
            <td width="*"><?= $e_siswa['ibu_kk_wn']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">NIK/Kitas</td>
            <td width="*"><?= $e_siswa['ibu_kk_nik']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Tempat, Tgl Lahir</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['ibu_kk_tempat'])); ?>, <?= $e_siswa['ibu_kk_tgllahir']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Pendidikan</td>
            <td width="*"><?= $e_siswa['ibu_kk_nik']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Pekerjaan</td>
            <td width="*"><?= $e_siswa['ibu_kk_pekerjaan']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Penghasilan</td>
            <td width="*"><?= $e_siswa['ibu_kk_penghasilan']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">No. Telepon</td>
            <td width="*"><?= $e_siswa['ibu_kk_hp']; ?></td>
          </tr>
        </table>
        <table style=" margin-bottom:10px;" class="it-grid it-cetak" width="49%">
          <tr>
            <th>4</th>
            <th colspan="2" align="left">DATA WALI</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Status Wali</td>
            <td width="*"><?= $e_siswa['siswa_wali_hubungan']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nama Wali</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['wali_kk_nama'])); ?></td>
          </tr>

          <tr>
            <td width="15"></td>
            <td width="110">Kewarganegaraan</td>
            <td width="*"><?= $e_siswa['wali_kk_wn']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">NIK/Kitas</td>
            <td width="*"><?= $e_siswa['wali_kk_nik']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Tempat, Tgl Lahir</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['wali_kk_tempat'])); ?>, <?= $e_siswa['wali_kk_tgllahir']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Pendidikan</td>
            <td width="*"><?= $e_siswa['wali_kk_nik']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Pekerjaan</td>
            <td width="*"><?= $e_siswa['wali_kk_pekerjaan']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Penghasilan</td>
            <td width="*"><?= $e_siswa['wali_kk_penghasilan']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">No. Telepon</td>
            <td width="*"><?= $e_siswa['wali_kk_hp']; ?></td>
          </tr>
        </table>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th>5</th>
            <th colspan="5" align="left">ALAMAT SISWA</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Provinsi</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['siswa_kk_provinsi'])); ?></td>
            <td width="15"></td>
            <td width="110">Kota/Kabupaten</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['siswa_kk_kota'])); ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Kecamatan</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['siswa_kk_kecamatan'])); ?></td>
            <td width="15"></td>
            <td width="110">Kelurahan</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['siswa_kk_kelurahan'])); ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">RT/RW</td>
            <td width="*"><?= $e_siswa['siswa_kk_rt']; ?> / <?= $e_siswa['siswa_kk_rw']; ?></td>
            <td width="15"></td>
            <td width="110">Kode Pos</td>
            <td width="*"><?= $e_siswa['siswa_kk_kodepos']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td valign="top" width="110">Penghasilan</td>
            <td valign="top" width="*" height="40" colspan="4">
              <?= ucwords(strtolower($e_siswa['siswa_kk_alamat'])); ?>
            </td>
          </tr>
        </table>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th>6</th>
            <th colspan="5" align="left">ALAMAT WALI</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Provinsi</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['wali_dom_provinsi'])); ?></td>
            <td width="15"></td>
            <td width="110">Kota/Kabupaten</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['wali_dom_kota'])); ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Kecamatan</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['wali_dom_kecamatan'])); ?></td>
            <td width="15"></td>
            <td width="110">Kelurahan</td>
            <td width="*"><?= ucwords(strtolower($e_siswa['wali_dom_kelurahan'])); ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">RT/RW</td>
            <td width="*"><?= $e_siswa['wali_dom_rt']; ?> / <?= $e_siswa['wali_dom_rw']; ?></td>
            <td width="15"></td>
            <td width="110">Kode Pos</td>
            <td width="*"><?= $e_siswa['wali_dom_kodepos']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td valign="top" width="110">Alamat</td>
            <td valign="top" width="*" height="40" colspan="4">
              <?= ucwords(strtolower($e_siswa['wali_dom_alamat'])); ?>
            </td>
          </tr>
        </table>
      
        <br>
        <div class="footer">
          <table width="100%" height="30">
            <tbody>
              <tr>
                <td width="25px" style="border:1px solid black"></td>
                <td width="5px">&nbsp;</td>
                <td style="border:1px solid black;font-weight:bold;font-size:14px;text-align:center;">BUKU INDUK SISWA <?= ucwords(strtoupper($t_lembaga['lembaga_nama'])); ?></td>
                <td width="5px">&nbsp;</td>
                <td width="25px" style="border:1px solid black"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="page">
        <div class="watermark"></div>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th>7</th>
            <th colspan="5" align="left">AKTIFITAS SISWA</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Hobi</td>
            <td width="*"><?= $e_siswa['siswa_act_hobi']; ?></td>
            <td width="15"></td>
            <td width="110">Cita-Cita</td>
            <td width="*"><?= $e_siswa['siswa_act_cita']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Kebutuhan Khusus</td>
            <td width="*"><?= $e_siswa['siswa_act_abk']; ?></td>
            <td width="15"></td>
            <td width="110">Kebutuhan Disibilitas</td>
            <td width="*"><?= $e_siswa['siswa_act_disability']; ?></td>
          </tr>
        </table>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th colspan="4" align="left">8. DATA VAKSIN</th>
          </tr>
          <tr>
            <td width="110">HEPATITIS-B</td>
            <td width="15" align="center"><?= $e_siswa['health_hepatitis_b']; ?></td>
            <td width="110">BCG</td>
            <td width="15" align="center"><?= $e_siswa['health_campak']; ?></td>
          </tr>
          <tr>
            <td width="110">DPT</td>
            <td width="15" align="center"><?= $e_siswa['health_bcg']; ?></td>
            <td width="110">POLIO</td>
            <td width="15" align="center"><?= $e_siswa['health_dpt']; ?></td>
          </tr>
          <tr>
            <td width="110">CAMPAK</td>
            <td width="15" align="center"><?= $e_siswa['health_polio']; ?></td>
            <td width="110">COVID-1</td>
            <td width="15" align="center"><?= $e_siswa['health_covid_one']; ?></td>
          </tr>
          <tr>
            <td width="110">COVID-2</td>
            <td width="15" align="center"><?= $e_siswa['health_covid_two']; ?></td>
            <td width="110">Booster-1</td>
            <td width="15" align="center"><?= $e_siswa['health_booster_one']; ?></td>
          </tr>
          <tr>
            <td width="110">Booster-2</td>
            <td width="15" align="center"><?= $e_siswa['health_booster_two']; ?></td>
            <td width="110">Lainya</td>
            <td width="15" align="center">-</td>
          </tr>

        </table>

        <!-- <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th colspan="2" style="background-color: white;" align="center">DATA BANTUAN </th>
          </tr>
        </table> -->
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="49%">
          <tr>
            <th>9</th>
            <th colspan="2" align="left">KARTU JAKARTA PINTAR (KJP) </th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Status Penerima KJP</td>
            <td width="*"><?= $e_siswa['siswa_kjp_status']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nama Rekening</td>
            <td width="*"><?= $e_siswa['siswa_kjp_namarek']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nomor Rekening</td>
            <td width="*"><?= $e_siswa['siswa_kjp_norek']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Bank Cabang</td>
            <td width="*"><?= $e_siswa['siswa_kjp_bankcab']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nomor Kartu ATM</td>
            <td width="*"><?= $e_siswa['siswa_kjp_nomoratm']; ?></td>
          </tr>

        </table>
        <table style=" margin-bottom:10px;" class="it-grid it-cetak" width="49%">
          <tr>
            <th>10</th>
            <th colspan="2" align="left">KARTU INDONESIA PINTAR (KIP) </th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Status Penerima KIP</td>
            <td width="*"><?= $e_siswa['siswa_kip_status']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nama Rekening</td>
            <td width="*"><?= $e_siswa['siswa_kip_namarek']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nomor Rekening</td>
            <td width="*"><?= $e_siswa['siswa_kip_norek']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Bank Cabang</td>
            <td width="*"><?= $e_siswa['siswa_kip_bankcab']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nomor Kartu KIP</td>
            <td width="*"><?= $e_siswa['siswa_kip_nomoratm']; ?></td>
          </tr>

        </table>
        <!-- <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th colspan="2" style="background-color: white;" align="center">KETERANGAN PENDIDIKAN </th>
          </tr>
        </table> -->
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th>11</th>
            <th colspan="5" align="left">JENJANG SEBELUMNYA</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Status</td>
            <td width="*"><?= $e_siswa['siswa_ijz_statusasal']; ?></td>
            <td width="15"></td>
            <td width="110">Tempat Lahir</td>
            <td width="*"><?= $e_siswa['siswa_ijz_tempat']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">NPSN</td>
            <td width="*"><?= $e_siswa['siswa_ijz_npsnasal']; ?></td>
            <td width="15"></td>
            <td width="110">Tgl. Lahir</td>
            <td width="*"><?= $e_siswa['siswa_ijz_tgllahir']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nama Sekolah</td>
            <td width="*"><?= $e_siswa['siswa_ijz_sekolahasal']; ?></td>
            <td width="15"></td>
            <td width="110">Nama Orgtua di Ijazah</td>
            <td width="*"><?= $e_siswa['siswa_ijz_namaortu']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Kabupaten/Kota</td>
            <td width="*"><?= $e_siswa['siswa_ijz_kotaasal']; ?></td>
            <td width="15"></td>
            <td width="110">Nomor Ujian</td>
            <td width="*"><?= $e_siswa['siswa_ijz_noujian']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Nama SISWA Di Ijazah</td>
            <td width="*"><?= $e_siswa['siswa_ijz_nama']; ?></td>
            <td width="15"></td>
            <td width="110">No. Seri Ijazah</td>
            <td width="*"><?= $e_siswa['siswa_ijz_noseri']; ?></td>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">NISN</td>
            <td width="*"><?= $e_siswa['siswa_ijz_nisn']; ?></td>
            <td width="15"></td>
            <td width="110">Tahun Lulus</td>
            <td width="*"><?= $e_siswa['siswa_ijz_thnlulus']; ?></td>
          </tr>
        </table>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th>12</th>
            <th colspan="5" align="left">KETERANGAN DITERIMA</th>
          </tr>
          <tr>
            <td width="15"></td>
            <td width="110">Diterima dikelas</td>
            <td width="*"><?= $e_siswa['siswa_kelasterima']; ?></td>
            <td width="15"></td>
            <td width="110">Tanggal Diterima</td>
            <td width="*"><?= $e_siswa['tanggal_terima']; ?></td>
          </tr>
        </table>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr>
            <th colspan="2" style="background-color: white;" align="center">KETERANGAN PERKEMBANGAN SISWA </th>
          </tr>
        </table>

        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr valign="top">
            <th>13</th>
            <th colspan="5" align="left">KETERANGAN MUTASI</th>
          </tr>
          <tr valign="top">
            <td width="15"></td>
            <td width="110">Tahun Mutasi</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
            <td width="15"></td>
            <td width="110">Kelas Mutasi</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
          </tr>
          <tr valign="top">
            <td width="15"></td>
            <td width="110">Alasan Mutasi</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
            <td width="15"></td>
            <td width="110">Tanggal Mutasi</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
          </tr>
          <tr valign="top">
            <td width="15"></td>
            <td width="110">Mutasi Ke</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
            <td width="15"></td>
            <td width="110">Nama Sekolah Lanjutan</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
          </tr>
          <tr valign="top">
            <td width="15"></td>
            <td width="110">Status Lanjutan</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
            <td width="15"></td>
            <td width="110">NPSN Sekolah Lanjutan</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
          </tr>
        </table>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" class="it-grid it-cetak" width="100%">
          <tr valign="top">
            <th>14</th>
            <th colspan="5" align="left">KELULUSAN</th>
          </tr>
          <tr valign="top">
            <td width="15"></td>
            <td width="110">Tahun Lulus</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
            <td width="15"></td>
            <td width="110">No. Seri Ijazah</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
          </tr>
          <tr valign="top">
            <td width="15"></td>
            <td width="110">Melanjutkan ke</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
            <td width="15"></td>
            <td width="110">Status Lanjutan</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
          </tr>
          <tr valign="top">
            <td width="15"></td>
            <td width="110">Nama Sekolah Lanjutan</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
            <td width="15"></td>
            <td width="110">NPSN Sekolah Lanjutan</td>
            <td width="*">SYAKIRA ANAYA HUSNA</td>
          </tr>
        </table>
        <table style="float: left; margin-bottom:10px;margin-right:15px;" width="100%">

          <tr>
            <td width="80%" style="text-align: center;" width="150"></td>
            <td style="border:1px solid black; text-align: center;" width="150"><img alt="QR image" src="../../../../tmp/students-qr-code/<?= $e_siswa['siswa_nis'] ?>.png" width="100px"><br>NIS.Lokal 213212</td>
          </tr>
          </tbody>
        </table>
        <br>
        <div class="footer">
          <table width="100%" height="30">
            <tbody>
              <tr>
                <td width="25px" style="border:1px solid black"></td>
                <td width="5px">&nbsp;</td>
                <td style="border:1px solid black;font-weight:bold;font-size:14px;text-align:center;">BUKU INDUK SISWA MTS SAFINATUL HUSNA</td>
                <td width="5px">&nbsp;</td>
                <td width="25px" style="border:1px solid black"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      </div>
    </body>
<?php }
} ?>

</html>
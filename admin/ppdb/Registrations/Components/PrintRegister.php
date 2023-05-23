<?php
require("../../../../config/database.php");
require("../../../../config/config.function.php");
require("../../../../config/functions.crud.php");
// echo "<link rel='stylesheet' href='../assets/css/cetak.min.css'>";

$thn_id = $_GET['tahunajaran_id'];
$tahunajaran = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_tahunajaran where tahunajaran_id = '$thn_id'"));
$querysetting = mysqli_query($koneksi, "SELECT * 
FROM e_lembaga el
JOIN t_lembaga ml ON el.lembaga_nsm=ml.lembaga_nsm");
$setting = mysqli_fetch_array($querysetting);
$ckck = mysqli_query($koneksi, "SELECT *
FROM t_ppdbregist a
JOIN t_ppdbperiode b ON b.tahunajaran_id=a.tahunajaran_id
JOIN t_ppdbjurusan c ON c.ppdbjurusan_id=a.ppdbjurusan_id
WHERE a.tahunajaran_id = '$thn_id'
");
$jumlahData = mysqli_num_rows($ckck);
$sql_jum_lk = mysqli_query($koneksi, "SELECT *
FROM t_ppdbregist a
JOIN t_ppdbperiode b ON b.tahunajaran_id=a.tahunajaran_id
JOIN t_ppdbjurusan c ON c.ppdbjurusan_id=a.ppdbjurusan_id
WHERE a.tahunajaran_id = '$thn_id'
AND a.ppdbregist_gender ='L'
");
$sum_lk = mysqli_num_rows($sql_jum_lk);
$sql_jum_pr = mysqli_query($koneksi, "SELECT *
FROM t_ppdbregist a
JOIN t_ppdbperiode b ON b.tahunajaran_id=a.tahunajaran_id
JOIN t_ppdbjurusan c ON c.ppdbjurusan_id=a.ppdbjurusan_id
WHERE a.tahunajaran_id = '$thn_id'
AND a.ppdbregist_gender ='P'
");
$sum_pr = mysqli_num_rows($sql_jum_pr);
if ($jumlahData == 0) {
    echo "<span style='font-size:30; color:red'>Belum ada pendaftar di tahun ini";
    echo mysqli_error($koneksi);
    die;
}
$jumlahn = '15';
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
        <title>PPDB - <?= $thn_id; ?></title>
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../../../../app-assets/images/sidoel/kemenag.png">
        <link rel="icon" type="image/png" href="../../../../app-assets/images/sidoel/kemenag.png">
        <link rel="stylesheet" href="../../../../assets/css/cetak/cetak_dnt_kemenag.min.css">
        <style>
            .kartu td {
                font-size: 11px;

            }

            .kartu tr td:first-child {
                padding-left: 10px;
            }

            .page .watermark {
                content: "";
                background: url("../../../../app-assets/images/sidoel/kemenag.png");
                opacity: 0.1;
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
                width: 450px;
                height: 450px;
                position: absolute;
                top: 40%;
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
                background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='240px' width='400px'><text transform='translate(20, 200) rotate(-20)' stroke='rgb(194,179,179,0.82)' fill='rgb(255,255,255,0)' font-size='40'>DATA SEMENTARA</text></svg>");
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

    <body>
        <div id="chart"></div>
        <?php if ($i == $n) : ?>
            <div class="page">
                <div class="watermark"></div>
                <center style="z-index: index 10;">
                    <table width="100%" class="page_header1">
                        <tbody>
                            <tr>
                                <td width='100'><img src='../../../../app-assets/images/sidoel/kemenag.png' width='80'></td>
                                <td style="text-align:center">
                                    <strong class="f12">
                                        DAFTAR PESERTA DIDIK BARU <br>
                                        ( PPDB ) <?= $setting['L_ujian_nama'] ?><br>
                                        <?= $setting['lembaga_nama'] ?><br> TAHUN PENDAFTARAN <?= $tahunajaran['tahunajaran_nama'] ?>
                                    </strong>
                                    <!-- logo  -->
                                <td width='100'><img src="../../../../../<?= $setting['lembaga_foto'] ?>" height='75'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table width="100%" class="detail">
                        <tbody>
                            <tr>
                                <td>NAMA MADRASAH</td>
                                <td>:</td>
                                <td><span style="width:300px;"><strong style="font-size: 12pt;"><?= $setting['lembaga_nama'] ?></strong></span></td>
                                <td>Kecamatan</td>
                                <td>:</td>
                                <td><span style="width:100px;"><?= $setting['lembaga_kec'] ?></span></td>
                            </tr>
                            <tr>
                                <td>NSM</td>
                                <td>:</td>
                                <td><span style="width:300px;"><?= $setting['lembaga_nsm'] ?></span></td>
                                <td>NPSN</td>
                                <td>:</td>
                                <td><span style="width:100px;"><?= $setting['lembaga_npsn'] ?></span></td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="it-grid it-cetak" width="100%">
                        <tbody>
                            <tr style="height:30px; text-align:center;">
                                <th width="40" align="center">No.</th>
                                <th width="110" align="center">No. Registrasi</th>
                                <th width="80" align="center">NISN</th>
                                <th width="250" align="center">Nama Pendaftar </th>
                                <th width="30" align="center">JK</th>
                                <th width="180" align="center">Tempat Lahir </th>
                                <th width="130" align="center">Tanggal Lahir </th>
                                <th width="250" align="center">Nama Ayah </th>
                                <th width="250" align="center">Nama Ibu </th>
                                <th width="90" align="center">No. HP</th>
                                <th width="70" align="center">Status </th>
                            </tr>
                            <?php
                            $ckck = mysqli_query($koneksi, "SELECT *
                            FROM t_ppdbregist a
                            JOIN t_ppdbperiode b ON b.tahunajaran_id=a.tahunajaran_id
                            JOIN t_ppdbjurusan c ON c.ppdbjurusan_id=a.ppdbjurusan_id
                            WHERE a.tahunajaran_id = '$thn_id'
                            limit $batas,$jumlahn");
                            ?>
                            <?php while ($t_ppdbregist = mysqli_fetch_array($ckck)) :
                                // $cek_u_urutpeserta = rowcount($koneksi, 'u_urutpeserta', ['siswa_id' => $t_ppdbregist['siswa_id']]);
                                // $u_siswa = fetch($koneksi, 'u_urutpeserta', ['siswa_id' => $t_ppdbregist['siswa_id']]);
                            ?>
                                <tr>
                                    <td align="center"><?= $nomer ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_number'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_nisn'] ?></td>
                                    <td><?= $t_ppdbregist['ppdbregist_name'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_gender'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_tempat'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_tgllahir'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbayah_name'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbibu_name'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_nohp'] ?></td>
                                    <td align="center">
                                        <?php if ($t_ppdbregist['ppdbregist_actived'] == 1) { ?>
                                            Diterima
                                        <?php } else { ?>
                                            Ditolak
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                $nomer++;
                                $jlhhdr = ($nomer - 1);
                                ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <br>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
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
                                <td align="center" width="200">

                                </td>
                                <td align="center" width="175">
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
                        <table width="100%" height="30">
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
            <center style="z-index: index 10;">
                <table width="100%" class="page_header1">
                    <tbody>
                        <tr>
                            <td width='100'><img src='../../../../app-assets/images/sidoel/kemenag.png' width='80'></td>
                            <td style="text-align:center">
                                <strong class="f12">
                                    DAFTAR PESERTA DIDIK BARU <br>
                                    ( PPDB ) <?= $setting['L_ujian_nama'] ?><br>
                                    <?= $setting['lembaga_nama'] ?><br> TAHUN PENDAFTARAN <?= $tahunajaran['tahunajaran_nama'] ?>
                                </strong>
                                <!-- logo  -->
                            <td width='100'><img src="../../../../../<?= $setting['lembaga_foto'] ?>" height='75'></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table width="100%" class="detail">
                    <tbody>
                        <tr>
                            <td>NAMA MADRASAH</td>
                            <td>:</td>
                            <td><span style="width:300px;"><strong style="font-size: 12pt;"><?= $setting['lembaga_nama'] ?></strong></span></td>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td><span style="width:100px;"><?= $setting['lembaga_kec'] ?></span></td>
                        </tr>
                        <tr>
                            <td>NSM</td>
                            <td>:</td>
                            <td><span style="width:300px;"><?= $setting['lembaga_nsm'] ?></span></td>
                            <td>NPSN</td>
                            <td>:</td>
                            <td><span style="width:100px;"><?= $setting['lembaga_npsn'] ?></span></td>
                        </tr>

                    </tbody>
                </table>
                <table class="it-grid it-cetak" width="100%">
                    <tbody>
                    <tr style="height:30px; text-align:center;">
                                <th width="40" align="center">No.</th>
                                <th width="110" align="center">No. Registrasi</th>
                                <th width="80" align="center">NISN</th>
                                <th width="250" align="center">Nama Pendaftar </th>
                                <th width="30" align="center">JK</th>
                                <th width="180" align="center">Tempat Lahir </th>
                                <th width="130" align="center">Tanggal Lahir </th>
                                <th width="250" align="center">Nama Ayah </th>
                                <th width="250" align="center">Nama Ibu </th>
                                <th width="90" align="center">No. HP</th>
                                <th width="70" align="center">Status </th>
                            </tr>
                            <?php
                            $ckck = mysqli_query($koneksi, "SELECT *
                            FROM t_ppdbregist a
                            JOIN t_ppdbperiode b ON b.tahunajaran_id=a.tahunajaran_id
                            JOIN t_ppdbjurusan c ON c.ppdbjurusan_id=a.ppdbjurusan_id
                            WHERE a.tahunajaran_id = '$thn_id'
                            limit $batas,$jumlahn");
                            ?>
                            <?php while ($t_ppdbregist = mysqli_fetch_array($ckck)) :
                                // $cek_u_urutpeserta = rowcount($koneksi, 'u_urutpeserta', ['siswa_id' => $t_ppdbregist['siswa_id']]);
                                // $u_siswa = fetch($koneksi, 'u_urutpeserta', ['siswa_id' => $t_ppdbregist['siswa_id']]);
                            ?>
                                <tr>
                                    <td align="center"><?= $nomer ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_number'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_nisn'] ?></td>
                                    <td><?= $t_ppdbregist['ppdbregist_name'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_gender'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_tempat'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_tgllahir'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbayah_name'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbibu_name'] ?></td>
                                    <td align="center"><?= $t_ppdbregist['ppdbregist_nohp'] ?></td>
                                    <td align="center">
                                        <?php if ($t_ppdbregist['ppdbregist_actived'] == 1) { ?>
                                            Diterima
                                        <?php } else { ?>
                                            Ditolak
                                        <?php } ?>
                                    </td>
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
                    <table width="100%" height="30">
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
<?php
require("../../../config/database.php");
require("../../../config/config.function.php");
require("../../../config/functions.crud.php");
include "../../../assets/phpqrcode/qrlib.php";

$kelas_id = @$_GET['kelas_id'];
if (date('m') >= 7 and date('m') <= 12) {
    $ajaran = date('Y') . "/" . (date('Y') + 1);
} elseif (date('m') >= 1 and date('m') <= 6) {
    $ajaran = (date('Y') - 1) . "/" . date('Y');
}
$u_jenis = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM u_jenis Where jenis_u_status = 'aktif'"));
$kelas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM e_kelas kl JOIN e_tingkat tk ON kl.tingkat_id=tk.tingkat_id WHERE kl.kelas_id='$kelas_id'"));
$setting = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_lembaga el JOIN m_lembaga ml ON el.lembaga_nsm=ml.lembaga_nsm"));
function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<link rel="stylesheet" href="../../../assets/css/cetak_kemenag.min.css">

<head>
    <title>KARTU UJIAN KLS <?= $kelas['tingkat_nama'] ?>-<?= $kelas['kelas_nama'] ?></title>
    <style>
        .kartu td {
            font-size: 11px;

        }

        .kartu tr td:first-child {
            padding-left: 10px;
        }
    </style>
</head>

<div id="chart"></div>
<div class="page">
    <div class="watermark"></div>
    <center style="z-index: index 10;">
        <table align="center">
            <tr>
                <?php $query = mysqli_query($koneksi, "SELECT *
                FROM m_detail_siswa ds
                JOIN e_siswa es ON ds.siswa_id=es.siswa_id 
                JOIN e_kelas kl ON es.kelas_id=kl.kelas_id
                JOIN e_tingkat tk ON tk.tingkat_id=kl.tingkat_id
                JOIN e_tahunajaran thn ON kl.tahunajaran_id=thn.tahunajaran_id 
                WHERE kl.kelas_id='$kelas_id' AND es.siswa_alasan_mutasi IS NULL 
                ORDER BY siswa_nama ASC");
                $no = 0;
                ?>
                <?php while ($m_siswa = mysqli_fetch_array($query)) :
                    $no++;
                    $cek_u_urutpeserta = rowcount($koneksi, 'u_urutpeserta', ['siswa_id' => $m_siswa['siswa_id']]);
                    $u_siswa = fetch($koneksi, 'u_urutpeserta', ['siswa_id' => $m_siswa['siswa_id']]);
                    $halaman = '/app/qrcodekartupelajar.php';
                    $tempdir = "../../../tmp/";
                    if (!file_exists($tempdir)) 
                        mkdir($tempdir);
                    $codeContents = $setting['lembaga_link_rdm'] . $halaman . '?' . 'id=' . enkripsi($m_siswa['siswa_nis']);

                    QRcode::png($codeContents, $tempdir . $m_siswa['siswa_nis'] . '.png', QR_ECLEVEL_M, 4);
                ?>
                    <td style="padding:8px;">
                        <table style="width:10.4cm;border:1px solid #666;" class="kartu">
                            <tbody>
                                <tr>
                                    <td colspan="3" style="border-bottom:1px solid black">
                                        <table width="100%" class="kartu">
                                            <tbody>
                                                <tr>
                                                    <td style="width:50px;">
                                                        <img src="../../../../<?= $setting['lembaga_foto'] ?>" height="40">
                                                    </td>
                                                    <td align="center" style="font-weight:bold">
                                                        KARTU <?= strtoupper($u_jenis['jenis_u_nama']) ?><br>
                                                        <?= strtoupper($setting['lembaga_nama']) ?><br>
                                                        TAHUN PELAJARAN <?= $ajaran ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:115px">Nama Peserta</td>
                                    <td width="1">:</td>
                                    <td style="font-size:12px;font-weight:bold;"><?= ucfirst(strtoupper($m_siswa['siswa_nama'])) ?></td>
                                </tr>
                                <tr>
                                    <td style="width:115px">Nomor Peserta</td>
                                    <td>:</td>
                                    <td style="font-size:12px;font-weight:bold;">
                                        <?= strtoupper($setting['L_ujian_nopes']) ?>-
                                        <?php if ($cek_u_urutpeserta === 0) { ?>
                                            kosong
                                        <?php } else { ?>
                                            <?= sprintf('%04d', $u_siswa['id_urutpeserta']); ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:115px">NISN</td>
                                    <td>:</td>
                                    <td style="font-size:12px;font-weight:bold;"><?= $m_siswa['siswa_nisn'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width:115px">Tempat Tanggal Lahir</td>
                                    <td>:</td>
                                    <td style="font-size:12px;font-weight:bold;">
                                        <?php echo ucfirst(strtolower($m_siswa['siswa_tempat'])); ?>,
                                        <?php echo tanggal_indo($m_siswa['siswa_tgllahir']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:115px">Kelas / Ruang</td>
                                    <td>:</td>
                                    <td style="font-size:12px;font-weight:bold;">
                                        <?= $m_siswa['tingkat_nama'] ?>-<?= $m_siswa['kelas_nama'] ?> /
                                        <?php if ($cek_u_urutpeserta === 0) { ?>
                                            Kosong
                                        <?php } elseif ($u_siswa['ruang_u_id'] == null or $u_siswa['ruang_u_id'] == '0') { ?>
                                            Tanpa Ruang
                                        <?php } elseif ($u_ruang = fetch($koneksi, 'u_ruang', ['ruang_u_id' => $u_siswa['ruang_u_id']])) { ?>
                                            <?= $u_ruang['ruang_u_nama']; ?>
                                            (<?= $u_siswa['ruang_u_id']; ?>)
                                        <?php } else { ?>

                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table width="100%">
                                            <tbody>
                                                <td>
                                                <td valign="top" style="padding: 0">
                                                    <div style="width: 2cm; height: 3cm; border: 1px solid #ccc; text-align: center;margin-left:40px">
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <!-- Foto 2x3 -->

                                                    </div>
                                                </td>

                                                <td style="padding: 0; padding-left: 5px; width:240px" align="left" valign="top"><br>
                                                    <?= ucwords(strtolower($setting['lembaga_kota'])) ?>,
                                                    <?php echo tanggal_indo($setting['L_ujian_tglujian']); ?>
                                                    <br>Kepala Madrasah<br>
                                                    <div>
                                                        <img class="img-responsive img" alt="QR image" src="../../../tmp/<?= $m_siswa['siswa_nis'] ?>.png" width="50px">
                                                    </div>
                                                    <?= ucwords(strtolower($setting['lembaga_kamad'])) ?>
                                                    <br>
                                                    NIP. <?= ucwords(strtoupper($setting['lembaga_nip_kamad'])) ?>
                                                </td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
            </tr>
            </tbody>
        </table>
        </td>
        <?php if (($no % 2) == 0) : ?>
            </tr>
            <tr>
            <?php endif; ?>
        <?php endwhile; ?>
            </tr>
            </table>
    </center>
</div>
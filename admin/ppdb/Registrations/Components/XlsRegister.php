<?php
require("../../../../config/database.php");
require("../../../../config/function.php");
require("../../../../config/functions.crud.php");
$thn_id = $_GET['thn_id'];
$tahunajaran = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_tahunajaran where tahunajaran_id = '$thn_id'"));
$querysetting = mysqli_query($koneksi, "SELECT * 
FROM e_lembaga el
JOIN t_lembaga ml ON el.lembaga_nsm=ml.lembaga_nsm");
$setting = mysqli_fetch_array($querysetting);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DATA-PPDB-" . $tahunajaran['tahunajaran_nama'] . ".xls");
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        .str {
            mso-number-format: \@;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div align="center">
        <h5>DATA PESERTA DIDIK BARU (PPDB) <?= $setting['lembaga_nama']; ?> TAHUN PENDAFTARAN <?= $tahunajaran['tahunajaran_nama']; ?> </h5>
        <table border="1">
            <thead>
                <tr>
                    <td class="str">No</td>
                    <td class="str">GEL</td>
                    <td class="str">NO REGIST</td>
                    <td class="str">NAMA SISWA</td>
                    <td class="str">JK</td>
                    <td class="str">TEMPAT</td>
                    <td class="str">TGL LAHIR</td>
                    <td class="str">NISN</td>
                    <td class="str">NO KK</td>
                    <td class="str">NIK</td>
                    <td class="str">nohp</td>
                    <td class="str">anakke</td>
                    <td class="str">saudara</td>
                    <td class="str">hobi</td>
                    <td class="str">cita</td>
                    <td class="str">actived</td>
                    <td class="str">stt</td>
                    <td class="str">prov</td>
                    <td class="str">kota</td>
                    <td class="str">kec</td>
                    <td class="str">kel</td>
                    <td class="str">alamat</td>
                    <td class="str">rt</td>
                    <td class="str">rw</td>
                    <td class="str">kodepos</td>
                    <td class="str">jarak</td>
                    <td class="str">transportasi</td>
                    <td class="str">Ayah status</td>
                    <td class="str">Ayah name</td>
                    <td class="str">Ayah wn</td>
                    <td class="str">Ayah nik</td>
                    <td class="str">Ayah tempat</td>
                    <td class="str">Ayah tgllahir</td>
                    <td class="str">Ayah pekerjaan</td>
                    <td class="str">Ayah pendidikan</td>
                    <td class="str">Ayah penghasilan</td>
                    <td class="str">Ayah nohp</td>
                    <td class="str">Ibu status</td>
                    <td class="str">Ibu name</td>
                    <td class="str">Ibu wn</td>
                    <td class="str">Ibu nik</td>
                    <td class="str">Ibu tempat</td>
                    <td class="str">Ibu tgllahir</td>
                    <td class="str">Ibu pekerjaan</td>
                    <td class="str">Ibu pendidikan</td>
                    <td class="str">Ibu penghasilan</td>
                    <td class="str">Ibu nohp</td>
                    <td class="str">Wali status</td>
                    <td class="str">Wali name</td>
                    <td class="str">Wali wn</td>
                    <td class="str">Wali nik</td>
                    <td class="str">Wali tempat</td>
                    <td class="str">Wali tgllahir</td>
                    <td class="str">Wali pekerjaan</td>
                    <td class="str">Wali pendidikan</td>
                    <td class="str">Wali penghasilan</td>
                    <td class="str">Wali nohp</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $thn_id = $_GET['thn_id'];
                $query = "SELECT *
                FROM t_ppdbregist a
                JOIN t_ppdbperiode b ON b.tahunajaran_id=a.tahunajaran_id
                JOIN t_ppdbjurusan c ON c.ppdbjurusan_id=a.ppdbjurusan_id
                WHERE a.tahunajaran_id = '$thn_id'";
                $stmt = $koneksi->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($data_ppdb = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td class="str"><?= $no++; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbjurusan_alias']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_number']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_name']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_gender']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_tempat']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_tgllahir']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_nisn']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_nokk']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_nik']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_nohp']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_anakke']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_saudara']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_hobi']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_cita']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_actived']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_stt']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_prov']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_kota']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_kec']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_kel']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_alamat']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_rt']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_rw']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_kodepos']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_jarak']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbregist_transportasi']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_status']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_name']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_wn']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_nik']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_tempat']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_tgllahir']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_pekerjaan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_pendidikan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_penghasilan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbayah_nohp']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_status']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_name']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_wn']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_nik']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_tempat']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_tgllahir']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_pekerjaan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_pendidikan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_penghasilan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbibu_nohp']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_status']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_name']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_wn']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_nik']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_tempat']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_tgllahir']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_pekerjaan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_pendidikan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_penghasilan']; ?></td>
                            <td class="str"><?= $data_ppdb['ppdbwali_nohp']; ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td class="str" colspan='5'>Tidak ada data ditemukan</td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>

</body>

</html>
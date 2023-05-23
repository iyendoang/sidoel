<?php
require("../../../../config/database.php");
require("../../../../config/function.php");
require("../../../../config/functions.crud.php");

// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Ekspor Siswa.xls");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

?>
<style>
    .str {
        mso-number-format: \@;
    }
</style>
<table border="1">
    <thead>
        <tr>
            <th class="text-left" style="background-color:#808080;">NO</th>
            <?= isset($_POST["siswa_nama"]) == "on" ? '<th style="background-color:#808080;">NAMA SISWA</th>' : ''; ?>
            <?= isset($_POST["siswa_nis"]) == "on" ? '<th style="background-color:#808080;">NIS</th>' : ''; ?>
            <?= isset($_POST["siswa_nisn"]) == "on" ? '<th style="background-color:#808080;">NISN</th>' : ''; ?>
            <?= isset($_POST["siswa_gender"]) == "on" ? '<th style="background-color:#808080;">JK</th>' : ''; ?>
            <th class="text-left" style="background-color:#808080;">TKT</th>
            <th class="text-left" style="background-color:#808080;">RBL</th>
            <?= isset($_POST["siswa_tempat"]) == "on" ? '<th style="background-color:#808080;">TMP LHR</th>' : ''; ?>
            <?= isset($_POST["siswa_tgllahir"]) == "on" ? '<th style="background-color:#808080;">TGL LAHIR</th>' : ''; ?>
            <?= isset($_POST["siswa_telpon"]) == "on" ? '<th style="background-color:#808080;">CONTACT SISWA</th>' : ''; ?>
            <?= isset($_POST["nama_ayah"]) == "on" ? '<th style="background-color:#808080;">NAMA AYAH</th>' : ''; ?>
            <?= isset($_POST["nik_ayah"]) == "on" ? '<th style="background-color:#808080;">NIK AYAH</th>' : ''; ?>
            <?= isset($_POST["nama_ibu"]) == "on" ? '<th style="background-color:#808080;">NAMA IBU</th>' : ''; ?>
            <?= isset($_POST["nik_ibu"]) == "on" ? '<th style="background-color:#808080;">NIK IBU</th>' : ''; ?>
            <?= isset($_POST["telpon_ortu"]) == "on" ? '<th style="background-color:#808080;">CONTACT ORTU</th>' : ''; ?>
            <?= isset($_POST["nama_wali"]) == "on" ? '<th style="background-color:#808080;">NAMA WALI</th>' : ''; ?>
            <?= isset($_POST["telpon_wali"]) == "on" ? '<th style="background-color:#808080;">CONTACT WALI</th>' : ''; ?>
            <?= isset($_POST["alamat_wali"]) == "on" ? '<th style="background-color:#808080;">ALAMAT WALI</th>' : ''; ?>
            <?= isset($_POST["siswa_akta_nama"]) == "on" ? '<th style="background-color:#808080;">NAMA AKTA</th>' : ''; ?>
            <?= isset($_POST["siswa_akta_nik"]) == "on" ? '<th style="background-color:#808080;">NIK AKTA</th>' : ''; ?>
            <?= isset($_POST["siswa_akta_tempat"]) == "on" ? '<th style="background-color:#808080;">TMP LAHIR AKTA</th>' : ''; ?>
            <?= isset($_POST["siswa_akta_tgllahir"]) == "on" ? '<th style="background-color:#808080;">TGL LAHIR AKTA</th>' : ''; ?>
            <?= isset($_POST["siswa_akta_ayah"]) == "on" ? '<th style="background-color:#808080;">NAMA AYAH AKTA</th>' : ''; ?>
            <?= isset($_POST["siswa_akta_ibu"]) == "on" ? '<th style="background-color:#808080;">NAMA IBU AKTA</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_asal"]) == "on" ? '<th style="background-color:#808080;">JENJANG IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_statusasal"]) == "on" ? '<th style="background-color:#808080;">STATUS IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_npsnasal"]) == "on" ? '<th style="background-color:#808080;">NPSN IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_sekolahasal"]) == "on" ? '<th style="background-color:#808080;">NAMA SEKOLAH IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_kotaasal"]) == "on" ? '<th style="background-color:#808080;">ALAMAT SEKOLAH IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_nama"]) == "on" ? '<th style="background-color:#808080;">NAMA IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_nisn"]) == "on" ? '<th style="background-color:#808080;">NISN IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_tempat"]) == "on" ? '<th style="background-color:#808080;">TMP LAHIR IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_tgllahir"]) == "on" ? '<th style="background-color:#808080;">TGL LAHIR IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_namaortu"]) == "on" ? '<th style="background-color:#808080;">ORTU IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_noujian"]) == "on" ? '<th style="background-color:#808080;">NO UJIAN IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_noseri"]) == "on" ? '<th style="background-color:#808080;">NO SERI IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_ijz_thnlulus"]) == "on" ? '<th style="background-color:#808080;">TAHUN LULUS IJZ</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_nomor"]) == "on" ? '<th style="background-color:#808080;">NOMOR KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_kepala"]) == "on" ? '<th style="background-color:#808080;">KEPALA KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_provinsi"]) == "on" ? '<th style="background-color:#808080;">PROVINSI KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_kota"]) == "on" ? '<th style="background-color:#808080;">KOTA KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_kecamatan"]) == "on" ? '<th style="background-color:#808080;">KEC KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_kelurahan"]) == "on" ? '<th style="background-color:#808080;">KEL KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_alamat"]) == "on" ? '<th style="background-color:#808080;">ALAMAT KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_rt"]) == "on" ? '<th style="background-color:#808080;">RT/RW KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_kodepos"]) == "on" ? '<th style="background-color:#808080;">KODEPOS KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_nama"]) == "on" ? '<th style="background-color:#808080;">NAMA SISWA KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_wn"]) == "on" ? '<th style="background-color:#808080;">WARGA KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_nik"]) == "on" ? '<th style="background-color:#808080;">NIK KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_tempat"]) == "on" ? '<th style="background-color:#808080;">TMP LAHIR KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_tgllahir"]) == "on" ? '<th style="background-color:#808080;">TGL LAHIR KK</th>' : ''; ?>
            <?= isset($_POST["siswa_anakke"]) == "on" ? '<th style="background-color:#808080;">ANAK KE KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_jmlsaudara"]) == "on" ? '<th style="background-color:#808080;">JML SAUDARA KK</th>' : ''; ?>
            <?= isset($_POST["siswa_kk_darah"]) == "on" ? '<th style="background-color:#808080;">GOL DARAH</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_nama"]) == "on" ? '<th style="background-color:#808080;">NAMA AYAH KK</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_status"]) == "on" ? '<th style="background-color:#808080;">STATUS AYAH KK</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_wn"]) == "on" ? '<th style="background-color:#808080;">WARGA AYAH KK</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_nik"]) == "on" ? '<th style="background-color:#808080;">NIK AYAH KK</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_tempat"]) == "on" ? '<th style="background-color:#808080;">TMP LAHIR AYAH</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_tgllahir"]) == "on" ? '<th style="background-color:#808080;">TGL LAHIR AYAH</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_pendidikan"]) == "on" ? '<th style="background-color:#808080;">PENDIDIKAN AYAH</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_pekerjaan"]) == "on" ? '<th style="background-color:#808080;">PEKERJAAN AYAH</th>' : ''; ?>
            <?= isset($_POST["ayah_kk_penghasilan"]) == "on" ? '<th style="background-color:#808080;">PENGHASILAN AYAH</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_nama"]) == "on" ? '<th style="background-color:#808080;">NAMA IBU KK</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_status"]) == "on" ? '<th style="background-color:#808080;">STATUS IBU KK</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_wn"]) == "on" ? '<th style="background-color:#808080;">WARGA IBU KK</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_nik"]) == "on" ? '<th style="background-color:#808080;">NIK IBU KK</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_tempat"]) == "on" ? '<th style="background-color:#808080;">TMP LAHIR IBU</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_tgllahir"]) == "on" ? '<th style="background-color:#808080;">TGL LAHIR IBU</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_pendidikan"]) == "on" ? '<th style="background-color:#808080;">PENDIDIKAN IBU</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_pekerjaan"]) == "on" ? '<th style="background-color:#808080;">PEKERJAAN AYAH</th>' : ''; ?>
            <?= isset($_POST["ibu_kk_penghasilan"]) == "on" ? '<th style="background-color:#808080;">PENGHASILAN IBU</th>' : ''; ?>
            <?= isset($_POST["wali_kk_nama"]) == "on" ? '<th style="background-color:#808080;">NAMA WALI</th>' : ''; ?>
            <?= isset($_POST["wali_kk_wn"]) == "on" ? '<th style="background-color:#808080;">WARGA WALI</th>' : ''; ?>
            <?= isset($_POST["wali_kk_nik"]) == "on" ? '<th style="background-color:#808080;">NIK WALI</th>' : ''; ?>
            <?= isset($_POST["wali_kk_tempat"]) == "on" ? '<th style="background-color:#808080;">TMP LAHIR WALI</th>' : ''; ?>
            <?= isset($_POST["wali_kk_tgllahir"]) == "on" ? '<th style="background-color:#808080;">TGL LAHIR WALI</th>' : ''; ?>
            <?= isset($_POST["wali_kk_pendidikan"]) == "on" ? '<th style="background-color:#808080;">PENDIDIKAN WALI</th>' : ''; ?>
            <?= isset($_POST["wali_kk_pekerjaan"]) == "on" ? '<th style="background-color:#808080;">PEKERJAAN WALI</th>' : ''; ?>
            <?= isset($_POST["wali_kk_penghasilan"]) == "on" ? '<th style="background-color:#808080;">PENGHASILAN WALI</th>' : ''; ?>
            <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<th style="background-color:#808080;">HEPATITIS-B</th>' : ''; ?>
            <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<th style="background-color:#808080;">BCG</th>' : ''; ?>
            <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<th style="background-color:#808080;">DPT</th>' : ''; ?>
            <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<th style="background-color:#808080;">POLIO</th>' : ''; ?>
            <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<th style="background-color:#808080;">CAMPAK</th>' : ''; ?>
            <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<th style="background-color:#808080;">VAKSIN-1</th>' : ''; ?>
            <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<th style="background-color:#808080;">VAKSIN-2</th>' : ''; ?>
            <?= isset($_POST["siswa_kjp_status"]) == "on" ? '<th style="background-color:#808080;">STATUS KJP</th>' : ''; ?>
            <?= isset($_POST["siswa_kjp_namarek"]) == "on" ? '<th style="background-color:#808080;">NAMA REK KJP</th>' : ''; ?>
            <?= isset($_POST["siswa_kjp_norek"]) == "on" ? '<th style="background-color:#808080;">NOREK KJP</th>' : ''; ?>
            <?= isset($_POST["siswa_kjp_bankcab"]) == "on" ? '<th style="background-color:#808080;">CABANG KJP</th>' : ''; ?>
            <?= isset($_POST["siswa_kjp_nomoratm"]) == "on" ? '<th style="background-color:#808080;">ATM KJP</th>' : ''; ?>
            <?= isset($_POST["siswa_kip_status"]) == "on" ? '<th style="background-color:#808080;">STATUS KIP</th>' : ''; ?>
            <?= isset($_POST["siswa_kip_namarek"]) == "on" ? '<th style="background-color:#808080;">NAMA REK KIP</th>' : ''; ?>
            <?= isset($_POST["siswa_kip_norek"]) == "on" ? '<th style="background-color:#808080;">NOREK KIP</th>' : ''; ?>
            <?= isset($_POST["siswa_kip_bankcab"]) == "on" ? '<th style="background-color:#808080;">CABANG KIP</th>' : ''; ?>
            <?= isset($_POST["siswa_kip_nomoratm"]) == "on" ? '<th style="background-color:#808080;">ATM KIP</th>' : ''; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_POST["kelas_id"])) {
            $tahunajaran_id = $_POST['tahunajaran_id'];
            $kelas_id = $_POST['kelas_id'];
            if ((empty($_POST['kelas_id']))) {
                echo "Data Kosong";
             } elseif ($_POST["kelas_id"] != "ALL") {
                $query = mysqli_query($koneksi, "SELECT * FROM e_siswa a 
                JOIN e_kelas b ON a.kelas_id=b.kelas_id 
                JOIN f_siswa_act c ON a.siswa_id=c.siswa_id 
                JOIN e_tingkat d ON b.tingkat_id=d.tingkat_id 
                WHERE b.kelas_id = '$kelas_id' and a.kelas_id != '-1' 
                AND a.siswa_alasan_mutasi IS NULL 
                AND b.tahunajaran_id='$tahunajaran_id'
                ORDER BY b.kelas_id ASC, a.siswa_nama ");
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM e_siswa a 
                JOIN e_kelas b ON a.kelas_id=b.kelas_id 
                JOIN f_siswa_act c ON a.siswa_id=c.siswa_id 
                JOIN e_tingkat d ON b.tingkat_id=d.tingkat_id 
                WHERE a.kelas_id != '-1' 
                AND a.siswa_alasan_mutasi IS NULL 
                AND b.tahunajaran_id='$tahunajaran_id'
                ORDER BY b.kelas_id ASC, a.siswa_nama ");
            }
            $no = 0;
            while ($row = mysqli_fetch_array($query)) {
                $no++;
            ?>
                <tr>
                    <td><?= $no; ?></td>
                    <?= isset($_POST["siswa_nama"]) == "on" ? '<td class="str">' . ucwords(strtolower($row["siswa_nama"])) . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_nis"]) == "on" ? '<td class="str">' . $row["siswa_nis"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_nisn"]) == "on" ? '<td class="str">' . $row["siswa_nisn"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_gender"]) == "on" ? '<td class="str">' . $row["siswa_gender"] . '</td>' : ''; ?>
                    <td style="text-align: center; background-color: #FFFF8B;"><?= $row["tingkat_nama"]; ?></td>
                    <td style="text-align: center; background-color: #FFFF8B;"><?= $row["kelas_nama"]; ?></td>
                    <?= isset($_POST["siswa_tempat"]) == "on" ? '<td class="str">' . $row["siswa_tempat"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_tgllahir"]) == "on" ? '<td class="str">' . $row["siswa_tgllahir"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_telpon"]) == "on" ? '<td class="str">' . $row["siswa_telpon"] . '</td>' : ''; ?>
                    <?= isset($_POST["nama_ayah"]) == "on" ? '<td class="str">' . $row["nama_ayah"] . '</td>' : ''; ?>
                    <?= isset($_POST["nik_ayah"]) == "on" ? '<td class="str">' . $row["nik_ayah"] . '</td>' : ''; ?>
                    <?= isset($_POST["nama_ibu"]) == "on" ? '<td class="str">' . $row["nama_ibu"] . '</td>' : ''; ?>
                    <?= isset($_POST["nik_ibu"]) == "on" ? '<td class="str">' . $row["nik_ibu"] . '</td>' : ''; ?>
                    <?= isset($_POST["telpon_ortu"]) == "on" ? '<td class="str">' . $row["telpon_ortu"] . '</td>' : ''; ?>
                    <?= isset($_POST["nama_wali"]) == "on" ? '<td class="str">' . $row["nama_wali"] . '</td>' : ''; ?>
                    <?= isset($_POST["telpon_wali"]) == "on" ? '<td class="str">' . $row["telpon_wali"] . '</td>' : ''; ?>
                    <?= isset($_POST["alamat_wali"]) == "on" ? '<td class="str">' . $row["alamat_wali"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_akta_nama"]) == "on" ? '<td class="str">' . $row["siswa_akta_nama"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_akta_nik"]) == "on" ? '<td class="str">' . $row["siswa_akta_nik"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_akta_tempat"]) == "on" ? '<td class="str">' . $row["siswa_akta_tempat"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_akta_tgllahir"]) == "on" ? '<td class="str">' . $row["siswa_akta_tgllahir"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_akta_ayah"]) == "on" ? '<td class="str">' . $row["siswa_akta_ayah"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_akta_ibu"]) == "on" ? '<td class="str">' . $row["siswa_akta_ibu"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_asal"]) == "on" ? '<td class="str">' . $row["siswa_ijz_asal"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_statusasal"]) == "on" ? '<td class="str">' . $row["siswa_ijz_statusasal"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_npsnasal"]) == "on" ? '<td class="str">' . $row["siswa_ijz_npsnasal"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_sekolahasal"]) == "on" ? '<td class="str">' . $row["siswa_ijz_sekolahasal"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_kotaasal"]) == "on" ? '<td class="str">' . $row["siswa_ijz_kotaasal"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_nama"]) == "on" ? '<td class="str">' . $row["siswa_ijz_nama"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_nisn"]) == "on" ? '<td class="str">' . $row["siswa_ijz_nisn"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_tempat"]) == "on" ? '<td class="str">' . $row["siswa_ijz_tempat"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_tgllahir"]) == "on" ? '<td class="str">' . $row["siswa_ijz_tgllahir"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_namaortu"]) == "on" ? '<td class="str">' . $row["siswa_ijz_namaortu"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_noujian"]) == "on" ? '<td class="str">' . $row["siswa_ijz_noujian"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_noseri"]) == "on" ? '<td class="str">' . $row["siswa_ijz_noseri"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_ijz_thnlulus"]) == "on" ? '<td class="str">' . $row["siswa_ijz_thnlulus"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_nomor"]) == "on" ? '<td class="str">' . $row["siswa_kk_nomor"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_kepala"]) == "on" ? '<td class="str">' . $row["siswa_kk_kepala"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_provinsi"]) == "on" ? '<td class="str">' . $row["siswa_kk_provinsi"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_kota"]) == "on" ? '<td class="str">' . $row["siswa_kk_kota"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_kecamatan"]) == "on" ? '<td class="str">' . $row["siswa_kk_kecamatan"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_kelurahan"]) == "on" ? '<td class="str">' . $row["siswa_kk_kelurahan"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_alamat"]) == "on" ? '<td class="str">' . $row["siswa_kk_alamat"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_rt"]) == "on" ? '<td class="str">' . $row["siswa_kk_rt"] . '/' . $row["siswa_kk_rw"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_kodepos"]) == "on" ? '<td class="str">' . $row["siswa_kk_kodepos"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_nama"]) == "on" ? '<td class="str">' . $row["siswa_kk_nama"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_wn"]) == "on" ? '<td class="str">' . $row["siswa_kk_wn"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_nik"]) == "on" ? '<td class="str">' . $row["siswa_kk_nik"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_tempat"]) == "on" ? '<td class="str">' . $row["siswa_kk_tempat"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_tgllahir"]) == "on" ? '<td class="str">' . $row["siswa_kk_tgllahir"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_anakke"]) == "on" ? '<td class="str">' . $row["siswa_anakke"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_jmlsaudara"]) == "on" ? '<td class="str">' . $row["siswa_kk_jmlsaudara"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kk_darah"]) == "on" ? '<td class="str">' . $row["siswa_kk_darah"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_nama"]) == "on" ? '<td class="str">' . $row["ayah_kk_nama"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_status"]) == "on" ? '<td class="str">' . $row["ayah_kk_status"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_wn"]) == "on" ? '<td class="str">' . $row["ayah_kk_wn"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_nik"]) == "on" ? '<td class="str">' . $row["ayah_kk_nik"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_tempat"]) == "on" ? '<td class="str">' . $row["ayah_kk_tempat"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_tgllahir"]) == "on" ? '<td class="str">' . $row["ayah_kk_tgllahir"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_pendidikan"]) == "on" ? '<td class="str">' . $row["ayah_kk_pendidikan"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_pekerjaan"]) == "on" ? '<td class="str">' . $row["ayah_kk_pekerjaan"] . '</td>' : ''; ?>
                    <?= isset($_POST["ayah_kk_penghasilan"]) == "on" ? '<td class="str">' . $row["ayah_kk_penghasilan"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_nama"]) == "on" ? '<td class="str">' . $row["ibu_kk_nama"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_status"]) == "on" ? '<td class="str">' . $row["ibu_kk_status"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_wn"]) == "on" ? '<td class="str">' . $row["ibu_kk_wn"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_nik"]) == "on" ? '<td class="str">' . $row["ibu_kk_nik"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_tempat"]) == "on" ? '<td class="str">' . $row["ibu_kk_tempat"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_tgllahir"]) == "on" ? '<td class="str">' . $row["ibu_kk_tgllahir"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_pendidikan"]) == "on" ? '<td class="str">' . $row["ibu_kk_pendidikan"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_pekerjaan"]) == "on" ? '<td class="str">' . $row["ibu_kk_pekerjaan"] . '</td>' : ''; ?>
                    <?= isset($_POST["ibu_kk_penghasilan"]) == "on" ? '<td class="str">' . $row["ibu_kk_penghasilan"] . '</td>' : ''; ?>
                    <?= isset($_POST["wali_kk_nama"]) == "on" ? '<td class="str">' . $row["wali_kk_nama"] . '</td>' : ''; ?>
                    <?= isset($_POST["wali_kk_wn"]) == "on" ? '<td class="str">' . $row["wali_kk_wn"] . '</td>' : ''; ?>
                    <?= isset($_POST["wali_kk_nik"]) == "on" ? '<td class="str">' . $row["wali_kk_nik"] . '</td>' : ''; ?>
                    <?= isset($_POST["wali_kk_tempat"]) == "on" ? '<td class="str">' . $row["wali_kk_tempat"] . '</td>' : ''; ?>
                    <?= isset($_POST["wali_kk_tgllahir"]) == "on" ? '<td class="str">' . $row["wali_kk_tgllahir"] . '</td>' : ''; ?>
                    <?= isset($_POST["wali_kk_pendidikan"]) == "on" ? '<td class="str">' . $row["wali_kk_pendidikan"] . '</td>' : ''; ?>
                    <?= isset($_POST["wali_kk_pekerjaan"]) == "on" ? '<td class="str">' . $row["wali_kk_pekerjaan"] . '</td>' : ''; ?>
                    <?= isset($_POST["wali_kk_penghasilan"]) == "on" ? '<td class="str">' . $row["wali_kk_penghasilan"] . '</td>' : ''; ?>
                    <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<td class="str">' . $row["health_hepatitis_b"] . '</td>' : ''; ?>
                    <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<td class="str">' . $row["health_bcg"] . '</td>' : ''; ?>
                    <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<td class="str">' . $row["health_dpt"] . '</td>' : ''; ?>
                    <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<td class="str">' . $row["health_polio"] . '</td>' : ''; ?>
                    <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<td class="str">' . $row["health_campak"] . '</td>' : ''; ?>
                    <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<td class="str">' . $row["health_covid_one"] . '</td>' : ''; ?>
                    <?= isset($_POST["imunisasi_danvaksin"]) == "on" ? '<td class="str">' . $row["health_covid_two"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kjp_status"]) == "on" ? '<td class="str">' . $row["siswa_kjp_status"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kjp_namarek"]) == "on" ? '<td class="str">' . $row["siswa_kjp_namarek"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kjp_norek"]) == "on" ? '<td class="str">' . $row["siswa_kjp_norek"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kjp_bankcab"]) == "on" ? '<td class="str">' . $row["siswa_kjp_bankcab"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kjp_nomoratm"]) == "on" ? '<td class="str">' . $row["siswa_kjp_nomoratm"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kip_status"]) == "on" ? '<td class="str">' . $row["siswa_kip_status"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kip_namarek"]) == "on" ? '<td class="str">' . $row["siswa_kip_namarek"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kip_norek"]) == "on" ? '<td class="str">' . $row["siswa_kip_norek"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kip_bankcab"]) == "on" ? '<td class="str">' . $row["siswa_kip_bankcab"] . '</td>' : ''; ?>
                    <?= isset($_POST["siswa_kip_nomoratm"]) == "on" ? '<td class="str">' . $row["siswa_kip_nomoratm"] . '</td>' : ''; ?>
                </tr>
        <?php  }
        } ?>
    </tbody>
</table>
<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 't_lembaga'");
$t_lembagaTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$t_lembagaTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `t_lembaga` (
        id_m_lembaga bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        lembaga_id varchar(100) NOT NULL UNIQUE,
        lembaga_nama varchar(150) DEFAULT NULL UNIQUE,
        lembaga_nsm varchar(20) DEFAULT NULL,
        lembaga_npsn varchar(20) DEFAULT NULL,
        lembaga_npwp varchar(100) DEFAULT NULL,
        jenjang_id varchar(100) DEFAULT NULL,
        lembaga_status varchar(10) DEFAULT NULL,
        lembaga_alamat TEXT DEFAULT NULL,
        lembaga_kota varchar(150) DEFAULT NULL,
        lembaga_provinsi varchar(150) DEFAULT NULL,
        lembaga_kec varchar(150) DEFAULT NULL,
        lembaga_kel varchar(150) DEFAULT NULL,
        lembaga_rt char(4) DEFAULT NULL,
        lembaga_rw char(4) DEFAULT NULL,
        lembaga_kodepos varchar(10) DEFAULT NULL,
        lembaga_notelp varchar(20) DEFAULT NULL,
        lembaga_email varchar(150) DEFAULT NULL,
        lembaga_web varchar(150) DEFAULT NULL,
        lembaga_link_rdm varchar(150) DEFAULT NULL,
        lembaga_siopstatus varchar(10) DEFAULT NULL,
        lembaga_no_siop varchar(150) DEFAULT NULL,
        lembaga_tgl_siop DATE DEFAULT NULL,
        lembaga_siop_end DATE DEFAULT NULL,
        lembaga_akre varchar(150) DEFAULT NULL,
        lembaga_nilai_akre varchar(150) DEFAULT NULL,
        lembaga_no_akre varchar(150) DEFAULT NULL,
        lembaga_tgl_akre DATE DEFAULT NULL,
        lembaga_tgl_akre_end DATE DEFAULT NULL,
        lembaga_thnberdiri varchar(10) DEFAULT NULL,
        lembaga_pengawas varchar(150) DEFAULT NULL,
        lembaga_nip_pengawas varchar(150) DEFAULT NULL,
        lembaga_kasie varchar(150) DEFAULT NULL,
        lembaga_nip_kasie varchar(150) DEFAULT NULL,
        lembaga_kamad varchar(150) DEFAULT NULL,
        lembaga_nip_kamad varchar(150) DEFAULT NULL,
        lembaga_kamad_notelp varchar(150) DEFAULT NULL,
        lembaga_operator varchar(150) DEFAULT NULL,
        lembaga_nip_operator varchar(150) DEFAULT NULL,
        lembaga_operator_notelp varchar(150) DEFAULT NULL,
        lembaga_komite varchar(150) DEFAULT NULL,
        lembaga_nip_komite varchar(150) DEFAULT NULL,
        lembaga_kop_surat varchar(150) DEFAULT NULL,
        LY_noakta varchar(150) DEFAULT NULL,
        LY_tglakta DATE DEFAULT NULL,
        LY_namanotaris varchar(150) DEFAULT NULL,
        LY_noakta_update varchar(150) DEFAULT NULL,
        LY_tglakta_update DATE DEFAULT NULL,
        LY_namaakta_update varchar(150) DEFAULT NULL,
        LY_sk_kemenkumham varchar(150) DEFAULT NULL,
        LY_tgl_kemenkumham DATE DEFAULT NULL,
        lembaga_filekopsurat text DEFAULT NULL,
        lembaga_filesiop text DEFAULT NULL,
        lembaga_fileakre text DEFAULT NULL,
        lembaga_fileakta text DEFAULT NULL,
        lembaga_fileaktaend text DEFAULT NULL,
        lembaga_fileskmenkumham text DEFAULT NULL,
        lembaga_filenpsn text DEFAULT NULL,
        lembaga_filenpwp text DEFAULT NULL,
        lembaga_filestempel text DEFAULT NULL,
        lembaga_filettdkamad text DEFAULT NULL,
        L_tglkartupelajar DATE DEFAULT NULL,
        L_judulkartu text DEFAULT NULL,
        L_isikartu TEXT DEFAULT NULL,
        L_templatekartu text DEFAULT NULL,
        L_ujian_nama text DEFAULT NULL,
        L_ujian_nopes text DEFAULT NULL,
        L_ujian_headercard text DEFAULT NULL,
        L_ujian_tglujian DATE DEFAULT NULL,
        lembaga_sidoel text DEFAULT NULL,
        lembaga_active INT(10) DEFAULT NULL,
        lembaga_tgl_tigalima DATE DEFAULT NULL,
        lembaga_ppdb_embed text DEFAULT NULL,
        username text DEFAULT NULL,
        password text DEFAULT NULL
    )";

    if (mysqli_query($koneksi, $sql)) {
        $sql = "INSERT IGNORE INTO t_lembaga (lembaga_nsm, lembaga_id)
            SELECT lembaga_nsm, lembaga_id FROM e_lembaga";
        if (mysqli_query($koneksi, $sql)) {
            $sqlUpdate = "UPDATE `t_lembaga` SET `jenjang_id` = '3' WHERE `t_lembaga`.`id_m_lembaga` = 1";
            if (mysqli_query($koneksi, $sqlUpdate)) {
                echo "Data berhasil diduplikat dan diperbarui dari tabel e_lembaga ke t_lembaga.";
            } else {
                echo "Error saat melakukan operasi UPDATE: " . mysqli_error($koneksi);
            }
        } else {
            echo "Error saat menduplikat data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error saat membuat tabel t_lembaga: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

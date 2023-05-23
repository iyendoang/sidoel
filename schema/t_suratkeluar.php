<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 't_suratkeluar'");
$t_suratkeluarTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$t_suratkeluarTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `t_suratkeluar` (
        suratkeluar_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        siswa_id bigint(100) DEFAULT NULL,
        kelas_id bigint(100) DEFAULT NULL,
        tahunajaran_id bigint(100) DEFAULT NULL,
        judul_id bigint(100) DEFAULT NULL,
        suratkeluar_nomor VARCHAR(225) DEFAULT NULL,
        suratkeluar_tgl DATE DEFAULT NULL,
        suratkeluar_perihal VARCHAR(225) DEFAULT NULL,
        suratkeluar_maksud VARCHAR(225) DEFAULT NULL,
        suratkeluar_isi TEXT DEFAULT NULL,
        suratkeluar_penutup VARCHAR(225) DEFAULT NULL,
        sukel_mut_nama VARCHAR(225) DEFAULT NULL,
        sukel_mut_tingkat VARCHAR(225) DEFAULT NULL,
        sukel_mut_tgllahir VARCHAR(225) DEFAULT NULL,
        sukel_mut_gender VARCHAR(225) DEFAULT NULL,
        sukel_mut_alasan VARCHAR(225) DEFAULT NULL,
        sukel_mut_tujuan VARCHAR(225) DEFAULT NULL,
        sukel_kjp_jenis VARCHAR(225) DEFAULT NULL,
        sukel_kjp_walibefore VARCHAR(225) DEFAULT NULL,
        sukel_kjp_waliafter VARCHAR(225) DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "Data  tabel t_suratkeluar berhasil dibuat.";
    } else {
        echo "Error saat create t_suratkeluar: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

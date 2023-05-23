<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 'f_add_prestasi'");
$f_add_prestasiTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$f_add_prestasiTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `f_add_prestasi` (
      prestasi_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        siswa_id bigint(100) NOT NULL UNIQUE,
        kelas_id VARCHAR(100) DEFAULT NULL,
        prestasi_thn_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_nama_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_bid_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_panra_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_tingkat_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_peringkat_lomba VARCHAR(225) DEFAULT NULL,
        file_bukti_lomba VARCHAR(225) DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        updated_at DATETIME DEFAULT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "Data  tabel f_add_prestasi berhasil dibuat.";
    } else {
        echo "Error saat create f_add_prestasi: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

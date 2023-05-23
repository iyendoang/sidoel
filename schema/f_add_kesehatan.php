<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 'f_add_kesehatan'");
$f_add_kesehatanTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$f_add_kesehatanTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `f_add_kesehatan` (
       add_kes_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        siswa_id bigint(100) NOT NULL UNIQUE,
        siswa_nis VARCHAR(20) DEFAULT NULL,
        add_kes_nama VARCHAR(225) DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "Data  tabel f_add_kesehatan berhasil dibuat.";
    } else {
        echo "Error saat create f_add_kesehatan: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

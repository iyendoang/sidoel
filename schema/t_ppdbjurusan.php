<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 't_ppdbjurusan'");
$t_ppdbjurusanTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$t_ppdbjurusanTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `t_ppdbjurusan` (
        ppdbjurusan_id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        ppdbjurusan_alias VARCHAR(225) DEFAULT NULL UNIQUE,
        ppdbjurusan_kuota int(10) DEFAULT NULL,
        ppdbjurusan_name VARCHAR(225) DEFAULT NULL,
        ppdbjurusan_actived int(10) DEFAULT NULL,
        ppdbjurusan_desc VARCHAR(225) DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "Data  tabel t_ppdbjurusan berhasil dibuat.";
    } else {
        echo "Error saat create t_ppdbjurusan: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

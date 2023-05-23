<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 't_ppdbperiode'");
$t_ppdbperiodeTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$t_ppdbperiodeTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `t_ppdbperiode` (
      ppdbperiode_id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        tahunajaran_id INT(10) DEFAULT NULL UNIQUE,
        ppdbperiode_opened DATE DEFAULT NULL,
        ppdbperiode_closed DATE DEFAULT NULL,
        ppdbjurusan_actived int(10) DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "Data  tabel t_ppdbperiode berhasil dibuat.";
    } else {
        echo "Error saat create t_ppdbperiode: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

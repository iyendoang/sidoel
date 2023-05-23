<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 't_judulsurat'");
$t_judulsuratTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$t_judulsuratTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `t_judulsurat` (
  judul_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT UNIQUE,
        judul_nama VARCHAR(225) DEFAULT NULL,
        judul_alias VARCHAR(100) DEFAULT NULL,
        judul_icon VARCHAR(100) DEFAULT NULL,
        judul_link_add VARCHAR(225) DEFAULT NULL,
        judul_link_edit VARCHAR(225) DEFAULT NULL,
        judul_status INT(10) DEFAULT NULL,
        judul_on VARCHAR(225) DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "Data  tabel t_judulsurat berhasil dibuat.";
    } else {
        echo "Error saat create t_judulsurat: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

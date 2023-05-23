<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 'm_uploadfile'");
$m_uploadfileTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$m_uploadfileTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `m_uploadfile` (
       id_upload bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        upload_id VARCHAR(100) NOT NULL,
        upload_name VARCHAR(225) DEFAULT NULL,
        upload_file VARCHAR(225) DEFAULT NULL,
        upload_status VARCHAR(225) DEFAULT NULL,
        siswa_id bigint(100) DEFAULT NULL,
        guru_id bigint(100) DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        updated_at DATETIME DEFAULT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "Data  tabel m_uploadfile berhasil dibuat.";
    } else {
        echo "Error saat create m_uploadfile: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

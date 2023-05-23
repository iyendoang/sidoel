<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 't_jenjang'");
$t_jenjangTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$t_jenjangTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `t_jenjang` (
        `id_jenjang` INT AUTO_INCREMENT PRIMARY KEY,
        `jenjang_id` INT NOT NULL,
        `jenjang_nama` VARCHAR(50) NOT NULL,
        `jenjang_alias` VARCHAR(50) NOT NULL,
        `jenjang_users` VARCHAR(50) NOT NULL,
        `jenjang_status` INT NOT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        $sql = "INSERT INTO `t_jenjang` (`id_jenjang`, `jenjang_id`, `jenjang_nama`, `jenjang_alias`, `jenjang_users`, `jenjang_status`) 
        VALUES 
        (NULL, '1', 'Raudlatul Athfal (RA)', 'RA', 'admin_ra', '1'), 
        (NULL, '2', 'Madrasah Ibtida`iyyah (MI)', 'MI', 'admin_mi', '1'), 
        (NULL, '3', 'Madrasah Tsnawiyah (MTs)', 'MTs', 'admin_mts', '1'), 
        (NULL, '4', 'Madrasah `Aliyah (MA)', 'MA', 'admin_ma', '1'), 
        (NULL, '5', 'Kantorr Kementerian Agama', 'Kemenag', 'admin_kota', '2')";

        if (mysqli_query($koneksi, $sql)) {
            echo "Data berhasil di insert dari tabel e_lembaga ke t_jenjang.";
        } else {
            echo "Error saat menduplikat data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error saat membuat tabel t_jenjang: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

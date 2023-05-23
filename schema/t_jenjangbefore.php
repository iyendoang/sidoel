<?php 
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 't_jenjangbefore'");
$t_jenjangbeforeTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$t_jenjangbeforeTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `t_jenjangbefore` (
        `jenjangbefore_id` INT AUTO_INCREMENT PRIMARY KEY,
        `jenjang_id` INT NOT NULL,
        `jenjangbefore_nama` VARCHAR(50) NOT NULL,
        `jenjangbefore_alias` VARCHAR(50) NOT NULL,
        `jenjangbefore_urut` INT NOT NULL,
        `jenjangbefore_status` INT NOT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        $sql = "INSERT INTO `t_jenjangbefore` (`jenjangbefore_id`, `jenjang_id`, `jenjangbefore_nama`, `jenjangbefore_alias`, `jenjangbefore_urut`, `jenjangbefore_status`) 
        VALUES 
        (NULL, '2', 'Raudlatul Athfal', 'RA', '1', '1'), 
        (NULL, '2', 'Taman Kanak-kanak', 'TK', '2', '1'), 
        (NULL, '2', 'Orangtua', 'Ortu', '3', '1'), 
        (NULL, '3', 'Madrasah Ibtida`iyyah', 'MI', '1', '1'), 
        (NULL, '3', 'Sekolah Dasar', 'SD', '2', '1'), 
        (NULL, '3', 'PAKET A', 'Paket A', '3', '1'), 
        (NULL, '4', 'Madrasah Tsnawiyah', 'MTs', '1', '1'), 
        (NULL, '4', 'Sekolah Menengah Pertama', 'SMP', '2', '1'), 
        (NULL, '4', 'PAKET B', 'Paket B', '3', '1')";

        if (mysqli_query($koneksi, $sql)) {
            echo "Data berhasil diduplikat dari tabel e_lembaga ke t_jenjangbefore.";
        } else {
            echo "Error saat menduplikat data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error saat membuat tabel t_jenjangbefore: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

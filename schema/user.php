<?php
$tablesExistQuery = mysqli_query($koneksi, "SHOW TABLES LIKE 'user'");
$userTableExists = mysqli_num_rows($tablesExistQuery) > 0;
if (!$userTableExists) {
    $sql = "CREATE TABLE IF NOT EXISTS `user` (
         `id_user` INT AUTO_INCREMENT PRIMARY KEY,
        `nama_user` VARCHAR(50) NOT NULL,
        `level` VARCHAR(50) NOT NULL,
        `username` VARCHAR(50) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `status` VARCHAR(50) NOT NULL,
        `foto` VARCHAR(255),
        `akses` VARCHAR(50) NOT NULL,
        `user_versi` VARCHAR(50) NOT NULL,
        `createby` VARCHAR(50) NOT NULL,
        `title_app` VARCHAR(50) NOT NULL
    )";
    if (mysqli_query($koneksi, $sql)) {
        $sql = "INSERT INTO `user` (`id_user`, `nama_user`, `level`, `username`, `password`, `status`, `foto`, `akses`, `user_versi`, `createby`, `title_app`) VALUES 
        (NULL, 'Administrator', 'admin', 'admin', '$2y$10$3aN3Bd8L0wMno/4d7sBSOe1kyunplnL9Qp.ruKj5a65go8phAl6x.', '2', NULL, 'admin', '0,2', 'FKMTs Jakarta Barat', 'Sidoel-&-RDM')";

        if (mysqli_query($koneksi, $sql)) {
            echo "Data berhasil diduplikat dari tabel e_lembaga ke user.";
        } else {
            echo "Error saat menduplikat data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error saat membuat tabel user: " . mysqli_error($koneksi);
    }
    echo '<br>';
}

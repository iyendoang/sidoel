<?php
require("../../../config/function.php");
require("../../../config/database.php");
require("../../../config/functions.crud.php");

if ($pg = 'edit_tahunalumni') {
    if (isset($_POST["siswa_id"])) {
        $siswa_id = $_POST['siswa_id'];
        $siswa_lulus_tahunajaran_id = $_POST['siswa_lulus_tahunajaran_id'];
        foreach ($_POST['siswa_id'] as $siswa_id) {
            $siswa_lulus_tahunajaran_id = $_POST['siswa_lulus_tahunajaran_id'];
            $update_all = "UPDATE f_siswa_act SET 
                        siswa_lulus_tahunajaran_id='" . $siswa_lulus_tahunajaran_id . "'
                        WHERE siswa_id = '$siswa_id'";
            mysqli_query($koneksi, $update_all) or die(mysqli_error($koneksi));
        }
    }
    if ($update_all) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Akte Lahir  Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 300,
            'icon'          => "error",
            'message'       => "Update Data Akte Lahir  Gagal Bos",
        ];
        echo json_encode($response);
    }
}


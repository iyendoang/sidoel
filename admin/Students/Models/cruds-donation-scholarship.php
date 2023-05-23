<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

if ($pg == 'FormSiswaKJPEdit') {
    $f_siswa_act_kjpEdit = [
        // data siswa
        'siswa_kjp_status'             => $_POST['siswa_kjp_status'],
        'siswa_kjp_namarek'               => str_replace("'", "`", ucfirst(strtoupper($_POST['siswa_kjp_namarek']))),
        'siswa_kjp_norek'             => $_POST['siswa_kjp_norek'],
        'siswa_kjp_bankcab'               => str_replace("'", "`", ucwords(strtolower($_POST['siswa_kjp_bankcab']))),
        'siswa_kjp_nomoratm'             => $_POST['siswa_kjp_nomoratm'],
    ];
    $f_siswa = [];
    $id = $_POST['siswa_id'];
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act_kjpEdit, ['siswa_id' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Data KJP Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Data KJP Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'FormSiswaKIPEdit') {
    $f_siswa_act_kip = [
        // data siswa
        'siswa_kip_status'             => $_POST['siswa_kip_status'],
        'siswa_kip_namarek'               => str_replace("'", "`", ucfirst(strtoupper($_POST['siswa_kip_namarek']))),
        'siswa_kip_norek'             => $_POST['siswa_kip_norek'],
        'siswa_kip_bankcab'               => str_replace("'", "`", ucwords(strtolower($_POST['siswa_kip_bankcab']))),
        'siswa_kip_nomoratm'             => $_POST['siswa_kip_nomoratm'],
    ];
    $id = $_POST['siswa_id'];
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act_kip, ['siswa_id' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Data KIP Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Data KIP Gagal Bos",
        ];
        echo json_encode($response);
    }
}

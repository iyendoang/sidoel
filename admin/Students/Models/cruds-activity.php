<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

if ($pg == 'f_siswa_actEdit') {
    $siswa_act_nama = str_replace("'", "`", $_POST['siswa_act_nama']);
    $siswa_act_email = str_replace("'", "`", $_POST['siswa_act_email']);
    if (!preg_match('/[^+0-9]/', trim($_POST['siswa_act_hp']))) {
        // cek apakah no siswa_act_hp karakter 1-3 adalah +62
        if (substr(trim($_POST['siswa_act_hp']), 0, 2) == '62') {
            $post_siswa_act_hp = trim($_POST['siswa_act_hp']);
        } elseif (substr(trim($_POST['siswa_act_hp']), 0, 1) == '0') {
            $post_siswa_act_hp = '62' . substr(trim($_POST['siswa_act_hp']), 1);
        } elseif (substr(trim($_POST['siswa_act_hp']), 0, 1) == '') {
            $post_siswa_act_hp = '';
        } else {
            $post_siswa_act_hp =  $_POST['siswa_act_hp'];
        }
    }
    $f_siswa_act = [
        // 'siswa_id_kota'             => $_POST['siswa_nsm'] . $_POST['siswa_act_nis'],
        'siswa_act_nama'            => ucwords(strtoupper($siswa_act_nama)),
        // 'siswa_act_nis'             => $_POST['siswa_act_nis'],
        'siswa_act_nisn'            => $_POST['siswa_act_nisn'],
        'siswa_act_tingkat'         => $_POST['siswa_act_tingkat'],
        'siswa_act_jurusan'         => $_POST['siswa_act_jurusan'],
        'siswa_act_gender'          => $_POST['siswa_act_gender'],
        'siswa_act_hobi'            => $_POST['siswa_act_hobi'],
        'siswa_act_cita'            => $_POST['siswa_act_cita'],
        'siswa_act_abk'             => $_POST['siswa_act_abk'],
        'siswa_act_disability'      => $_POST['siswa_act_disability'],
        'siswa_act_abk'             => $_POST['siswa_act_abk'],
        'siswa_act_hp'              => $post_siswa_act_hp,
        'siswa_act_email'           => strtolower($siswa_act_email),
    ];
    $f_siswa = [
        // 'siswa_id_kota'             => $_POST['siswa_nsm'] . $_POST['siswa_act_nis'],
        'siswa_nama'                => ucwords(strtoupper($siswa_act_nama)),
        // 'siswa_nis'                 => $_POST['siswa_act_nis'],
        'siswa_nisn'                => $_POST['siswa_act_nisn'],
        'tingkat_id'                => $_POST['siswa_act_tingkat'],
        'siswa_gender'              => $_POST['siswa_act_gender'],
        'siswa_telpon'              => $post_siswa_act_hp,
    ];
    $id = $_POST['siswa_id_kota'];
    $nama_update = ucfirst(strtolower($_POST['siswa_act_nama']));
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id_kota' => $id]);
    $exec .= update($koneksi, 'f_siswa', $f_siswa, ['siswa_id_kota' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Akte Lahir " . $nama_update . " Berhasil",
            // 'icon1'          => $f_siswa,
            // 'icon2'          => $f_siswa_act,
            // 'icon3'          => $f_siswa_full,
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Akte Lahir " . $nama_update . " Gagal Bos",
        ];
        echo json_encode($response);
    }
}

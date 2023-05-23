<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

if ($pg == 'FormEditKesehatanEdit') {
    $f_siswa_act_update = [
        'health_hepatitis_b'    => (isset($_POST['health_hepatitis_b'])) ? 'Y' : 'N',
        'health_bcg'            => (isset($_POST['health_bcg'])) ? 'Y' : 'N',
        'health_dpt'            => (isset($_POST['health_dpt'])) ? 'Y' : 'N',
        'health_polio'          => (isset($_POST['health_polio'])) ? 'Y' : 'N',
        'health_campak'         => (isset($_POST['health_campak'])) ? 'Y' : 'N',
        'health_covid_one'      => (isset($_POST['health_covid_one'])) ? 'Y' : 'N',
        'health_covid_two'      => (isset($_POST['health_covid_two'])) ? 'Y' : 'N',
        'health_booster_one'    => (isset($_POST['health_booster_one'])) ? 'Y' : 'N',
        'health_booster_two'    => (isset($_POST['health_booster_two'])) ? 'Y' : 'N',
    ];
    $id = $_POST['siswa_id'];
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act_update, ['siswa_id' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Imunisasi Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Imunisasi Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'FormModalAddImmunizationAdd') {
    if (!empty($_POST['add_kes_nama'])) {
        $f_siswa_act_add = [
            'siswa_id'              => $_POST['siswa_id'],
            'siswa_nis'             => $_POST['siswa_nis'],
            'add_kes_nama'          => $_POST['add_kes_nama'],
        ];
        $addd_exec = insert($koneksi, 'f_add_kesehatan', $f_siswa_act_add);
        if ($addd_exec) {
            $response = [
                'status'        => 201,
                'icon'          => "success",
                'message'       => "Insert Data Imunisasi Berhasil",
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status'        => 500,
                'icon'          => "error",
                'message'       => "Insert Data Imunisasi Gagal Bos",
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'status'        => 300,
            'icon'          => "error",
            'message'       => "Nama Vaksin Tidak Boleh Kosong",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'DeleteFormKesehatanAdd') {
    $add_kes_id = $_POST['id'];
    delete($koneksi, 'f_add_kesehatan', ['add_kes_id' => $add_kes_id]);
}

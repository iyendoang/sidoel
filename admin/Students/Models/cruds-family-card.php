<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

if ($pg == 'FormSiswaKKEdit') {
    $siswa_kk_kepala = str_replace("'", "`", $_POST['siswa_kk_kepala']);
    $siswa_kk_alamat = str_replace("'", "`", $_POST['siswa_kk_alamat']);
    $siswa_kk_nama = str_replace("'", "`", $_POST['siswa_kk_nama']);
    $siswa_kk_tempat = str_replace("'", "`", $_POST['siswa_kk_tempat']);
    $f_siswa_act = [
        // data siswa
        'siswa_kk_nomor'             => $_POST['siswa_kk_nomor'],
        'siswa_kk_kepala'            => ucwords(strtolower($siswa_kk_kepala)),
        'siswa_kk_rt'                => $_POST['siswa_kk_rt'],
        'siswa_kk_rw'                => $_POST['siswa_kk_rw'],
        'siswa_kk_alamat'            => ucwords(strtolower($siswa_kk_alamat)),
        'siswa_kk_kodepos'           => $_POST['siswa_kk_kodepos'],
        'siswa_kk_provinsi'          => $_POST['siswa_kk_provinsi'],
        'siswa_kk_kota'              => $_POST['siswa_kk_kota'],
        'siswa_kk_kecamatan'         => $_POST['siswa_kk_kecamatan'],
        'siswa_kk_kelurahan'         => $_POST['siswa_kk_kelurahan'],
        'siswa_kk_nama'              => ucwords(strtolower($siswa_kk_nama)),
        'siswa_kk_wn'                => $_POST['siswa_kk_wn'],
        'siswa_kk_nik'               => $_POST['siswa_kk_nik'],
        'siswa_kk_tempat'            => ucwords(strtolower($siswa_kk_tempat)),
        'siswa_kk_tgllahir'          => $_POST['siswa_kk_tgllahir'],
        'siswa_kk_anakke'            => $_POST['siswa_kk_anakke'],
        'siswa_kk_jmlsaudara'        => $_POST['siswa_kk_jmlsaudara'],
        'siswa_kk_darah'             => $_POST['siswa_kk_darah'],
        // data ayah
        'ayah_kk_nama'               => str_replace("'", "`", ucwords(strtolower($_POST['ayah_kk_nama']))),
        'ayah_kk_status'             => $_POST['ayah_kk_status'],
        'ayah_kk_wn'                 => $_POST['ayah_kk_wn'],
        'ayah_kk_nik'                => $_POST['ayah_kk_nik'],
        'ayah_kk_tempat'             => str_replace("'", "`", ucwords(strtolower($_POST['ayah_kk_tempat']))),
        'ayah_kk_tgllahir'           => $_POST['ayah_kk_tgllahir'],
        'ayah_kk_pendidikan'         => $_POST['ayah_kk_pendidikan'],
        'ayah_kk_pekerjaan'          => $_POST['ayah_kk_pekerjaan'],
        'ayah_kk_penghasilan'        => $_POST['ayah_kk_penghasilan'],
        'ayah_kk_hp'                 => $_POST['ayah_kk_hp'],
        // data ibu
        'ibu_kk_nama'               => str_replace("'", "`", ucwords(strtolower($_POST['ibu_kk_nama']))),
        'ibu_kk_status'             => $_POST['ibu_kk_status'],
        'ibu_kk_wn'                 => $_POST['ibu_kk_wn'],
        'ibu_kk_nik'                => $_POST['ibu_kk_nik'],
        'ibu_kk_tempat'             => str_replace("'", "`", ucwords(strtolower($_POST['ibu_kk_tempat']))),
        'ibu_kk_tgllahir'           => $_POST['ibu_kk_tgllahir'],
        'ibu_kk_pendidikan'         => $_POST['ibu_kk_pendidikan'],
        'ibu_kk_pekerjaan'          => $_POST['ibu_kk_pekerjaan'],
        'ibu_kk_penghasilan'        => $_POST['ibu_kk_penghasilan'],
        'ibu_kk_hp'                 => $_POST['ibu_kk_hp'],
        // data wali
        'siswa_wali_hubungan'        => $_POST['siswa_wali_hubungan'],
        'wali_kk_nama'               => str_replace("'", "`", ucwords(strtolower($_POST['wali_kk_nama']))),
        'wali_kk_wn'                 => $_POST['wali_kk_wn'],
        'wali_kk_nik'                => $_POST['wali_kk_nik'],
        'wali_kk_tempat'             => str_replace("'", "`", ucwords(strtolower($_POST['wali_kk_tempat']))),
        'wali_kk_tgllahir'           => $_POST['wali_kk_tgllahir'],
        'wali_kk_pendidikan'         => $_POST['wali_kk_pendidikan'],
        'wali_kk_pekerjaan'          => $_POST['wali_kk_pekerjaan'],
        'wali_kk_penghasilan'        => $_POST['wali_kk_penghasilan'],
        'wali_kk_hp'                 => $_POST['wali_kk_hp'],
    ];
    $f_siswa = [];
    $id = $_POST['siswa_id'];
    $nama_update = ucfirst(strtolower($_POST['siswa_kk_nama']));
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Akte Lahir " . $nama_update . " Berhasil",
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

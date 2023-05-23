<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'FormEditResidenceEdit') {
    $id = $_POST['siswa_id'];
    $siswa_wali_hubungan = $_POST['siswa_wali_hubungan'];
    if ($siswa_wali_hubungan == 1) {
        $f_siswa_act = [
            // data siswa
            'siswa_dom_statusrumah'             => $_POST['siswa_dom_statusrumah'],
            'siswa_dom_jarak'                   => $_POST['siswa_dom_jarak'],
            'siswa_dom_waktu'                   => $_POST['siswa_dom_waktu'],
            'siswa_dom_transportasi'            => $_POST['siswa_dom_transportasi'],
            'siswa_dom_statusalamat'            => $_POST['siswa_dom_statusalamat'],
            'siswa_dom_provinsi'                => $_POST['siswa_dom_provinsi'],
            'siswa_dom_kota'                    => $_POST['siswa_dom_kota'],
            'siswa_dom_kecamatan'               => $_POST['siswa_dom_kecamatan'],
            'siswa_dom_kelurahan'               => $_POST['siswa_dom_kelurahan'],
            'siswa_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['siswa_dom_alamat']))),
            'siswa_dom_rt'                      => $_POST['siswa_dom_rt'],
            'siswa_dom_rw'                      => $_POST['siswa_dom_rw'],
            'siswa_dom_kodepos'                 => $_POST['siswa_dom_kodepos'],
            //ayah
            'ayah_dom_statusalamat'            => $_POST['ayah_dom_statusalamat'],
            'ayah_dom_provinsi'                => $_POST['ayah_dom_provinsi'],
            'ayah_dom_kota'                    => $_POST['ayah_dom_kota'],
            'ayah_dom_kecamatan'               => $_POST['ayah_dom_kecamatan'],
            'ayah_dom_kelurahan'               => $_POST['ayah_dom_kelurahan'],
            'ayah_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['ayah_dom_alamat']))),
            'ayah_dom_rt'                      => $_POST['ayah_dom_rt'],
            'ayah_dom_rw'                      => $_POST['ayah_dom_rw'],
            'ayah_dom_kodepos'                 => $_POST['ayah_dom_kodepos'],
            //ibu
            'ibu_dom_statusalamat'            => $_POST['ibu_dom_statusalamat'],
            'ibu_dom_provinsi'                => $_POST['ibu_dom_provinsi'],
            'ibu_dom_kota'                    => $_POST['ibu_dom_kota'],
            'ibu_dom_kecamatan'               => $_POST['ibu_dom_kecamatan'],
            'ibu_dom_kelurahan'               => $_POST['ibu_dom_kelurahan'],
            'ibu_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['ibu_dom_alamat']))),
            'ibu_dom_rt'                      => $_POST['ibu_dom_rt'],
            'ibu_dom_rw'                      => $_POST['ibu_dom_rw'],
            'ibu_dom_kodepos'                 => $_POST['ibu_dom_kodepos'],
            //wali
            'wali_dom_statusalamat'            => $_POST['ayah_dom_statusalamat'],
            'wali_dom_provinsi'                => $_POST['ayah_dom_provinsi'],
            'wali_dom_kota'                    => $_POST['ayah_dom_kota'],
            'wali_dom_kecamatan'               => $_POST['ayah_dom_kecamatan'],
            'wali_dom_kelurahan'               => $_POST['ayah_dom_kelurahan'],
            'wali_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['ayah_dom_alamat']))),
            'wali_dom_rt'                      => $_POST['ayah_dom_rt'],
            'wali_dom_rw'                      => $_POST['ayah_dom_rw'],
            'wali_dom_kodepos'                 => $_POST['ayah_dom_kodepos'],
        ];
    } elseif ($siswa_wali_hubungan == 2) {
        $f_siswa_act = [
            // data siswa
            'siswa_dom_statusrumah'             => $_POST['siswa_dom_statusrumah'],
            'siswa_dom_jarak'                   => $_POST['siswa_dom_jarak'],
            'siswa_dom_waktu'                   => $_POST['siswa_dom_waktu'],
            'siswa_dom_transportasi'            => $_POST['siswa_dom_transportasi'],
            'siswa_dom_statusalamat'            => $_POST['siswa_dom_statusalamat'],
            'siswa_dom_provinsi'                => $_POST['siswa_dom_provinsi'],
            'siswa_dom_kota'                    => $_POST['siswa_dom_kota'],
            'siswa_dom_kecamatan'               => $_POST['siswa_dom_kecamatan'],
            'siswa_dom_kelurahan'               => $_POST['siswa_dom_kelurahan'],
            'siswa_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['siswa_dom_alamat']))),
            'siswa_dom_rt'                      => $_POST['siswa_dom_rt'],
            'siswa_dom_rw'                      => $_POST['siswa_dom_rw'],
            'siswa_dom_kodepos'                 => $_POST['siswa_dom_kodepos'],
            //ayah
            'ayah_dom_statusalamat'            => $_POST['ayah_dom_statusalamat'],
            'ayah_dom_provinsi'                => $_POST['ayah_dom_provinsi'],
            'ayah_dom_kota'                    => $_POST['ayah_dom_kota'],
            'ayah_dom_kecamatan'               => $_POST['ayah_dom_kecamatan'],
            'ayah_dom_kelurahan'               => $_POST['ayah_dom_kelurahan'],
            'ayah_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['ayah_dom_alamat']))),
            'ayah_dom_rt'                      => $_POST['ayah_dom_rt'],
            'ayah_dom_rw'                      => $_POST['ayah_dom_rw'],
            'ayah_dom_kodepos'                 => $_POST['ayah_dom_kodepos'],
            //ibu
            'ibu_dom_statusalamat'            => $_POST['ibu_dom_statusalamat'],
            'ibu_dom_provinsi'                => $_POST['ibu_dom_provinsi'],
            'ibu_dom_kota'                    => $_POST['ibu_dom_kota'],
            'ibu_dom_kecamatan'               => $_POST['ibu_dom_kecamatan'],
            'ibu_dom_kelurahan'               => $_POST['ibu_dom_kelurahan'],
            'ibu_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['ibu_dom_alamat']))),
            'ibu_dom_rt'                      => $_POST['ibu_dom_rt'],
            'ibu_dom_rw'                      => $_POST['ibu_dom_rw'],
            'ibu_dom_kodepos'                 => $_POST['ibu_dom_kodepos'],
            //wali
            'wali_dom_statusalamat'            => $_POST['ibu_dom_statusalamat'],
            'wali_dom_provinsi'                => $_POST['ibu_dom_provinsi'],
            'wali_dom_kota'                    => $_POST['ibu_dom_kota'],
            'wali_dom_kecamatan'               => $_POST['ibu_dom_kecamatan'],
            'wali_dom_kelurahan'               => $_POST['ibu_dom_kelurahan'],
            'wali_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['ibu_dom_alamat']))),
            'wali_dom_rt'                      => $_POST['ibu_dom_rt'],
            'wali_dom_rw'                      => $_POST['ibu_dom_rw'],
            'wali_dom_kodepos'                 => $_POST['ibu_dom_kodepos'],
        ];
    } else {
        $f_siswa_act = [
            // data siswa
            'siswa_dom_statusrumah'             => $_POST['siswa_dom_statusrumah'],
            'siswa_dom_jarak'                   => $_POST['siswa_dom_jarak'],
            'siswa_dom_waktu'                   => $_POST['siswa_dom_waktu'],
            'siswa_dom_transportasi'            => $_POST['siswa_dom_transportasi'],
            'siswa_dom_statusalamat'            => $_POST['siswa_dom_statusalamat'],
            'siswa_dom_provinsi'                => $_POST['siswa_dom_provinsi'],
            'siswa_dom_kota'                    => $_POST['siswa_dom_kota'],
            'siswa_dom_kecamatan'               => $_POST['siswa_dom_kecamatan'],
            'siswa_dom_kelurahan'               => $_POST['siswa_dom_kelurahan'],
            'siswa_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['siswa_dom_alamat']))),
            'siswa_dom_rt'                      => $_POST['siswa_dom_rt'],
            'siswa_dom_rw'                      => $_POST['siswa_dom_rw'],
            'siswa_dom_kodepos'                 => $_POST['siswa_dom_kodepos'],
            //ayah
            'ayah_dom_statusalamat'            => $_POST['ayah_dom_statusalamat'],
            'ayah_dom_provinsi'                => $_POST['ayah_dom_provinsi'],
            'ayah_dom_kota'                    => $_POST['ayah_dom_kota'],
            'ayah_dom_kecamatan'               => $_POST['ayah_dom_kecamatan'],
            'ayah_dom_kelurahan'               => $_POST['ayah_dom_kelurahan'],
            'ayah_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['ayah_dom_alamat']))),
            'ayah_dom_rt'                      => $_POST['ayah_dom_rt'],
            'ayah_dom_rw'                      => $_POST['ayah_dom_rw'],
            'ayah_dom_kodepos'                 => $_POST['ayah_dom_kodepos'],
            //ibu
            'ibu_dom_statusalamat'            => $_POST['ibu_dom_statusalamat'],
            'ibu_dom_provinsi'                => $_POST['ibu_dom_provinsi'],
            'ibu_dom_kota'                    => $_POST['ibu_dom_kota'],
            'ibu_dom_kecamatan'               => $_POST['ibu_dom_kecamatan'],
            'ibu_dom_kelurahan'               => $_POST['ibu_dom_kelurahan'],
            'ibu_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['ibu_dom_alamat']))),
            'ibu_dom_rt'                      => $_POST['ibu_dom_rt'],
            'ibu_dom_rw'                      => $_POST['ibu_dom_rw'],
            'ibu_dom_kodepos'                 => $_POST['ibu_dom_kodepos'],
            //wali
            'wali_dom_statusalamat'            => $_POST['wali_dom_statusalamat'],
            'wali_dom_provinsi'                => $_POST['wali_dom_provinsi'],
            'wali_dom_kota'                    => $_POST['wali_dom_kota'],
            'wali_dom_kecamatan'               => $_POST['wali_dom_kecamatan'],
            'wali_dom_kelurahan'               => $_POST['wali_dom_kelurahan'],
            'wali_dom_alamat'                  => str_replace("'", "`", ucwords(strtolower($_POST['wali_dom_alamat']))),
            'wali_dom_rt'                      => $_POST['wali_dom_rt'],
            'wali_dom_rw'                      => $_POST['wali_dom_rw'],
            'wali_dom_kodepos'                 => $_POST['wali_dom_kodepos'],
        ];
    }
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Akte Lahir  Berhasil",
            'value'         => $exec,
            'value2'         => $f_siswa_act,
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Akte Lahir  Gagal Bos",
        ];
        echo json_encode($response);
    }
}

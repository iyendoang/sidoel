<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'edit_istitution_detail') {
    $lembaga_nama = str_replace("'", "`", $_POST['lembaga_nama']);
    $lembaga_no_siop = str_replace("'", "`", $_POST['lembaga_no_siop']);
    $lembaga_no_akre = str_replace("'", "`", $_POST['lembaga_no_akre']);
    $data = [
        'lembaga_id'                  => $_POST['lembaga_id'],
        'lembaga_nsm'                 => $_POST['lembaga_nsm'],
        'lembaga_nama'                 => $_POST['lembaga_nama'],
        'lembaga_npsn'                => $_POST['lembaga_npsn'],
        'jenjang_id'                  => $_POST['jenjang_id'],
        'lembaga_status'              => $_POST['lembaga_status'],
        'lembaga_nama'                => ucwords(strtoupper($lembaga_nama)),
        'lembaga_no_siop'             => $lembaga_no_siop,
        'lembaga_tgl_siop'            => $_POST['lembaga_tgl_siop'],
        'lembaga_siopstatus'          => $_POST['lembaga_siopstatus'],
        'lembaga_siop_end'            => $_POST['lembaga_siop_end'],
        'lembaga_akre'                => $_POST['lembaga_akre'],
        'lembaga_nilai_akre'          => $_POST['lembaga_nilai_akre'],
        'lembaga_tgl_akre'            => $_POST['lembaga_tgl_akre'],
        'lembaga_tgl_akre_end'        => $_POST['lembaga_tgl_akre_end'],
        'lembaga_no_akre'             => $lembaga_no_akre,
        'lembaga_thnberdiri'          => $_POST['lembaga_thnberdiri'],
        'lembaga_npwp'                => $_POST['lembaga_npwp'],
        'lembaga_link_rdm'            => $_POST['lembaga_link_rdm'],
    ];
    $id = $_POST['lembaga_id'];
    $exec = update($koneksi, 't_lembaga', $data, ['lembaga_id' => $id]);
    if ($exec) {
        $pesan = [
            'pesan'     => 'ok',
            'status'    => 200,
            'message' => 'Update Profile Lembaga Berhasil',
        ];
        echo json_encode($pesan);
    } else {
        $pesan = [
            'pesan'     => 'error',
            'status'    => 300,
            'message' => 'Update Profile Lembaga Gagal',
        ];
        echo json_encode($pesan);
    }
}
if ($pg == 'editAddress') {
    $lembaga_alamat = str_replace("'", "`", $_POST['lembaga_alamat']);
    $lembaga_web = str_replace("'", "`", $_POST['lembaga_web']);
    $lembaga_email = str_replace("'", "`", $_POST['lembaga_email']);
    if (!preg_match('/[^+0-9]/', trim($_POST['lembaga_notelp']))) {
        // cek apakah no post_notelp karakter 1-3 adalah +62
        if (substr(trim($_POST['lembaga_notelp']), 0, 2) == '62') {
            $post_notelp = trim($_POST['lembaga_notelp']);
        }
        // cek apakah no post_notelp karakter 1 adalah 0
        elseif (substr(trim($_POST['lembaga_notelp']), 0, 1) == '0') {
            $post_notelp = '62' . substr(trim($_POST['lembaga_notelp']), 1);
        }
    }
    $data = [
        'lembaga_provinsi'            => $_POST['lembaga_provinsi'],
        'lembaga_kota'                => $_POST['lembaga_kota'],
        'lembaga_kec'                 => $_POST['lembaga_kec'],
        'lembaga_kel'                 => $_POST['lembaga_kel'],
        'lembaga_alamat'              => ucwords(strtolower($lembaga_alamat)),
        'lembaga_rt'                  => $_POST['lembaga_rt'],
        'lembaga_rw'                  => $_POST['lembaga_rw'],
        'lembaga_kodepos'             => $_POST['lembaga_kodepos'],
        'lembaga_notelp'              => $post_notelp,
        'lembaga_web'                 => strtolower($lembaga_web),
        'lembaga_email'               => strtolower($lembaga_email),
    ];
    $id = $_POST['lembaga_id'];
    $exec = update($koneksi, 't_lembaga', $data, ['lembaga_id' => $id]);
    if ($exec) {
        $pesan = [
            'pesan'     => 'ok',
            'status'    => 200,
            'message' => 'Update Alamat Lembaga Berhasil',
        ];
        echo json_encode($pesan);
    } else {
        $pesan = [
            'pesan'     => 'error',
            'status'    => 300,
            'message' => 'Update Alamat Lembaga Gagal',
        ];
        echo json_encode($pesan);
    }
}
if ($pg == 'editLeader') {
    $lembaga_kamad = str_replace("'", "`", $_POST['lembaga_kamad']);
    $lembaga_operator = str_replace("'", "`", $_POST['lembaga_operator']);
    $lembaga_pengawas = str_replace("'", "`", $_POST['lembaga_pengawas']);
    $lembaga_kasie = str_replace("'", "`", $_POST['lembaga_kasie']);
    $lembaga_komite = str_replace("'", "`", $_POST['lembaga_komite']);
    if (!preg_match('/[^+0-9]/', trim($_POST['lembaga_kamad_notelp']))) {
        // cek apakah no post_notelp karakter 1-3 adalah +62
        if (substr(trim($_POST['lembaga_kamad_notelp']), 0, 2) == '62') {
            $lembaga_kamad_notelp = trim($_POST['lembaga_kamad_notelp']);
        }
        // cek apakah no post_notelp karakter 1 adalah 0
        elseif (substr(trim($_POST['lembaga_kamad_notelp']), 0, 1) == '0') {
            $lembaga_kamad_notelp = '62' . substr(trim($_POST['lembaga_kamad_notelp']), 1);
        }
    }
    if (!preg_match('/[^+0-9]/', trim($_POST['lembaga_operator_notelp']))) {
        // cek apakah no post_notelp karakter 1-3 adalah +62
        if (substr(trim($_POST['lembaga_operator_notelp']), 0, 2) == '62') {
            $lembaga_operator_notelp = trim($_POST['lembaga_operator_notelp']);
        }
        // cek apakah no post_notelp karakter 1 adalah 0
        elseif (substr(trim($_POST['lembaga_operator_notelp']), 0, 1) == '0') {
            $lembaga_operator_notelp = '62' . substr(trim($_POST['lembaga_operator_notelp']), 1);
        }
    }
    $data = [
        'lembaga_kamad'               => ucwords(strtolower($lembaga_kamad)),
        'lembaga_nip_kamad'           => $_POST['lembaga_nip_kamad'],
        'lembaga_kamad_notelp'        => $lembaga_kamad_notelp,
        'lembaga_operator'            => ucwords(strtolower($lembaga_operator)),
        'lembaga_nip_operator'        => $_POST['lembaga_nip_operator'],
        'lembaga_operator_notelp'     => $lembaga_operator_notelp,
        'lembaga_pengawas'            => ucwords(strtolower($lembaga_pengawas)),
        'lembaga_nip_pengawas'        => $_POST['lembaga_nip_pengawas'],
        'lembaga_operator_notelp'     => $lembaga_operator_notelp,
        'lembaga_kasie'               => ucwords(strtolower($lembaga_kasie)),
        'lembaga_nip_kasie'           => $_POST['lembaga_nip_kasie'],
        'lembaga_komite'              => ucwords(strtolower($lembaga_komite)),
        'lembaga_nip_komite'          => $_POST['lembaga_nip_komite'],
    ];
    $id = $_POST['lembaga_id'];
    $exec = update($koneksi, 't_lembaga', $data, ['lembaga_id' => $id]);
    if ($exec) {
        $pesan = [
            'pesan'     => 'ok',
            'status'    => 200,
            'message' => 'Update Pimpinan Lembaga Berhasil',
        ];
        echo json_encode($pesan);
    } else {
        $pesan = [
            'pesan'     => 'error',
            'status'    => 300,
            'message' => 'Update Pimpinan Lembaga Gagal',
        ];
        echo json_encode($pesan);
    }
}
if ($pg == 'editFoundation') {
    $LY_noakta = str_replace("'", "`", $_POST['LY_noakta']);
    $LY_namanotaris = str_replace("'", "`", $_POST['LY_namanotaris']);
    $LY_noakta_update = str_replace("'", "`", $_POST['LY_noakta_update']);
    $LY_namaakta_update = str_replace("'", "`", $_POST['LY_namaakta_update']);
    $LY_sk_kemenkumham = str_replace("'", "`", $_POST['LY_sk_kemenkumham']);
    $LY_namaakta_update = str_replace("'", "`", $_POST['LY_namaakta_update']);
    $data = [
        'LY_noakta'                   => ucwords(strtolower($LY_noakta)),
        'LY_tglakta'                  => $_POST['LY_tglakta'],
        'LY_namanotaris'              => ucwords(strtoupper($LY_namanotaris)),
        'LY_noakta_update'            => ucwords(strtolower($LY_noakta_update)),
        'LY_tglakta_update'           => $_POST['LY_tglakta_update'],
        'LY_namaakta_update'          => ucwords(strtolower($LY_namaakta_update)),
        'LY_sk_kemenkumham'           => ucwords(strtolower($LY_sk_kemenkumham)),
        'LY_tgl_kemenkumham'          => $_POST['LY_tgl_kemenkumham'],
    ];
    $id = $_POST['lembaga_id'];
    $exec = update($koneksi, 't_lembaga', $data, ['lembaga_id' => $id]);
    if ($exec) {
        $pesan = [
            'pesan'     => 'ok',
            'status'    => 200,
            'message' => 'Update Data Hukum Lembaga Berhasil',
        ];
        echo json_encode($pesan);
    } else {
        $pesan = [
            'pesan'     => 'error',
            'status'    => 300,
            'message' => 'Update Data Hukum Lembaga Gagal',
        ];
        echo json_encode($pesan);
    }
}
if ($pg == 'FormL_tglkartupelajar') {
    $data = [
        'L_tglkartupelajar'                  => $_POST['L_tglkartupelajar'],
    ];
    $id = $_POST['lembaga_id'];
    $exec = update($koneksi, 't_lembaga', $data, ['lembaga_id' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Tanggal Cetak Kartu Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Gagal Bos",
        ];
        echo json_encode($response);
    }
}

<?php

require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");


if ($pg == 'storeControllers') {
    $q_reg = "SELECT max(ppdbregist_number) as maxKode FROM t_ppdbregist";
    $r_reg = mysqli_query($koneksi, $q_reg);
    $data = mysqli_fetch_array($r_reg);
    $code_regist = $data['maxKode'];
    $num_reg = (int) substr($code_regist, 8, 4);
    $num_reg++;
    $char = "PPDB" . date('Y');
    $code_regist = $char . sprintf("%04s", $num_reg);
    $ppdbregist_name = str_replace("'", "`", $_POST['ppdbregist_name']);
    $ppdbregist_tempat = str_replace("'", "`", $_POST['ppdbregist_tempat']);
    if (!preg_match('/[^+0-9]/', trim($_POST['ppdbregist_nohp']))) {
        if (substr(trim($_POST['ppdbregist_nohp']), 0, 2) == '62') {
            $post_ppdbregist_nohp = trim($_POST['ppdbregist_nohp']);
        } elseif (substr(trim($_POST['ppdbregist_nohp']), 0, 1) == '0') {
            $post_ppdbregist_nohp = '62' . substr(trim($_POST['ppdbregist_nohp']), 1);
        } elseif (substr(trim($_POST['ppdbregist_nohp']), 0, 1) == '') {
            $post_ppdbregist_nohp = '';
        } else {
            $post_ppdbregist_nohp =  $_POST['ppdbregist_nohp'];
        }
    }
    $t_ppdbregist = [
        'tahunajaran_id'         => $_POST['tahunajaran_id'],
        'ppdbjurusan_id'      => $_POST['ppdbjurusan_id'],
        'ppdbregist_number'      => $code_regist,
        'ppdbregist_name'        => strtoupper($ppdbregist_name),
        'ppdbregist_gender'      => $_POST['ppdbregist_gender'],
        'ppdbregist_tempat'      => strtoupper($ppdbregist_tempat),
        'ppdbregist_tgllahir'    => $_POST['ppdbregist_tgllahir'],
        'ppdbregist_nisn'        => $_POST['ppdbregist_nisn'],
        'ppdbregist_nokk'        => $_POST['ppdbregist_nokk'],
        'ppdbregist_nik'         => $_POST['ppdbregist_nik'],
        'ppdbregist_nohp'        => $post_ppdbregist_nohp,
        'password'               => $_POST['password'],
        'ppdbregist_actived'     => 1,
    ];
    $q_nisn = mysqli_query($koneksi, "SELECT * FROM t_ppdbregist where ppdbregist_nisn='$_POST[ppdbregist_nisn]'");
    $cek_nisn = mysqli_num_rows($q_nisn);
    if ($cek_nisn == 0) {
        $q_nik = mysqli_query($koneksi, "SELECT * FROM t_ppdbregist where ppdbregist_nik='$_POST[ppdbregist_nik]'");
        $cek_nik = mysqli_num_rows($q_nik);
        if ($cek_nik == 0) {
            $res_jur = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_ppdbjurusan where ppdbjurusan_id='$_POST[ppdbjurusan_id]'"));
            $q_jur = mysqli_query($koneksi, "SELECT * FROM t_ppdbregist where ppdbjurusan_id='$_POST[ppdbjurusan_id]'");
            $cek_jur = mysqli_num_rows($q_jur);
            if ($cek_jur >= $res_jur['ppdbjurusan_kuota']) {
                $response = [
                    'status'        => 500,
                    'title_message' => "Ooops..!",
                    'icon'          => "error",
                    'message'       => "Kuota jurusan sudah terpenuhi",
                ];
                echo json_encode($response);
            } else {
                $add_exec = insert($koneksi, 't_ppdbregist', $t_ppdbregist);
                if ($add_exec == true) {
                    $response = [
                        'status'        => 200,
                        'title_message' => "Sukses",
                        'icon'          => "success",
                        'message'       => "Insert Data Berhasil",
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        'status'        => 500,
                        'title_message' => "Ooops..!",
                        'icon'          => "error",
                        'message'       => "Gagal Yang tidak bisa disebutkan",
                    ];
                    echo json_encode($response);
                }
            }
        } else {
            $response = [
                'status'        => 300,
                'title_message' => "Ooops..!",
                'icon'          => "error",
                'message'       => "NIK Sudah dimiliki pendaftar lain",
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'status'        => 300,
            'title_message' => "Ooops..!",
            'icon'          => "error",
            'message'       => "NISN Sudah dimiliki pendaftar lain",
        ];
        echo json_encode($response);
    }
}
// if ($pg == 'storeControllers') {
//     $q_reg = "SELECT max(ppdbregist_number) as maxKode FROM t_ppdbregist";
//     $r_reg = mysqli_query($koneksi, $q_reg);
//     $data = mysqli_fetch_array($r_reg);
//     $code_regist = $data['maxKode'];
//     $num_reg = (int) substr($code_regist, 8, 4);
//     $num_reg++;
//     $char = "PPDB" . date('Y');
//     $code_regist = $char . sprintf("%04s", $num_reg);
//     $ppdbregist_name = str_replace("'", "`", $_POST['ppdbregist_name']);
//     $ppdbregist_tempat = str_replace("'", "`", $_POST['ppdbregist_tempat']);
//     if (!preg_match('/[^+0-9]/', trim($_POST['ppdbregist_nohp']))) {
//         if (substr(trim($_POST['ppdbregist_nohp']), 0, 2) == '62') {
//             $post_ppdbregist_nohp = trim($_POST['ppdbregist_nohp']);
//         } elseif (substr(trim($_POST['ppdbregist_nohp']), 0, 1) == '0') {
//             $post_ppdbregist_nohp = '62' . substr(trim($_POST['ppdbregist_nohp']), 1);
//         } elseif (substr(trim($_POST['ppdbregist_nohp']), 0, 1) == '') {
//             $post_ppdbregist_nohp = '';
//         } else {
//             $post_ppdbregist_nohp =  $_POST['ppdbregist_nohp'];
//         }
//     }
//     $t_ppdbregist = [
//         'tahunajaran_id'         => $_POST['tahunajaran_id'],
//         'ppdbjurusan_id'      => $_POST['ppdbjurusan_id'],
//         'ppdbregist_number'      => $code_regist,
//         'ppdbregist_name'        => strtoupper($ppdbregist_name),
//         'ppdbregist_gender'      => $_POST['ppdbregist_gender'],
//         'ppdbregist_tempat'      => strtoupper($ppdbregist_tempat),
//         'ppdbregist_tgllahir'    => $_POST['ppdbregist_tgllahir'],
//         'ppdbregist_nisn'        => $_POST['ppdbregist_nisn'],
//         'ppdbregist_nokk'        => $_POST['ppdbregist_nokk'],
//         'ppdbregist_nik'         => $_POST['ppdbregist_nik'],
//         'ppdbregist_nohp'        => $post_ppdbregist_nohp,
//         'password'               => $_POST['password'],
//         'ppdbregist_actived'     => 0,
//     ];
//     $q_nisn = mysqli_query($koneksi, "SELECT * FROM t_ppdbregist where ppdbregist_nisn='$_POST[ppdbregist_nisn]'");
//     $cek_nisn = mysqli_num_rows($q_nisn);
//     if ($cek_nisn == 0) {
//         $q_nik = mysqli_query($koneksi, "SELECT * FROM t_ppdbregist where ppdbregist_nik='$_POST[ppdbregist_nik]'");
//         $cek_nik = mysqli_num_rows($q_nik);
//         if ($cek_nik == 0) {
//             $add_exec = insert($koneksi, 't_ppdbregist', $t_ppdbregist);
//             if ($add_exec) {
//                 $response = [
//                     'status'        => 200,
//                     'title_message' => "Sukses",
//                     'icon'          => "success",
//                     'message'       => "Pendaftaran berhasil silahkan login username:" . $_POST['password'] . " pasword: " . $_POST['password'] . " untuk melengkapi data anda ",
//                 ];
//                 echo json_encode($response);
//             } else {
//                 $response = [
//                     'status'        => 500,
//                     'title_message' => "Ooops..!",
//                     'icon'          => "error",
//                     'message'       => "Pendafaran gagal silahkan cek kembali data anda",
//                 ];
//                 echo json_encode($response);
//             }
//         } else {
//             $response = [
//                 'status'        => 300,
//                 'title_message' => "Ooops..!",
//                 'icon'          => "error",
//                 'message'       => "NIK Sudah dimiliki pendaftar lain",
//             ];
//             echo json_encode($response);
//         }
//     } else {
//         $response = [
//             'status'        => 300,
//             'title_message' => "Ooops..!",
//             'icon'          => "error",
//             'message'       => "NISN Sudah dimiliki pendaftar lain",
//         ];
//         echo json_encode($response);
//     }
// }
if ($pg == 'showSelectTahunajaran') {
    $query = "SELECT * FROM t_ppdbperiode a 
    LEFT JOIN e_tahunajaran b ON a.tahunajaran_id = b.tahunajaran_id
            WHERE a.ppdbperiode_actived = 1
            ORDER BY a.tahunajaran_id DESC
    ";
    $query = $koneksi->prepare($query);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['tahunajaran_id'] . "'>" . $row['tahunajaran_nama'] . "</option>";
    }
}
if ($pg == 'showSelectJurusan') {
    $query = "SELECT * FROM t_ppdbjurusan a 
                WHERE a.ppdbjurusan_actived = 1
                ORDER BY a.ppdbjurusan_id ASC
    ";
    $query = $koneksi->prepare($query);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['ppdbjurusan_id'] . "'>" . $row['ppdbjurusan_name'] . "</option>";
    }
}

<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['users_id'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
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
            $post_siswa_act_hp = '' . substr(trim($_POST['siswa_act_hp']), 1);
        } else {
            $post_siswa_act_hp = '';
        }
    }
    $f_siswa_act = [
        'siswa_act_nama'            => ucwords(strtoupper($siswa_act_nama)),
        'siswa_act_nis'             => $_POST['siswa_act_nis'],
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
        'siswa_nama'            => ucwords(strtoupper($siswa_act_nama)),
        'siswa_nis'             => $_POST['siswa_act_nis'],
        'siswa_nisn'            => $_POST['siswa_act_nisn'],
        'tingkat_id'            => $_POST['siswa_act_tingkat'],
        'siswa_gender'          => $_POST['siswa_act_gender'],
        'siswa_telpon'          => $post_siswa_act_hp,
    ];
    $id = $_POST['siswa_id_kota'];
    $nama_update = ucfirst(strtolower($_POST['siswa_act_nama']));
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id_kota' => $id]);
    $exec .= update($koneksi, 'f_siswa', $f_siswa, ['siswa_id_kota' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'        => "success",
            'message'       => "Update Data Akte Lahir " . $nama_update . " Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'        => "error",
            'message'       => "Update Data Akte Lahir " . $nama_update . " Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'f_siswa_aktaEdit') {
    if ($_FILES['siswa_akta_file']['name'] <> '') {
        if (!empty($_POST["siswa_akta_nama"])) {
            $siswa_akta_nama = $_POST['siswa_akta_nama'];
            $siswa_nsm = $_POST['siswa_nsm'];
            $name_siswa_akta_file = $_FILES["siswa_akta_file"]["name"];
            $ext_siswa_akta_file = explode(".", $name_siswa_akta_file);
            $ext_siswa_akta_file = end($ext_siswa_akta_file);
            $size_siswa_akta_file = $_FILES["siswa_akta_file"]["size"];
            $allowed_ext = array("png", "jpg", "jpeg");
            $temp = "../../../tmp/file-siswa/" . $siswa_nsm;
            if (!file_exists($temp))
                mkdir($temp, 0777, true);
            if ($size_siswa_akta_file < (1024 * 1024 * 4)) {
                if (in_array($ext_siswa_akta_file, $allowed_ext)) {
                    $new_name_siswa_akta_file = $siswa_akta_nama . rand(1, 1000) . '.' . $ext_siswa_akta_file;
                    $dest_siswa_akta_file = "tmp/file-siswa/" . $siswa_nsm . '/' . $new_name_siswa_akta_file;
                    $path_siswa_akta_file = "../../../tmp/file-siswa/" . $siswa_nsm . '/' . $new_name_siswa_akta_file;
                    list($width, $height) = @getimagesize($_FILES["siswa_akta_file"]["tmp_name"]);
                    if ($ext_siswa_akta_file == 'png') {
                        $new_image_siswa_akta_file = @imagecreatefrompng($_FILES["siswa_akta_file"]["tmp_name"]);
                    }
                    if ($ext_siswa_akta_file == 'jpg' || $ext_siswa_akta_file == 'jpeg') {
                        $new_image_siswa_akta_file = @imagecreatefromjpeg($_FILES["siswa_akta_file"]["tmp_name"]);
                    }
                    $new_width_siswa_akta_file = 500;
                    $new_height_siswa_akta_file = ($height / $width) * 500;
                    $tmp_image_siswa_akta_file = imagecreatetruecolor($new_width_siswa_akta_file, $new_height_siswa_akta_file);
                    imagecopyresampled($tmp_image_siswa_akta_file, $new_image_siswa_akta_file, 0, 0, 0, 0, $new_width_siswa_akta_file, $new_height_siswa_akta_file, $width, $height);
                    imagejpeg($tmp_image_siswa_akta_file, $path_siswa_akta_file, 400);
                    imagedestroy($new_image_siswa_akta_file);
                    imagedestroy($tmp_image_siswa_akta_file);
                    if (!empty($_POST["siswa_akta_nama"]
                        and $_POST["siswa_akta_nik"]
                        and $_POST["siswa_akta_tempat"]
                        and $_POST["siswa_akta_tgllahir"]
                        and $_POST["siswa_akta_ayah"]
                        and $_POST["siswa_akta_ibu"])) {
                        $siswa_akta_nama = str_replace("'", "`", $_POST['siswa_akta_nama']);
                        $siswa_akta_tempat = str_replace("'", "`", $_POST['siswa_akta_tempat']);
                        $siswa_akta_ayah = str_replace("'", "`", $_POST['siswa_akta_ayah']);
                        $siswa_akta_ibu = str_replace("'", "`", $_POST['siswa_akta_ibu']);
                        $f_siswa_akta = [
                            'siswa_akta_nama'        => ucfirst(strtolower($siswa_akta_nama)),
                            'siswa_akta_nik'         => $_POST['siswa_akta_nik'],
                            'siswa_akta_tempat'      => ucfirst(strtolower($siswa_akta_tempat)),
                            'siswa_akta_tgllahir'    => $_POST['siswa_akta_tgllahir'],
                            'siswa_akta_ayah'        => ucfirst(strtolower($siswa_akta_ayah)),
                            'siswa_akta_ibu'         => ucfirst(strtolower($siswa_akta_ibu)),
                            'siswa_akta_file'        => $dest_siswa_akta_file,
                        ];
                        $id = $_POST['siswa_id_kota'];
                        $nama_update = ucfirst(strtolower($_POST['siswa_akta_nama']));
                        $exec = update($koneksi, 'f_siswa_akta', $f_siswa_akta, ['siswa_id_kota' => $id]);
                        $siswa_akta_filelama = $_POST['siswa_akta_filelama'];
                        if ($exec) {
                            $response = [
                                'status'        => 200,
                                'icon'          => "success",
                                'message'       => "Update Data Akte Lahir " . $nama_update . " Berhasil",
                            ];
                            echo json_encode($response);
                        } else {
                            $response = [
                                'status'        => 300,
                                'icon'          => "error",
                                'message'       => "Update Data Akte Lahir " . $nama_update . " Gagal Bos",
                            ];
                            echo json_encode($response);
                        }
                        if (!empty($_POST["siswa_akta_filelama"])) {
                            unlink('../../../' . $siswa_akta_filelama);
                        }
                    } else {
                        $response = [
                            'status'        => 300,
                            'icon'          => "error",
                            'message'       => "Update data akta lahir gagal. cek kembali isian form",
                        ];
                        echo json_encode($response);
                        die;
                    }
                } else {
                    $response = [
                        'status'        => 300,
                        'icon'          => "info",
                        'message'       => "Extensi file hanya png, jpg, jpeg",
                    ];
                    echo json_encode($response);
                }
            } else {
                $response = [
                    'status'        => 300,
                    'icon'          => "info",
                    'message'       => "Size Lebih dari 4MB",
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status'        => 300,
                'icon'          => "info",
                'message'       => "Nama Siswa Tidak Boleh Kosong",
            ];
            echo json_encode($response);
        }
    } else {
        if (!empty($_POST["siswa_akta_nama"]
            and $_POST["siswa_akta_nik"]
            and $_POST["siswa_akta_tempat"]
            and $_POST["siswa_akta_tgllahir"]
            and $_POST["siswa_akta_ayah"]
            and $_POST["siswa_akta_ibu"])) {
            $siswa_akta_nama = str_replace("'", "`", $_POST['siswa_akta_nama']);
            $siswa_akta_tempat = str_replace("'", "`", $_POST['siswa_akta_tempat']);
            $siswa_akta_ayah = str_replace("'", "`", $_POST['siswa_akta_ayah']);
            $siswa_akta_ibu = str_replace("'", "`", $_POST['siswa_akta_ibu']);
            $f_siswa_akta = [
                'siswa_akta_nama'        => ucfirst(strtolower($siswa_akta_nama)),
                'siswa_akta_nik'         => $_POST['siswa_akta_nik'],
                'siswa_akta_tempat'      => ucfirst(strtolower($siswa_akta_tempat)),
                'siswa_akta_tgllahir'    => $_POST['siswa_akta_tgllahir'],
                'siswa_akta_ayah'        => ucfirst(strtolower($siswa_akta_ayah)),
                'siswa_akta_ibu'         => ucfirst(strtolower($siswa_akta_ibu)),
            ];
            $id = $_POST['siswa_id_kota'];
            $nama_update = ucfirst(strtolower($_POST['siswa_akta_nama']));
            $exec = update($koneksi, 'f_siswa_akta', $f_siswa_akta, ['siswa_id_kota' => $id]);
            $siswa_akta_filelama = $_POST['siswa_akta_filelama'];
            if ($exec) {
                $response = [
                    'status'        => 202,
                    'icon'          => "success",
                    'message'       => "Update Data Akte Lahir " . $nama_update . " Berhasil",
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'status'        => 300,
                    'icon'          => "error",
                    'message'       => "Update Data Akte Lahir " . $nama_update . " Gagal Bos",
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status'        => 300,
                'icon'          => "error",
                'message'       => "Update data akta lahir gagal. cek kembali isian form",
            ];
            echo json_encode($response);
            die;
        }
    }
}

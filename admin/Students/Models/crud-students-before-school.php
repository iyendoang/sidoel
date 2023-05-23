<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['users_id'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'f_siswa_schoolBeforeEdit') {
    if ($_FILES['file_ijz_siswa']['name'] <> '') {
        if (!empty($_POST["siswa_ijz_asal"])) {
            $siswa_ijz_nama = $_POST['siswa_ijz_nama'];
            $siswa_nsm = $_POST['siswa_nsm'];
            $name_file_ijz_siswa = $_FILES["file_ijz_siswa"]["name"];
            $ext_file_ijz_siswa = explode(".", $name_file_ijz_siswa);
            $ext_file_ijz_siswa = end($ext_file_ijz_siswa);
            $size_file_ijz_siswa = $_FILES["file_ijz_siswa"]["size"];
            $allowed_ext = array("png", "jpg", "jpeg");
            $temp = "../../../tmp/file-siswa/" . $siswa_nsm;
            if (!file_exists($temp))
                mkdir($temp, 0777, true);
            if ($size_file_ijz_siswa < (1024 * 1024 * 4)) {
                if (in_array($ext_file_ijz_siswa, $allowed_ext)) {
                    $new_name_file_ijz_siswa = 'ijazah' . $siswa_ijz_nama . rand(1, 1000) . '.' . $ext_file_ijz_siswa;
                    $dest_file_ijz_siswa = "tmp/file-siswa/" . $siswa_nsm . '/' . $new_name_file_ijz_siswa;
                    $path_file_ijz_siswa = "../../../tmp/file-siswa/" . $siswa_nsm . '/' . $new_name_file_ijz_siswa;
                    list($width, $height) = @getimagesize($_FILES["file_ijz_siswa"]["tmp_name"]);
                    if ($ext_file_ijz_siswa == 'png') {
                        $new_image_file_ijz_siswa = @imagecreatefrompng($_FILES["file_ijz_siswa"]["tmp_name"]);
                    }
                    if ($ext_file_ijz_siswa == 'jpg' || $ext_file_ijz_siswa == 'jpeg') {
                        $new_image_file_ijz_siswa = @imagecreatefromjpeg($_FILES["file_ijz_siswa"]["tmp_name"]);
                    }
                    $new_width_file_ijz_siswa = 500;
                    $new_height_file_ijz_siswa = ($height / $width) * 500;
                    $tmp_image_file_ijz_siswa = imagecreatetruecolor($new_width_file_ijz_siswa, $new_height_file_ijz_siswa);
                    imagecopyresampled($tmp_image_file_ijz_siswa, $new_image_file_ijz_siswa, 0, 0, 0, 0, $new_width_file_ijz_siswa, $new_height_file_ijz_siswa, $width, $height);
                    imagejpeg($tmp_image_file_ijz_siswa, $path_file_ijz_siswa, 400);
                    imagedestroy($new_image_file_ijz_siswa);
                    imagedestroy($tmp_image_file_ijz_siswa);
                    if (!empty($_POST["siswa_ijz_asal"]
                        and $_POST["siswa_ijz_statusasal"]
                        and $_POST["siswa_ijz_npsnasal"]
                        and $_POST["siswa_ijz_sekolahasal"]
                        and $_POST["siswa_ijz_kotaasal"]
                        and $_POST["siswa_ijz_nama"]
                        and $_POST["siswa_ijz_nisn"]
                        and $_POST["siswa_ijz_tempat"]
                        and $_POST["siswa_ijz_tgllahir"]
                        and $_POST["siswa_ijz_namaortu"]
                        and $_POST["siswa_ijz_noujian"]
                        and $_POST["siswa_ijz_noseri"]
                        and $_POST["siswa_ijz_thnlulus"]
                        and $_POST["siswa_ijz_noseri"])) {
                        $f_siswa_akta = [
                            'siswa_ijz_asal'            => $_POST['siswa_ijz_asal'],
                            'siswa_ijz_statusasal'      => $_POST['siswa_ijz_statusasal'],
                            'siswa_ijz_npsnasal'        => $_POST['siswa_ijz_npsnasal'],
                            'siswa_ijz_sekolahasal'     => $_POST['siswa_ijz_sekolahasal'],
                            'siswa_ijz_kotaasal'        => $_POST['siswa_ijz_kotaasal'],
                            'siswa_ijz_nama'            => $_POST['siswa_ijz_nama'],
                            'siswa_ijz_nisn'            => $_POST['siswa_ijz_nisn'],
                            'siswa_ijz_tempat'          => $_POST['siswa_ijz_tempat'],
                            'siswa_ijz_tgllahir'        => $_POST['siswa_ijz_tgllahir'],
                            'siswa_ijz_namaortu'        => $_POST['siswa_ijz_namaortu'],
                            'siswa_ijz_noujian'         => $_POST['siswa_ijz_noujian'],
                            'siswa_ijz_noseri'          => $_POST['siswa_ijz_noseri'],
                            'siswa_ijz_thnlulus'        => $_POST['siswa_ijz_thnlulus'],
                            'file_ijz_siswa'            => $dest_file_ijz_siswa,
                        ];
                        $id = $_POST['siswa_id_kota'];
                        $nama_update = ucfirst(strtolower($_POST['siswa_ijz_nama']));
                        $exec = update($koneksi, 'f_siswa_akta', $f_siswa_akta, ['siswa_id_kota' => $id]);
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
                        $file_ijz_siswalama = $_POST['file_ijz_siswalama'];
                        if (!empty($_POST["file_ijz_siswalama"])) {
                            unlink('../../../' . $file_ijz_siswalama);
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
        if (!empty($_POST["siswa_ijz_asal"]
            and $_POST["siswa_ijz_statusasal"]
            and $_POST["siswa_ijz_npsnasal"]
            and $_POST["siswa_ijz_sekolahasal"]
            and $_POST["siswa_ijz_kotaasal"]
            and $_POST["siswa_ijz_nama"]
            and $_POST["siswa_ijz_nisn"]
            and $_POST["siswa_ijz_tempat"]
            and $_POST["siswa_ijz_tgllahir"]
            and $_POST["siswa_ijz_namaortu"]
            and $_POST["siswa_ijz_noujian"]
            and $_POST["siswa_ijz_noseri"]
            and $_POST["siswa_ijz_thnlulus"]
            and $_POST["siswa_ijz_noseri"])) {
            $f_siswa_akta = [
                'siswa_ijz_asal'            => $_POST['siswa_ijz_asal'],
                'siswa_ijz_statusasal'      => $_POST['siswa_ijz_statusasal'],
                'siswa_ijz_npsnasal'        => $_POST['siswa_ijz_npsnasal'],
                'siswa_ijz_sekolahasal'     => $_POST['siswa_ijz_sekolahasal'],
                'siswa_ijz_kotaasal'        => $_POST['siswa_ijz_kotaasal'],
                'siswa_ijz_nama'            => $_POST['siswa_ijz_nama'],
                'siswa_ijz_nisn'            => $_POST['siswa_ijz_nisn'],
                'siswa_ijz_tempat'          => $_POST['siswa_ijz_tempat'],
                'siswa_ijz_tgllahir'        => $_POST['siswa_ijz_tgllahir'],
                'siswa_ijz_namaortu'        => $_POST['siswa_ijz_namaortu'],
                'siswa_ijz_noujian'         => $_POST['siswa_ijz_noujian'],
                'siswa_ijz_noseri'          => $_POST['siswa_ijz_noseri'],
                'siswa_ijz_thnlulus'        => $_POST['siswa_ijz_thnlulus'],
            ];
            $id = $_POST['siswa_id_kota'];
            $nama_update = ucfirst(strtolower($_POST['siswa_ijz_nama']));
            $exec = update($koneksi, 'f_siswa_akta', $f_siswa_akta, ['siswa_id_kota' => $id]);
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

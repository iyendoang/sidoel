<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

if ($pg == 'file_kjp_bukurek_Edit') {
    if (!empty($_FILES["file_kjp_bukurek"]["name"])) {
        $siswa_nama = ucfirst(strtoupper($_POST['siswa_nama']));
        $dirKJP = 'file_kjp';
        $name = $_FILES["file_kjp_bukurek"]["name"];
        $size = $_FILES["file_kjp_bukurek"]["size"];
        $ext = explode(".", $name);
        $ext = end($ext);
        $allowed_ext = array("png", "jpg", "jpeg");
        $temp = "../../../tmp/file-siswa/" . $dirKJP . '/kjp-file/';
        $destinasi = "tmp/file-siswa/" . $dirKJP . '/kjp-file/';
        if (!file_exists($temp))
            mkdir($temp, 0777, true);
        if (in_array($ext, $allowed_ext)) {
            if ($size < (1024 * 1024 * 5)) {
                $new_name = 'REK-KJP-' . $siswa_nama . '-' . rand(1, 1000) . '.' . $ext;
                $path = $temp . $new_name;
                $dest_file_kjp_bukurek = $destinasi . $new_name;
                list($width, $height) = @getimagesize($_FILES["file_kjp_bukurek"]["tmp_name"]);
                if ($ext == 'png') {
                    $new_image = @imagecreatefrompng($_FILES["file_kjp_bukurek"]["tmp_name"]);
                }
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $new_image = @imagecreatefromjpeg($_FILES["file_kjp_bukurek"]["tmp_name"]);
                }
                $new_width = 700;
                $new_height = ($height / $width) * 700;
                $tmp_image = imagecreatetruecolor($new_width, $new_height);
                @imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                @imagejpeg($tmp_image, $path, 600);
                @imagedestroy($new_image);
                @imagedestroy($tmp_image);
                $f_siswa_act = [
                    'file_kjp_bukurek'        => $dest_file_kjp_bukurek,
                ];
                $id = $_POST['siswa_id'];
                $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                $file_kjp_bukureklama = $_POST['file_kjp_bukureklama'];
                if (!empty($_POST["file_kjp_bukureklama"])) {
                    unlink('../../../' . $file_kjp_bukureklama);
                    $response = [
                        'status'        => 200,
                        'icon'          => "success",
                        'message'       => "Gambar berhasil diupdate",
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        'status'        => 200,
                        'icon'          => "success",
                        'message'       => "Gambar berhasil diinsert",
                    ];
                    echo json_encode($response);
                }
            } else {
                $response = [
                    'status'        => 300,
                    'icon'          => "error",
                    'message'       => "maksimal gambar 5 MB",
                ];
                echo json_encode($response);
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
            'icon'          => "error",
            'message'       => "Upload gagal! tidak ada file yang diupload",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'file_kjp_ktpwali_Edit') {
    if (!empty($_FILES["file_kjp_ktpwali"]["name"])) {
        $siswa_nama = ucfirst(strtoupper($_POST['siswa_nama']));
        $dirKJP = 'file_kjp';
        $name = $_FILES["file_kjp_ktpwali"]["name"];
        $size = $_FILES["file_kjp_ktpwali"]["size"];
        $ext = explode(".", $name);
        $ext = end($ext);
        $allowed_ext = array("png", "jpg", "jpeg");
        $temp = "../../../tmp/file-siswa/" . $dirKJP . '/kjp-file/';
        $destinasi = "tmp/file-siswa/" . $dirKJP . '/kjp-file/';
        if (!file_exists($temp))
            mkdir($temp, 0777, true);
        if (in_array($ext, $allowed_ext)) {
            if ($size < (1024 * 1024 * 5)) {
                $new_name = 'KTP-WALI-KJP-' . $siswa_nama . '-' . rand(1, 1000) . '.' . $ext;
                $path = $temp . $new_name;
                $dest_file_kjp_ktpwali = $destinasi . $new_name;
                list($width, $height) = @getimagesize($_FILES["file_kjp_ktpwali"]["tmp_name"]);
                if ($ext == 'png') {
                    $new_image = @imagecreatefrompng($_FILES["file_kjp_ktpwali"]["tmp_name"]);
                }
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $new_image = @imagecreatefromjpeg($_FILES["file_kjp_ktpwali"]["tmp_name"]);
                }
                $new_width = 700;
                $new_height = ($height / $width) * 700;
                $tmp_image = imagecreatetruecolor($new_width, $new_height);
                @imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                @imagejpeg($tmp_image, $path, 600);
                @imagedestroy($new_image);
                @imagedestroy($tmp_image);
                $f_siswa_act = [
                    'file_kjp_ktpwali'        => $dest_file_kjp_ktpwali,
                ];
                $id = $_POST['siswa_id'];
                $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                $file_kjp_ktpwalilama = $_POST['file_kjp_ktpwalilama'];
                if (!empty($_POST["file_kjp_ktpwalilama"])) {
                    unlink('../../../' . $file_kjp_ktpwalilama);
                    $response = [
                        'status'        => 200,
                        'icon'          => "success",
                        'message'       => "Gambar berhasil diupdate",
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        'status'        => 200,
                        'icon'          => "success",
                        'message'       => "Gambar berhasil diinsert",
                    ];
                    echo json_encode($response);
                }
            } else {
                $response = [
                    'status'        => 300,
                    'icon'          => "error",
                    'message'       => "maksimal gambar 5 MB",
                ];
                echo json_encode($response);
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
            'icon'          => "error",
            'message'       => "Upload gagal! tidak ada file yang diupload",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'file_kjp_atm_Edit') {
    if (!empty($_FILES["file_kjp_atm"]["name"])) {
        $siswa_nama = ucfirst(strtoupper($_POST['siswa_nama']));
        $dirKJP = 'file_kjp';
        $name = $_FILES["file_kjp_atm"]["name"];
        $size = $_FILES["file_kjp_atm"]["size"];
        $ext = explode(".", $name);
        $ext = end($ext);
        $allowed_ext = array("png", "jpg", "jpeg");
        $temp = "../../../tmp/file-siswa/" . $dirKJP . '/kjp-file/';
        $destinasi = "tmp/file-siswa/" . $dirKJP . '/kjp-file/';
        if (!file_exists($temp))
            mkdir($temp, 0777, true);
        if (in_array($ext, $allowed_ext)) {
            if ($size < (1024 * 1024 * 5)) {
                $new_name = 'ATM-KJP-' . $siswa_nama . '-' . rand(1, 1000) . '.' . $ext;
                $path = $temp . $new_name;
                $dest_file_kjp_atm = $destinasi . $new_name;
                list($width, $height) = @getimagesize($_FILES["file_kjp_atm"]["tmp_name"]);
                if ($ext == 'png') {
                    $new_image = @imagecreatefrompng($_FILES["file_kjp_atm"]["tmp_name"]);
                }
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $new_image = @imagecreatefromjpeg($_FILES["file_kjp_atm"]["tmp_name"]);
                }
                $new_width = 700;
                $new_height = ($height / $width) * 700;
                $tmp_image = imagecreatetruecolor($new_width, $new_height);
                @imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                @imagejpeg($tmp_image, $path, 600);
                @imagedestroy($new_image);
                @imagedestroy($tmp_image);
                $f_siswa_act = [
                    'file_kjp_atm'        => $dest_file_kjp_atm,
                ];
                $id = $_POST['siswa_id'];
                $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                $file_kjp_atmlama = $_POST['file_kjp_atmlama'];
                if (!empty($_POST["file_kjp_atmlama"])) {
                    unlink('../../../' . $file_kjp_atmlama);
                    $response = [
                        'status'        => 200,
                        'icon'          => "success",
                        'message'       => "Gambar berhasil diupdate",
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        'status'        => 200,
                        'icon'          => "success",
                        'message'       => "Gambar berhasil diinsert",
                    ];
                    echo json_encode($response);
                }
            } else {
                $response = [
                    'status'        => 300,
                    'icon'          => "error",
                    'message'       => "maksimal gambar 5 MB",
                ];
                echo json_encode($response);
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
            'icon'          => "error",
            'message'       => "Upload gagal! tidak ada file yang diupload",
        ];
        echo json_encode($response);
    }
}

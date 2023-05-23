<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

if ($pg == 'file_kk_siswa_Edit') {
    if (!empty($_FILES["file_kk_siswa"]["name"])) {
        $siswa_kk_nama = ucfirst(strtolower($_POST['siswa_kk_nama']));
        $kartuKeluarga = 'Kartu-Keluarga';
        $name = $_FILES["file_kk_siswa"]["name"];
        $size = $_FILES["file_kk_siswa"]["size"];
        $ext = explode(".", $name);
        $ext = end($ext);
        $allowed_ext = array("png", "jpg", "jpeg");
        $temp = "../../../tmp/file-siswa/" . $kartuKeluarga . '/';
        $destinasi = "tmp/file-siswa/" . $kartuKeluarga . '/';
        if (!file_exists($temp))
            mkdir($temp, 0777, true);
        if (in_array($ext, $allowed_ext)) {
            if ($size < (1024 * 1024 * 5)) {
                $new_name = 'KK-' . $siswa_kk_nama . '-' . rand(1, 1000) . '.' . $ext;
                $path = $temp . $new_name;
                $dest_data = $destinasi . $new_name;
                list($width, $height) = @getimagesize($_FILES["file_kk_siswa"]["tmp_name"]);
                if ($ext == 'png') {
                    $new_image = @imagecreatefrompng($_FILES["file_kk_siswa"]["tmp_name"]);
                }
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $new_image = @imagecreatefromjpeg($_FILES["file_kk_siswa"]["tmp_name"]);
                }
                $new_width = 700;
                $new_height = ($height / $width) * 700;
                $tmp_image = imagecreatetruecolor($new_width, $new_height);
                @imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                @imagejpeg($tmp_image, $path, 600);
                @imagedestroy($new_image);
                @imagedestroy($tmp_image);
                $f_siswa_act = [
                    'file_kk_siswa'        => $dest_data,
                ];
                $id = $_POST['siswa_id'];
                $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                $file_kk_siswalama = $_POST['file_kk_siswalama'];
                if (!empty($_POST["file_kk_siswalama"])) {
                    unlink('../../../' . $file_kk_siswalama);
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
if ($pg == 'file_ktp_ayah_Edit') {
    if (!empty($_FILES["file_ktp_ayah"]["name"])) {
        $siswa_kk_nama = ucfirst(strtolower($_POST['siswa_kk_nama']));
        $kartuKeluarga = 'Kartu-Keluarga';
        $name = $_FILES["file_ktp_ayah"]["name"];
        $size = $_FILES["file_ktp_ayah"]["size"];
        $ext = explode(".", $name);
        $ext = end($ext);
        $allowed_ext = array("png", "jpg", "jpeg");
        $temp = "../../../tmp/file-siswa/" . $kartuKeluarga . '/';
        $destinasi = "tmp/file-siswa/" . $kartuKeluarga . '/';
        if (!file_exists($temp))
            mkdir($temp, 0777, true);
        if (in_array($ext, $allowed_ext)) {
            if ($size < (1024 * 1024 * 5)) {
                $new_name = 'KTP-AYAH-' . $siswa_kk_nama . '-' . rand(1, 1000) . '.' . $ext;
                $path = $temp . $new_name;
                $dest_file_ktp_ayah = $destinasi . $new_name;
                list($width, $height) = @getimagesize($_FILES["file_ktp_ayah"]["tmp_name"]);
                if ($ext == 'png') {
                    $new_image = @imagecreatefrompng($_FILES["file_ktp_ayah"]["tmp_name"]);
                }
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $new_image = @imagecreatefromjpeg($_FILES["file_ktp_ayah"]["tmp_name"]);
                }
                $new_width = 700;
                $new_height = ($height / $width) * 700;
                $tmp_image = imagecreatetruecolor($new_width, $new_height);
                @imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                @imagejpeg($tmp_image, $path, 600);
                @imagedestroy($new_image);
                @imagedestroy($tmp_image);
                $f_siswa_act = [
                    'file_ktp_ayah'        => $dest_file_ktp_ayah,
                ];
                $id = $_POST['siswa_id'];
                $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                $file_ktp_ayahlama = $_POST['file_ktp_ayahlama'];
                if (!empty($_POST["file_ktp_ayahlama"])) {
                    unlink('../../../' . $file_ktp_ayahlama);
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
if ($pg == 'file_ktp_ibu_Edit') {
    if (!empty($_FILES["file_ktp_ibu"]["name"])) {
        $siswa_kk_nama = ucfirst(strtolower($_POST['siswa_kk_nama']));
        $kartuKeluarga = 'Kartu-Keluarga';
        $name = $_FILES["file_ktp_ibu"]["name"];
        $size = $_FILES["file_ktp_ibu"]["size"];
        $ext = explode(".", $name);
        $ext = end($ext);
        $allowed_ext = array("png", "jpg", "jpeg");
        $temp = "../../../tmp/file-siswa/" . $kartuKeluarga . '/';
        $destinasi = "tmp/file-siswa/" . $kartuKeluarga . '/';
        if (!file_exists($temp))
            mkdir($temp, 0777, true);
        if (in_array($ext, $allowed_ext)) {
            if ($size < (1024 * 1024 * 5)) {
                $new_name = 'KTP-IBU-' . $siswa_kk_nama . '-' . rand(1, 1000) . '.' . $ext;
                $path = $temp . $new_name;
                $dest_file_ktp_ibu = $destinasi . $new_name;
                list($width, $height) = @getimagesize($_FILES["file_ktp_ibu"]["tmp_name"]);
                if ($ext == 'png') {
                    $new_image = @imagecreatefrompng($_FILES["file_ktp_ibu"]["tmp_name"]);
                }
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $new_image = @imagecreatefromjpeg($_FILES["file_ktp_ibu"]["tmp_name"]);
                }
                $new_width = 700;
                $new_height = ($height / $width) * 700;
                $tmp_image = imagecreatetruecolor($new_width, $new_height);
                @imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                @imagejpeg($tmp_image, $path, 600);
                @imagedestroy($new_image);
                @imagedestroy($tmp_image);
                $f_siswa_act = [
                    'file_ktp_ibu'        => $dest_file_ktp_ibu,
                ];
                $id = $_POST['siswa_id'];
                $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                $file_ktp_ibulama = $_POST['file_ktp_ibulama'];
                if (!empty($_POST["file_ktp_ibulama"])) {
                    unlink('../../../' . $file_ktp_ibulama);
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
if ($pg == 'file_ktp_wali_Edit') {
    if (!empty($_FILES["file_ktp_wali"]["name"])) {
        $siswa_kk_nama = ucfirst(strtolower($_POST['siswa_kk_nama']));
        $kartuKeluarga = 'Kartu-Keluarga';
        $name = $_FILES["file_ktp_wali"]["name"];
        $size = $_FILES["file_ktp_wali"]["size"];
        $ext = explode(".", $name);
        $ext = end($ext);
        $allowed_ext = array("png", "jpg", "jpeg");
        $temp = "../../../tmp/file-siswa/" . $kartuKeluarga . '/';
        $destinasi = "tmp/file-siswa/" . $kartuKeluarga . '/';
        if (!file_exists($temp))
            mkdir($temp, 0777, true);
        if (in_array($ext, $allowed_ext)) {
            if ($size < (1024 * 1024 * 5)) {
                $new_name = 'KTP-WALI-' . $siswa_kk_nama . '-' . rand(1, 1000) . '.' . $ext;
                $path = $temp . $new_name;
                $dest_file_ktp_wali = $destinasi . $new_name;
                list($width, $height) = @getimagesize($_FILES["file_ktp_wali"]["tmp_name"]);
                if ($ext == 'png') {
                    $new_image = @imagecreatefrompng($_FILES["file_ktp_wali"]["tmp_name"]);
                }
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $new_image = @imagecreatefromjpeg($_FILES["file_ktp_wali"]["tmp_name"]);
                }
                $new_width = 700;
                $new_height = ($height / $width) * 700;
                $tmp_image = imagecreatetruecolor($new_width, $new_height);
                @imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                @imagejpeg($tmp_image, $path, 600);
                @imagedestroy($new_image);
                @imagedestroy($tmp_image);
                $f_siswa_act = [
                    'file_ktp_wali'        => $dest_file_ktp_wali,
                ];
                $id = $_POST['siswa_id'];
                $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                $file_ktp_walilama = $_POST['file_ktp_walilama'];
                if (!empty($_POST["file_ktp_walilama"])) {
                    unlink('../../../' . $file_ktp_walilama);
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

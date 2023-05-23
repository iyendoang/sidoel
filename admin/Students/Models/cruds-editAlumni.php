<?php
require("../../../config/function.php");
require("../../../config/database.php");
require("../../../config/functions.crud.php");

if ($pg == 'formEditAlumni') {
    if ($_FILES['file_lulus_ijz']['name'] <> '') {
        if (!empty($_POST["siswa_lulus_noseri"])) {
            $siswa_nama = $_POST['siswa_nama'];
            $ijazahFIleLulusan = 'Ijazah-Lulusan';
            $name_file_lulus_ijz = $_FILES["file_lulus_ijz"]["name"];
            $ext_file_lulus_ijz = explode(".", $name_file_lulus_ijz);
            $ext_file_lulus_ijz = end($ext_file_lulus_ijz);
            $size_file_lulus_ijz = $_FILES["file_lulus_ijz"]["size"];
            $allowed_ext = array("png", "jpg", "jpeg");
            $temp = "../../../tmp/file-siswa/" . $ijazahFIleLulusan;
            if (!file_exists($temp))
                mkdir($temp, 0777, true);
            if ($size_file_lulus_ijz < (1024 * 1024 * 4)) {
                if (in_array($ext_file_lulus_ijz, $allowed_ext)) {
                    $new_name_file_lulus_ijz = 'ijazah' . $siswa_nama . rand(1, 1000) . '.' . $ext_file_lulus_ijz;
                    $dest_file_lulus_ijz = "tmp/file-siswa/" . $ijazahFIleLulusan . '/' . $new_name_file_lulus_ijz;
                    $path_file_lulus_ijz = "../../../tmp/file-siswa/" . $ijazahFIleLulusan . '/' . $new_name_file_lulus_ijz;
                    list($width, $height) = @getimagesize($_FILES["file_lulus_ijz"]["tmp_name"]);
                    if ($ext_file_lulus_ijz == 'png') {
                        $new_image_file_lulus_ijz = @imagecreatefrompng($_FILES["file_lulus_ijz"]["tmp_name"]);
                    }
                    if ($ext_file_lulus_ijz == 'jpg' || $ext_file_lulus_ijz == 'jpeg') {
                        $new_image_file_lulus_ijz = @imagecreatefromjpeg($_FILES["file_lulus_ijz"]["tmp_name"]);
                    }
                    $new_width_file_lulus_ijz = 500;
                    $new_height_file_lulus_ijz = ($height / $width) * 500;
                    $tmp_image_file_lulus_ijz = imagecreatetruecolor($new_width_file_lulus_ijz, $new_height_file_lulus_ijz);
                    imagecopyresampled($tmp_image_file_lulus_ijz, $new_image_file_lulus_ijz, 0, 0, 0, 0, $new_width_file_lulus_ijz, $new_height_file_lulus_ijz, $width, $height);
                    imagejpeg($tmp_image_file_lulus_ijz, $path_file_lulus_ijz, 400);
                    imagedestroy($new_image_file_lulus_ijz);
                    imagedestroy($tmp_image_file_lulus_ijz);
                    if (!empty($_POST["siswa_lulus_noseri"]
                        and $_POST["siswa_lulus_tahunajaran_id"]
                        and $_POST["siswa_lulus_ke"])) {
                        $f_siswa_act = [
                            'siswa_lulus_noseri'            => $_POST['siswa_lulus_noseri'],
                            'siswa_lulus_tahunajaran_id'    => $_POST['siswa_lulus_tahunajaran_id'],
                            'siswa_lulus_ke'                => $_POST['siswa_lulus_ke'],
                            'siswa_lulus_kestatus'          => $_POST['siswa_lulus_kestatus'],
                            'siswa_lulus_namasekolah'       => $_POST['siswa_lulus_namasekolah'],
                            'siswa_lulus_npsnsekolah'       => $_POST['siswa_lulus_npsnsekolah'],
                            'file_lulus_ijz'                => $dest_file_lulus_ijz,
                        ];
                        $id = $_POST['siswa_id'];
                        $nama_update = ucfirst(strtolower($_POST['siswa_nama']));
                        $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                        if ($exec) {
                            $response = [
                                'status'        => 200,
                                'icon'          => "success",
                                'message'       => "Update Data Lulusan " . $nama_update . " Berhasil",
                            ];
                            echo json_encode($response);
                        } else {
                            $response = [
                                'status'        => 300,
                                'icon'          => "error",
                                'message'       => "Update Data Lulusan " . $nama_update . " Gagal Bos",
                            ];
                            echo json_encode($response);
                        }
                        $file_lulus_ijzlama = $_POST['file_lulus_ijzlama'];
                        if (!empty($_POST["file_lulus_ijzlama"])) {
                            unlink('../../../' . $file_lulus_ijzlama);
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
        if (!empty($_POST["siswa_lulus_noseri"]
            and $_POST["siswa_lulus_tahunajaran_id"]
            and $_POST["siswa_lulus_ke"])) {
            $f_siswa_act = [
                'siswa_lulus_noseri'            => $_POST['siswa_lulus_noseri'],
                'siswa_lulus_tahunajaran_id'      => $_POST['siswa_lulus_tahunajaran_id'],
                'siswa_lulus_ke'        => $_POST['siswa_lulus_ke'],
                'siswa_lulus_kestatus'     => $_POST['siswa_lulus_kestatus'],
                'siswa_lulus_namasekolah'        => $_POST['siswa_lulus_namasekolah'],
                'siswa_lulus_npsnsekolah'            => $_POST['siswa_lulus_npsnsekolah'],
            ];
            $id = $_POST['siswa_id'];
            $nama_update = ucfirst(strtolower($_POST['siswa_nama']));
            $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
            if ($exec) {
                $response = [
                    'status'        => 200,
                    'icon'          => "success",
                    'message'       => "Update Data Lulusan " . $nama_update . " Berhasil",
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'status'        => 300,
                    'icon'          => "error",
                    'message'       => "Update Data Lulusan " . $nama_update . " Gagal Bos",
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

<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'synchrone_sidoel') {
    if ($_POST['synchrone_check'] != "") {
        foreach ($_POST['pilih'] as $id) {
            $check = "SELECT * FROM f_siswa_act WHERE siswa_id = '$id'";
            $checkresult = mysqli_query($koneksi, $check);
            if (mysqli_num_rows($checkresult) > 0) {
                $update_all = "UPDATE f_siswa_act SET 
                        WHERE siswa_id = '$id'";
                mysqli_query($koneksi, $update_all);
            } else {
                $insert_query = "INSERT INTO f_siswa_act (siswa_id, siswa_edit_status) VALUES ('$id', '1')";
                mysqli_query($koneksi, $insert_query);
            }
        }
    } else {
        echo "ceklis";
    }
}
if ($pg == 'deleteStudents') {
    $siswa_id = dekripsi($_POST['id']);
    $exec = delete($koneksi, 'f_siswa_act', ['siswa_id' => $siswa_id]);
    $exec .= delete($koneksi, 'e_siswa', ['siswa_id' => $siswa_id]);
    $exec .= delete($koneksi, 'e_absenwalas', ['siswa_id' => $siswa_id]);
    $exec .= delete($koneksi, 'e_extrapilihan', ['siswa_id' => $siswa_id]);
    $exec .= delete($koneksi, 'e_extrasiswa', ['siswa_id' => $siswa_id]);
    $exec .= delete($koneksi, 'e_inputnilai', ['siswa_id' => $siswa_id]);
    $exec .= delete($koneksi, 'e_prestasi', ['siswa_id' => $siswa_id]);
    $exec .= delete($koneksi, 'e_rapor', ['siswa_id' => $siswa_id]);
    $exec .= delete($koneksi, 'e_riwayatsiswa', ['siswa_id' => $siswa_id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'        => "success",
            'message'       => "Delete Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'        => "error",
            'message'       => "Delete Gagal Bos",
        ];
        echo json_encode($response);
    } 
}
if ($pg == 'formEditActivity') {
    $siswa_nama = str_replace("'", "`", $_POST['siswa_nama']);
    $siswa_tempat = str_replace("'", "`", $_POST['siswa_tempat']);
    $siswa_act_email = str_replace("'", "`", $_POST['siswa_act_email']);
    if (!preg_match('/[^+0-9]/', trim($_POST['siswa_telpon']))) {
        // cek apakah no siswa_telpon karakter 1-3 adalah +62
        if (substr(trim($_POST['siswa_telpon']), 0, 2) == '62') {
            $post_siswa_telpon = trim($_POST['siswa_telpon']);
        } elseif (substr(trim($_POST['siswa_telpon']), 0, 1) == '0') {
            $post_siswa_telpon = '62' . substr(trim($_POST['siswa_telpon']), 1);
        } elseif (substr(trim($_POST['siswa_telpon']), 0, 1) == '') {
            $post_siswa_telpon = '';
        } else {
            $post_siswa_telpon =  $_POST['siswa_telpon'];
        }
    }
    $e_siswa = [
        'siswa_nama'                => ucwords(strtoupper($siswa_nama)),
        'siswa_nisn'                => $_POST['siswa_nisn'],
        'siswa_tempat'              => ucwords(strtoupper($siswa_tempat)),
        'siswa_tgllahir'            => $_POST['siswa_tgllahir'],
        'siswa_gender'              => $_POST['siswa_gender'],
        'siswa_telpon'              => $post_siswa_telpon,
    ];
    $f_siswa_act = [
        'siswa_act_hobi'            => $_POST['siswa_act_hobi'],
        'siswa_act_cita'            => $_POST['siswa_act_cita'],
        'siswa_act_abk'             => $_POST['siswa_act_abk'],
        'siswa_act_disability'      => $_POST['siswa_act_disability'],
        'siswa_act_email'           => strtolower($siswa_act_email),
    ];
    $id = $_POST['siswa_id'];
    $nama_update = ucfirst(strtolower($_POST['siswa_nama']));
    $exec = update($koneksi, 'e_siswa', $e_siswa, ['siswa_id' => $id]);
    $exec .= update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
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
if ($pg == 'formEditCertificateOfBirth') {
    if ($_FILES['file_akta_siswa']['name'] <> '') {
        if (!empty($_POST["siswa_akta_nama"])) {
            $siswa_akta_nama = $_POST['siswa_akta_nama'];
            $aktaLahir = 'Akta-Lahir';
            $name_file_akta_siswa = $_FILES["file_akta_siswa"]["name"];
            $ext_file_akta_siswa = explode(".", $name_file_akta_siswa);
            $ext_file_akta_siswa = end($ext_file_akta_siswa);
            $size_file_akta_siswa = $_FILES["file_akta_siswa"]["size"];
            $allowed_ext = array("png", "jpg", "jpeg");
            $temp = "../../../tmp/file-siswa/" . $aktaLahir;
            if (!file_exists($temp))
                mkdir($temp, 0777, true);
            if ($size_file_akta_siswa < (1024 * 1024 * 4)) {
                if (in_array($ext_file_akta_siswa, $allowed_ext)) {
                    $new_name_file_akta_siswa = 'akte' . $siswa_akta_nama . rand(1, 1000) . '.' . $ext_file_akta_siswa;
                    $dest_file_akta_siswa = "tmp/file-siswa/" . $aktaLahir . '/' . $new_name_file_akta_siswa;
                    $path_file_akta_siswa = "../../../tmp/file-siswa/" . $aktaLahir . '/' . $new_name_file_akta_siswa;
                    list($width, $height) = @getimagesize($_FILES["file_akta_siswa"]["tmp_name"]);
                    if ($ext_file_akta_siswa == 'png') {
                        $new_image_file_akta_siswa = @imagecreatefrompng($_FILES["file_akta_siswa"]["tmp_name"]);
                    }
                    if ($ext_file_akta_siswa == 'jpg' || $ext_file_akta_siswa == 'jpeg') {
                        $new_image_file_akta_siswa = @imagecreatefromjpeg($_FILES["file_akta_siswa"]["tmp_name"]);
                    }
                    $new_width_file_akta_siswa = 500;
                    $new_height_file_akta_siswa = ($height / $width) * 500;
                    $tmp_image_file_akta_siswa = imagecreatetruecolor($new_width_file_akta_siswa, $new_height_file_akta_siswa);
                    imagecopyresampled($tmp_image_file_akta_siswa, $new_image_file_akta_siswa, 0, 0, 0, 0, $new_width_file_akta_siswa, $new_height_file_akta_siswa, $width, $height);
                    imagejpeg($tmp_image_file_akta_siswa, $path_file_akta_siswa, 400);
                    imagedestroy($new_image_file_akta_siswa);
                    imagedestroy($tmp_image_file_akta_siswa);
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
                        $f_siswa_act = [
                            'siswa_akta_nama'        => ucfirst(strtolower($siswa_akta_nama)),
                            'siswa_akta_nik'         => $_POST['siswa_akta_nik'],
                            'siswa_akta_tempat'      => ucfirst(strtolower($siswa_akta_tempat)),
                            'siswa_akta_tgllahir'    => $_POST['siswa_akta_tgllahir'],
                            'siswa_akta_ayah'        => ucfirst(strtolower($siswa_akta_ayah)),
                            'siswa_akta_ibu'         => ucfirst(strtolower($siswa_akta_ibu)),
                            'file_akta_siswa'        => $dest_file_akta_siswa,
                        ];
                        $id = $_POST['siswa_id'];
                        $nama_update = ucfirst(strtolower($_POST['siswa_akta_nama']));
                        $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
                        $file_akta_siswalama = $_POST['file_akta_siswalama'];
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
                        if (!empty($_POST["file_akta_siswalama"])) {
                            unlink('../../../' . $file_akta_siswalama);
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
            $f_siswa_act = [
                'siswa_akta_nama'        => ucfirst(strtolower($siswa_akta_nama)),
                'siswa_akta_nik'         => $_POST['siswa_akta_nik'],
                'siswa_akta_tempat'      => ucfirst(strtolower($siswa_akta_tempat)),
                'siswa_akta_tgllahir'    => $_POST['siswa_akta_tgllahir'],
                'siswa_akta_ayah'        => ucfirst(strtolower($siswa_akta_ayah)),
                'siswa_akta_ibu'         => ucfirst(strtolower($siswa_akta_ibu)),
            ];
            $id = $_POST['siswa_id'];
            $nama_update = ucfirst(strtolower($_POST['siswa_akta_nama']));
            $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
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
if ($pg == 'formEditPreviousLevel') {
    if ($_FILES['file_ijz_siswa']['name'] <> '') {
        if (!empty($_POST["siswa_ijz_asal"])) {
            $siswa_ijz_nama = $_POST['siswa_ijz_nama'];
            $ijazahFIle = 'Ijazah-Siswa';
            $name_file_ijz_siswa = $_FILES["file_ijz_siswa"]["name"];
            $ext_file_ijz_siswa = explode(".", $name_file_ijz_siswa);
            $ext_file_ijz_siswa = end($ext_file_ijz_siswa);
            $size_file_ijz_siswa = $_FILES["file_ijz_siswa"]["size"];
            $allowed_ext = array("png", "jpg", "jpeg");
            $temp = "../../../tmp/file-siswa/" . $ijazahFIle;
            if (!file_exists($temp))
                mkdir($temp, 0777, true);
            if ($size_file_ijz_siswa < (1024 * 1024 * 4)) {
                if (in_array($ext_file_ijz_siswa, $allowed_ext)) {
                    $new_name_file_ijz_siswa = 'ijazah' . $siswa_ijz_nama . rand(1, 1000) . '.' . $ext_file_ijz_siswa;
                    $dest_file_ijz_siswa = "tmp/file-siswa/" . $ijazahFIle . '/' . $new_name_file_ijz_siswa;
                    $path_file_ijz_siswa = "../../../tmp/file-siswa/" . $ijazahFIle . '/' . $new_name_file_ijz_siswa;
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
                        $f_siswa_act = [
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
                        $id = $_POST['siswa_id'];
                        $nama_update = ucfirst(strtolower($_POST['siswa_ijz_nama']));
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
            and $_POST["siswa_ijz_sekolahasal"]
            and $_POST["siswa_ijz_kotaasal"]
            and $_POST["siswa_ijz_nama"]
            and $_POST["siswa_ijz_tempat"]
            and $_POST["siswa_ijz_tgllahir"]
            and $_POST["siswa_ijz_namaortu"])) {
            $f_siswa_act = [
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
            $id = $_POST['siswa_id'];
            $nama_update = ucfirst(strtolower($_POST['siswa_ijz_nama']));
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

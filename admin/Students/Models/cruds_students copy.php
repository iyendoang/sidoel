<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");
require "../../../vendor/autoload.php";

session_start();
if (!isset($_SESSION['users_id'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if ($pg == 'addNewStudent') {
    $siswa_id_kota = $_POST['siswa_nsm'] . $_POST['siswa_act_nis'];
    $data = [
        'tahunajaran_id'    => $_POST['tahunajaran_id'],
        'siswa_id_kota'     => $siswa_id_kota,
        'siswa_nsm'         => $_POST['siswa_nsm'],
        'siswa_act_nis'         => $_POST['siswa_act_nis'],
        'siswa_act_nisn'        => $_POST['siswa_act_nisn'],
        'siswa_act_nama'        => $_POST['siswa_act_nama'],
        'tingkat_id'        => $_POST['tingkat_id'],
    ];
    $exec = insert($koneksi, 'f_siswa', $data);
    echo $exec;
}
if ($pg == 'deleteStudents') {
    $siswa_id_kota = $_POST['id'];
    $exec = delete($koneksi, 'f_siswa_act', ['siswa_id_kota' => $siswa_id_kota]);
    $exec .= delete($koneksi, 'f_siswa_akta', ['siswa_id_kota' => $siswa_id_kota]);
    $exec .= delete($koneksi, 'f_siswa_bantuan', ['siswa_id_kota' => $siswa_id_kota]);
    $exec .= delete($koneksi, 'f_siswa_domisili', ['siswa_id_kota' => $siswa_id_kota]);
    $exec .= delete($koneksi, 'f_siswa_kesehatan', ['siswa_id_kota' => $siswa_id_kota]);
    $exec .= delete($koneksi, 'f_siswa_kk', ['siswa_id_kota' => $siswa_id_kota]);
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
            'message'       => "Update Data Akte Lahir Gagal Bos",
        ];
        echo json_encode($response);
    } 
}
if ($pg == 'activatedUsers') {
    $id = $_POST['id'];
    update($koneksi, 'd_users', ['users_status' => 0], ['users_id' => $id]);
    echo "Data Berhasil Di Non Aktivasi";
}
if ($pg == 'unactivatedUsers') {
    $id = $_POST['id'];
    update($koneksi, 'd_users', ['users_status' => 1], ['users_id' => $id]);
    echo "Data Berhasil Di Aktivasi";
}
if ($pg == 'editUsers') {
    if ($_POST['password'] <> "") {
        $data = [
            'users_nama'    => $_POST['users_nama'],
            'username'      => $_POST['username'],
            'users_level'   => $_POST['users_level'],
            'password'      => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'users_status'  => 1
        ];
    } else {
        $data = [
            'users_nama'    => $_POST['users_nama'],
            'username'      => $_POST['username'],
            'users_level'   => $_POST['users_level'],
            'users_status'  => 1
        ];
    }
    $users_id = $_POST['users_id'];
    $exec = update($koneksi, 'd_users', $data, ['users_id' => $users_id]);
    echo $exec;
}

if ($pg == 'importStudentLembaga') {
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if (isset($_POST['namafile'])) {
        $nama_file_baru = $_POST['namafile'];
        $lembaga_nsm    = $_POST['lembaga_nsm'];
        $tingkat_id     = $_POST['tingkat_id'];
        $tahunajaran_id = $_POST['tahunajaran_id'];
        $jenjang_id = $_POST['jenjang_id'];
        $arr_file = explode('.', $_POST['namafile']);
        $extension = end($arr_file);
        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        if ($extension <> 'xlsx') {
            echo "harap pilih file excel .xlsx";
        } else {
            $path = '../../../tmp/' . $nama_file_baru; // Set tempat menyimpan file tersebut dimana
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
            $sheetNames = $spreadsheet->getSheetNames();
            foreach ($sheetNames as $sheetIndex => $sheetName) {
                if ($sheetName == 'upload_siswa') {
                    $sheetData = $spreadsheet->setActiveSheetIndexByName('upload_siswa')->toArray();
                    $sukses_insert = $gagal_insert = 0;
                    $sukses_update = $gagal_update = 0;
                    for ($i = 1; $i < count($sheetData); $i++) {
                        $siswa_act_nama = str_replace("'", "`", $sheetData[$i]['1']);
                        // $siswa_act_nama = $sheetData[$i]['1'];
                        $siswa_act_gender = $sheetData[$i]['2'];
                        $siswa_act_nis = $sheetData[$i]['3'];
                        $siswa_act_nisn = $sheetData[$i]['4'];
                        $siswa_act_tempat = str_replace("'", "`", $sheetData[$i]['5']);
                        $siswa_act_tgllahir = $sheetData[$i]['6'];
                        $siswa_kk_nik = $sheetData[$i]['7'];
                        $siswa_kk_nomor = $sheetData[$i]['8'];
                        $siswa_act_uuid = $lembaga_nsm . $siswa_act_nis;
                        $cek_id_siswa = rowcount($koneksi, 'f_siswa_act', ['siswa_id_kota' => $siswa_act_uuid]);
                        $cek_id_siswa = rowcount($koneksi, 'f_siswa_act', ['siswa_id_kota' => $siswa_act_uuid]);
                        if (
                            $siswa_act_nama     == "" &&
                            $siswa_act_gender   == "" &&
                            $siswa_act_nis      == "" &&
                            $siswa_act_nisn     == "" &&
                            $siswa_act_tempat   == "" &&
                            $siswa_act_tgllahir == "" &&
                            $siswa_kk_nik   == "" &&
                            $siswa_kk_nomor == ""
                        )
                            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                        if ($cek_id_siswa <> 0) {
                            $f_siswa = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'siswa_act_nama' => ucfirst(strtoupper($siswa_act_nama)),
                                'siswa_nsm' => $lembaga_nsm,
                                'siswa_act_gender' => $siswa_act_gender,
                                'siswa_act_nis' => addslashes($siswa_act_nis),
                                'siswa_act_nisn' => addslashes($siswa_act_nisn),
                                'siswa_act_tempat' => ucfirst(strtoupper($siswa_act_tempat)),
                                'siswa_act_tgllahir' => $siswa_act_tgllahir,
                                'siswa_kk_nik' => $siswa_kk_nik,
                                'tahunajaran_id' => $tahunajaran_id,
                                'tingkat_id' => $tingkat_id,
                                'siswa_kk_nomor' => $siswa_kk_nomor,
                                'siswa_id_kota' => $siswa_act_uuid,
                            ];
                            $f_siswa_act = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'siswa_nsm' => $lembaga_nsm,
                                'siswa_act_tingkat' => $tingkat_id,
                                'siswa_act_nama' => ucfirst(strtoupper($siswa_act_nama)),
                                'siswa_act_nis' => addslashes($siswa_act_nis),
                                'siswa_act_nisn' => addslashes($siswa_act_nisn),
                                'siswa_act_gender' => addslashes($siswa_act_gender),
                                'siswa_act_tempat' => ucfirst(strtoupper($siswa_act_tempat)),
                                'siswa_act_tgllahir' => $siswa_act_tgllahir,
                                'siswa_act_status' => 1,
                            ];
                            $f_siswa_kk = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'siswa_nsm' => $lembaga_nsm,
                                'siswa_kk_nomor' => $siswa_kk_nomor,
                                'siswa_kk_nama' => ucfirst(strtoupper($siswa_act_nama)),
                                'siswa_kk_nik' => $siswa_kk_nik,
                                'siswa_kk_tempat' => ucfirst(strtoupper($siswa_act_tempat)),
                                'siswa_kk_tgllahir' => $siswa_act_tgllahir,
                            ];
                            $data_id = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'siswa_nsm' => $lembaga_nsm,
                            ];
                            $riwayat_siswa = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'tahunajaran_id' => $tahunajaran_id,
                                'tingkat_id' => $tingkat_id,
                                'riwayatsiswa_nsm' => $lembaga_nsm,
                                'jenjang_id' => $jenjang_id,
                                'status_id' => $status_id,
                                'riwayatsiswa_add' => 1,
                            ];
                            $exec = update($koneksi, 'f_siswa', $f_siswa, ['siswa_id_kota' => $siswa_act_uuid]);
                            $exec .= update($koneksi, 'f_siswa_kk', $f_siswa_kk, ['siswa_id_kota' => $siswa_act_uuid]);
                            $exec .= update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id_kota' => $siswa_act_uuid]);
                            $exec .= update($koneksi, 'f_siswa_akta', $data_id, ['siswa_id_kota' => $siswa_act_uuid]);
                            $exec .= update($koneksi, 'f_siswa_bantuan', $data_id, ['siswa_id_kota' => $siswa_act_uuid]);
                            $exec .= update($koneksi, 'f_siswa_domisili', $data_id, ['siswa_id_kota' => $siswa_act_uuid]);
                            $exec .= update($koneksi, 'f_siswa_kesehatan', $data_id, ['siswa_id_kota' => $siswa_act_uuid]);
                            $exec .= update($koneksi, 'f_siswa_kesehatan', $data_id, ['siswa_id_kota' => $siswa_act_uuid]);
                            echo mysqli_error($koneksi);
                            ($exec) ? $sukses_update++ : $gagal_update++;
                        } else {
                            $f_siswa = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'siswa_act_nama' => ucfirst(strtoupper($siswa_act_nama)),
                                'siswa_nsm' => $lembaga_nsm,
                                'siswa_act_gender' => $siswa_act_gender,
                                'siswa_act_nis' => addslashes($siswa_act_nis),
                                'siswa_act_nisn' => addslashes($siswa_act_nisn),
                                'siswa_act_tempat' => ucfirst(strtoupper($siswa_act_tempat)),
                                'siswa_act_tgllahir' => $siswa_act_tgllahir,
                                'siswa_kk_nik' => $siswa_kk_nik,
                                'siswa_kk_nomor' => $siswa_kk_nomor,
                                'siswa_id_kota' => $siswa_act_uuid,
                                'tingkat_id' => $tingkat_id,
                                'tahunajaran_id' => $tahunajaran_id,
                            ];
                            $f_siswa_act = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'siswa_nsm' => $lembaga_nsm,
                                'siswa_act_tingkat' => $tingkat_id,
                                'siswa_act_nama' => ucfirst(strtoupper($siswa_act_nama)),
                                'siswa_act_nis' => addslashes($siswa_act_nis),
                                'siswa_act_nisn' => addslashes($siswa_act_nisn),
                                'siswa_act_gender' => addslashes($siswa_act_gender),
                            ];
                            $f_siswa_kk = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'siswa_nsm' => $lembaga_nsm,
                                'siswa_kk_nomor' => $siswa_kk_nomor,
                                'siswa_kk_nama' => ucfirst(strtoupper($siswa_act_nama)),
                                'siswa_kk_nik' => $siswa_kk_nik,
                                'siswa_kk_tempat' => ucfirst(strtoupper($siswa_act_tempat)),
                                'siswa_kk_tgllahir' => $siswa_act_tgllahir,
                            ];
                            $data_id = [
                                'siswa_id_kota' => $siswa_act_uuid,
                                'siswa_nsm' => $lembaga_nsm,
                            ];
                            $exec = insert($koneksi, 'f_siswa', $f_siswa);
                            $exec .= insert($koneksi, 'f_siswa_kk', $f_siswa_kk);
                            $exec .= insert($koneksi, 'f_siswa_act', $f_siswa_act);
                            $exec .= insert($koneksi, 'f_siswa_akta', $data_id);
                            $exec .= insert($koneksi, 'f_siswa_bantuan', $data_id);
                            $exec .= insert($koneksi, 'f_siswa_domisili', $data_id);
                            $exec .= insert($koneksi, 'f_siswa_kesehatan', $data_id);
                            echo mysqli_error($koneksi);
                            ($exec) ? $sukses_insert++ : $gagal_insert++;
                        }
                    }
                    echo "Sukses Import :" .
                        " Add = "
                        . $sukses_insert .
                        " Gagal = "
                        . $gagal_insert .
                        " ||| Sudah Ada :" .
                        " Update = "
                        . $sukses_update .
                        " Gagal = "
                        . $gagal_insert;
                }
            }
        }
    }
}

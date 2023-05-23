<?php

require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");
if ($pg == 'showregist') {
    $tahunajaran_id = isset($_POST['tahunajaran_id']) ? $_POST['tahunajaran_id'] : '';
    $query = "SELECT * FROM t_ppdbregist a 
        LEFT JOIN e_tahunajaran b ON a.tahunajaran_id = b.tahunajaran_id
        LEFT JOIN t_ppdbjurusan c ON a.ppdbjurusan_id = c.ppdbjurusan_id";
    if ($tahunajaran_id) {
        $query .= " WHERE a.tahunajaran_id = '$tahunajaran_id'";
    }
    $query .= " ORDER BY a.ppdbregist_id ASC";
    $results = $koneksi->prepare($query);
    $results->execute();
    $result = $results->get_result();
    $data = array();
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $data[$i]['ppdbregist_id']      = enkripsi($row['ppdbregist_id']);
        $data[$i]['tahunajaran_id']     = $row['tahunajaran_id'];
        $data[$i]['tahunajaran_nama']     = $row['tahunajaran_nama'];
        $data[$i]['ppdbjurusan_id']  = $row['ppdbjurusan_id'];
        $data[$i]['ppdbjurusan_name']  = $row['ppdbjurusan_name'];
        $data[$i]['ppdbregist_number']  = $row['ppdbregist_number'];
        $data[$i]['ppdbregist_name']    = $row['ppdbregist_name'];
        $data[$i]['ppdbregist_gender']  = $row['ppdbregist_gender'];
        $data[$i]['ppdbregist_tempat']  = $row['ppdbregist_tempat'];
        $data[$i]['ppdbregist_tgllahir'] = $row['ppdbregist_tgllahir'];
        $data[$i]['ppdbregist_nisn']    = $row['ppdbregist_nisn'];
        $data[$i]['ppdbregist_nokk']    = $row['ppdbregist_nokk'];
        $data[$i]['ppdbregist_nik']     = $row['ppdbregist_nik'];
        $data[$i]['ppdbregist_nohp']    = $row['ppdbregist_nohp'];
        $data[$i]['ppdbregist_actived'] = $row['ppdbregist_actived'];
        $data[$i]['password']           = $row['password'];
        $i++;
    }
    echo json_encode(array('data' => $data));
}

if ($pg == 'storeRegistrations') {
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
if ($pg == 'showSelectTahunajaran2') {
    $query = "SELECT DISTINCT b.tahunajaran_id, b.tahunajaran_nama FROM t_ppdbregist a 
    LEFT JOIN e_tahunajaran b ON a.tahunajaran_id = b.tahunajaran_id
    LEFT JOIN t_ppdbjurusan c ON a.ppdbjurusan_id = c.ppdbjurusan_id
    ORDER BY b.tahunajaran_id ASC";
    $results = $koneksi->prepare($query);
    $results->execute();
    $result = $results->get_result();
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'id' => $row['tahunajaran_id'],
            'text' => $row['tahunajaran_nama']
        );
    }
    echo json_encode($data);
}
if ($pg == 'showSelectTahunajaran') {
    echo "<option value=''>Pilih Tahun Periode</option>";
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
    echo "<option value=''>Pilih Kelas</option>";
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
if ($pg == 'deleteRegistrations') {
    $ppdbregist_id = dekripsi($_POST['id']);
    $exec = delete($koneksi, 't_ppdbregist', ['ppdbregist_id' => $ppdbregist_id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'title_message' => "Sukses",
            'icon'          => "success",
            'message'       => "Delete Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'title_message' => "Ooops..!",
            'icon'          => "error",
            'message'       => "Delete Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'dtUnactivated') {
    $ppdbregist_id = dekripsi($_POST['id']);
    $exec = update(
        $koneksi,
        't_ppdbregist',
        ['ppdbregist_actived' => 0],
        ['ppdbregist_id' => $ppdbregist_id]
    );
    if ($exec) {
        $response = [
            'status'        => 200,
            'title_message' => "Sukses",
            'icon'          => "warning",
            'message'       => "Registrations tidak diaktifkan",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'title_message' => "Ooops..!",
            'icon'          => "error",
            'message'       => "Update Data Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'dtActivated') {
    $ppdbregist_id = dekripsi($_POST['id']);
    $exec = update(
        $koneksi,
        't_ppdbregist',
        ['ppdbregist_actived' => 1],
        ['ppdbregist_id' => $ppdbregist_id]
    );
    if ($exec) {
        $response = [
            'status'        => 200,
            'title_message' => "Sukses",
            'icon'          => "success",
            'message'       => "Registrations tidak diaktifkan",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'title_message' => "Ooops..!",
            'icon'          => "error",
            'message'       => "Update Data Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'updateRegistrations') {
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
        'ppdbregist_name'        => strtoupper($ppdbregist_name),
        'ppdbregist_gender'      => $_POST['ppdbregist_gender'],
        'ppdbregist_tempat'      => strtoupper($ppdbregist_tempat),
        'ppdbregist_tgllahir'    => $_POST['ppdbregist_tgllahir'],
        'ppdbregist_nisn'        => $_POST['ppdbregist_nisn'],
        'ppdbregist_nokk'        => $_POST['ppdbregist_nokk'],
        'ppdbregist_nik'         => $_POST['ppdbregist_nik'],
        'ppdbregist_anakke'      => $_POST['ppdbregist_anakke'],
        'ppdbregist_saudara'     => $_POST['ppdbregist_saudara'],
        'ppdbregist_hobi'        => $_POST['ppdbregist_hobi'],
        'ppdbregist_cita'        => $_POST['ppdbregist_cita'],
        'ppdbregist_nohp'        => $post_ppdbregist_nohp,
        'password'               => $_POST['password'],
        'ppdbregist_actived'     => 1,
    ];

    $q_nisn = mysqli_query($koneksi, "SELECT * FROM t_ppdbregist where ppdbregist_nisn='$_POST[ppdbregist_nisn]'");
    $cek_nisn = mysqli_num_rows($q_nisn);
    if ($cek_nisn == true) {
        $q_nik = mysqli_query($koneksi, "SELECT * FROM t_ppdbregist where ppdbregist_nik='$_POST[ppdbregist_nik]'");
        $cek_nik = mysqli_num_rows($q_nik);
        if ($cek_nik == true) {
            $id = $_POST['ppdbregist_id'];
            $execute_address = update($koneksi, 't_ppdbregist', $t_ppdbregist, ['ppdbregist_id' => $id]);
            if ($execute_address) {
                $response = [
                    'idRegist'      => enkripsi($_POST['ppdbregist_id']),
                    'status'        => 200,
                    'title_message' => "Sukses",
                    'icon'          => "success",
                    'message'       => "Update aLAMAT data berhasil",
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'status'        => 500,
                    'title_message' => "Ooops..!",
                    'icon'          => "error",
                    'message'       => "Gagal mengupdate data",
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status'        => 300,
                'title_message' => "Ooops..!",
                'icon'          => "error",
                'message'       => "NIK Tidak boleh di edit",
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'status'        => 300,
            'title_message' => "Ooops..!",
            'icon'          => "error",
            'message'       => "NISN Tidak boleh di edit",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'updateAddressRegist') {
    $ppdbregist_prov = str_replace("'", "`", $_POST['ppdbregist_prov']);
    $ppdbregist_kota = str_replace("'", "`", $_POST['ppdbregist_kota']);
    $ppdbregist_kec = str_replace("'", "`", $_POST['ppdbregist_kec']);
    $ppdbregist_kel = str_replace("'", "`", $_POST['ppdbregist_kel']);
    $ppdbregist_alamat = str_replace("'", "`", $_POST['ppdbregist_alamat']);
    $t_ppdbregist = [
        'ppdbregist_stt'         => $_POST['ppdbregist_stt'],
        'ppdbregist_prov'        => strtoupper($ppdbregist_prov),
        'ppdbregist_kota'        => strtoupper($ppdbregist_kota),
        'ppdbregist_kec'         => strtoupper($ppdbregist_kec),
        'ppdbregist_kel'         => strtoupper($ppdbregist_kel),
        'ppdbregist_alamat'      => strtoupper($ppdbregist_alamat),
        'ppdbregist_rt'          => $_POST['ppdbregist_rt'],
        'ppdbregist_rw'          => $_POST['ppdbregist_rw'],
        'ppdbregist_kodepos'     => $_POST['ppdbregist_kodepos'],
        'ppdbregist_jarak'       => $_POST['ppdbregist_jarak'],
        'ppdbregist_transportasi' => $_POST['ppdbregist_transportasi'],
    ];
    $id = $_POST['ppdbregist_id'];
    $update_exec = update($koneksi, 't_ppdbregist', $t_ppdbregist, ['ppdbregist_id' => $id]);
    if ($update_exec) {
        $response = [
            'idRegist'      => enkripsi($_POST['ppdbregist_id']),
            'status'        => 200,
            'title_message' => "Sukses",
            'icon'          => "success",
            'message'       => "Update alamat data berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'title_message' => "Ooops..!",
            'icon'          => "error",
            'message'       => "Gagal mengupdate data",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'updateParentRegist') {
    $ppdbayah_name = str_replace("'", "`", $_POST['ppdbayah_name']);
    $ppdbayah_tempat = str_replace("'", "`", $_POST['ppdbayah_tempat']);
    $ppdbibu_name = str_replace("'", "`", $_POST['ppdbibu_name']);
    $ppdbibu_tempat = str_replace("'", "`", $_POST['ppdbibu_tempat']);
    $ppdbwali_name = str_replace("'", "`", $_POST['ppdbwali_name']);
    $ppdbwali_tempat = str_replace("'", "`", $_POST['ppdbwali_tempat']);
    $t_ppdbregist = [
        'ppdbayah_status' => $_POST['ppdbayah_status'],
        'ppdbayah_name' => strtoupper($ppdbayah_name),
        'ppdbayah_wn' => $_POST['ppdbayah_wn'],
        'ppdbayah_nik' => $_POST['ppdbayah_nik'],
        'ppdbayah_tempat' => strtoupper($ppdbayah_tempat),
        'ppdbayah_tgllahir' => $_POST['ppdbayah_tgllahir'],
        'ppdbayah_pekerjaan' => $_POST['ppdbayah_pekerjaan'],
        'ppdbayah_pendidikan' => $_POST['ppdbayah_pendidikan'],
        'ppdbayah_penghasilan' => $_POST['ppdbayah_penghasilan'],
        'ppdbayah_nohp' => $_POST['ppdbayah_nohp'],
        'ppdbibu_status' => $_POST['ppdbibu_status'],
        'ppdbibu_name' => strtoupper($ppdbibu_name),
        'ppdbibu_wn' => $_POST['ppdbibu_wn'],
        'ppdbibu_nik' => $_POST['ppdbibu_nik'],
        'ppdbibu_tempat' => strtoupper($ppdbibu_tempat),
        'ppdbibu_tgllahir' => $_POST['ppdbibu_tgllahir'],
        'ppdbibu_pekerjaan' => $_POST['ppdbibu_pekerjaan'],
        'ppdbibu_pendidikan' => $_POST['ppdbibu_pendidikan'],
        'ppdbibu_penghasilan' => $_POST['ppdbibu_penghasilan'],
        'ppdbibu_nohp' => $_POST['ppdbibu_nohp'],
        'ppdbwali_status' => $_POST['ppdbwali_status'],
        'ppdbwali_name' => strtoupper($ppdbwali_name),
        'ppdbwali_wn' => $_POST['ppdbwali_wn'],
        'ppdbwali_nik' => $_POST['ppdbwali_nik'],
        'ppdbwali_tempat' => strtoupper($ppdbwali_tempat),
        'ppdbwali_tgllahir' => $_POST['ppdbwali_tgllahir'],
        'ppdbwali_pekerjaan' => $_POST['ppdbwali_pekerjaan'],
        'ppdbwali_pendidikan' => $_POST['ppdbwali_pendidikan'],
        'ppdbwali_penghasilan' => $_POST['ppdbwali_penghasilan'],
        'ppdbwali_nohp' => $_POST['ppdbwali_nohp'],
    ];
    $id = $_POST['ppdbregist_id'];
    $update_exec = update($koneksi, 't_ppdbregist', $t_ppdbregist, ['ppdbregist_id' => $id]);
    if ($update_exec != "NO") {
        $response = [
            // 'datanya' => $t_ppdbregist,
            // 'update_exec' => $update_exec,
            'idRegist' => enkripsi($_POST['ppdbregist_id']),
            'status' => 200,
            'title_message' => "Sukses",
            'icon' => "success",
            'message' => "Update alamat data berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            // 'datanya' => $t_ppdbregist,
            // 'update_exec' => $update_exec,
            'status' => 500,
            'title_message' => "Ooops..!",
            'icon' => "error",
            'message' => "Gagal mengupdate data",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'updatePreviousRegist') {
    $ppdbasal_sekolah = str_replace("'", "`", $_POST['ppdbasal_sekolah']);
    $ppdbasal_kota = str_replace("'", "`", $_POST['ppdbasal_kota']);
    $ppdbasal_noujian = str_replace("'", "`", $_POST['ppdbasal_noujian']);
    $ppdbasal_noijazah = str_replace("'", "`", $_POST['ppdbasal_noijazah']);
    $t_ppdbregist = [
        'ppdbasal_jenjang' => $_POST['ppdbasal_jenjang'],
        'ppdbasal_status' => $_POST['ppdbasal_status'],
        'ppdbasal_npsn' => $_POST['ppdbasal_npsn'],
        'ppdbasal_sekolah' => strtoupper($ppdbasal_sekolah),
        'ppdbasal_kota' => strtoupper($ppdbasal_kota),
        'ppdbasal_tahun' => $_POST['ppdbasal_tahun'],
        'ppdbasal_noujian' => strtoupper($ppdbasal_noujian),
        'ppdbasal_noijazah' => strtoupper($ppdbasal_noijazah),
    ];
    $id = $_POST['ppdbregist_id'];
    $update_exec = update($koneksi, 't_ppdbregist', $t_ppdbregist, ['ppdbregist_id' => $id]);
    if ($update_exec != "NO") {
        $response = [
            // 'datanya' => $t_ppdbregist,
            // 'update_exec' => $update_exec,
            'idRegist' => enkripsi($_POST['ppdbregist_id']),
            'status' => 200,
            'title_message' => "Sukses",
            'icon' => "success",
            'message' => "Update alamat data berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            // 'datanya' => $t_ppdbregist,
            // 'update_exec' => $update_exec,
            'status' => 500,
            'title_message' => "Ooops..!",
            'icon' => "error",
            'message' => "Gagal mengupdate data",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'deletePatchExcel') {
    if (isset($_POST['filepath'])) {
        $filepath = $_POST['filepath'];
        if (file_exists($filepath)) {
            if (unlink($filepath)) {
                echo "File berhasil dihapus.";
            } else {
                echo "Gagal menghapus file.";
            }
        } else {
            echo "File tidak ditemukan.";
        }
    }
}

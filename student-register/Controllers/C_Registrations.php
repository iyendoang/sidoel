<?php

require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");

if ($pg == 'showSelectTahunajaran') {
    echo "<option value=''>Pilih Kelas</option>";
    $query = "SELECT * FROM e_tahunajaran a 
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
    ORDER BY a.ppdbjurusan_id ASC
    ";
    $query = $koneksi->prepare($query);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['ppdbjurusan_id'] . "'>" . $row['ppdbjurusan_name'] . "</option>";
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
        'ppdbjurusan_id'         => $_POST['ppdbjurusan_id'],
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

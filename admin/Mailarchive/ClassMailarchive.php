<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
if ($pg == 'showjurusan') {
    $i = 1;
    $query = "SELECT * FROM t_ppdbjurusan
    ORDER BY ppdbjurusan_actived DESC
    ";
    $results = $koneksi->prepare($query);
    $results->execute();
    $result = $results->get_result();
    while ($row = $result->fetch_assoc()) {
        $data[$i]['ppdbjurusan_id'] = enkripsi($row['ppdbjurusan_id']);
        $data[$i]['ppdbjurusan_alias'] = $row['ppdbjurusan_alias'];
        $data[$i]['ppdbjurusan_name'] = $row['ppdbjurusan_name'];
        $data[$i]['ppdbjurusan_desc'] = $row['ppdbjurusan_desc'];
        $data[$i]['ppdbjurusan_actived'] = $row['ppdbjurusan_actived'];
        $i++;
    }

    // $json = array_values(array($data));
    $json = array_values($data);
    echo json_encode(array('data' => $json));
}

if ($pg == 'storeMailarchive') {
    $t_ppdbjurusan = [
        'ppdbjurusan_alias'           => $_POST['ppdbjurusan_alias'],
        'ppdbjurusan_name'            => $_POST['ppdbjurusan_name'],
        'ppdbjurusan_desc'            => $_POST['ppdbjurusan_desc'],
        'ppdbjurusan_actived'         => 1,
    ];
    $q_ppdbjurusan = mysqli_query($koneksi, "SELECT * FROM t_ppdbjurusan where ppdbjurusan_alias='$_POST[ppdbjurusan_alias]'");
    $cek_jurusan = mysqli_num_rows($q_ppdbjurusan);
    if ($cek_jurusan == 0) {
        mysqli_query($koneksi, "UPDATE t_ppdbjurusan SET ppdbjurusan_actived=0");
        $add_exec = insert($koneksi, 't_ppdbjurusan', $t_ppdbjurusan);
        if ($add_exec) {
            $response = [
                'status'        => 200,
                'icon'          => "success",
                'message'       => "Insert Data Jurusan Berhasil",
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status'        => 500,
                'icon'          => "error",
                'message'       => "Insert Data Jurusan Gagal Bos",
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'status'        => 300,
            'icon'          => "error",
            'message'       => "kode Jurusan sudah ada tidak boleh ganda",
        ];
        echo json_encode($response);
    }
}

if ($pg == 'deleteMailarchive') {
    $ppdbjurusan_id = dekripsi($_POST['id']);
    $exec = delete($koneksi, 't_ppdbjurusan', ['ppdbjurusan_id' => $ppdbjurusan_id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Delete Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Delete Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'dtUnactivated') {
    $ppdbjurusan_id = dekripsi($_POST['id']);
    mysqli_query($koneksi, "UPDATE t_ppdbjurusan SET ppdbjurusan_actived=0");
    $exec = update(
        $koneksi,
        't_ppdbjurusan',
        ['ppdbjurusan_actived' => 0],
        ['ppdbjurusan_id' => $ppdbjurusan_id]
    );
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "warning",
            'message'       => "Mailarchive tidak diaktifkan",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'dtActivated') {
    $ppdbjurusan_id = dekripsi($_POST['id']);
    mysqli_query($koneksi, "UPDATE t_ppdbjurusan SET ppdbjurusan_actived=0");
    $exec = update(
        $koneksi,
        't_ppdbjurusan',
        ['ppdbjurusan_actived' => 1],
        ['ppdbjurusan_id' => $ppdbjurusan_id]
    );
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Mailarchive tidak diaktifkan",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Gagal Bos",
        ];
        echo json_encode($response);
    }
}

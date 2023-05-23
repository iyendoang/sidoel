<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");
if ($pg == 'showjurusan') {
    // Definisi fungsi hitungTotalSiswa()
    function hitungTotalSiswa($jurusanAlias)
    {
        // Query untuk menghitung total siswa berdasarkan ppdbjurusan_id
        $query = "SELECT COUNT(*) AS total FROM t_ppdbregist WHERE ppdbjurusan_id = ?";
        // Menggunakan prepared statement
        global $koneksi;
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("i", $jurusanAlias);
        $stmt->execute();
        $result = $stmt->get_result();
        // Mengambil hasil perhitungan total siswa
        $row = $result->fetch_assoc();
        $total = $row['total'];
        return $total;
    }
    $query = "SELECT * FROM t_ppdbjurusan
    ORDER BY ppdbjurusan_actived DESC";
    $results = $koneksi->prepare($query);
    $results->execute();
    $result = $results->get_result();

    $data = array();
    $i = 0;
    $totalSiswa = 0;

    while ($row = $result->fetch_assoc()) {
        $data[$i]['ppdbjurusan_id_enc'] = enkripsi($row['ppdbjurusan_id']);
        $data[$i]['ppdbjurusan_id'] = $row['ppdbjurusan_id'];
        $data[$i]['ppdbjurusan_alias'] = $row['ppdbjurusan_alias'];
        $data[$i]['ppdbjurusan_kuota'] = $row['ppdbjurusan_kuota'];
        $data[$i]['ppdbjurusan_name'] = $row['ppdbjurusan_name'];
        $data[$i]['ppdbjurusan_desc'] = $row['ppdbjurusan_desc'];
        $data[$i]['ppdbjurusan_actived'] = $row['ppdbjurusan_actived'];
        $data[$i]['total_siswa_jurusan'] = hitungTotalSiswa($row['ppdbjurusan_id']);

        // Menghitung total siswa
        $totalSiswa += hitungTotalSiswa($row['ppdbjurusan_id']);

        $i++;
    }

    $json = array_values($data);
    $response = array('data' => $json, 'total_siswa' => $totalSiswa);
    echo json_encode($response);

    $koneksi->close();
}

if ($pg == 'storeMajors') {
    $t_ppdbjurusan = [
        'ppdbjurusan_alias'           => $_POST['ppdbjurusan_alias'],
        'ppdbjurusan_kuota'           => $_POST['ppdbjurusan_kuota'],
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
if ($pg == 'dtUnactivated') {
    $ppdbjurusan_id = $_POST['id'];
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
            'message'       => "Majors tidak diaktifkan",
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
    $ppdbjurusan_id = $_POST['id'];
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
            'message'       => "Majors tidak diaktifkan",
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
if ($pg == 'showbyidmajors') {
    // Memastikan parameter id ada dan tidak kosong
    if (isset($_GET['ppdbjurusan_id'])) {
        // Mengambil ID dari URL
        $ppdbjurusan_id = $_GET['ppdbjurusan_id'];

        // Query untuk mendapatkan data surat masuk berdasarkan ID
        $query = "SELECT * FROM t_ppdbjurusan WHERE ppdbjurusan_id = $ppdbjurusan_id";
        $result = mysqli_query($koneksi, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);
        } else {
            echo 'Data surat masuk tidak ditemukan.';
        }
    } else {
        echo 'Parameter ID tidak valid.';
    }
}
if ($pg == 'editMajors') {
    $t_ppdbjurusan = [
        // 'ppdbjurusan_alias'           => $_POST['ppdbjurusan_alias'],
        'ppdbjurusan_kuota'           => $_POST['ppdbjurusan_kuota'],
        'ppdbjurusan_name'            => $_POST['ppdbjurusan_name'],
        'ppdbjurusan_desc'            => $_POST['ppdbjurusan_desc'],
    ];
    $ppdbjurusan_id = $_POST['ppdbjurusan_id'];
    $update_exec = update($koneksi, 't_ppdbjurusan', $t_ppdbjurusan, ['ppdbjurusan_id' => $ppdbjurusan_id]);
    if ($update_exec == true) {
        $response = [
            'datanya' => $update_exec,
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Jurusan Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Jurusan Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'deleteMajors') {
    $ppdbjurusan_id = $_POST['id'];
    $query = "SELECT COUNT(*) AS total FROM t_ppdbregist WHERE ppdbjurusan_id = $ppdbjurusan_id";
    $result = $koneksi->query($query);
    $row = $result->fetch_assoc();
    $total = $row['total'];
    if ($total > 0) {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Tidak dapat menghapus data karena ada data terkait di tabel PPDB.",
        ];
        echo json_encode($response);
    } else {
        $deleteQuery = "DELETE FROM t_ppdbjurusan WHERE ppdbjurusan_id = $ppdbjurusan_id";
        if ($koneksi->query($deleteQuery) === TRUE) {
            $response = [
                'status'        => 200,
                'icon'          => "success",
                'message'       => "Data berhasil dihapus.",
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status'        => 500,
                'icon'          => "error",
                'message'       => "Gagal menghapus data: " . $koneksi->error,
            ];
            echo json_encode($response);
        }
    }
}

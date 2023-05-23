<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

if ($pg == 'showperiode') {
    // Definisi fungsi hitungTotalSiswa()
    function hitungTotalSiswa($tahunajaranId)
    {
        // Query untuk menghitung total siswa berdasarkan tahunajaran_id
        $query = "SELECT COUNT(*) AS total FROM t_ppdbregist WHERE tahunajaran_id = ?";

        // Menggunakan prepared statement
        global $koneksi;
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("i", $tahunajaranId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Mengambil hasil perhitungan total siswa
        $row = $result->fetch_assoc();
        $total = $row['total'];

        return $total;
    }
    $query = "SELECT * FROM t_ppdbperiode a 
    LEFT JOIN e_tahunajaran b ON a.tahunajaran_id = b.tahunajaran_id
    ORDER BY a.tahunajaran_id DESC";

    $results = $koneksi->prepare($query);
    $results->execute();
    $result = $results->get_result();

    $data = array();
    $i = 0;
    $totalSiswa = 0;

    while ($row = $result->fetch_assoc()) {
        $data[$i]['ppdbperiode_id'] = enkripsi($row['ppdbperiode_id']);
        $data[$i]['periodetrue_id'] = $row['ppdbperiode_id'];
        $data[$i]['tahunajaran_id'] = $row['tahunajaran_id'];
        $data[$i]['tahunajaran_nama'] = $row['tahunajaran_nama'];
        $data[$i]['ppdbperiode_opened'] = $row['ppdbperiode_opened'];
        $data[$i]['ppdbperiode_closed'] = $row['ppdbperiode_closed'];
        $data[$i]['ppdbperiode_actived'] = $row['ppdbperiode_actived'];
        $data[$i]['total_siswa_thn'] = hitungTotalSiswa($row['tahunajaran_id']);

        // Menghitung total siswa
        $totalSiswa += hitungTotalSiswa($row['tahunajaran_id']);

        $i++;
    }

    $json = array_values($data);
    $response = array('data' => $json, 'total_siswa' => $totalSiswa);
    echo json_encode($response);

    $koneksi->close();
}
if ($pg == 'showSelectTahunajaran') {
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
if ($pg == 'storePeriode') {
    if (!empty($_POST['tahunajaran_id'])) {
        $t_ppdbperiode = [
            'tahunajaran_id'                => $_POST['tahunajaran_id'],
            'ppdbperiode_opened'            => $_POST['ppdbperiode_opened'],
            'ppdbperiode_closed'            => $_POST['ppdbperiode_closed'],
            'ppdbperiode_actived'           => 1,
        ];
        $q_ppdbperiode = mysqli_query($koneksi, "SELECT * FROM t_ppdbperiode where tahunajaran_id='$_POST[tahunajaran_id]'");
        $cek_periode = mysqli_num_rows($q_ppdbperiode);
        if ($cek_periode == 0) {
            mysqli_query($koneksi, "UPDATE t_ppdbperiode SET ppdbperiode_actived=0");
            $add_exec = insert($koneksi, 't_ppdbperiode', $t_ppdbperiode);
            if ($add_exec == true) {
                $response = [
                    'data'        => $add_exec,
                    'data2'        => $t_ppdbperiode,
                    'status'        => 200,
                    'icon'          => "success",
                    'message'       => "Insert Data Prestasi Berhasil",
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'status'        => 500,
                    'icon'          => "error",
                    'message'       => "Insert Data Prestasi Gagal Bos",
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status'        => 300,
                'icon'          => "error",
                'message'       => "Tahun Periode sudah ada tidak boleh ganda",
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'status'        => 300,
            'icon'          => "error",
            'message'       => "Tahun Periode Tidak Boleh Kosong",
        ];
        echo json_encode($response);
    }
}


if ($pg == 'dtUnactivated') {
    $ppdbperiode_id = dekripsi($_POST['id']);
    mysqli_query($koneksi, "UPDATE t_ppdbperiode SET ppdbperiode_actived=0");
    $exec = update($koneksi, 't_ppdbperiode', ['ppdbperiode_actived' => 0], ['ppdbperiode_id' => $ppdbperiode_id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "warning",
            'message'       => "Periode tidak diaktifkan",
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
if ($pg == 'dtActivated') {
    $ppdbperiode_id = dekripsi($_POST['id']);
    mysqli_query($koneksi, "UPDATE t_ppdbperiode SET ppdbperiode_actived=0");
    $exec = update($koneksi, 't_ppdbperiode', ['ppdbperiode_actived' => 1], ['ppdbperiode_id' => $ppdbperiode_id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Periode tidak diaktifkan",
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
if ($pg == 'showbyidperiode') {
    // Memastikan parameter id ada dan tidak kosong
    if (isset($_GET['ppdbperiode_id'])) {
        // Mengambil ID dari URL
        $ppdbperiode_id = $_GET['ppdbperiode_id'];
        // Query untuk mendapatkan data surat masuk berdasarkan ID
        $query = " SELECT * FROM t_ppdbperiode a 
        LEFT JOIN e_tahunajaran b ON a.tahunajaran_id = b.tahunajaran_id
        WHERE a.ppdbperiode_id = $ppdbperiode_id ";
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
if ($pg == 'editperiode') {
    $t_ppdbperiode = [
        // 'tahunajaran_id'      => $_POST['tahunajaran_id'],
        'ppdbperiode_opened'  => $_POST['ppdbperiode_opened'],
        'ppdbperiode_closed'  => $_POST['ppdbperiode_closed'],
    ];
    $ppdbperiode_id = $_POST['ppdbperiode_id'];
    $update_exec = update($koneksi, 't_ppdbperiode', $t_ppdbperiode, ['ppdbperiode_id' => $ppdbperiode_id]);
    if ($update_exec == 'OK') {
        $response = [
            'datanya'       => $update_exec,
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data periode Berhasil",
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Tahun ajaran yang diupdate sudah ada",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'deletePeriode') {
    $tahunajaran_id = $_POST['id'];
    $query = "SELECT COUNT(*) AS total FROM t_ppdbregist WHERE tahunajaran_id = $tahunajaran_id";
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
        $deleteQuery = "DELETE FROM t_ppdbperiode WHERE tahunajaran_id = $tahunajaran_id";
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

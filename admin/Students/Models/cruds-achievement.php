<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

if ($pg == 'dataPrestasi') {
    $i = 1;
    $query = "SELECT * FROM e_prestasi a 
    LEFT JOIN e_siswa b ON a.siswa_id = b.siswa_id
    LEFT JOIN e_kelas c ON a.kelas_id = c.kelas_id
    LEFT JOIN e_tingkat d ON c.tingkat_id = d.tingkat_id
    LEFT JOIN e_jurusan e ON c.jurusan_id = e.jurusan_id
    LEFT JOIN e_tahunajaran f ON a.tahunajaran_id = f.tahunajaran_id
    LEFT JOIN e_semester g ON a.semester_id = g.semester_id
    ";
    $results = $koneksi->prepare($query);
    $results->execute();
    $result = $results->get_result();
    while ($row = $result->fetch_assoc()) {
        $data[$i]['siswa_id'] = $row['siswa_id'];
        $data[$i]['siswa_nama'] = $row['siswa_nama'];
        $data[$i]['kelas_id'] = $row['kelas_id'];
        $data[$i]['prestasi_id'] = enkripsi($row['prestasi_id']);
        $data[$i]['jurusan_nama'] = $row['jurusan_nama'];
        $data[$i]['tingkat_nama'] = $row['tingkat_nama'];
        $data[$i]['kelas_nama'] = $row['kelas_nama'];
        $data[$i]['prestasi_nama'] = $row['prestasi_nama'];
        $data[$i]['prestasi_keterangan'] = $row['prestasi_keterangan'];
        $data[$i]['tahunajaran_nama'] = $row['tahunajaran_nama'];
        $data[$i]['semester_nama'] = $row['semester_nama'];
        $i++;
    }

    // $json = array_values(array($data));
    $json = array_values($data);
    echo json_encode(array('data' => $json));
}
if ($pg == 'selectKelasId') {
    echo "<option value=''>Pilih Kelas</option>";
    $query = "SELECT * FROM e_siswa a 
    LEFT JOIN e_riwayatsiswa b ON a.siswa_id = b.siswa_id
    LEFT JOIN e_tahunajaran c ON b.tahunajaran_id = c.tahunajaran_id
    LEFT JOIN e_kelaslock d ON b.kelas_id = d.kelas_id
    LEFT JOIN e_kelas e ON b.kelas_id = e.kelas_id
    LEFT JOIN e_tingkat f ON f.tingkat_id = e.tingkat_id
    LEFT JOIN e_jurusan g ON g.jurusan_id = e.jurusan_id
    LEFT JOIN e_semester h ON h.semester_id = d.semester_id
    WHERE a.kelas_id != '-1' AND c.tahunajaran_status = '1' AND a.siswa_alasan_mutasi IS NULL
    GROUP BY b.kelas_id ORDER BY f.tingkat_urutan ASC
    ";
    $query = $koneksi->prepare($query);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['kelas_id'] . "'>" . $row['tingkat_nama'] . '-' . $row['kelas_nama']  . '-' . $row['jurusan_nama'] . "</option>";
    }
}
if ($pg == 'selectSiswaId') {
    $kelas_id = $_POST['kelas_id'];
    echo "<option value=''>Pilih Siswa</option>";
    $query = "SELECT * FROM e_siswa a 
    LEFT JOIN e_kelas e ON a.kelas_id = e.kelas_id
    LEFT JOIN e_tahunajaran c ON e.tahunajaran_id = c.tahunajaran_id
    LEFT JOIN e_tingkat f ON f.tingkat_id = e.tingkat_id
    LEFT JOIN e_jurusan g ON g.jurusan_id = e.jurusan_id
    WHERE  c.tahunajaran_status = '1' AND a.siswa_alasan_mutasi IS NULL AND a.kelas_id=?
    ORDER BY a.siswa_nama ASC
    ";
    $query = $koneksi->prepare($query);
    $query->bind_param("i", $kelas_id);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['siswa_id'] . "'>" . $row['siswa_nama'] . "</option>";
    }
}
if ($pg == 'addAchievementStudent') {
    if (!empty($_POST['siswa_id'])) {
        $e_prestasi = [
            'lembaga_id'            => $_POST['lembaga_id'],
            'tahunajaran_id'        => $_POST['tahunajaran_id'],
            'semester_id'           => $_POST['semester_id'],
            'siswa_id'              => $_POST['siswa_id'],
            'kelas_id'              => $_POST['kelas_id'],
            'prestasi_nama'         => ucwords(strtoupper($_POST['prestasi_nama'])),
            'prestasi_keterangan'   => ucfirst(strtolower($_POST['prestasi_keterangan'])),
        ];
        $addd_exec = insert($koneksi, 'e_prestasi', $e_prestasi);
        if ($addd_exec) {
            $response = [
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
            'message'       => "Nama Siswa Tidak Boleh Kosong",
        ];
        echo json_encode($response);
    }
}

if ($pg == 'dataPrestasiDeleted') {
    $prestasi_id = dekripsi($_POST['id']);
    $exec = delete($koneksi, 'e_prestasi', ['prestasi_id' => $prestasi_id]);
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

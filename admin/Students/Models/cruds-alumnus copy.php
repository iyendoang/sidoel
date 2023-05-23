<?php
require("../../../config/function.php");
require("../../../config/database.php");
require("../../../config/functions.crud.php");

if ($pg == 'dataAlumnus') {
    // Database connection info 
    $sql_details = array(
        'host' => $server,
        'user' => $username,
        'pass' => $password,
        'db'   => $database
    );
    $table = <<<EOT
 (
    SELECT 
      a.siswa_id, 
      a.siswa_nis, 
      a.siswa_nisn, 
      a.siswa_nama, 
      a.siswa_gender, 
      a.siswa_tempat, 
      a.siswa_tgllahir, 
      a.siswa_alamat, 
      a.nama_ayah, 
      a.nama_ibu, 
      a.migrasi, 
      a.siswa_telpon, 
      a.siswa_foto, 
      b.siswa_lulus_tahunajaran_id,
      b.siswa_lulus_noseri,
      b.siswa_lulus_ke,
      b.siswa_lulus_kestatus,
      b.siswa_lulus_namasekolah,
      b.siswa_lulus_npsnsekolah,
      b.file_lulus_ijz,
      c.tahunajaran_nama
    FROM e_siswa a
    LEFT JOIN f_siswa_act b ON a.siswa_id = b.siswa_id
    LEFT JOIN e_tahunajaran c ON b.siswa_lulus_tahunajaran_id = c.tahunajaran_id
    WHERE a.kelas_id = '-1' ORDER BY siswa_nama
 ) temp
EOT;

    // Table's primary key 
    $primaryKey = 'siswa_id';

    // Array of database columns which should be read and sent back to DataTables. 
    // The `db` parameter represents the column name in the database.  
    // The `dt` parameter represents the DataTables column identifier. 
    $columns = array(
        array(
            'db'        => 'siswa_id',
            'dt'        => 'siswa_id',
            'formatter' => function ($d, $row) {
                return enkripsi($d);
            }
        ),
        array('db' => 'siswa_nis', 'dt' => 'siswa_nis'),
        array('db' => 'siswa_nisn', 'dt' => 'siswa_nisn'),
        array('db' => 'siswa_nama', 'dt' => 'siswa_nama'),
        array('db' => 'siswa_gender', 'dt' => 'siswa_gender'),
        array('db' => 'siswa_tempat', 'dt' => 'siswa_tempat'),
        array(
            'db'        => 'siswa_tgllahir',
            'dt'        => 'siswa_tgllahir',
            'formatter' => function ($d, $row) {
                return tgl_indo(date('Y-m-d', strtotime($d)));
            }
        ),
        array('db' => 'nama_ayah', 'dt' => 'nama_ayah'),
        array('db' => 'nama_ibu', 'dt' => 'nama_ibu'),
        array('db' => 'siswa_telpon', 'dt' => 'siswa_telpon'),
        array('db' => 'tingkat_nama', 'dt' => 'tingkat_nama'),
        array('db' => 'kelas_nama', 'dt' => 'kelas_nama'),
        array('db' => 'jurusan_nama', 'dt' => 'jurusan_nama'),
        array('db' => 'migrasi', 'dt' => 'migrasi'),
        array('db' => 'tahunajaran_nama', 'dt' => 'tahunajaran_nama'),
        array('db' => 'siswa_lulus_noseri', 'dt' => 'siswa_lulus_noseri'),
        array('db' => 'siswa_lulus_ke', 'dt' => 'siswa_lulus_ke'),
        array('db' => 'siswa_lulus_kestatus', 'dt' => 'siswa_lulus_kestatus'),
        array('db' => 'siswa_lulus_namasekolah', 'dt' => 'siswa_lulus_namasekolah'),
        array('db' => 'siswa_lulus_npsnsekolah', 'dt' => 'siswa_lulus_npsnsekolah'),
        array('db' => 'file_lulus_ijz', 'dt' => 'file_lulus_ijz')
    );

    // Include SQL query processing class 
    require("../../../config/ssp.php");

    // Output data as json format 
    echo json_encode(

        // SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, null, "siswa_nsm = $siswa_nsm")
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)

    );
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
if ($pg == 'cancelMutation') {
    $siswa_id = dekripsi($_POST['id']);
    $exec = mysqli_query($koneksi, "UPDATE e_siswa SET 
    siswa_alasan_mutasi= NULL,
    siswa_tahun_mutasi= NULL,
    siswa_semester_mutasi= NULL 
    WHERE siswa_id = $siswa_id");
    $exec .= mysqli_query($koneksi, "UPDATE f_siswa_act SET 
    siswa_mutasi_tgl= NULL,
    siswa_mutasi_tahunajaran_id= NULL,
    siswa_semester_mutasi= NULL,
    siswa_mutasi_kelaslama= NULL,
    siswa_mutasi_alasan= NULL,
    siswa_mutasi_ke= NULL,
    siswa_mutasi_kestatus= NULL,
    siswa_mutasi_namasekolah= NULL,
    siswa_mutasi_npsnsekolah= NULL
    WHERE siswa_id = $siswa_id");
    if (!$exec) :
        $response = [
            'status'        => 500,
            'icon'        => "danger",
            'message'       => "Gagal Batal Mutasi",
        ];
        echo json_encode($response);
    else :
        $response = [
            'status'        => 200,
            'icon'        => "success",
            'message'       => "Delete Berhasil",
        ];
        echo json_encode($response);
    endif;
}
if ($pg == 'addMutation') {
    $f_siswa_act = [
        'siswa_mutasi_kelaslama'    => $_POST['siswa_mutasi_kelaslama'],
        'siswa_id'                  => $_POST['siswa_id'],
        'siswa_mutasi_tgl'          => $_POST['siswa_mutasi_tgl'],
        'siswa_mutasi_ke'           => $_POST['siswa_mutasi_ke'],
        'siswa_mutasi_kestatus'     => $_POST['siswa_mutasi_kestatus'],
        'siswa_mutasi_namasekolah'  => ucwords(strtoupper($_POST['siswa_mutasi_namasekolah'])),
        'siswa_mutasi_npsnsekolah'  => $_POST['siswa_mutasi_npsnsekolah'],
        'siswa_mutasi_alasan'       => $_POST['siswa_mutasi_alasan']
    ];
    $e_siswa = [
        'siswa_tahun_mutasi'                => $_POST['tahunajaran_id'],
        'siswa_semester_mutasi'             => $_POST['semester_id'],
        'siswa_alasan_mutasi'               => $_POST['siswa_mutasi_alasan']
    ];
    $id = $_POST['siswa_id'];
    $nama_update = mysqli_fetch_array(mysqli_query($koneksi, "SELECT siswa_nama FROM e_siswa WHERE siswa_id = $id"));
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
    $exec .= update($koneksi, 'e_siswa', $e_siswa, ['siswa_id' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Akte Lahir " . $nama_update['siswa_nama'] . " Berhasil",
            // 'icon1'          => $f_siswa,
            // 'icon2'          => $f_siswa_act,
            // 'icon3'          => $f_siswa_full,
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Akte Lahir " . $nama_update['siswa_nama'] . " Gagal Bos",
        ];
        echo json_encode($response);
    }
}
if ($pg == 'editMutation') {
    $f_siswa_act = [
        'siswa_mutasi_kelaslama'    => $_POST['siswa_mutasi_kelaslama'],
        'siswa_id'                  => $_POST['siswa_id'],
        'siswa_mutasi_tgl'          => $_POST['siswa_mutasi_tgl'],
        'siswa_mutasi_ke'           => $_POST['siswa_mutasi_ke'],
        'siswa_mutasi_kestatus'     => $_POST['siswa_mutasi_kestatus'],
        'siswa_mutasi_namasekolah'  => ucwords(strtoupper($_POST['siswa_mutasi_namasekolah'])),
        'siswa_mutasi_npsnsekolah'  => $_POST['siswa_mutasi_npsnsekolah'],
        'siswa_mutasi_alasan'       => $_POST['siswa_mutasi_alasan']
    ];
    $e_siswa = [
        'siswa_tahun_mutasi'                => $_POST['tahunajaran_id'],
        'siswa_semester_mutasi'             => $_POST['semester_id'],
        'siswa_alasan_mutasi'               => $_POST['siswa_mutasi_alasan']
    ];
    $id = $_POST['siswa_id'];
    $nama_update = mysqli_fetch_array(mysqli_query($koneksi, "SELECT siswa_nama FROM e_siswa WHERE siswa_id = $id"));
    $exec = update($koneksi, 'f_siswa_act', $f_siswa_act, ['siswa_id' => $id]);
    $exec .= update($koneksi, 'e_siswa', $e_siswa, ['siswa_id' => $id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Update Data Akte Lahir " . $nama_update['siswa_nama'] . " Berhasil",
            // 'icon1'          => $f_siswa,
            // 'icon2'          => $f_siswa_act,
            // 'icon3'          => $f_siswa_full,
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status'        => 500,
            'icon'          => "error",
            'message'       => "Update Data Akte Lahir " . $nama_update['siswa_nama'] . " Gagal Bos",
        ];
        echo json_encode($response);
    }
}
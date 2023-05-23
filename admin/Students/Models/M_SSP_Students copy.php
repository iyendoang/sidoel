<?php
require("../../../config/function.php");
require("../../../config/database.php");

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
      a.migrasi, 
      a.nama_ibu, 
      a.siswa_telpon, 
      a.siswa_foto, 
      a.siswa_alasan_mutasi, 
      b.tahunajaran_id,
      b.kelas_nama,
      b.kelas_id, 
      c.tahunajaran_status,
      c.tahunajaran_nama,
      d.tingkat_id,
      d.tingkat_nama,
      e.jurusan_nama,
      g.semester_nama
    FROM e_siswa a
    LEFT JOIN e_kelas b ON a.kelas_id = b.kelas_id
    LEFT JOIN e_tahunajaran c ON b.tahunajaran_id = c.tahunajaran_id
    LEFT JOIN e_tingkat d ON d.tingkat_id = b.tingkat_id
    LEFT JOIN e_jurusan e ON e.jurusan_id = b.jurusan_id
    LEFT JOIN e_kelaslock f ON f.kelas_id = a.kelas_id
    LEFT JOIN e_semester g ON f.semester_id = g.semester_id
    WHERE a.kelas_id != '-1' AND c.tahunajaran_status = '1' AND a.siswa_alasan_mutasi IS NULL
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
    array('db' => 'siswa_foto', 'dt' => 'siswa_foto'),
    array(
        'db' => 'tingkat_nama',
        'dt' => 'alias_tingkat_nama',
        'formatter' => function ($d, $row) {
            return $d . ' - ' . $row[11] . ' - ' . $row[12];
        }
    )
);

// Include SQL query processing class 
require("../../../config/ssp.php");

// Output data as json format 
echo json_encode(

    // SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, null, "siswa_nsm = $siswa_nsm")
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)

);

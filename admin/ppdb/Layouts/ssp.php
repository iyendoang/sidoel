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
    A.siswa_id, 
    A.siswa_nis, 
    A.siswa_nisn, 
    A.siswa_nama, 
    A.siswa_gender, 
    A.siswa_tempat, 
    A.siswa_tgllahir, 
    A.siswa_foto, 
    A.siswa_agama, 
    A.siswa_alamat, 
    A.nama_ayah, 
    A.nik_ayah, 
    A.nik_ibu, 
    A.alamat_ortu, 
    A.nama_wali, 
    A.pekerjaan_wali, 
    A.siswa_statuskel, 
    A.siswa_anakke, 
    A.sekolah_asal, 
    A.telpon_ortu, 
    A.telpon_wali, 
    A.siswa_alasan_mutasi,
    B.tahunajaran_id
    C.
  FROM e_siswa A
  LEFT JOIN e_riwayatsiswa B ON A.siswa_id = B.siswa_id 
 ) temp
EOT;

// Table's primary key 
$primaryKey = 'siswa_id';

// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array(
    array(
        'db'        => 'siswa_id_kota',
        'dt'        => 'siswa_id_kota',
        'formatter' => function ($d, $row) {
            return enkripsi($d);
        }
    ),
    array('db' => 'siswa_id_kota', 'dt' => 'uuid'),
    array('db' => 'siswa_nsm', 'dt' => 'siswa_nsm'),
    array('db' => 'siswa_act_nama', 'dt' => 'siswa_act_nama'),
    array('db' => 'siswa_act_nis', 'dt' => 'siswa_act_nis'),
    array('db' => 'siswa_act_nisn', 'dt' => 'siswa_act_nisn'),
    array('db' => 'tingkat_id', 'dt' => 'tingkat_id'),
    array('db' => 'siswa_act_gender', 'dt' => 'siswa_act_gender'),
    array('db' => 'siswa_act_tempat', 'dt' => 'siswa_act_tempat'),
    array('db' => 'tingkat_deskripsi', 'dt' => 'tingkat_deskripsi'),
    array('db' => 'lembaga_nama', 'dt' => 'lembaga_nama'),
    array('db' => 'jenjang_id', 'dt' => 'jenjang_id'),
    array('db' => 'jenjang_alias', 'dt' => 'jenjang_alias'),
    array('db' => 'lembaga_status', 'dt' => 'lembaga_status'),
    array('db' => 'nama', 'dt' => 'nama'),
    array('db' => 'tahunajaran_nama', 'dt' => 'tahunajaran_nama'),
    array(
        'db'        => 'siswa_act_tgllahir',
        'dt'        => 'siswa_act_tgllahir',
        'formatter' => function ($d, $row) {
            return tgl_indo(date('Y-m-d', strtotime($d)));
        }
    ),
    array('db' => 'siswa_act_tempat', 'dt' => 'siswa_act_tempat')
);

// Include SQL query processing class 
require("../../../../config/ssp.php");

// Output data as json format 
echo json_encode(

    // SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, null, "siswa_nsm = $siswa_nsm")
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)

);

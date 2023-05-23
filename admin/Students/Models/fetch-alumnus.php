<?php
require("../../../config/function.php");
require("../../../config/database.php");

// Database connection info 
$sql_details = array(
    'host' => $server,
    'user' => $username,
    'pass' => $password,
    'db' => $database
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
        'db' => 'siswa_id',
        'dt' => 'siswa_id',
        'formatter' => function ($d, $row) {
            return enkripsi($d);
        }
    ),
    array('db' => 'siswa_nis', 'dt' => 'siswa_nis'),
    array('db' => 'siswa_nisn', 'dt' => 'siswa_nisn'),
    array('db' => 'siswa_nama', 'dt' => 'siswa_nama'),
    array('db' => 'siswa_gender', 'dt' => 'siswa_gender'),
    array('db' => 'siswa_tempat', 'dt' => 'siswa_tempat'),
    array('db' => 'tahunajaran_nama', 'dt' => 'tahunajaran_nama'),
    array('db' => 'siswa_lulus_noseri', 'dt' => 'siswa_lulus_noseri'),
    array('db' => 'siswa_lulus_ke', 'dt' => 'siswa_lulus_ke'),
    array(
        'db' => 'siswa_tgllahir',
        'dt' => 'siswa_tgllahir',
        'formatter' => function ($d, $row) {
            return tgl_indo(date('Y-m-d', strtotime($d)));
        }
    ),
    array('db' => 'nama_ayah', 'dt' => 'nama_ayah'),
    array('db' => 'nama_ibu', 'dt' => 'nama_ibu'),
    array('db' => 'siswa_telpon', 'dt' => 'siswa_telpon'),
    array(
        'db' => 'siswa_gender',
        'dt' => 'alias_siswa_gender',
        'formatter' => function ($d, $row) {
            return ($d == 'L') ? 'Laki-laki' : 'Perempuan';
        }
    ),
    array(
        'db' => 'file_lulus_ijz',
        'dt' => 'file_lulus_ijz',
        'formatter' => function ($d, $row) {
            return ($d == null) ? '' : '<a href="../' . $d . '" target="_blank" type="button" class="btn btn-sm btn-warning">File</a>';
        }
    ),
    array(
        'db' => 'siswa_id',
        'dt' => 'check_siswa_id',
        'formatter' => function ($d, $row) {
            return ' 
                <input name="siswa_id[]" class="form-check-input ckeckBoxId" type="checkbox" value="' . $d . '" /> 
            ';
        }
    ),
    array(
        'db' => 'siswa_id',
        'dt' => 'btn_siswa_id',
        'formatter' => function ($d, $row) {
            return ' 
                <a href="?pg=student-alumni&id=' . enkripsi($d) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="popover" data-bs-trigger="hover" title="Edit Siswa">Edit</a>
                ';
        }
    ),
    array(
        'db' => 'siswa_nama',
        'dt' => 'siswa_nama_bold',
        'formatter' => function ($d, $row) {
            return ' 
            <a href=?pg=student-activity&id="' . enkripsi($row[0]) . '" class="text-truncated text-body fw-bolder"><span class="fw-bolder">' . $d . '</span></a>';
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

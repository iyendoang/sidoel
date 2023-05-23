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
      g.semester_nama,
      h.siswa_kk_nik,
      h.siswa_edit_status
    FROM e_siswa a
    LEFT JOIN e_kelas b ON a.kelas_id = b.kelas_id
    LEFT JOIN e_tahunajaran c ON b.tahunajaran_id = c.tahunajaran_id
    LEFT JOIN e_tingkat d ON d.tingkat_id = b.tingkat_id
    LEFT JOIN e_jurusan e ON e.jurusan_id = b.jurusan_id
    LEFT JOIN e_kelaslock f ON f.kelas_id = a.kelas_id
    LEFT JOIN e_semester g ON f.semester_id = g.semester_id
    LEFT JOIN f_siswa_act h ON a.siswa_id = h.siswa_id
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
    array('db' => 'tingkat_id', 'dt' => 'tingkat_id'),
    array('db' => 'siswa_alasan_mutasi', 'dt' => 'siswa_alasan_mutasi'),
    array('db' => 'siswa_nis', 'dt' => 'siswa_nis'),
    array('db' => 'siswa_nisn', 'dt' => 'siswa_nisn'),
    array('db' => 'siswa_kk_nik', 'dt' => 'siswa_kk_nik'),
    array('db' => 'siswa_edit_status', 'dt' => 'siswa_edit_status'),
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
    array('db' => 'kelas_id', 'dt' => 'kelas_id'),
    array('db' => 'jurusan_nama', 'dt' => 'jurusan_nama'),
    array('db' => 'siswa_edit_status', 'dt' => 'siswa_edit_status'),
    array('db' => 'siswa_foto', 'dt' => 'siswa_foto'),
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
        'db' => 'siswa_edit_status',
        'dt' => 'alias_siswa_edit_status',
        'formatter' => function ($d, $row) {
            return ($d == 1) ? 'Write' : 'Disable';
        }
    ),
    array(
        'db' => 'tingkat_id',
        'dt' => 'alias_tingkat_id',
        'formatter' => function ($d, $row) {
            if ($row[1] > 1 & $row[2] == NUll) {
                return 'Active';
            } elseif ($row[1] > 1 & $row[2] != NUll) {
                return 'Mutasi';
            } else {
                return 'Alumni';
            }
        }
    ),
    array(
        'db' => 'siswa_nama',
        'dt' => 'siswa_nama_bold',
        'formatter' => function ($d, $row) {
            return ' 
            <a href=?pg=student-activity&id="' . enkripsi($row[0]) . '" class="text-truncated text-body fw-bolder"><span class="fw-bolder">' . $d . '</span></a>';
        }
    ),
    array(
        'db' => 'siswa_nis',
        'dt' => 'siswa_avatar',
        'formatter' => function ($d, $row) {
            return ' 
            <object class="avatar" data="Students/Models/zip-photo-siswa/' . $d . '.jpg"' . 'type="image/png" width="32" height="32">
                <img class="avatar" src="https://cdn0.iconfinder.com/data/icons/octicons/1024/x-512.png" alt="Photo" width="32" height="32">
            </object>
';
        }
    )
    //     array(
    //         'db' => 'siswa_nis',
    //         'dt' => 'siswa_avatar',
    //         'formatter' => function ($d, $row) {
    //             return ' 
    //             <img src="Students/Models/zip-photo-siswa/' . $d . '.jpg"'.'onError="this.onerror=null;this.src=../assets/images/avatars/1.png"' . 'width="32" height="32">
    // ';
    //         }
    //     )
);

// Include SQL query processing class 
require("../../../config/ssp.php");

// Output data as json format 
echo json_encode(

    // SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, null, "siswa_nsm = $siswa_nsm")
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)

);

<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'Editlembaga_fileakre') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_fileakre']['name'] <> '') {
        $lembaga_fileakrelama = $_POST['lembaga_fileakrelama'];
        $patch = '../../' . $lembaga_fileakrelama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf'];
        $lembaga_fileakre = $_FILES['lembaga_fileakre']['name'];
        $temp = $_FILES['lembaga_fileakre']['tmp_name'];
        $size = $_FILES["lembaga_fileakre"]["size"];
        $ext = explode('.', $lembaga_fileakre);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_fileakre) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-Akreditasi-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_fileakre'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_fileakta') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_fileakta']['name'] <> '') {
        $lembaga_fileaktalama = $_POST['lembaga_fileaktalama'];
        $patch = '../../' . $lembaga_fileaktalama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf'];
        $lembaga_fileakta = $_FILES['lembaga_fileakta']['name'];
        $temp = $_FILES['lembaga_fileakta']['tmp_name'];
        $size = $_FILES["lembaga_fileakta"]["size"];
        $ext = explode('.', $lembaga_fileakta);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_fileakta) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-Akta-Notaris-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_fileakta'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf'");
                }
            } else {
                echo json_encode("Gagal");
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_fileaktaend') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_fileaktaend']['name'] <> '') {
        $lembaga_fileaktaendlama = $_POST['lembaga_fileaktaendlama'];
        $patch = '../../' . $lembaga_fileaktaendlama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf'];
        $lembaga_fileaktaend = $_FILES['lembaga_fileaktaend']['name'];
        $temp = $_FILES['lembaga_fileaktaend']['tmp_name'];
        $size = $_FILES["lembaga_fileaktaend"]["size"];
        $ext = explode('.', $lembaga_fileaktaend);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_fileaktaend) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-Akta-Notaris-Awal' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_fileaktaend'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf'");
                }
            } else {
                echo json_encode("Gagal");
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_filekopsurat') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_filekopsurat']['name'] <> '') {
        $lembaga_filekopsuratlama = $_POST['lembaga_filekopsuratlama'];
        $patch = '../../' . $lembaga_filekopsuratlama;
        $ektensi = ['jpg', 'jpeg', 'png'];
        $lembaga_filekopsurat = $_FILES['lembaga_filekopsurat']['name'];
        $temp = $_FILES['lembaga_filekopsurat']['tmp_name'];
        $size = $_FILES["lembaga_filekopsurat"]["size"];
        $ext = explode('.', $lembaga_filekopsurat);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_filekopsurat) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-Akta-Notaris-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_filekopsurat'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_filesiop') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_filesiop']['name'] <> '') {
        $lembaga_filesioplama = $_POST['lembaga_filesioplama'];
        $patch = '../../' . $lembaga_filesioplama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf'];
        $lembaga_filesiop = $_FILES['lembaga_filesiop']['name'];
        $temp = $_FILES['lembaga_filesiop']['tmp_name'];
        $size = $_FILES["lembaga_filesiop"]["size"];
        $ext = explode('.', $lembaga_filesiop);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_filesiop) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-SIOP-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_filesiop'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_filenpsn') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_filenpsn']['name'] <> '') {
        $lembaga_filenpsnlama = $_POST['lembaga_filenpsnlama'];
        $patch = '../../' . $lembaga_filenpsnlama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf'];
        $lembaga_filenpsn = $_FILES['lembaga_filenpsn']['name'];
        $temp = $_FILES['lembaga_filenpsn']['tmp_name'];
        $size = $_FILES["lembaga_filenpsn"]["size"];
        $ext = explode('.', $lembaga_filenpsn);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_filenpsn) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-NPSN-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_filenpsn'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_fileskmenkumham') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_fileskmenkumham']['name'] <> '') {
        $lembaga_fileskmenkumhamlama = $_POST['lembaga_fileskmenkumhamlama'];
        $patch = '../../' . $lembaga_fileskmenkumhamlama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf'];
        $lembaga_fileskmenkumham = $_FILES['lembaga_fileskmenkumham']['name'];
        $temp = $_FILES['lembaga_fileskmenkumham']['tmp_name'];
        $size = $_FILES["lembaga_fileskmenkumham"]["size"];
        $ext = explode('.', $lembaga_fileskmenkumham);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_fileskmenkumham) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-SK-MENKUMHAM-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_fileskmenkumham'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_filenpwp') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_filenpwp']['name'] <> '') {
        $lembaga_filenpwplama = $_POST['lembaga_filenpwplama'];
        $patch = '../../' . $lembaga_filenpwplama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf'];
        $lembaga_filenpwp = $_FILES['lembaga_filenpwp']['name'];
        $temp = $_FILES['lembaga_filenpwp']['tmp_name'];
        $size = $_FILES["lembaga_filenpwp"]["size"];
        $ext = explode('.', $lembaga_filenpwp);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_filenpwp) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-NPWP-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_filenpwp'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_filettdkamad') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_filettdkamad']['name'] <> '') {
        $lembaga_filettdkamadlama = $_POST['lembaga_filettdkamadlama'];
        $patch = '../../' . $lembaga_filettdkamadlama;
        $ektensi = ['jpg', 'jpeg', 'png'];
        $lembaga_filettdkamad = $_FILES['lembaga_filettdkamad']['name'];
        $temp = $_FILES['lembaga_filettdkamad']['tmp_name'];
        $size = $_FILES["lembaga_filettdkamad"]["size"];
        $ext = explode('.', $lembaga_filettdkamad);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_filettdkamad) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-TTD-KAMAD-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_filettdkamad'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'Editlembaga_filestempel') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['lembaga_filestempel']['name'] <> '') {
        $lembaga_filestempellama = $_POST['lembaga_filestempellama'];
        $patch = '../../' . $lembaga_filestempellama;
        $ektensi = ['jpg', 'jpeg', 'png'];
        $lembaga_filestempel = $_FILES['lembaga_filestempel']['name'];
        $temp = $_FILES['lembaga_filestempel']['tmp_name'];
        $size = $_FILES["lembaga_filestempel"]["size"];
        $ext = explode('.', $lembaga_filestempel);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($lembaga_filestempel) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-Stempel-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'lembaga_filestempel'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'EditL_templatekartu') {
    $lembaga_id = $_POST['lembaga_id'];
    $m_setting = fetch($koneksi, 't_lembaga', ['lembaga_id' => $lembaga_id]);
    if ($_FILES['L_templatekartu']['name'] <> '') {
        $L_templatekartulama = $_POST['L_templatekartulama'];
        $patch = '../../' . $L_templatekartulama;
        $ektensi = ['jpg', 'jpeg', 'png'];
        $L_templatekartu = $_FILES['L_templatekartu']['name'];
        $temp = $_FILES['L_templatekartu']['tmp_name'];
        $size = $_FILES["L_templatekartu"]["size"];
        $ext = explode('.', $L_templatekartu);
        $ext = end($ext);
        $direktori = "../../assets/images/lembaga-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($L_templatekartu) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/File-kartu-nama-' . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        $data = [
                            'L_templatekartu'        => $dest,
                        ];
                        $lembaga_id = $_POST['lembaga_id'];
                        update($koneksi, 't_lembaga', $data, ['lembaga_id' => $lembaga_id]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'add_filelembaga') {
    if ($_FILES['upload_file']['name'] <> '') {
        $upload_name = str_replace("'", "`", $_POST['upload_name']);
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xlsx', 'xls', 'rar', 'zip'];
        $upload_file = $_FILES['upload_file']['name'];
        $temp = $_FILES['upload_file']['tmp_name'];
        $size = $_FILES["upload_file"]["size"];
        $ext = explode('.', $upload_file);
        $ext = end($ext);
        $direktori = "../../../assets/images/lembaga-file/add-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($upload_file) {
                if (in_array($ext, $ektensi)) {
                    $dest = 'assets/images/lembaga-file/add-file/File-' . $upload_name . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../../' . $dest);
                    if ($upload) {
                        $data = [
                            'upload_name'           => ucwords(strtoupper($upload_name)),
                            'upload_file'           => $dest,
                        ];
                        insert($koneksi, 'm_uploadfile', $data);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xlsx', 'xls','rar','zip'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'edit_filelembaga') {
    if ($_FILES['upload_file']['name'] <> '') {
        $upload_name = str_replace("'", "`", $_POST['upload_name']);
        $upload_filelama = $_POST['upload_filelama'];
        $patch = '../../../' . $upload_filelama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xlsx', 'xls', 'rar', 'zip'];
        $upload_file = $_FILES['upload_file']['name'];
        $temp = $_FILES['upload_file']['tmp_name'];
        $size = $_FILES["upload_file"]["size"];
        $ext = explode('.', $upload_file);
        $ext = end($ext);
        $direktori = "../../../assets/images/lembaga-file/add-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($upload_file) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/add-file/File-' . $upload_name . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../../' . $dest);
                    $date_now = date('Y-m-d H:i:s');
                    if ($upload) {
                        $data = [
                            'upload_name'           => ucwords(strtoupper($upload_name)),
                            'upload_file'           => $dest,
                            'updated_at'            => $date_now
                        ];
                        $id_upload = $_POST['id_upload'];
                        update($koneksi, 'm_uploadfile', $data, ['id_upload' => $id_upload]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xlsx', 'xls','rar','zip'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}

if ($pg == 'hapus_filelembaga') {
    $id = $_POST['id_upload'];
    $m_uploadfile = fetch($koneksi, 'm_uploadfile', ['id_upload' => $id]);
    $Path = ('../../../' . $m_uploadfile['upload_file']);
    if (unlink($Path)) {
        delete($koneksi, 'm_uploadfile', ['id_upload' => $id]);
    } else {
        echo "fail";
    }
}
if ($pg == 'add_filelembaga') {
    if ($_FILES['upload_file']['name'] <> '') {
        $upload_name = str_replace("'", "`", $_POST['upload_name']);
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xlsx', 'xls', 'rar', 'zip'];
        $upload_file = $_FILES['upload_file']['name'];
        $temp = $_FILES['upload_file']['tmp_name'];
        $size = $_FILES["upload_file"]["size"];
        $ext = explode('.', $upload_file);
        $ext = end($ext);
        $direktori = "../../../assets/images/lembaga-file/add-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($upload_file) {
                if (in_array($ext, $ektensi)) {
                    $dest = 'assets/images/lembaga-file/add-file/File-' . $upload_name . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../../' . $dest);
                    if ($upload) {
                        $data = [
                            'upload_name'           => ucwords(strtoupper($upload_name)),
                            'upload_file'           => $dest,
                        ];
                        insert($koneksi, 'm_uploadfile', $data);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xlsx', 'xls','rar','zip'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}
if ($pg == 'edit_filelembaga') {
    if ($_FILES['upload_file']['name'] <> '') {
        $upload_name = str_replace("'", "`", $_POST['upload_name']);
        $upload_filelama = $_POST['upload_filelama'];
        $patch = '../../../' . $upload_filelama;
        $ektensi = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xlsx', 'xls', 'rar', 'zip'];
        $upload_file = $_FILES['upload_file']['name'];
        $temp = $_FILES['upload_file']['tmp_name'];
        $size = $_FILES["upload_file"]["size"];
        $ext = explode('.', $upload_file);
        $ext = end($ext);
        $direktori = "../../../assets/images/lembaga-file/add-file/";
        if ($size < (1024 * 1024 * 5)) {
            if (!file_exists($direktori))
                mkdir($direktori);
            if ($upload_file) {
                if (in_array($ext, $ektensi)) {
                    if (file_exists($patch)) {
                        unlink($patch);
                    }
                    $dest = 'assets/images/lembaga-file/add-file/File-' . $upload_name . rand(1, 1000) . '.' . $ext;
                    $upload = move_uploaded_file($temp, '../../../' . $dest);
                    $date_now = date('Y-m-d H:i:s');
                    if ($upload) {
                        $data = [
                            'upload_name'           => ucwords(strtoupper($upload_name)),
                            'upload_file'           => $dest,
                            'updated_at'            => $date_now
                        ];
                        $id_upload = $_POST['id_upload'];
                        update($koneksi, 'm_uploadfile', $data, ['id_upload' => $id_upload]);
                        echo json_encode("ok");
                    } else {
                        echo json_encode("Gagal");
                    }
                } else {
                    echo json_encode("Ekstensi File Tidak Diperbolehkan hanya 'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xlsx', 'xls','rar','zip'");
                }
            }
        } else {
            echo json_encode("Maksimal Ukuran Gambar 5 MB");
        }
    } else {
        echo json_encode("Pilih Gambar Terlebih Dahulu");
    }
}

if ($pg == 'hapus_filelembaga') {
    $id = $_POST['id_upload'];
    $m_uploadfile = fetch($koneksi, 'm_uploadfile', ['id_upload' => $id]);
    $Path = ('../../../' . $m_uploadfile['upload_file']);
    if (unlink($Path)) {
        delete($koneksi, 'm_uploadfile', ['id_upload' => $id]);
    } else {
        echo "fail";
    }
}

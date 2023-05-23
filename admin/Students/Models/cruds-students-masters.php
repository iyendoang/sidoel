
<?php
require("../../../config/database.php");
require("../../../config/function.php");
require("../../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

if ($pg == 'zipUploadFiles') {
    if (isset($_POST["btn_zip"])) {
        $output = '';
        if ($_FILES['zip_file']['name'] != '') {
            $file_name = $_FILES['zip_file']['name'];
            $size = $_FILES["zip_file"]["size"];
            $array = explode(".", $file_name);
            $name = $array[0];
            $ext = $array[1];
            $folder_dir = "zip-photo-siswa";
            if (file_exists($folder_dir)) {
                $folders = new RecursiveDirectoryIterator($folder_dir, FilesystemIterator::SKIP_DOTS);
                $direktories = new RecursiveIteratorIterator($folders, RecursiveIteratorIterator::CHILD_FIRST);
                foreach ($direktories as $file_dir) {
                    $file_dir->isDir() ?  rmdir($file_dir) : unlink($file_dir);
                }
            }
            if ($ext == 'zip') {
                if ($size < (1024 * 1024 * 10)) {
                    $path = 'zip-photo-siswa/';
                    if (!file_exists($path))
                        mkdir($path);
                    $location = $path . $file_name;
                    if (move_uploaded_file($_FILES['zip_file']['tmp_name'], $location)) {
                        $zip = new ZipArchive;
                        if ($zip->open($location)) {
                            $zip->extractTo($path);
                            $zip->close();
                            $valid_image = array_filter(glob('*'), 'is_dir');
                            foreach ($valid_image as $directory) {
                                $images = glob("zip-photo-siswa/*.{png,jpeg,pdf,txt,php,xlsb,jfif,xla,xls,xlsx,gif,psd,tiff,raw,eps,ai,heif,exe,pif,APPLICATION,GADGET,MSI,MSP,COM,SCR,HTA,CPL,MSC,JAR,BAT,CMD,VB,VBE,JS,JSE,PS1,PS1XML,PS2,PS2XML,PSC1,PSC2,MSH,MSH1,MSH2,MSHXML,MSH1XML,MSH2XML,WS,WSF}", GLOB_BRACE);
                                foreach ($images as $image) {
                                    unlink($image);
                                }
                            }
                        }
                        unlink($location);
                        echo "<script>location='../../?pg=students-masters';</script>";
                    }
                } else {
                    echo "<script>alert('Ukuran File tidak boleh lebih dari 10MB dan Hanya zip yang diperbolehkan'); location='../../?pg=students-masters';</script>";
                }
            } else {
                echo "<script>alert('Ukuran File tidak boleh lebih dari 10MB dan Hanya zip yang diperbolehkan'); location='../../?pg=students-masters';</script>";
            }
        }
    }
}
if ($pg == 'writeStudents') {
    $siswa_id = dekripsi($_POST['id']);
    $exec = update($koneksi, 'f_siswa_act', ['siswa_edit_status' => 0], ['siswa_id' => $siswa_id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "info",
            'message'       => "Siswa Tidak Diberikan Akses Edit",
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
if ($pg == 'readStudents') {
    $siswa_id = dekripsi($_POST['id']);
    $exec = update($koneksi, 'f_siswa_act', ['siswa_edit_status' => 1], ['siswa_id' => $siswa_id]);
    if ($exec) {
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Siswa Diberikan Akses Edit",
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

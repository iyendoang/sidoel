<?php  
if(isset($_POST["btn_zip"])){
  $output = '';
  if($_FILES['zip_file']['name'] != ''){
     $file_name = $_FILES['zip_file']['name'];
     $array = explode(".", $file_name);
     $name = $array[0];
     $ext = $array[1];
     if($ext == 'zip'){
        $path = 'upload/';
        if (!file_exists($path))
          mkdir($path);
        
        $location = $path . $file_name;
        if(move_uploaded_file($_FILES['zip_file']['tmp_name'], $location)){
           $zip = new ZipArchive;
           if($zip->open($location)){
              $zip->extractTo($path);
              $zip->close();
           }
           unlink($location);

           echo "<script>alert('Data berhasil diupload'); location='index.php';</script>";
        }
     } else {
        echo "<script>alert('Hanya .zip yang diperbolehkan'); location='index.php';</script>";
     }
  }
}
?>
<?php
$cek_siswa_id = rowcount($koneksi, 'f_siswa_act');
$cek_esiswa = rowcount($koneksi, 'e_siswa'); ?>

<?php if ($cek_siswa_id !== $cek_esiswa) { ?>
    <?php include "Students/Pages/Lists/students-synchrone.php"  ?>
    <?php } else { ?>
        <?php include "Students/Pages/Lists/students-active.php"  ?>
<?php }
?>

<?php
$e_riwayatsiswa = fetch($koneksi, 'e_riwayatsiswa', ['siswa_id' => dekripsi($_GET['id'])], ['tahunajaran_id' => $e_tahunajaran['tahunajaran_id']]);
$e_siswa = fetch($koneksi, 'e_siswa', ['siswa_id' => $e_riwayatsiswa['siswa_id']]);
$f_siswa_act = fetch($koneksi, 'f_siswa_act', ['siswa_id' => $e_siswa['siswa_id']]);
$e_tingkat = fetch($koneksi, 'e_tingkat', ['tingkat_id' => $e_siswa['tingkat_id']], ['tahunajaran_id' => $e_tahunajaran['tahunajaran_id']], ['semester_id' => $e_semester['semester_id']]);
$e_kelas = fetch($koneksi, 'e_kelas', ['kelas_id' => $e_riwayatsiswa['kelas_id']], ['tahunajaran_id' => $e_tahunajaran['tahunajaran_id']], ['semester_id' => $e_semester['semester_id']]);
$e_jurusan = fetch($koneksi, 'e_jurusan', ['jurusan_id' => $e_kelas['jurusan_id']], ['tahunajaran_id' => $e_tahunajaran['tahunajaran_id']], ['semester_id' => $e_semester['semester_id']]);
?>
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill mb-2 student-nav-form">
                <!-- student-activity -->
                <li class="nav-item">
                    <a class="nav-link active" href="?pg=student-activity&id=<?= enkripsi($f_siswa_act['siswa_id']) ?>">
                        <i data-feather="home" class="font-medium-3 me-50"></i>
                        <span class="fw-bold d-none d-sm-block">Aktivitas</span>
                    </a>
                </li>
                <!-- student-certificate-of-birth -->
                <li class="nav-item">
                    <a class="nav-link" href="?pg=student-certificate-of-birth&id=<?= enkripsi($f_siswa_act['siswa_id']) ?>">
                        <i data-feather="home" class="font-medium-3 me-50"></i>
                        <span class="fw-bold d-none d-sm-block">Akta Lahir</span></a>
                    </a>
                </li>
                <!-- student-before-school -->
                <li class="nav-item">
                    <a class="nav-link" href="?pg=student-previous-level&id=<?= enkripsi($f_siswa_act['siswa_id']) ?>">
                        <i data-feather="home" class="font-medium-3 me-50"></i>
                        <span class="fw-bold d-none d-sm-block">Jenjang Lalu</span></a>
                    </a>
                </li>
                <!-- student-family-card -->
                <li class="nav-item">
                    <a class="nav-link" href="?pg=student-family-card&id=<?= enkripsi($f_siswa_act['siswa_id']) ?>">
                        <i data-feather="home" class="font-medium-3 me-50"></i>
                        <span class="fw-bold d-none d-sm-block">Kartu Keluarga</span></a>
                    </a>
                </li>
                <!-- notification -->
                <li class="nav-item">
                    <a class="nav-link" href="?pg=student-residence&id=<?= enkripsi($f_siswa_act['siswa_id']) ?>">
                        <i data-feather="home" class="font-medium-3 me-50"></i>
                        <span class="fw-bold d-none d-sm-block">Domisili</span></a>
                    </a>
                </li>
                <!-- Immunization -->
                <li class="nav-item">
                    <a class="nav-link" href="?pg=student-immunization&id=<?= enkripsi($f_siswa_act['siswa_id']) ?>">
                        <i data-feather="home" class="font-medium-3 me-50"></i>
                        <span class="fw-bold d-none d-sm-block">Imunisasi</span></a>
                    </a>
                </li>
                <!-- student-donation-scholarship -->
                <li class="nav-item">
                    <a class="nav-link" href="?pg=student-donation-scholarship&id=<?= enkripsi($f_siswa_act['siswa_id']) ?>">
                        <i data-feather="home" class="font-medium-3 me-50"></i>
                        <span class="fw-bold d-none d-sm-block">Bantuan</span></a>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
<script>
    var uriTabsStudents = window.location.href;
    // alert(uriTabsStudents);
    $('.student-nav-form a').each(function() {
        if (this.href === uriTabsStudents) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
</script>
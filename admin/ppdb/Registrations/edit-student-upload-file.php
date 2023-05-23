<?php
$t_ppdbregist = fetch($koneksi, 't_ppdbregist', ['ppdbregist_id' => dekripsi($_GET['id'])]);
$ppdb_tahunajaran = fetch($koneksi, 'e_tahunajaran', ['tahunajaran_id' => $t_ppdbregist['tahunajaran_id']]);
$ppdb_jurusan = fetch($koneksi, 't_ppdbjurusan', ['ppdbjurusan_id' => $t_ppdbregist['ppdbjurusan_id']]);
?>
<section id="basic-horizontal-layouts">
    <?php include 'Registrations/Components/Navbar.php' ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
               <?= $t_lembaga['lembaga_ppdb_embed']; ?>
            </div>
        </div>
    </div>
</section>
<script src="Registrations/scripts.js"></script>
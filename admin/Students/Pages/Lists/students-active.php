<div class="content-body">
    <!-- users list start -->
    <section class="app-user-list">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">
                                <?=
                                mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM e_siswa"));
                                ?>
                            </h3>
                            <span class="fw-bolder">Total Siswa</span><br>
                            <span>RDM Madrasah</span>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content">
                                <i data-feather="user" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">
                                <?=
                                mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM e_siswa WHERE kelas_id != '-1' AND siswa_alasan_mutasi IS NULL"));
                                ?>
                            </h3>
                            <span class="fw-bolder">Siswa Aktif</span><br>
                            <span><?= $e_tahunajaran['tahunajaran_nama']; ?></span>
                        </div>
                        <div class="avatar bg-light-danger p-50">
                            <span class="avatar-content">
                                <i data-feather="user-plus" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">
                                <?=
                                mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM e_siswa
                                     WHERE kelas_id != '-1' AND siswa_alasan_mutasi IS NULL AND siswa_gender ='L'"));
                                ?>
                            </h3>
                            <span class="fw-bolder">Laki-laki</span><br>
                            <span><?= $e_tahunajaran['tahunajaran_nama']; ?></span>
                        </div>
                        <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                                <i data-feather="user-check" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">
                                <?=
                                mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM e_siswa
                                     WHERE kelas_id != '-1' AND siswa_alasan_mutasi IS NULL AND siswa_gender ='P'"));
                                ?>
                            </h3>
                            <span class="fw-bolder">Perempuan</span><br>
                            <span><?= $e_tahunajaran['tahunajaran_nama']; ?></span>
                        </div>
                        <div class="avatar bg-light-warning p-50">
                            <span class="avatar-content">
                                <i data-feather="user-x" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- list and filter start -->
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title text-uppercase fw-bolder">data siswa aktif <?= $e_tahunajaran['tahunajaran_nama']; ?> smt <?= $e_semester['semester_nama']; ?></h4>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExcelStudents" title="Ekport Excel Data Siswa" data-bs-animation="false">
                        <i data-feather="printer" class="me-25"></i>
                        <span></span>
                    </a>
                    <a data-bs-toggle="modal" data-bs-target="#modalDelapanTigaLima" class="btn btn-primary">
                        <i me="1" data-feather='printer'></i>
                        <span class="align-middle"></span>
                    </a>
                </div>
                <!-- Modal 8355 -->
                <div class="modal fade text-start" id="modalDelapanTigaLima" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="printStudents8355" action="Students/Pages/Print/students-8355.php" method="post" class="form form-horizontal" target="_blank">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">Form 8355</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-1">
                                        <label class="form-label mb-1" for="tingkat_id">Pilih Tanggal Cetak 8355</label>
                                        <select class="select2 form-select" id="tingkat_id" name="tingkat_id" data-placeholder="Pilih Tingkat Kelas" required>
                                            <option value="">---Pilih Kelas---</option>
                                            <?php
                                            $sql = mysqli_query($koneksi, "SELECT * FROM e_tingkat WHERE jenjang_id='$t_lembaga[jenjang_id]' ORDER BY tingkat_urutan ASC") or die(mysqli_error($koneksi));
                                            while ($e_tingkat = mysqli_fetch_array($sql)) {
                                            ?>
                                                <option value="<?php echo $e_tingkat['tingkat_id'] ?>"><?php echo $e_tingkat['tingkat_nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label mb-1" for="post_tglcetak">Pilih Tanggal Cetak 8355</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="post_tglcetak" name="post_tglcetak" class="flatpickr form-control  flatpickr-basic" placeholder="Pilih Tanggal Cetak 8355" />
                                        </div>
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        <div class="alert-body">
                                            <span class="fw-bolder">8355</span> Silahkan setting tingkat dan tanggal dan submit tombol biru untuk mencetak berkas 8355 | Untuk setting kertas dengan A4 dan mode landscape serta aktifkan cetak background untuk hasil maksimal.
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i me="1" data-feather='printer'></i>
                                        <span class="align-middle">8355</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>

                </script>
                <!-- End Modal 8355 -->
                <!-- Modal Export Excel -->
                <div class="modal fade text-start" id="modalExcelStudents" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <?= include 'Students/Pages/Lists/students-reports.php' ?>
                        </div>
                    </div>
                </div>
                <!-- End Modal Export Excel -->
            </div>
            <div class="card-datatable table-responsive pt-0">
                <table class="user-list-table table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Nama Peserta Didik</th>
                            <th>Kelas</th>
                            <th>Tempat Tgl. Lahir</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                            <th>NO HP</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- list and filter end -->
    </section>
    <!-- users list ends -->

</div>
<script src="Students/js/students-list-table.js"></script>
<script>
    $(document).ready(function() {
        const flatpickr = $('.flatpickr').flatpickr({
            static: true
        });
        select = $('.select2');
        // select2
        select.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this
                .select2({
                    placeholder: 'Select value',
                    dropdownParent: $this.parent()
                })
                .change(function() {
                    $(this).valid();
                });
        });
        $("#printStudents8355").validate({
            ignore: ":hidden",
            rules: {
                tingkat_id: {
                    required: true,
                },
                post_tglcetak: {
                    required: true,
                }
            },
        });

    });
</script>
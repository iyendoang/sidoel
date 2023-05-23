<?php include 'Students/Pages/Forms/nav-tab-student.php' ?>
<div class="col-lg-12">
    <div class="card">
        <form id="FormEditKesehatan" method="post">
            <div class="card-header border-bottom">
                <h4 class="card-title">Imunisasi</h4>
                <div class="text-end">
                    <button type="sumbit" class="btn btn-primary me-1">Simpan</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddImmunization">Tambah</button>
                </div>
            </div>
            <input type="hidden" name="siswa_id" id="siswa_id" value="<?= $f_siswa_act['siswa_id'] ?>">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_hepatitis_b" name="health_hepatitis_b" value="Y" <?php if ($f_siswa_act['health_hepatitis_b'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_hepatitis_b">Hepatitis B</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_bcg" name="health_bcg" value="Y" <?php if ($f_siswa_act['health_bcg'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_bcg">BCG</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_dpt" name="health_dpt" value="Y" <?php if ($f_siswa_act['health_dpt'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_dpt">DPT</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_polio" name="health_polio" value="Y" <?php if ($f_siswa_act['health_polio'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_polio">Polio</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_campak" name="health_campak" value="Y" <?php if ($f_siswa_act['health_campak'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_campak">Campak</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_covid_one" name="health_covid_one" value="Y" <?php if ($f_siswa_act['health_covid_one'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_covid_one">Covid-1</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_covid_two" name="health_covid_two" value="Y" <?php if ($f_siswa_act['health_covid_two'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_covid_two">Covid-2</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_booster_one" name="health_booster_one" value="Y" <?php if ($f_siswa_act['health_booster_one'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_booster_one">Booster-1</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="health_booster_two" name="health_booster_two" value="Y" <?php if ($f_siswa_act['health_booster_two'] == 'Y') echo 'checked' ?>>
                                    </div>
                                </div>
                                <label class="form-control" for="health_booster_two">Booster-2</label>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="text-end mt-2">
                        <button type="sumbit" class="btn btn-primary me-1">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary">Batal</button>
                    </div> -->
                </div>
        </form>
        <div class="row" id="colDeleteImmunization">
            <?php
            $query = mysqli_query($koneksi, "select * from f_add_kesehatan where siswa_id='$f_siswa_act[siswa_id]'");
            $no = 0;
            while ($add_healty = mysqli_fetch_array($query)) {
                $no++;
            ?>
                <div class="col-md-4">
                    <div class="mb-1">
                        <div class="input-group">
                            <div class="input-group-text">
                                <div class="form-check form-check-warning">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                </div>
                            </div>
                            <label class="form-control" for="<?= $add_healty['siswa_id'] ?>"><?= $add_healty['add_kes_nama'] ?></label>
                            <button data-id="<?= $add_healty['add_kes_id'] ?>" type="button" id="deleteImmunization" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Hapus Data">
                                <i data-feather='trash-2'></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script>
        $('#colDeleteImmunization').on('click', '#deleteImmunization', function() {
            var id = $(this).data('id');
            console.log(id);
            Swal.fire({
                title: 'Peringatan?',
                text: "Anda Akan Menghapus User Ini !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: 'Students/Models/cruds-immunization.php?pg=DeleteFormKesehatanAdd',
                        method: "POST",
                        data: 'id=' + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Your file has been deleted.',
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                }
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your imaginary file is safe :)',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                }
            });
        });
    </script>
    <!-- Modal -->
    <div class="modal fade text-start" id="modalAddImmunization" tabindex="-1" aria-labelledby="modalAddImmunization" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form form-vertical" id="FormModalAddImmunization" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalAddImmunization">Tambah Data</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" name="siswa_id" value="<?= $f_siswa_act['siswa_id'] ?>">
                            <input type="text" name="siswa_nis" value="<?= $e_siswa['siswa_nis'] ?>">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="health_tambahan">Nama Vaksin</label>
                                    <input type="text" id="add_kes_nama" class="form-control" name="add_kes_nama" placeholder="Nama Vaksin" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="value" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Basic trigger modal end -->
</div>
</div>
<script src="Students/js/students-immunization.js"></script>
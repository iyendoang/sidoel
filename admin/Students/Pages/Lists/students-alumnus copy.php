<style>
    .removeRow {
        background-color: #E94560;
        color: #FFFFFF;
    }

    .removeRow a {
        background-color: #E94560;
        color: #FFFFFF;
    }
</style>
<div class="content-body">
    <!-- Basic table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title text-uppercase fw-bolder">data alumni</h4>
                        <div class="basic-modal">
                            <!-- <button type="button" name="btnUpdateYears" id="btnUpdateYears" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#default"> -->
                            <button type="button" name="btnUpdateYears" id="btnUpdateYears" class="btn btn-outline-primary">
                                Edit Tahun Lulus
                            </button>
                        </div>
                    </div>
                    <form id="editYearAlumnus" method="post">
                        <div class="modal fade text-start" id="yearsModal" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Edit Tahun Lulus</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Basic -->
                                            <div class="col-md-12 mb-1">
                                                <label class="form-label" for="siswa_lulus_tahunajaran_id">Pilih Tahun Kelulusan</label>
                                                <select class="select2 form-select" name="siswa_lulus_tahunajaran_id" id="siswa_lulus_tahunajaran_id" data-placeholder="Pilih Tahun Kelulusan">
                                                    <option value=""></option>
                                                    <?php
                                                    $query = "SELECT * FROM e_tahunajaran";
                                                    $results = $koneksi->prepare($query);
                                                    $results->execute();
                                                    $result = $results->get_result();
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?= $row['tahunajaran_id']; ?>"><?= $row['tahunajaran_nama']; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Accept</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="datatables" class="table datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th><input type="checkbox" class="form-check-input checkBoxAll" /></th>
                                    <th>Nama Lengkap</th>
                                    <th>NISN</th>
                                    <th>JK</th>
                                    <th>Tahun Lulus</th>
                                    <th>NO Seri Ijz</th>
                                    <th>Lulus Ke</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = "SELECT 
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
                                WHERE a.kelas_id = '-1' ORDER BY siswa_nama ";
                                $results = $koneksi->prepare($query);
                                $results->execute();
                                $result = $results->get_result();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tr class="form-check-input check" id="<?= $row["siswa_id"]; ?>">
                                            <td><?= $no++; ?></td>
                                            <td>
                                                <input name="siswa_id[]" class="form-check-input ckeckBoxId" type="checkbox" value="<?= $row["siswa_id"]; ?>" />
                                            </td>
                                            <td><a class="fw-bold" href="?pg=student-activity&id=<?= enkripsi($row['siswa_id']) ?>"><?= $row["siswa_nama"]; ?></a></td>
                                            <td><?= $row["siswa_nisn"]; ?></td>
                                            <td><?= $row["siswa_gender"]; ?></td>
                                            <td><?= $row["tahunajaran_nama"]; ?></td>
                                            <td><?= $row["siswa_lulus_noseri"]; ?></td>
                                            <td><?= $row["siswa_lulus_ke"]; ?></td>
                                            <td>
                                                <?php if ($row['file_lulus_ijz'] == null) { ?>
                                                    <!-- <a href="#"  class="btn btn-sm btn-icon btn-warning" data-bs-toggle="popover" data-bs-trigger="hover" title="Kosong">
                                                        <i data-feather='eye'></i>
                                                    </a> -->
                                                <?php } else { ?>
                                                    <a href="../<?= $row['file_lulus_ijz'] ?>" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="popover" data-bs-trigger="hover" title="FIle Ijazah">
                                                        <i data-feather='eye'></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="?pg=student-alumni&id=<?= enkripsi($row['siswa_id']) ?>" type="button" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="popover" data-bs-trigger="hover" title="Edit Siswa">
                                                    <i data-feather='edit'></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--/ Basic table -->
</div>
<script>
    $(document).ready(function() {
        $('.ckeckBoxId').click(function() {
            if ($(this).is(':checked')) {
                $(this).closest('tr').addClass('removeRow');
            } else {
                $(this).closest('tr').removeClass('removeRow');
            }
        });
        $('#btnUpdateYears').click(function() {
            var id = [];
            $(':checkbox:checked').each(function(i) {
                id[i] = $(this).val();
            });
            if (id.length === 0) {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Pilih minimal satu data',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                return false;
                alert("Pilih minimal satu data");
            } else {
                $("#yearsModal").modal("show");
                if ($('#editYearAlumnus').length) {
                    $('#editYearAlumnus').validate({
                        rules: {
                            siswa_lulus_tahunajaran_id: {
                                required: true,
                            },
                        },
                    });
                }
                $('#editYearAlumnus').submit(function() {
                    if ($('#editYearAlumnus').valid())
                        $.ajax({
                            type: 'POST',
                            url: 'Students/Models/cruds-alumnus.php?pg=edit_tahunalumni',
                            data: $(this).serialize(),
                            success: function(data) {
                                const obj = JSON.parse(data);
                                if (obj.status == 200) {
                                    Swal.fire({
                                        title: 'Good job!',
                                        text: obj.message,
                                        icon: obj.icon,
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    });
                                    setTimeout(function() {
                                        window.location.reload()
                                    }, 2200);
                                }
                            },
                        });
                    else
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Kolom Input Isian Belum Lengkap',
                            icon: 'info',
                            customClass: {
                                confirmButton: 'btn btn-info'
                            },
                            buttonsStyling: false
                        });
                    return false;
                });
            }
        });
        $('.checkBoxAll').click(function() {
            $('.ckeckBoxId').prop('checked', this.checked);
            if ($(this).is(':checked')) {
                $('.check').addClass('removeRow');
            } else {
                $('.check').removeClass('removeRow');
            }
        });
    });
</script>
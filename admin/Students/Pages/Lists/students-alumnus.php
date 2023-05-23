<div class="content-body">
    <!-- Students Alumnus table -->
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
                        <table class="studentsAlumnus-list-table table datatables">
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
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--/ Students Alumnus table -->
</div>
<script src="Students/js/students-list-alumnus.js"></script>
<div class="content-body">
    <!-- Achievement Table -->
    <div class="card">
        <div class="card-header">
            <h3>Data Prestasi Siswa</h3>
        </div>
        <div class="card-datatable table-responsive">
            <table id=.datatables-achievements" class="datatables-achievements table">
                <thead class="table-primary">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Actions</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tahun Prestasi</th>
                        <th>Nama Prestasi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Achievement Table -->

    <!-- Add Achievement Modal -->
    <div class="modal fade" id="addAchievementModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 pb-2">
                    <div class="text-center mb-2">
                        <h3 class="mb-1">Tambah Data Prestasi</h3>
                    </div>
                    <form id="addAchievementForm" class="row" onsubmit="return false">
                        <input type="hidden" name="lembaga_id" class="form-control" value="<?= $e_lembaga['lembaga_id']; ?>" />
                        <input type="hidden" name="tahunajaran_id" class="form-control" value="<?= $e_tahunajaran['tahunajaran_id']; ?>" />
                        <input type="hidden" name="semester_id" class="form-control" value="<?= $e_semester['semester_id']; ?>" />
                        <div class="col-12 mb-1">
                            <label class="form-label" for="kelas_id">Kelas Siswa</label>
                            <select class="form-control select2" name="kelas_id" id="kelas_id" data-placeholder="Pilih Kelas Siswa">
                                <option value=""> Pilih Kelas</option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="siswa_id">Nama Siswa</label>
                            <select class="form-control select2" name="siswa_id" id="siswa_id" data-placeholder="Pilih Nama Siswa">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="prestasi_nama">Nama Prestasi</label>
                            <input type="text" id="prestasi_nama" name="prestasi_nama" class="form-control" placeholder="Nama Prestasi" autofocus data-msg="Please enter Nama Prestasi" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="prestasi_keterangan">Keterangan Prestasi</label>
                            <textarea class="form-control" id="prestasi_keterangan" name="prestasi_keterangan" rows="3" placeholder="Keterangan Prestasi"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Tambah Prestasi</button>
                            <button type="button" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Achievement Modal -->
</div>
<script src="Students/js/students-achievement.js"></script><!-- table -->
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
        <h4 class="card-title text-uppercase fw-bolder">data siswa mutasi</h4>
      </div>
      <div class="card-datatable table-responsive pt-0">
        <table class="students-mutations-table table">
          <thead class="table-dark">
            <tr>
              <th></th>
              <th>Nama Peserta Didik</th>
              <th>Kelas</th>
              <th>Tempat Tgl. Lahir</th>
              <th>Nama Ayah</th>
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
  <div class="modal fade" id="addMutationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-transparent">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-sm-2 pb-2">
          <div class="text-center mb-2">
            <h3 class="mb-1">Tambah Data Mutasi</h3>
          </div>
          <form id="addMutationForm" class="row" onsubmit="return false">
            <input type="hidden" name="tahunajaran_id" class="form-control" value="<?= $e_tahunajaran['tahunajaran_id']; ?>" />
            <input type="hidden" name="semester_id" class="form-control" value="<?= $e_semester['semester_id']; ?>" />
            <div class="col-12 mb-1">
              <label class="form-label" for="siswa_mutasi_kelaslama">Kelas Siswa</label>
              <select class="form-control select2" name="siswa_mutasi_kelaslama" id="kelas_id" data-placeholder="Pilih Kelas Siswa"  autofocus data-msg="Please enter Kelas Siswa">
                <option value=""> Pilih Kelas</option>
              </select>
            </div>
            <div class="col-12 mb-1">
              <label class="form-label" for="siswa_id">Nama Siswa</label>
              <select class="form-control select2" name="siswa_id" id="siswa_id" data-placeholder="Pilih Nama Siswa" autofocus data-msg="Please enter Nama Siswa">
                <option value=""></option>
              </select>
            </div>
            <div class="col-12 mb-1">
              <label class="form-label" for="siswa_mutasi_tgl">Tanggal Mutasi</label>
              <input type="text" id="siswa_mutasi_tgl" name="siswa_mutasi_tgl" class="form-control flatpickr-basic" placeholder="Tanggal Mutasi" autofocus data-msg="Please enter Tanggal Mutasi" />
            </div>
            <div class="col-12 mb-1">
              <label class="form-label" for="siswa_mutasi_alasan">Alasan Mutasi</label>
              <select class="select2 form-select" id="siswa_mutasi_alasan" name="siswa_mutasi_alasan" data-placeholder="Pilih Alasan Mutasi" autofocus data-msg="Please enter Alasan Mutasi">
                <?php foreach ($alasan_mutasi as $code => $val) {  ?>
                  <option value="">Pilih Alasan Mutasi</option>
                  <option value="<?= $code ?>"><?= $val ?> </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-12 mb-1">
              <label class="form-label" for="siswa_mutasi_ke">Mutasi Jenjang Ke-</label>
              <select class="form-control select2" name="siswa_mutasi_ke" id="siswa_mutasi_ke" data-placeholder="Pilih Mutasi Jenjang Ke-">
                <?php if ($t_lembaga['jenjang_id'] == '2') { ?>
                  <option value=""></option>
                  <option value="MI">MI</option>
                  <option value="SD">SD</option>
                  <option value="PAKET A">PAKET A</option>
                  <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                <?php } elseif ($t_lembaga['jenjang_id'] == '3') { ?>
                  <option value=""></option>
                  <option value="MTS">MTS</option>
                  <option value="SMP">SMP</option>
                  <option value="PAKET B">PAKET B</option>
                  <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                <?php } elseif ($t_lembaga['jenjang_id'] == '4') { ?>
                  <option value=""></option>
                  <option value="MA">MA</option>
                  <option value="SMA">SMA</option>
                  <option value="PAKET C">PAKET C</option>
                  <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                <?php  } else { ?>
                  <option value=""></option>
                  <option value="RA">RA</option>
                  <option value="TK">TK</option>
                  <option value="PAUD">PAUD</option>
                  <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                <?php } ?>
              </select>
            </div>
            <div class="col-12 mb-1">
              <label class="form-label" for="siswa_mutasi_kestatus">Mutasi Status Ke-</label>
              <select class="form-control select2" name="siswa_mutasi_kestatus" id="siswa_mutasi_kestatus" data-placeholder="Pilih Mutasi Status Ke-">
                <?php foreach ($statusSekolah as $val) {  ?>
                  <option value="">Pilih Mutasi Status Ke-</option>
                  <option value="<?= $val ?>"><?= $val ?> </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-12 mb-1">
              <label class="form-label" for="siswa_mutasi_namasekolah">Nama Sekolah Mutasi</label>
              <input type="text" id="siswa_mutasi_namasekolah" name="siswa_mutasi_namasekolah" class="form-control" placeholder="Nama Sekolah Mutasi" />
            </div>
            <div class="col-12 mb-1">
              <label class="form-label" for="siswa_mutasi_npsnsekolah">NPSN Sekolah Mutasi</label>
              <input type="text" id="siswa_mutasi_npsnsekolah" name="siswa_mutasi_npsnsekolah" class="form-control" placeholder="NPSN Sekolah Mutasi" />
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary mt-2 me-1">Tambah Mutasi</button>
              <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                Discard
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $.ajax({
        type: 'POST',
        url: 'Students/Models/cruds-mutations.php?pg=selectKelasId',
        cache: false,
        success: function(msg) {
          $("#kelas_id").html(msg);
        }
      });

      $("#kelas_id").change(function() {
        var kelas_id = $("#kelas_id").val();
        $.ajax({
          type: 'POST',
          url: 'Students/Models/cruds-mutations.php?pg=selectSiswaId',
          data: {
            kelas_id: kelas_id
          },
          cache: false,
          success: function(msg) {
            $("#siswa_id").html(msg);
          }
        });
      });


    });
  </script>
</div>
<script src="Students/js/students-mutations.js"></script>
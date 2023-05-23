<?php
$t_ppdbperiode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM t_ppdbperiode"));
?>
<div class="content-body">
    <!-- Achievement Table -->
    <div class="card">
        <div class="card-header">
            <h3>Data Registrations Siswa</h3>
        </div>
        <div class="card-datatable table-responsive">
            <table id="datatables-regist" class="datatables-regist table text-dark">
                <thead class="table-success ">
                    <tr class="text-center ">
                        <th></th>
                        <th>NO. Reg / GEL</th>
                        <th>Nama / NISN</th>
                        <th>NO Identitas</th>
                        <th>Tmp/Tgl Lahir</th>
                        <th>Contact/JK</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Achievement Table -->

    <!-- Add Achievement Modal -->
    <div class="modal fade" id="createRegistrations" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 pb-2">
                    <div class="text-center mb-2">
                        <h3 class="mb-1">Tambah Data Pendaftar</h3>
                    </div>
                    <form id="createRegistrationsForm" class="row" onsubmit="return false">
                        <div class="col-12 mb-1">
                            <label class="form-label" for="tahunajaran_id">Tahun Ajaran</label>
                            <select class="form-control select2" name="tahunajaran_id" id="tahunajaran_id" data-placeholder="Pilih Tahun Ajaran">
                                <option value="">Pilih Tahun PPDB</option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbjurusan_alias">Tahun Gelombang Daftar</label>
                            <select class="form-control select2" name="ppdbjurusan_alias" id="ppdbjurusan_alias" data-placeholder="Pilih Tahun Gelombang Daftar">
                                <option value="">Pilih Gelombang / Jurusan</option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_name">Pendaftar Nama</label>
                            <input type="text" id="ppdbregist_name" name="ppdbregist_name" class="form-control" placeholder="Pendaftar Nama" autofocus data-msg="Please enter Pendaftar Nama" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_gender">Jenis Kelamin</label>
                            <select class="form-control select2" name="ppdbregist_gender" id="ppdbregist_gender" data-placeholder="Pilih Jenis Kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_nisn">Pendaftar NISN</label>
                            <input type="text" id="ppdbregist_nisn" name="ppdbregist_nisn" class="form-control" placeholder="Pendaftar NISN" autofocus data-msg="Please enter Pendaftar NISN" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_tempat">Pendaftar Tempat Lahir</label>
                            <input type="text" id="ppdbregist_tempat" name="ppdbregist_tempat" class="form-control" placeholder="Pendaftar Tempat Lahir" autofocus data-msg="Please enter Pendaftar Tempat Lahir" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_tgllahir">Pendaftar Tgl Lahir</label>
                            <input type="text" id="ppdbregist_tgllahir" name="ppdbregist_tgllahir" class="form-control flatpickr-basic" placeholder="Pendaftar Tgl Lahir" autofocus data-msg="Please enter Pendaftar Tgl Lahir" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_nokk">Pendaftar No KK</label>
                            <input type="text" id="ppdbregist_nokk" name="ppdbregist_nokk" class="form-control" placeholder="Pendaftar No KK" autofocus data-msg="Please enter Pendaftar No KK" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_nik">Pendaftar NIK</label>
                            <input type="text" id="ppdbregist_nik" name="ppdbregist_nik" class="form-control" placeholder="Pendaftar NIK" autofocus data-msg="Please enter Pendaftar NIK" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbregist_nohp">Pendaftar No HP</label>
                            <input type="text" id="ppdbregist_nohp" name="ppdbregist_nohp" class="form-control" placeholder="Pendaftar No HP" autofocus data-msg="Please enter Pendaftar No HP" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="password">Pendaftar Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Pendaftar Password" autofocus data-msg="Please enter Pendaftar Password" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="password_confirm">Confirm Password</label>
                            <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Confirm Password" autofocus data-msg="Please enter Confirm Password" />
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Tambah Registrations</button>
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
<script src="Registrations/scripts.js"></script>
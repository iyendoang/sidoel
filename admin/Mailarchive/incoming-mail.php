<div class="content-body">
    <!-- Achievement Table -->
    <div class="card">
        <div class="card-header">
            <h3>Data Mailarchive Siswa</h3>
        </div>
        <div class="card-datatable table-responsive">
            <table id="datatables-jurusan" class="datatables-jurusan table text-center">
                <thead class="table-primary">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Mailarchive</th>
                        <th>Tgl. Buka</th>
                        <th>Tgl. Tutup</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Achievement Table -->

    <!-- Add Achievement Modal -->
    <div class="modal fade" id="createMailarchive" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 pb-2">
                    <div class="text-center mb-2">
                        <h3 class="mb-1">Tambah Data Jurusan</h3>
                    </div>
                    <form id="createMailarchiveForm" class="row" onsubmit="return false">
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbjurusan_alias">Kode / ALias Jurusan / Gelombang</label>
                            <input type="text" id="ppdbjurusan_alias" name="ppdbjurusan_alias" class="form-control" placeholder="Kode / ALias Jurusan / Gelombang" autofocus data-msg="Please enter Kode / ALias Jurusan / Gelombang" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbjurusan_name">Jurusan Nama</label>
                            <input type="text" id="ppdbjurusan_name" name="ppdbjurusan_name" class="form-control" placeholder="Jurusan Nama" autofocus data-msg="Please enter Jurusan Nama" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbjurusan_desc">Deskripsi Jurusan</label>
                            <textarea class="form-control" id="ppdbjurusan_desc" name="ppdbjurusan_desc" rows="3" placeholder="Deskripsi Jurusan"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Tambah Mailarchive</button>
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
    <!-- Edit Achievement Modal -->
    <div class="modal fade" id="createMailarchive" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 pb-2">
                    <div class="text-center mb-2">
                        <h3 class="mb-1">Edit Data Jurusan</h3>
                    </div>
                    <form id="createMailarchiveForm" class="row" onsubmit="return false">
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbjurusan_alias">Kode / ALias Jurusan / Gelombang</label>
                            <input type="text" id="ppdbjurusan_alias" name="ppdbjurusan_alias" class="form-control" placeholder="Kode / ALias Jurusan / Gelombang" autofocus data-msg="Please enter Kode / ALias Jurusan / Gelombang" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbjurusan_name">Jurusan Nama</label>
                            <input type="text" id="ppdbjurusan_name" name="ppdbjurusan_name" class="form-control" placeholder="Jurusan Nama" autofocus data-msg="Please enter Jurusan Nama" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbjurusan_desc">Deskripsi Jurusan</label>
                            <textarea class="form-control" id="ppdbjurusan_desc" name="ppdbjurusan_desc" rows="3" placeholder="Deskripsi Jurusan"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Edit Mailarchive</button>
                            <button type="button" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit Achievement Modal -->
</div>
<script src="Mailarchive/scripts.js"></script><!-- table -->
<div class="content-body">
    <!-- Achievement Table -->
    <div class="card">
        <div class="card-header">
            <h3>Data Periode Siswa</h3>
        </div>
        <div class="card-datatable table-responsive">
            <table id="datatables-periode" class="datatables-periode table text-center">
                <thead class="table-primary">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Periode</th>
                        <th>Tgl. Buka</th>
                        <th>Tgl. Tutup</th>
                        <th>Jml.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Achievement Table -->

    <!-- Add Achievement Modal -->
    <div class="modal fade" id="createPeriode" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 pb-2">
                    <div class="text-center mb-2">
                        <h3 class="mb-1">Tambah Data Periode</h3>
                    </div>
                    <form id="createPeriodeForm" class="row" onsubmit="return false">
                        <div class="col-12 mb-1">
                            <label class="form-label" for="tahunajaran_id">Periode Tahun</label>
                            <select class="form-control select2" name="tahunajaran_id" id="tahunajaran_id" data-placeholder="Pilih Periode Tahun">
                                <option value=""> Pilih Periode</option>
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbperiode_opened">Tanggal Dibuka</label>
                            <input type="text" id="ppdbperiode_opened" name="ppdbperiode_opened" class="form-control flatpickr-basic" placeholder="Tanggal Dibuka" autofocus data-msg="Please enter Tanggal Dibuka" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbperiode_closed">Tanggal Ditutup</label>
                            <input type="text" id="ppdbperiode_closed" name="ppdbperiode_closed" class="form-control flatpickr-basic" placeholder="Tanggal Ditutup" autofocus data-msg="Please enter Tanggal Ditutup" />
                        </div>
                        <!-- <div class="col-12 mb-1">
                            <div class="d-flex flex-column">
                                <label class="form-check-label mb-50" for="ppdbperiode_actived">Primary</label>
                                <div class="form-check form-switch form-check-primary">
                                    
                                    <input type="checkbox" class="form-check-input" id="ppdbperiode_actived" name="ppdbperiode_actived" checked />
                                    <label class="form-check-label" for="ppdbperiode_actived">
                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Tambah Periode</button>
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
    <div class="modal fade" id="editPeriodeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 pb-2">
                    <div class="text-center mb-2">
                        <h3 class="mb-1">Edit Data Periode</h3>
                    </div>
                    <form id="editPeriodeForm" class="row" onsubmit="return false">
                    <input type="hidden" name="ppdbperiode_id" id="edit_ppdbperiode_id">
                    <input type="hidden" name="tahunajaran_nama" id="edit_tahunajaran_nama">
                        <div class="col-12 mb-1">
                            <label class="form-label" for="tahunajaran_id">Periode Tahun</label>
                            <select class="form-control select2" name="tahunajaran_id" id="edit_tahunajaran_id" data-placeholder="Pilih Periode Tahun">
                                <!-- <option value=""> Pilih Periode</option> -->
                            </select>
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbperiode_opened">Tanggal Dibuka</label>
                            <input type="text" id="edit_ppdbperiode_opened" name="ppdbperiode_opened" class="form-control flatpickr-basic" placeholder="Tanggal Dibuka" autofocus data-msg="Please enter Tanggal Dibuka" />
                        </div>
                        <div class="col-12 mb-1">
                            <label class="form-label" for="ppdbperiode_closed">Tanggal Ditutup</label>
                            <input type="text" id="edit_ppdbperiode_closed" name="ppdbperiode_closed" class="form-control flatpickr-basic" placeholder="Tanggal Ditutup" autofocus data-msg="Please enter Tanggal Ditutup" />
                        </div>
                        <!-- <div class="col-12 mb-1">
                       <div class="d-flex flex-column">
                           <label class="form-check-label mb-50" for="ppdbperiode_actived">Primary</label>
                           <div class="form-check form-switch form-check-primary">
                               
                               <input type="checkbox" class="form-check-input" id="ppdbperiode_actived" name="ppdbperiode_actived" checked />
                               <label class="form-check-label" for="ppdbperiode_actived">
                                   <span class="switch-icon-left"><i data-feather="check"></i></span>
                                   <span class="switch-icon-right"><i data-feather="x"></i></span>
                               </label>
                           </div>
                       </div>
                   </div> -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Edit Periode</button>
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
<script src="Periode/scripts.js"></script><!-- table -->
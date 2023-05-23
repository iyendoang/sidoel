<div class="col-md-6 col-12 px-2">
    <div class="card business-card">
        <div class="business-items">
            <div class="business-item">
                <div class="transaction-item ">
                    <div class="d-flex flex-row">
                        <?php if ($f_siswa_act['file_ktp_ayah'] == null) { ?>
                            <div class="avatar bg-light-danger rounded">
                                <a href="#" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="right" title="Belum ada KTP Ayah">
                                    <div class="avatar-content text-danger">
                                        <i data-feather="x" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="transaction-info">
                                <h6 class="transaction-title fw-bolder text-danger">Kosong</h6>
                                <small class="text-muted">KTP Ayah</small>
                            </div>
                        <?php } else { ?>
                            <div class="avatar bg-light-success rounded">
                                <a href="../<?= $f_siswa_act['file_ktp_ayah'] ?>" target="_blank" data-bs-toggle="tooltip" data-bs-placement="right" title="Lihat File KTP Ayah">
                                    <div class="avatar-content">
                                        <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="transaction-info">
                                <h6 class="transaction-title fw-bolder text-success">Terupload</h6>
                                <small class="text-muted">KTP Ayah</small>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($f_siswa_act['file_ktp_ayah'] == null) { ?>
                        <button type=" button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#file_ktp_ayahModal">
                            <i data-feather="upload" class="me-25"></i>
                            <span class="d-none d-sm-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Upload File KTP Ayah">Upload</span>
                        </button>
                    <?php } else { ?>
                        <button type=" button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#file_ktp_ayahModal">
                            <i data-feather="upload" class="me-25"></i>
                            <span class="d-none d-sm-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Update File KTP Ayah">Update</span>
                        </button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-start modal-secondary" id="file_ktp_ayahModal" tabindex="-1" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">
                    Upload KTP Ayah
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-file_ktp_ayah" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-12 custom-options-checkable g-1 text-center">
                        <img src="" id="file_ktp_ayah-img" class="file_ktp_ayahAvatar rounded me-50" alt="profile image" height="100" width="200" style="display: none;" />
                        <label id="Labelfile_ktp_ayah" class="custom-option-item  p-1" for="file_ktp_ayah">
                            <i data-feather="upload" class="font-large-5 mb-75"></i>
                            <small class="d-block">Pilih file upload</small>
                        </label>
                        <input type="hidden" name="siswa_kk_nama" value="<?= $f_siswa_act['siswa_kk_nama'] ?>">
                        <input type="hidden" name="siswa_id" value="<?= $f_siswa_act['siswa_id'] ?>">
                        <input type="hidden" name="siswa_nsm" value="<?= $f_siswa_act['siswa_nsm'] ?>">
                        <input type="hidden" name="file_ktp_ayahlama" value="<?= $f_siswa_act['file_ktp_ayah'] ?>">
                        <input type="file" id="file_ktp_ayah" name="file_ktp_ayah" hidden accept="image/*" />
                        <div id="preview"></div>
                        <p class="mb-0 text-small text-muted">file types: png, jpg, jpeg.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="file_ktp_ayahReset" class="btn btn-secondary " style="display: none;">Reset</button>
                    <button type="submit" form="form-file_ktp_ayah" class="btn btn-success btn-simpan-file_ktp_ayah" style="display: none;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
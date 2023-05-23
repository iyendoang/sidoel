<form method="post" id="form-lembaga_filekopsurat" enctype="multipart/form-data" action="javascript:;">
    <div class="card-body pt-0">
        <input type="hidden" name="lembaga_id" id="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>">
        <input type="hidden" name="lembaga_filekopsuratlama" id="lembaga_filekopsuratlama" value="<?= $t_lembaga['lembaga_filekopsurat'] ?>">
        <div class="d-flex mt-2">
            <div class="flex-shrink-0 border-1">
                <?php if (substr($t_lembaga['lembaga_filekopsurat'], -3) === 'pdf') { ?>
                    <img src="../assets/images/files-icons/pdf.png" alt="lembaga_filekopsurat" class="me-1" height="55" width="55" id="lembaga_filekopsuratImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filekopsurat'], -3) === 'doc') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_filekopsurat" class="me-1" height="55" width="55" id="lembaga_filekopsuratImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filekopsurat'], -4) === 'docx') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_filekopsurat" class="me-1" height="55" width="55" id="lembaga_filekopsuratImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filekopsurat'], -4) === 'xlsx') { ?>
                    <img src="../assets/images/files-icons/xlsx_icon.png" alt="lembaga_filekopsurat" class="me-1" height="55" width="55" id="lembaga_filekopsuratImg" />
                <?php } else { ?>
                    <img src="../<?= $t_lembaga['lembaga_filekopsurat'] ?>" alt="lembaga_filekopsurat" class="me-1" height="55" width="55" id="lembaga_filekopsuratImg" />
                <?php } ?>
            </div>
            <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-1">
                    <p class="fw-bolder mb-0">Kop Surat</p>
                    <span>
                        <a href="../<?= $t_lembaga['lembaga_filekopsurat'] ?>" target="_blank" id="lembaga_filekopsurat-text">
                            <small>:../ <?php echo substr($t_lembaga['lembaga_filekopsurat'], -20); ?></small>
                        </a>
                    </span>
                </div>
                <div class="mt-50 mt-sm-0">
                    <label for="lembaga_filekopsurat" class="btn btn-sm btn-icon btn-outline-primary mr-75 mb-0">
                        <i data-feather="upload" class="font-medium-3"></i>
                    </label>
                    <input type="file" id="lembaga_filekopsurat" name="lembaga_filekopsurat" hidden accept="image/*" />
                    <button type="submit" data-bs-toggle="tooltip" title="Save And Change File" data-bs-delay="500" data-bs-toggle="tooltip" title="Save And Change File" data-bs-delay="500" id="lembaga_filekopsuratBtn" class="btn btn-sm btn-icon btn-outline-success mr-75 mb-0">
                        <i data-feather="send" class="font-medium-3"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
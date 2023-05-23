<form method="post" id="form-lembaga_fileakre" enctype="multipart/form-data" action="javascript:;">
    <div class="card-body pt-0">
        <input type="hidden" name="lembaga_id" id="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>">
        <input type="hidden" name="lembaga_fileakrelama" id="lembaga_fileakrelama" value="<?= $t_lembaga['lembaga_fileakre'] ?>">
        <div class="d-flex mt-2">
            <div class="flex-shrink-0 border-1">
                <?php if (substr($t_lembaga['lembaga_fileakre'], -3) === 'pdf') { ?>
                    <img src="../assets/images/files-icons/pdf.png" alt="lembaga_fileakre" class="me-1" height="45" width="45" id="lembaga_fileakreImg" />
                <?php } elseif (substr($t_lembaga['lembaga_fileakre'], -3) === 'doc') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_fileakre" class="me-1" height="45" width="45" id="lembaga_fileakreImg" />
                <?php } elseif (substr($t_lembaga['lembaga_fileakre'], -4) === 'docx') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_fileakre" class="me-1" height="45" width="45" id="lembaga_fileakreImg" />
                <?php } elseif (substr($t_lembaga['lembaga_fileakre'], -4) === 'xlsx') { ?>
                    <img src="../assets/images/files-icons/xlsx_icon.png" alt="lembaga_fileakre" class="me-1" height="45" width="45" id="lembaga_fileakreImg" />
                <?php } else { ?>
                    <img src="../<?= $t_lembaga['lembaga_fileakre'] ?>" alt="lembaga_fileakre" class="me-1" height="45" width="45" id="lembaga_fileakreImg" />
                <?php } ?>
            </div>
            <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-1">
                    <p class="fw-bolder mb-0">File Akreditasi</p>
                    <span>
                        <a href="../<?= $t_lembaga['lembaga_fileakre'] ?>" target="_blank" id="lembaga_fileakre-text">
                            <small>:../ <?php echo substr($t_lembaga['lembaga_fileakre'], -40); ?></small>
                        </a>
                    </span>
                </div>
                <div class="mt-50 mt-sm-0">
                    <label for="lembaga_fileakre" class="btn btn-sm btn-icon btn-outline-primary mr-75 mb-75">
                        <i data-feather="upload" class="font-medium-3"></i>
                    </label>
                    <input type="file" id="lembaga_fileakre" name="lembaga_fileakre" hidden accept="image/*" />
                    <button data-bs-toggle="tooltip" title="Save And Change File" data-bs-delay="500" type="submit" id="lembaga_fileakreBtn" class="btn btn-sm btn-icon btn-outline-success mr-75 mb-75">
                        <i data-feather="send" class="font-medium-3"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
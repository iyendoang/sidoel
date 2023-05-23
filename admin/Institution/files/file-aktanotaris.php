<form method="post" id="form-lembaga_fileakta" enctype="multipart/form-data" action="javascript:;">
    <div class="card-body pt-0">
        <input type="hidden" name="lembaga_id" id="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>">
        <input type="hidden" name="lembaga_fileaktalama" id="lembaga_fileaktalama" value="<?= $t_lembaga['lembaga_fileakta'] ?>">
        <div class="d-flex mt-2">
            <div class="flex-shrink-0 border-1">
                <?php if (substr($t_lembaga['lembaga_fileakta'], -3) === 'pdf') { ?>
                    <img src="../assets/images/files-icons/pdf.png" alt="lembaga_fileakta" class="me-1" height="45" width="45" id="lembaga_fileaktaImg" />
                <?php } elseif (substr($t_lembaga['lembaga_fileakta'], -3) === 'doc') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_fileakta" class="me-1" height="45" width="45" id="lembaga_fileaktaImg" />
                <?php } elseif (substr($t_lembaga['lembaga_fileakta'], -4) === 'docx') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_fileakta" class="me-1" height="45" width="45" id="lembaga_fileaktaImg" />
                <?php } elseif (substr($t_lembaga['lembaga_fileakta'], -4) === 'xlsx') { ?>
                    <img src="../assets/images/files-icons/xlsx_icon.png" alt="lembaga_fileakta" class="me-1" height="45" width="45" id="lembaga_fileaktaImg" />
                <?php } else { ?>
                    <img src="../<?= $t_lembaga['lembaga_fileakta'] ?>" alt="lembaga_fileakta" class="me-1" height="45" width="45" id="lembaga_fileaktaImg" />
                <?php } ?>
            </div>
            <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-1">
                    <p class="fw-bolder mb-0">Akta Notaris</p>
                    <span>
                        <a href="../<?= $t_lembaga['lembaga_fileakta'] ?>" target="_blank" id="lembaga_fileakta-text">
                            <small>:../ <?php echo substr($t_lembaga['lembaga_fileakta'], -40); ?></small>
                        </a>
                    </span>
                </div>
                <div class="mt-50 mt-sm-0">
                    <label for="lembaga_fileakta" class="btn btn-sm btn-icon btn-outline-primary mr-75 mb-75">
                        <i data-feather="upload" class="font-medium-3"></i>
                    </label>
                    <input type="file" id="lembaga_fileakta" name="lembaga_fileakta" hidden accept="image/*" />
                    <button type="submit" data-bs-toggle="tooltip" title="Save And Change File" data-bs-delay="500" data-bs-toggle="tooltip" title="Save And Change File" data-bs-delay="500" id="lembaga_fileaktaBtn" class="btn btn-sm btn-icon btn-outline-success mr-75 mb-75">
                        <i data-feather="send" class="font-medium-3"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
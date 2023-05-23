<form method="post" id="form-lembaga_filesiop" enctype="multipart/form-data" action="javascript:;">
    <div class="card-body pt-0">
        <input type="hidden" name="lembaga_id" id="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>">
        <input type="hidden" name="lembaga_filesioplama" id="lembaga_filesioplama" value="<?= $t_lembaga['lembaga_filesiop'] ?>">
        <div class="d-flex mt-2">
            <div class="flex-shrink-0 border-1">
                <?php if (substr($t_lembaga['lembaga_filesiop'], -3) === 'pdf') { ?>
                    <img src="../assets/images/files-icons/pdf.png" alt="lembaga_filesiop" class="me-1" height="45" width="45" id="lembaga_filesiopImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filesiop'], -3) === 'doc') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_filesiop" class="me-1" height="45" width="45" id="lembaga_filesiopImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filesiop'], -4) === 'docx') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_filesiop" class="me-1" height="45" width="45" id="lembaga_filesiopImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filesiop'], -4) === 'xlsx') { ?>
                    <img src="../assets/images/files-icons/xlsx_icon.png" alt="lembaga_filesiop" class="me-1" height="45" width="45" id="lembaga_filesiopImg" />
                <?php } else { ?>
                    <img src="../<?= $t_lembaga['lembaga_filesiop'] ?>" alt="lembaga_filesiop" class="me-1" height="45" width="45" id="lembaga_filesiopImg" />
                <?php } ?>
            </div>
            <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-1">
                    <p class="fw-bolder mb-0">SIOP Madrasah</p>
                    <span>
                        <a href="../<?= $t_lembaga['lembaga_filesiop'] ?>" target="_blank" id="lembaga_filesiop-text">
                            <small>:../ <?php echo substr($t_lembaga['lembaga_filesiop'], -40); ?></small>
                        </a>
                    </span>
                </div>
                <div class="mt-50 mt-sm-0">
                    <label for="lembaga_filesiop" class="btn btn-sm btn-icon btn-outline-primary mr-75 mb-75">
                        <i data-feather="upload" class="font-medium-3"></i>
                    </label>
                    <input type="file" id="lembaga_filesiop" name="lembaga_filesiop" hidden accept="image/*" />
                    <button type="submit" data-bs-toggle="tooltip" title="Save And Change File" data-bs-delay="500" id="lembaga_filesiopBtn" class="btn btn-sm btn-icon btn-outline-success mr-75 mb-75">
                        <i data-feather="send" class="font-medium-3"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
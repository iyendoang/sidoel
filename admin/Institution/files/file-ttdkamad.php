<form method="post" id="form-lembaga_filettdkamad" enctype="multipart/form-data" action="javascript:;">
    <div class="card-body pt-0">
        <input type="hidden" name="lembaga_id" id="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>">
        <input type="hidden" name="lembaga_filettdkamadlama" id="lembaga_filettdkamadlama" value="<?= $t_lembaga['lembaga_filettdkamad'] ?>">
        <div class="d-flex mt-2">
            <div class="flex-shrink-0 border-1">
                <?php if (substr($t_lembaga['lembaga_filettdkamad'], -3) === 'pdf') { ?>
                    <img src="../assets/images/files-icons/pdf.png" alt="lembaga_filettdkamad" class="me-1" height="55" width="55" id="lembaga_filettdkamadImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filettdkamad'], -3) === 'doc') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_filettdkamad" class="me-1" height="55" width="55" id="lembaga_filettdkamadImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filettdkamad'], -4) === 'docx') { ?>
                    <img src="../assets/images/files-icons/doc.png" alt="lembaga_filettdkamad" class="me-1" height="55" width="55" id="lembaga_filettdkamadImg" />
                <?php } elseif (substr($t_lembaga['lembaga_filettdkamad'], -4) === 'xlsx') { ?>
                    <img src="../assets/images/files-icons/xlsx_icon.png" alt="lembaga_filettdkamad" class="me-1" height="55" width="55" id="lembaga_filettdkamadImg" />
                <?php } else { ?>
                    <img src="../<?= $t_lembaga['lembaga_filettdkamad'] ?>" alt="lembaga_filettdkamad" class="me-1" height="55" width="55" id="lembaga_filettdkamadImg" />
                <?php } ?>
            </div>
            <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-1">
                    <p class="fw-bolder mb-0">TTD Kamad</p>
                    <span>
                        <a href="../<?= $t_lembaga['lembaga_filettdkamad'] ?>" target="_blank" id="lembaga_filettdkamad-text">
                            <small>:../ <?php echo substr($t_lembaga['lembaga_filettdkamad'], -20); ?></small>
                        </a>
                    </span>
                </div>
                <div class="mt-50 mt-sm-0">
                    <label for="lembaga_filettdkamad" class="btn btn-sm btn-icon btn-outline-primary mr-75 mb-0">
                        <i data-feather="upload" class="font-medium-3"></i>
                    </label>
                    <input type="file" id="lembaga_filettdkamad" name="lembaga_filettdkamad" hidden accept="image/*" />
                    <button type="submit" data-bs-toggle="tooltip" title="Save And Change File" data-bs-delay="500" id="lembaga_filettdkamadBtn" class="btn btn-sm btn-icon btn-outline-success mr-75 mb-0">
                        <i data-feather="send" class="font-medium-3"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
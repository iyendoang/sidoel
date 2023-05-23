<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">Dokumen Lainya</h5>
            <div class="offcanvas-start-example">
                <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStart" aria-controls="offcanvasStart">
                    Add
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasStart" aria-labelledby="offcanvasStartLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasStartLabel" class="offcanvas-title">Tambah File Dokumen</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                        <form id="form-add_filelembaga" class="add-new-user modal-content pt-0" method="post">
                            <div class="mb-1">
                                <label class="form-label" for="upload_name">Nama File</label>
                                <input type="text" name="upload_name" class="form-control" id="upload_name" placeholder="Nama File">
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="upload_file">FIle Upload</label>
                                <input type="file" name="upload_file" class="form-control" id="upload_file" placeholder="FIle Upload">
                            </div>
                            <button type="submit" class="btn btn-primary mb-1 d-grid w-100">Continue</button>
                            <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(function() {
                    ('use strict');
                    var
                        newUserForm = $('#form-add_filelembaga'),
                        select = $('.select2');
                    // select2
                    select.each(function() {
                        var $this = $(this);
                        $this.wrap('<div class="position-relative"></div>');
                        $this
                            .select2({
                                placeholder: 'Select value',
                                dropdownParent: $this.parent()
                            })
                            .change(function() {
                                $(this).valid();
                            });
                    });
                    statusObj = {
                        1: {
                            title: 'Pending',
                            class: 'badge-light-warning'
                        },
                        2: {
                            title: 'Active',
                            class: 'badge-light-success'
                        },
                        3: {
                            title: 'Inactive',
                            class: 'badge-light-secondary'
                        }
                    };
                    // Form Validation
                    if (newUserForm.length) {
                        newUserForm.validate({
                            errorClass: 'error',
                            rules: {
                                'upload_name': {
                                    required: true
                                },
                                'upload_file': {
                                    required: true
                                },
                            }
                        });
                        newUserForm.on('submit', function(e) {
                            var isValid = newUserForm.valid();
                            e.preventDefault();
                            if (isValid) {
                                $.ajax({
                                    url: 'Institution/M_institution_files.php?pg=add_filelembaga',
                                    method: "POST",
                                    data: new FormData(this),
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(data) {
                                        var json = $.parseJSON(data);
                                        if (json == 'ok') {
                                            Swal.fire({
                                                title: 'Gambar Sedang Di Upload..!',
                                                html: 'Harap Bersabar <b>Upload File</b> dalam Proses.',
                                                timer: 3000,
                                                timerProgressBar: true,
                                                didOpen: () => {
                                                    Swal.showLoading();
                                                    timerInterval = setInterval(() => {
                                                        const content = Swal.getHtmlContainer();
                                                        if (content) {
                                                            const b = content.querySelector('b');
                                                            if (b) {
                                                                b.textContent = Swal.getTimerLeft();
                                                            }
                                                        }
                                                    }, 3000);
                                                },
                                                willClose: () => {
                                                    clearInterval(timerInterval);
                                                }
                                            }).then(result => {
                                                if (result.dismiss === Swal.DismissReason.timer) {
                                                    console.log('Proses Generate Berhasil');
                                                }
                                            });
                                            setTimeout(function() {
                                                window.location.reload();
                                            }, 2000);
                                        } else {
                                            Swal.fire({
                                                title: 'Maaf',
                                                text: json,
                                                icon: 'error',
                                                customClass: {
                                                    confirmButton: 'btn btn-danger'
                                                }
                                            });
                                            setTimeout(function() {
                                                window.location.reload();
                                            }, 2000);
                                        }
                                    },
                                })
                            }
                        });
                    }
                });
            </script>
        </div>
        <?php
        $query = mysqli_query($koneksi, "select * from m_uploadfile order by updated_at DESC");
        $no = 0;
        while ($r_uploadfile = mysqli_fetch_array($query)) {
            $no++;
        ?>
            <div class="card-body pt-0">
                <div class="d-flex mt-2">
                    <div class="flex-shrink-0 border-1">
                        <?php if (substr($r_uploadfile['upload_file'], -3) === 'pdf') { ?>
                            <img src="../assets/images/files-icons/pdf.png" alt="upload_file" class="me-1" height="55" width="55" id="upload_fileImg" />
                        <?php } elseif (substr($r_uploadfile['upload_file'], -3) === 'doc') { ?>
                            <img src="../assets/images/files-icons/doc.png" alt="upload_file" class="me-1" height="55" width="55" id="upload_fileImg" />
                        <?php } elseif (substr($r_uploadfile['upload_file'], -4) === 'docx') { ?>
                            <img src="../assets/images/files-icons/doc.png" alt="upload_file" class="me-1" height="55" width="55" id="upload_fileImg" />
                        <?php } elseif (substr($r_uploadfile['upload_file'], -4) === 'xlsx') { ?>
                            <img src="../assets/images/files-icons/xlsx_icon.png" alt="upload_file" class="me-1" height="55" width="55" id="upload_fileImg" />
                        <?php } elseif (substr($r_uploadfile['upload_file'], -3) === 'rar' or substr($r_uploadfile['upload_file'], -3) === 'zip') { ?>
                            <img src="../assets/images/files-icons/rar.png" alt="upload_file" class="me-1" height="55" width="55" id="upload_fileImg" />
                        <?php } else { ?>
                            <img src="../<?= $r_uploadfile['upload_file'] ?>" alt="upload_file" class="me-1" height="55" width="55" id="upload_fileImg" />
                        <?php } ?>
                    </div>
                    <div class="d-flex justify-content-between flex-grow-1">
                        <div class="me-1">
                            <p class="fw-bolder mb-0"><?= $r_uploadfile['upload_name'] ?></p>
                            <span>
                                <a href="../<?= $r_uploadfile['upload_file'] ?>" target="_blank" id="upload_file-text">
                                    <small>:../ <?php echo substr($r_uploadfile['upload_file'], -35); ?></small>
                                </a><br>
                                <small class="text-muted">Updated at : <?php echo $r_uploadfile['updated_at']; ?></small>
                            </span>
                        </div>
                        <div class="mt-50 mt-sm-0">
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary mr-75 mb-75" data-bs-toggle="offcanvas" data-bs-target="#upload_file<?= $no ?>" title="Edit File">
                                <i data-feather="edit" class="font-medium-3"></i>
                            </button>
                            <button class="delete_class btn btn-sm btn-icon btn-outline-danger mr-75 mb-75" id="<?php echo $r_uploadfile['id_upload']; ?>" type="button" data-bs-toggle="tooltip" title="Hapus Files" data-bs-delay="500">
                                <i data-feather='trash-2'></i>
                            </button>
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="upload_file<?= $no ?>" aria-labelledby="offcanvasStartLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasStartLabel" class="offcanvas-title">Edit File Dokumen</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                    <form id="form-edit_filelembaga<?= $no ?>" class="add-new-user modal-content pt-0" method="post">
                                        <input type="hidden" name="id_upload" class="form-control" id="id_upload" placeholder="Nama File" value="<?= $r_uploadfile['id_upload'] ?>">
                                        <div class="mb-1">
                                            <label class="form-label" for="upload_name">Nama File</label>
                                            <input type="text" name="upload_name" class="form-control" id="upload_name" placeholder="Nama File" value="<?= $r_uploadfile['upload_name'] ?>">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="upload_file">FIle Upload</label>
                                            <input type="hidden" name="upload_filelama" class="form-control" id="upload_filelama" placeholder="FIle Upload" value="<?= $r_uploadfile['upload_file'] ?>">
                                            <input type="file" name="upload_file" class="form-control" id="upload_file" placeholder="FIle Upload">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-1 d-grid w-100">Continue</button>
                                        <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <script>
                                $(function() {
                                    ('use strict');
                                    var
                                        newUserForm = $('#form-edit_filelembaga<?= $no ?>'),
                                        select = $('.select2');
                                    // select2
                                    select.each(function() {
                                        var $this = $(this);
                                        $this.wrap('<div class="position-relative"></div>');
                                        $this
                                            .select2({
                                                placeholder: 'Select value',
                                                dropdownParent: $this.parent()
                                            })
                                            .change(function() {
                                                $(this).valid();
                                            });
                                    });
                                    statusObj = {
                                        1: {
                                            title: 'Pending',
                                            class: 'badge-light-warning'
                                        },
                                        2: {
                                            title: 'Active',
                                            class: 'badge-light-success'
                                        },
                                        3: {
                                            title: 'Inactive',
                                            class: 'badge-light-secondary'
                                        }
                                    };
                                    // Form Validation
                                    if (newUserForm.length) {
                                        newUserForm.validate({
                                            errorClass: 'error',
                                            rules: {
                                                'upload_name': {
                                                    required: true
                                                },
                                            }
                                        });
                                        newUserForm.on('submit', function(e) {
                                            var isValid = newUserForm.valid();
                                            e.preventDefault();
                                            if (isValid) {
                                                $.ajax({
                                                    url: 'Institution/M_institution_files.php?pg=edit_filelembaga',
                                                    method: "POST",
                                                    data: new FormData(this),
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    success: function(data) {
                                                        var json = $.parseJSON(data);
                                                        if (json == 'ok') {
                                                            Swal.fire({
                                                                title: 'Gambar Sedang Di Upload..!',
                                                                html: 'Harap Bersabar <b>Upload File</b> dalam Proses.',
                                                                timer: 3000,
                                                                timerProgressBar: true,
                                                                didOpen: () => {
                                                                    Swal.showLoading();
                                                                    timerInterval = setInterval(() => {
                                                                        const content = Swal.getHtmlContainer();
                                                                        if (content) {
                                                                            const b = content.querySelector('b');
                                                                            if (b) {
                                                                                b.textContent = Swal.getTimerLeft();
                                                                            }
                                                                        }
                                                                    }, 3000);
                                                                },
                                                                willClose: () => {
                                                                    clearInterval(timerInterval);
                                                                }
                                                            }).then(result => {
                                                                if (result.dismiss === Swal.DismissReason.timer) {
                                                                    console.log('Proses Generate Berhasil');
                                                                }
                                                            });
                                                            setTimeout(function() {
                                                                window.location.reload();
                                                            }, 2000);
                                                        } else {
                                                            Swal.fire({
                                                                title: 'Maaf',
                                                                text: json,
                                                                icon: 'error',
                                                                customClass: {
                                                                    confirmButton: 'btn btn-danger'
                                                                }
                                                            });
                                                            setTimeout(function() {
                                                                window.location.reload();
                                                            }, 2000);
                                                        }
                                                    },
                                                })
                                            }
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    $(".delete_class").click(function() {
        var del_id = $(this).attr('id');
        console.log(del_id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: 'Institution/M_institution_files.php?pg=hapus_filelembaga',
                    method: "POST",
                    data: 'id_upload=' + del_id,
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'Your imaginary file is safe :)',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                });
            }
        });
    });
</script>
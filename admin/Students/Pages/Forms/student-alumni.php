<?php
$e_siswa = fetch($koneksi, 'e_siswa', ['siswa_id' => dekripsi($_GET['id'])]);
$f_siswa_act = fetch($koneksi, 'f_siswa_act', ['siswa_id' => dekripsi($_GET['id'])]);
$e_tahunajaran = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM e_tahunajaran WHERE tahunajaran_id ='$f_siswa_act[siswa_lulus_tahunajaran_id]'"));
?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <a href="?pg=students-alumnus" class="btn btn-outline-primary">Back</a>
                    <h4 class="card-title">Lulusan</h4>
                </div>
                <div class="card-body">
                    <form class="form form-block" id="formEditAlumni" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="siswa_id" id="siswa_id" value="<?= $e_siswa['siswa_id']; ?>">
                        <input type="hidden" name="siswa_nama" id="siswa_nama" value="<?= $e_siswa['siswa_nama']; ?>">
                        <div class="row mt-2">
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="siswa_nama">Nama Alumni</label>
                                    <input type="text" class="form-control" value="<?= $e_siswa['siswa_nama']; ?>" disabled/>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="siswa_lulus_tahun">Tahun Lulus</label>
                                    <select class="select2 form-select" id="siswa_lulus_tahunajaran_id" name="siswa_lulus_tahunajaran_id" data-placeholder="Pilih Tahun">
                                        <option value="<?= $e_tahunajaran['tahunajaran_id']; ?>"><?= $e_tahunajaran['tahunajaran_nama']; ?></option>
                                        <?php
                                        $query = "SELECT * FROM e_tahunajaran";
                                        $results = $koneksi->prepare($query);
                                        $results->execute();
                                        $result = $results->get_result();
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <option value="<?= $row['tahunajaran_id']; ?>"><?= $row['tahunajaran_nama']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="siswa_lulus_noseri">No. Seri Ijazah</label>
                                    <input type="text" id="siswa_lulus_noseri" class="form-control" name="siswa_lulus_noseri" placeholder="No. Seri Ijazah" value="<?= $f_siswa_act['siswa_lulus_noseri']; ?>" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="siswa_lulus_ke">Melanjutkan ke</label>
                                    <select class="select2 form-select" id="siswa_lulus_ke" name="siswa_lulus_ke" data-placeholder="Melanjutkan ke">
                                        <?php if ($t_lembaga['jenjang_id'] == '2') { ?>
                                            <option value="<?= $f_siswa_act['siswa_lulus_ke'] ?>"><?= $f_siswa_act['siswa_lulus_ke'] ?></option>
                                            <option value="MTS">MTS</option>
                                            <option value="SMP">SMP</option>
                                            <option value="PAKET B">PAKET B</option>
                                            <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                                        <?php } elseif ($t_lembaga['jenjang_id'] == '3') { ?>
                                            <option value="<?= $f_siswa_act['siswa_lulus_ke'] ?>"><?= $f_siswa_act['siswa_lulus_ke'] ?></option>
                                            <option value="MA">MA</option>
                                            <option value="SMA">SMA</option>
                                            <option value="PAKET C">PAKET C</option>
                                            <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                                        <?php } elseif ($t_lembaga['jenjang_id'] == '4') { ?>
                                            <option value="<?= $f_siswa_act['siswa_lulus_ke'] ?>"><?= $f_siswa_act['siswa_lulus_ke'] ?></option>
                                            <option value="KULIAH">KULIAH</option>
                                            <option value="KERJA">KERJA</option>
                                            <option value="PUTUS PENDIDIKAN">PUTUS PENDIDIKAN</option>
                                        <?php  } else { ?>
                                            <option value="<?= $f_siswa_act['siswa_lulus_ke'] ?>"><?= $f_siswa_act['siswa_lulus_ke'] ?></option>
                                            <option value="MI">MI</option>
                                            <option value="SD">SD</option>
                                            <option value="PAKET A">PAKET A</option>
                                            <option value="PUTUS SEKOLAH">PUTUS SEKOLAH</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="siswa_lulus_kestatus">Status Lanjutan</label>
                                    <select class="select2 form-select" id="siswa_lulus_kestatus" name="siswa_lulus_kestatus" data-placeholder="Status Lanjutan">
                                        <?php foreach ($statusSekolah as $val) {  ?>
                                            <?php if ($f_siswa_act['siswa_lulus_kestatus'] == $val) { ?>
                                                <option value="<?= $val ?>" selected><?= $val ?></option>
                                            <?php  } else { ?>
                                                <option value="<?= $val ?>"><?= $val ?> </option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="siswa_lulus_namasekolah">Nama Sekolah
                                        Lanjutan</label>
                                    <input type="text" id="siswa_lulus_namasekolah" class="form-control" name="siswa_lulus_namasekolah" value="<?= $f_siswa_act['siswa_lulus_namasekolah']; ?>" placeholder="Nama Sekolah Lanjutan" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="siswa_lulus_npsnsekolah">NPSN Sekolah
                                        Lanjutan</label>
                                    <input type="text" id="siswa_lulus_npsnsekolah" class="form-control" name="siswa_lulus_npsnsekolah" value="<?= $f_siswa_act['siswa_lulus_npsnsekolah']; ?>" placeholder="NPSN Sekolah Lanjutan" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="file_lulus_ijz">Upload Ijazah /
                                        <a target="_blank" href="../<?= $f_siswa_act['file_lulus_ijz'] ?>"><span class="">Lihat File</span></a>
                                    </label>
                                    <input class="form-control" type="hidden" id="file_lulus_ijzlama" name="file_lulus_ijzlama" value="<?= $f_siswa_act['file_lulus_ijz'] ?>" />
                                    <input class="form-control" type="file" id="file_lulus_ijz" name="file_lulus_ijz" />
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <button type="submit" class="btn btn-primary me-1 btn-simpan">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary btn-batal">Batal</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Floating Label Form section end -->
<script>
    $(function() {
        'use strict';
        var is_supported_browser = !!window.File,
            fileSizeToBytes,
            formatter = $.validator.format,
            select = $('.select2'),
            picker = $('.picker'),
            timerInterval = setInterval(10000),
            formStudentBeforeSchool = $('#formEditAlumni');
        fileSizeToBytes = (function() {

            var units = ["B", "KB", "MB", "GB", "TB"];

            return function(size, unit) {

                var index_of_unit = units.indexOf(unit),
                    coverted_size;

                if (index_of_unit === -1) {

                    coverted_size = false;

                } else {

                    while (index_of_unit > 0) {
                        size *= 1024;
                        index_of_unit -= 1;
                    }

                    coverted_size = size;
                }

                return coverted_size;
            };
        }());
        $.validator.addMethod(
            "fileType",
            function(value, element, params) {

                var files,
                    types = params.types || ["text"],
                    is_valid = false;

                if (!is_supported_browser || this.optional(element)) {

                    is_valid = true;

                } else {

                    files = element.files;

                    if (files.length < 1) {

                        is_valid = false;

                    } else {

                        $.each(types, function(key, value) {
                            is_valid = is_valid || files[0].type.indexOf(value) !== -1;
                        });

                    }
                }

                return is_valid;
            },
            function(params, element) {
                return formatter(
                    // "File must be one of the following types: {0}.",
                    "File types harus: {0}.",
                    params.types.join(",")
                );
            }
        );
        $.validator.addMethod(
            "minFileSize",
            function(value, element, params) {

                var files,
                    unit = params.unit || "KB",
                    size = params.size || 100,
                    min_file_size = fileSizeToBytes(size, unit),
                    is_valid = false;

                if (!is_supported_browser || this.optional(element)) {

                    is_valid = true;

                } else {

                    files = element.files;

                    if (files.length < 1) {

                        is_valid = false;

                    } else {

                        is_valid = files[0].size >= min_file_size;

                    }
                }

                return is_valid;
            },
            function(params, element) {
                return formatter(
                    "Ukuran file terlalu kecil minimal {0}{1}.",
                    [params.size || 100, params.unit || "KB"]
                );
            }
        );
        $.validator.addMethod(
            "maxFileSize",
            function(value, element, params) {

                var files,
                    unit = params.unit || "KB",
                    size = params.size || 100,
                    max_file_size = fileSizeToBytes(size, unit),
                    is_valid = false;

                if (!is_supported_browser || this.optional(element)) {

                    is_valid = true;

                } else {

                    files = element.files;

                    if (files.length < 1) {

                        is_valid = false;

                    } else {

                        is_valid = files[0].size <= max_file_size;

                    }
                }

                return is_valid;
            },
            function(params, element) {
                return formatter(
                    // "File cannot be larger than {0}{1}.",
                    "Ukuran file terlalu besar maksimal {0}{1}.",
                    [params.size || 100, params.unit || "KB"]
                );
            }
        );
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
        if (picker.length) {
            picker.flatpickr({
                allowInput: true,
                onReady: function(selectedDates, dateStr, instance) {
                    if (instance.isMobile) {
                        $(instance.mobileInput).attr('step', null);
                    }
                }
            });
        }
        if (formStudentBeforeSchool.length) {
            formStudentBeforeSchool.validate({
                rules: {
                    siswa_lulus_tahunajaran_id: {
                        required: true
                    },
                    siswa_lulus_noseri: {
                        required: true,
                    },
                    siswa_lulus_ke: {
                        required: true,
                    },
                    siswa_lulus_npsnsekolah: {
                        number: true,
                        minlength: 8,
                        maxlength: 8,
                    },
                    siswa_lulus_namasekolah: {
                        minlength: 3,
                    },
                    file_lulus_ijz: {
                        fileType: {
                            types: ["png", "jpeg", "jpg"]
                        },
                        maxFileSize: {
                            "unit": "MB",
                            "size": 4
                        },
                        minFileSize: {
                            "unit": "KB",
                            "size": "20"
                        }
                    },
                },
                messages: {
                    'file_lulus_ijz': {
                        fileType: 'File type akta lahir harus "png", "jpeg", "jpg"',
                    },
                    'file_lulus_ijz': {
                        maxFileSize: 'Maksimal size file harus 4MB',
                    },
                    'file_lulus_ijz': {
                        minFileSize: 'Minimal size file harus 20 kb',
                    },
                }
            });
        }
        formStudentBeforeSchool.submit(function(event) {
            event.preventDefault();
            if (formStudentBeforeSchool.valid())
                $.ajax({
                    type: 'POST',
                    url: 'Students/Models/cruds-editAlumni.php?pg=formEditAlumni',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $.blockUI({
                            message: '<div class="d-flex justify-content-center align-items-center"><p class="me-50 mb-0">Please wait...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
                            css: {
                                backgroundColor: 'transparent',
                                color: '#fff',
                                border: '0'
                            },
                            overlayCSS: {
                                opacity: 0.5
                            },
                            timeout: 1500,
                        });
                        $(".btn-simpan").html(
                            '<div class="spinner-border spinner-border-sm text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...'
                        );
                        $(".btn-batal").hide(100);
                        $(".btn-simpan").attr("disabled", true);
                    },
                    success: function(data) {
                        const obj = JSON.parse(data);
                        if (obj.status == 200) {
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
                                    Swal.fire({
                                        title: 'Good job!',
                                        text: obj.message,
                                        icon: obj.icon,
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    })
                                }
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 4000);
                        } else if (obj.status == 202) {
                            Swal.fire({
                                title: 'Good job!',
                                text: obj.message,
                                icon: obj.icon,
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            });
                            $(".btn-simpan").html(
                                '<span class="text-white">simpan</span>'
                            );
                            $(".btn-batal").show(100);
                            $(".btn-simpan").attr("disabled", false);
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        } else if (obj.status == 300) {
                            Swal.fire({
                                title: 'Error!',
                                text: obj.message,
                                icon: obj.icon,
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                            });
                            $(".btn-simpan").html(
                                '<span class="text-white">simpan</span>'
                            );
                            $(".btn-batal").show(100);
                            $(".btn-simpan").attr("disabled", false);
                        } else {
                            Swal.fire({
                                title: 'Oooh No!',
                                text: 'Error Data Input',
                                icon: obj.icon,
                            });
                        }
                    },
                });
            else
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kolom Input Isian Belum Lengkap',
                    icon: 'info',
                    customClass: {
                        confirmButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                });
            return false;
        });
    });
</script>
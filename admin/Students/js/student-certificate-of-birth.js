$(function () {
    'use strict';
    var is_supported_browser = !!window.File,
        fileSizeToBytes,
        formatter = $.validator.format,
        select = $('.select2'),
        picker = $('.picker'),
        timerInterval = setInterval(10000),
        formCertificateOfBirth = $('#formEditCertificateOfBirth');
    fileSizeToBytes = (function () {

        var units = ["B", "KB", "MB", "GB", "TB"];

        return function (size, unit) {

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
        function (value, element, params) {

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

                    $.each(types, function (key, value) {
                        is_valid = is_valid || files[0].type.indexOf(value) !== -1;
                    });

                }
            }

            return is_valid;
        },
        function (params, element) {
            return formatter(
                // "File must be one of the following types: {0}.",
                "File types harus: {0}.",
                params.types.join(",")
            );
        }
    );
    $.validator.addMethod(
        "minFileSize",
        function (value, element, params) {

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
        function (params, element) {
            return formatter(
                "Ukuran file terlalu kecil minimal {0}{1}.",
                [params.size || 100, params.unit || "KB"]
            );
        }
    );
    $.validator.addMethod(
        "maxFileSize",
        function (value, element, params) {

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
        function (params, element) {
            return formatter(
                // "File cannot be larger than {0}{1}.",
                "Ukuran file terlalu besar maksimal {0}{1}.",
                [params.size || 100, params.unit || "KB"]
            );
        }
    );
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this
            .select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            })
            .change(function () {
                $(this).valid();
            });
    });
    if (picker.length) {
        picker.flatpickr({
            allowInput: true,
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr('step', null);
                }
            }
        });
    }
    if (formCertificateOfBirth.length) {
        formCertificateOfBirth.validate({
            rules: {
                siswa_akta_nama: {
                    required: true
                },
                siswa_akta_nik: {
                    required: true,
                    number: true,
                    minlength: 16,
                    maxlength: 16,
                },
                siswa_akta_tempat: {
                    required: true,
                },
                siswa_akta_tgllahir: {
                    required: true,
                },
                siswa_akta_ayah: {
                    required: true
                },
                siswa_akta_ibu: {
                    required: true
                },
                siswa_akta_file: {
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
                'siswa_akta_file': {
                    fileType: 'File type akta lahir harus "png", "jpeg", "jpg"',
                },
                'maxFileSize': {
                    fileType: 'Maksimal size file harus 4MB',
                },
                'minFileSize': {
                    fileType: 'Minimal size file harus 20 kb',
                },
            }
        });
    }
    formCertificateOfBirth.submit(function (event) {
        event.preventDefault();
        if (formCertificateOfBirth.valid())
            $.ajax({
                type: 'POST',
                url: 'Students/Models/M_Students.php?pg=formEditCertificateOfBirth',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $.blockUI({
                        message:
                            '<div class="d-flex justify-content-center align-items-center"><p class="me-50 mb-0">Please wait...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
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
                success: function (data) {
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
                        setTimeout(function () {
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
                        setTimeout(function () {
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
            }); return false;
    });
});
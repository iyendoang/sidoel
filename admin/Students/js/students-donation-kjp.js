$(function () {
    'use strict';
    var select = $('.select2'),
        picker = $('.picker'),
        timerInterval = setInterval(10000),
        studentSelectStatusKJP = $('#siswa_kjp_status'),
        formDonationKjp = $('#FormSiswaKJP'),
        file_kjp_bukurekForm = $('#form-file_kjp_bukurek'),
        file_kjp_bukurekImg = $('#file_kjp_bukurek-img'),
        file_kjp_bukurekBtn = $('#file_kjp_bukurek'),
        file_kjp_bukurekUserImage = $('.file_kjp_bukurekAvatar'),
        file_kjp_bukurekBtnSave = $('.btn-simpan-file_kjp_bukurek'),
        file_kjp_bukurekResetBtn = $('#file_kjp_bukurekReset'),
        file_kjp_bukurekLabel = $('#Labelfile_kjp_bukurek'),
        file_kjp_ktpwaliForm = $('#form-file_kjp_ktpwali'),
        file_kjp_ktpwaliImg = $('#file_kjp_ktpwali-img'),
        file_kjp_ktpwaliBtn = $('#file_kjp_ktpwali'),
        file_kjp_ktpwaliUserImage = $('.file_kjp_ktpwaliAvatar'),
        file_kjp_ktpwaliBtnSave = $('.btn-simpan-file_kjp_ktpwali'),
        file_kjp_ktpwaliResetBtn = $('#file_kjp_ktpwaliReset'),
        file_kjp_ktpwaliLabel = $('#Labelfile_kjp_ktpwali'),
        file_kjp_atmForm = $('#form-file_kjp_atm'),
        file_kjp_atmImg = $('#file_kjp_atm-img'),
        file_kjp_atmBtn = $('#file_kjp_atm'),
        file_kjp_atmUserImage = $('.file_kjp_atmAvatar'),
        file_kjp_atmBtnSave = $('.btn-simpan-file_kjp_atm'),
        file_kjp_atmResetBtn = $('#file_kjp_atmReset'),
        file_kjp_atmLabel = $('#Labelfile_kjp_atm');
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
    if (formDonationKjp.length) {
        formDonationKjp.validate({
            rules: {
                siswa_kjp_status: {
                    required: true,
                },
                siswa_kjp_norek: {
                    number: true,
                },
                siswa_kjp_nomoratm: {
                    number: true,
                },
            },
        });
    }
    if (formDonationKjp) {
        formDonationKjp.submit(function () {
            if (formDonationKjp.valid())
                $.ajax({
                    type: 'POST',
                    url: 'Students/Models/cruds-donation-scholarship.php?pg=FormSiswaKJPEdit',
                    data: $(this).serialize(),
                    // data: new FormData(this),
                    success: function (data) {
                        const obj = JSON.parse(data);
                        if (obj.status == 200) {
                            Swal.fire({
                                title: 'Good job!',
                                text: obj.message,
                                icon: obj.icon,
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            });
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
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
    }
    if (studentSelectStatusKJP) {
        studentSelectStatusKJP.on("select2:select", function (e) {
            var siswa_kjp_status = $(this).val();
            console.log(siswa_kjp_status)
            if (siswa_kjp_status == 1) {
                $('#id_formKjpRow').show(600);
                $('#id_fileKjpRow').show(600)
                $("input[name=siswa_kjp_namarek]").removeAttr("readonly", true);
                $("input[name=siswa_kjp_norek]").removeAttr("readonly", true);
                $("input[name=siswa_kjp_bankcab]").removeAttr("readonly", true);
                $("input[name=siswa_kjp_nomoratm]").removeAttr("readonly", true);
            } else {
                $('#id_formKjpRow').hide(600);
                $('#id_fileKjpRow').hide("slow").slideUp("slow");
                $("input[name=siswa_kjp_namarek]").attr("readonly", true);
                $("input[name=siswa_kjp_norek]").attr("readonly", true);
                $("input[name=siswa_kjp_bankcab]").attr("readonly", true);
                $("input[name=siswa_kjp_nomoratm]").attr("readonly", true);
            }
        });
    }
    if (file_kjp_bukurekUserImage) {
        var file_kjp_bukurekActionReset = file_kjp_bukurekUserImage.attr('src');
        file_kjp_bukurekBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_kjp_bukurekImg) {
                    file_kjp_bukurekImg.attr('src', reader.result);
                    file_kjp_bukurekImg.show();
                    file_kjp_bukurekLabel.hide();
                    file_kjp_bukurekResetBtn.show(250);
                    file_kjp_bukurekBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_kjp_bukurekResetBtn.on('click', function () {
            file_kjp_bukurekUserImage.attr('src', file_kjp_bukurekActionReset);
            file_kjp_bukurekBtn.val(null);
            file_kjp_bukurekImg.hide();
            file_kjp_bukurekResetBtn.hide(250);
            file_kjp_bukurekBtnSave.hide(250);
            file_kjp_bukurekLabel.show();
        });
    }
    if (file_kjp_bukurekForm) {
        file_kjp_bukurekForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-donation-kjp-files.php?pg=file_kjp_bukurek_Edit',
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
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
                    file_kjp_bukurekBtnSave.attr("disabled", true);
                },
                success: function (data) {
                    console.log(data);
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
                        file_kjp_bukurekBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_kjp_bukurekBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
    if (file_kjp_ktpwaliUserImage) {
        var file_kjp_ktpwaliActionReset = file_kjp_ktpwaliUserImage.attr('src');
        file_kjp_ktpwaliBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_kjp_ktpwaliImg) {
                    file_kjp_ktpwaliImg.attr('src', reader.result);
                    file_kjp_ktpwaliImg.show();
                    file_kjp_ktpwaliLabel.hide();
                    file_kjp_ktpwaliResetBtn.show(250);
                    file_kjp_ktpwaliBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_kjp_ktpwaliResetBtn.on('click', function () {
            file_kjp_ktpwaliUserImage.attr('src', file_kjp_ktpwaliActionReset);
            file_kjp_ktpwaliBtn.val(null);
            file_kjp_ktpwaliImg.hide();
            file_kjp_ktpwaliResetBtn.hide(250);
            file_kjp_ktpwaliBtnSave.hide(250);
            file_kjp_ktpwaliLabel.show();
        });
    }
    if (file_kjp_ktpwaliForm) {
        file_kjp_ktpwaliForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-donation-kjp-files.php?pg=file_kjp_ktpwali_Edit',
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
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
                    file_kjp_ktpwaliBtnSave.attr("disabled", true);
                },
                success: function (data) {
                    console.log(data);
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
                        file_kjp_ktpwaliBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_kjp_ktpwaliBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
    if (file_kjp_atmUserImage) {
        var file_kjp_atmActionReset = file_kjp_atmUserImage.attr('src');
        file_kjp_atmBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_kjp_atmImg) {
                    file_kjp_atmImg.attr('src', reader.result);
                    file_kjp_atmImg.show();
                    file_kjp_atmLabel.hide();
                    file_kjp_atmResetBtn.show(250);
                    file_kjp_atmBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_kjp_atmResetBtn.on('click', function () {
            file_kjp_atmUserImage.attr('src', file_kjp_atmActionReset);
            file_kjp_atmBtn.val(null);
            file_kjp_atmImg.hide();
            file_kjp_atmResetBtn.hide(250);
            file_kjp_atmBtnSave.hide(250);
            file_kjp_atmLabel.show();
        });
    }
    if (file_kjp_atmForm) {
        file_kjp_atmForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-donation-kjp-files.php?pg=file_kjp_atm_Edit',
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
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
                    file_kjp_atmBtnSave.attr("disabled", true);
                },
                success: function (data) {
                    console.log(data);
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
                        file_kjp_atmBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_kjp_atmBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
});

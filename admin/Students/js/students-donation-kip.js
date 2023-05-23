$(function () {
    'use strict';
    var select = $('.select2'),
        picker = $('.picker'),
        timerInterval = setInterval(10000),
        studentSelectStatusKIP = $('#siswa_kip_status'),
        FormDonationKIP = $('#FormSiswaKIP'),
        file_kip_bukurekForm = $('#form-file_kip_bukurek'),
        file_kip_bukurekImg = $('#file_kip_bukurek-img'),
        file_kip_bukurekBtn = $('#file_kip_bukurek'),
        file_kip_bukurekUserImage = $('.file_kip_bukurekAvatar'),
        file_kip_bukurekBtnSave = $('.btn-simpan-file_kip_bukurek'),
        file_kip_bukurekResetBtn = $('#file_kip_bukurekReset'),
        file_kip_bukurekLabel = $('#Labelfile_kip_bukurek'),
        file_kip_ktpwaliForm = $('#form-file_kip_ktpwali'),
        file_kip_ktpwaliImg = $('#file_kip_ktpwali-img'),
        file_kip_ktpwaliBtn = $('#file_kip_ktpwali'),
        file_kip_ktpwaliUserImage = $('.file_kip_ktpwaliAvatar'),
        file_kip_ktpwaliBtnSave = $('.btn-simpan-file_kip_ktpwali'),
        file_kip_ktpwaliResetBtn = $('#file_kip_ktpwaliReset'),
        file_kip_ktpwaliLabel = $('#Labelfile_kip_ktpwali'),
        file_kip_atmForm = $('#form-file_kip_atm'),
        file_kip_atmImg = $('#file_kip_atm-img'),
        file_kip_atmBtn = $('#file_kip_atm'),
        file_kip_atmUserImage = $('.file_kip_atmAvatar'),
        file_kip_atmBtnSave = $('.btn-simpan-file_kip_atm'),
        file_kip_atmResetBtn = $('#file_kip_atmReset'),
        file_kip_atmLabel = $('#Labelfile_kip_atm');
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
    if (FormDonationKIP.length) {
        FormDonationKIP.validate({
            rules: {
                siswa_kip_status: {
                    required: true,
                },
                siswa_kip_norek: {
                    number: true,
                },
                siswa_kip_nomoratm: {
                    number: true,
                },
            },
        });
    }
    if (FormDonationKIP) {
        FormDonationKIP.submit(function () {
            if (FormDonationKIP.valid())
                $.ajax({
                    type: 'POST',
                    url: 'Students/Models/cruds-donation-scholarship.php?pg=FormSiswaKIPEdit',
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
    if (studentSelectStatusKIP) {
        studentSelectStatusKIP.on("select2:select", function (e) {
            var siswa_kip_status = $(this).val();
            console.log(siswa_kip_status)
            if (siswa_kip_status == 1) {
                $('#id_formKipRow').show(600);
                $('#id_fileKipRow').show(600)
                $("input[name=siswa_kip_namarek]").removeAttr("readonly", true);
                $("input[name=siswa_kip_norek]").removeAttr("readonly", true);
                $("input[name=siswa_kip_bankcab]").removeAttr("readonly", true);
                $("input[name=siswa_kip_nomoratm]").removeAttr("readonly", true);
            } else {
                $('#id_formKipRow').hide(600);
                $('#id_fileKipRow').hide("slow").slideUp("slow");
                $("input[name=siswa_kip_namarek]").attr("readonly", true);
                $("input[name=siswa_kip_norek]").attr("readonly", true);
                $("input[name=siswa_kip_bankcab]").attr("readonly", true);
                $("input[name=siswa_kip_nomoratm]").attr("readonly", true);
            }
        });
    }
    if (file_kip_bukurekUserImage) {
        var file_kip_bukurekActionReset = file_kip_bukurekUserImage.attr('src');
        file_kip_bukurekBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_kip_bukurekImg) {
                    file_kip_bukurekImg.attr('src', reader.result);
                    file_kip_bukurekImg.show();
                    file_kip_bukurekLabel.hide();
                    file_kip_bukurekResetBtn.show(250);
                    file_kip_bukurekBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_kip_bukurekResetBtn.on('click', function () {
            file_kip_bukurekUserImage.attr('src', file_kip_bukurekActionReset);
            file_kip_bukurekBtn.val(null);
            file_kip_bukurekImg.hide();
            file_kip_bukurekResetBtn.hide(250);
            file_kip_bukurekBtnSave.hide(250);
            file_kip_bukurekLabel.show();
        });
    }
    if (file_kip_bukurekForm) {
        file_kip_bukurekForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-donation-kip-files.php?pg=file_kip_bukurek_Edit',
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
                    file_kip_bukurekBtnSave.attr("disabled", true);
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
                        file_kip_bukurekBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_kip_bukurekBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
    if (file_kip_ktpwaliUserImage) {
        var file_kip_ktpwaliActionReset = file_kip_ktpwaliUserImage.attr('src');
        file_kip_ktpwaliBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_kip_ktpwaliImg) {
                    file_kip_ktpwaliImg.attr('src', reader.result);
                    file_kip_ktpwaliImg.show();
                    file_kip_ktpwaliLabel.hide();
                    file_kip_ktpwaliResetBtn.show(250);
                    file_kip_ktpwaliBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_kip_ktpwaliResetBtn.on('click', function () {
            file_kip_ktpwaliUserImage.attr('src', file_kip_ktpwaliActionReset);
            file_kip_ktpwaliBtn.val(null);
            file_kip_ktpwaliImg.hide();
            file_kip_ktpwaliResetBtn.hide(250);
            file_kip_ktpwaliBtnSave.hide(250);
            file_kip_ktpwaliLabel.show();
        });
    }
    if (file_kip_ktpwaliForm) {
        file_kip_ktpwaliForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-donation-kip-files.php?pg=file_kip_ktpwali_Edit',
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
                    file_kip_ktpwaliBtnSave.attr("disabled", true);
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
                        file_kip_ktpwaliBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_kip_ktpwaliBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
    if (file_kip_atmUserImage) {
        var file_kip_atmActionReset = file_kip_atmUserImage.attr('src');
        file_kip_atmBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_kip_atmImg) {
                    file_kip_atmImg.attr('src', reader.result);
                    file_kip_atmImg.show();
                    file_kip_atmLabel.hide();
                    file_kip_atmResetBtn.show(250);
                    file_kip_atmBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_kip_atmResetBtn.on('click', function () {
            file_kip_atmUserImage.attr('src', file_kip_atmActionReset);
            file_kip_atmBtn.val(null);
            file_kip_atmImg.hide();
            file_kip_atmResetBtn.hide(250);
            file_kip_atmBtnSave.hide(250);
            file_kip_atmLabel.show();
        });
    }
    if (file_kip_atmForm) {
        file_kip_atmForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-donation-kip-files.php?pg=file_kip_atm_Edit',
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
                    file_kip_atmBtnSave.attr("disabled", true);
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
                        file_kip_atmBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_kip_atmBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
});

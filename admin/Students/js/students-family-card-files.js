$(function () {
    ('use strict');
    var file_kk_siswaForm = $('#form-file_kk_siswa'),
        file_kk_siswaImg = $('#file_kk_siswa-img'),
        file_kk_siswaBtn = $('#file_kk_siswa'),
        file_kk_siswaUserImage = $('.file_kk_siswaAvatar'),
        file_kk_siswaBtnSave = $('.btn-simpan-file_kk_siswa'),
        file_kk_siswaResetBtn = $('#file_kk_siswaReset'),
        file_kk_siswaLabel = $('#Labelfile_kk_siswa'),
        file_ktp_ayahForm = $('#form-file_ktp_ayah'),
        file_ktp_ayahImg = $('#file_ktp_ayah-img'),
        file_ktp_ayahBtn = $('#file_ktp_ayah'),
        file_ktp_ayahUserImage = $('.file_ktp_ayahAvatar'),
        file_ktp_ayahBtnSave = $('.btn-simpan-file_ktp_ayah'),
        file_ktp_ayahResetBtn = $('#file_ktp_ayahReset'),
        file_ktp_ayahLabel = $('#Labelfile_ktp_ayah'),
        file_ktp_ibuForm = $('#form-file_ktp_ibu'),
        file_ktp_ibuImg = $('#file_ktp_ibu-img'),
        file_ktp_ibuBtn = $('#file_ktp_ibu'),
        file_ktp_ibuUserImage = $('.file_ktp_ibuAvatar'),
        file_ktp_ibuBtnSave = $('.btn-simpan-file_ktp_ibu'),
        file_ktp_ibuResetBtn = $('#file_ktp_ibuReset'),
        file_ktp_ibuLabel = $('#Labelfile_ktp_ibu'),
        file_ktp_waliForm = $('#form-file_ktp_wali'),
        file_ktp_waliImg = $('#file_ktp_wali-img'),
        file_ktp_waliBtn = $('#file_ktp_wali'),
        file_ktp_waliUserImage = $('.file_ktp_waliAvatar'),
        file_ktp_waliBtnSave = $('.btn-simpan-file_ktp_wali'),
        file_ktp_waliResetBtn = $('#file_ktp_waliReset'),
        file_ktp_waliLabel = $('#Labelfile_ktp_wali');
    if (file_kk_siswaUserImage) {
        var file_kk_siswaActionReset = file_kk_siswaUserImage.attr('src');
        file_kk_siswaBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_kk_siswaImg) {
                    file_kk_siswaImg.attr('src', reader.result);
                    file_kk_siswaImg.show();
                    file_kk_siswaLabel.hide();
                    file_kk_siswaResetBtn.show(250);
                    file_kk_siswaBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_kk_siswaResetBtn.on('click', function () {
            file_kk_siswaUserImage.attr('src', file_kk_siswaActionReset);
            file_kk_siswaBtn.val(null);
            file_kk_siswaImg.hide();
            file_kk_siswaResetBtn.hide(250);
            file_kk_siswaBtnSave.hide(250);
            file_kk_siswaLabel.show();
        });
    }
    if (file_kk_siswaForm) {
        file_kk_siswaForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-family-card-files.php?pg=file_kk_siswa_Edit',
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
                    file_kk_siswaBtnSave.attr("disabled", true);
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
                        file_kk_siswaBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_kk_siswaBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
    if (file_ktp_ayahUserImage) {
        var file_ktp_ayahActionReset = file_ktp_ayahUserImage.attr('src');
        file_ktp_ayahBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_ktp_ayahImg) {
                    file_ktp_ayahImg.attr('src', reader.result);
                    file_ktp_ayahImg.show();
                    file_ktp_ayahLabel.hide();
                    file_ktp_ayahResetBtn.show(250);
                    file_ktp_ayahBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_ktp_ayahResetBtn.on('click', function () {
            file_ktp_ayahUserImage.attr('src', file_ktp_ayahActionReset);
            file_ktp_ayahBtn.val(null);
            file_ktp_ayahImg.hide();
            file_ktp_ayahResetBtn.hide(250);
            file_ktp_ayahBtnSave.hide(250);
            file_ktp_ayahLabel.show();
        });
    }
    if (file_ktp_ayahForm) {
        file_ktp_ayahForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-family-card-files.php?pg=file_ktp_ayah_Edit',
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
                    file_ktp_ayahBtnSave.attr("disabled", true);
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
                        file_ktp_ayahBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_ktp_ayahBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
    if (file_ktp_ibuUserImage) {
        var file_ktp_ibuActionReset = file_ktp_ibuUserImage.attr('src');
        file_ktp_ibuBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_ktp_ibuImg) {
                    file_ktp_ibuImg.attr('src', reader.result);
                    file_ktp_ibuImg.show();
                    file_ktp_ibuLabel.hide();
                    file_ktp_ibuResetBtn.show(250);
                    file_ktp_ibuBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_ktp_ibuResetBtn.on('click', function () {
            file_ktp_ibuUserImage.attr('src', file_ktp_ibuActionReset);
            file_ktp_ibuBtn.val(null);
            file_ktp_ibuImg.hide();
            file_ktp_ibuResetBtn.hide(250);
            file_ktp_ibuBtnSave.hide(250);
            file_ktp_ibuLabel.show();
        });
    }
    if (file_ktp_ibuForm) {
        file_ktp_ibuForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-family-card-files.php?pg=file_ktp_ibu_Edit',
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
                    file_ktp_ibuBtnSave.attr("disabled", true);
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
                        file_ktp_ibuBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_ktp_ibuBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
    if (file_ktp_waliUserImage) {
        var file_ktp_waliActionReset = file_ktp_waliUserImage.attr('src');
        file_ktp_waliBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (file_ktp_waliImg) {
                    file_ktp_waliImg.attr('src', reader.result);
                    file_ktp_waliImg.show();
                    file_ktp_waliLabel.hide();
                    file_ktp_waliResetBtn.show(250);
                    file_ktp_waliBtnSave.show(250);
                }
            };
            reader.readAsDataURL(files[0]);
        });
        file_ktp_waliResetBtn.on('click', function () {
            file_ktp_waliUserImage.attr('src', file_ktp_waliActionReset);
            file_ktp_waliBtn.val(null);
            file_ktp_waliImg.hide();
            file_ktp_waliResetBtn.hide(250);
            file_ktp_waliBtnSave.hide(250);
            file_ktp_waliLabel.show();
        });
    }
    if (file_ktp_waliForm) {
        file_ktp_waliForm.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'Students/Models/cruds-family-card-files.php?pg=file_ktp_wali_Edit',
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
                    file_ktp_waliBtnSave.attr("disabled", true);
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
                        file_ktp_waliBtnSave.attr("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Oooh No!',
                            text: 'Error Data Input',
                            icon: obj.icon,
                        });
                        file_ktp_waliBtnSave.attr("disabled", false);
                    }
                }
            })
        });
    }
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_fileaktaend");
var lembaga_fileaktaendFIle = $('#lembaga_fileaktaendImg');
var lembaga_fileaktaendText = document.getElementById('lembaga_fileaktaend-text');
var lembaga_fileaktaend = $('#lembaga_fileaktaend');
if (lembaga_fileaktaend.length) {
    $(lembaga_fileaktaend).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaendFIle.length) {
                lembaga_fileaktaendFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaendText.innerHTML = lembaga_fileaktaend.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileaktaend').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaendBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=z",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_filekopsurat");
var lembaga_filekopsuratFIle = $('#lembaga_filekopsuratImg');
var lembaga_filekopsuratText = document.getElementById('lembaga_filekopsurat-text');
var lembaga_filekopsurat = $('#lembaga_filekopsurat');
if (lembaga_filekopsurat.length) {
    $(lembaga_filekopsurat).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_filekopsuratFIle.length) {
                lembaga_filekopsuratFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_filekopsuratText.innerHTML = lembaga_filekopsurat.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_filekopsurat').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_filekopsuratBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_filekopsurat",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_filesiop");
var lembaga_filesiopFIle = $('#lembaga_filesiopImg');
var lembaga_filesiopText = document.getElementById('lembaga_filesiop-text');
var lembaga_filesiop = $('#lembaga_filesiop');
if (lembaga_filesiop.length) {
    $(lembaga_filesiop).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_filesiopFIle.length) {
                lembaga_filesiopFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_filesiopText.innerHTML = lembaga_filesiop.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_filesiop').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_filesiopBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_filesiop",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_fileaktaend");
var lembaga_fileaktaendFIle = $('#lembaga_fileaktaendImg');
var lembaga_fileaktaendText = document.getElementById('lembaga_fileaktaend-text');
var lembaga_fileaktaend = $('#lembaga_fileaktaend');
if (lembaga_fileaktaend.length) {
    $(lembaga_fileaktaend).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaendFIle.length) {
                lembaga_fileaktaendFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaendText.innerHTML = lembaga_fileaktaend.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileaktaend').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaendBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=z",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_filekopsurat");
var lembaga_filekopsuratFIle = $('#lembaga_filekopsuratImg');
var lembaga_filekopsuratText = document.getElementById('lembaga_filekopsurat-text');
var lembaga_filekopsurat = $('#lembaga_filekopsurat');
if (lembaga_filekopsurat.length) {
    $(lembaga_filekopsurat).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_filekopsuratFIle.length) {
                lembaga_filekopsuratFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_filekopsuratText.innerHTML = lembaga_filekopsurat.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_filekopsurat').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_filekopsuratBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_filekopsurat",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_filenpsn");
var lembaga_filenpsnFIle = $('#lembaga_filenpsnImg');
var lembaga_filenpsnText = document.getElementById('lembaga_filenpsn-text');
var lembaga_filenpsn = $('#lembaga_filenpsn');
if (lembaga_filenpsn.length) {
    $(lembaga_filenpsn).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_filenpsnFIle.length) {
                lembaga_filenpsnFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_filenpsnText.innerHTML = lembaga_filenpsn.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_filenpsn').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_filenpsnBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_filenpsn",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_fileaktaend");
var lembaga_fileaktaendFIle = $('#lembaga_fileaktaendImg');
var lembaga_fileaktaendText = document.getElementById('lembaga_fileaktaend-text');
var lembaga_fileaktaend = $('#lembaga_fileaktaend');
if (lembaga_fileaktaend.length) {
    $(lembaga_fileaktaend).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaendFIle.length) {
                lembaga_fileaktaendFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaendText.innerHTML = lembaga_fileaktaend.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileaktaend').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaendBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=z",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_filekopsurat");
var lembaga_filekopsuratFIle = $('#lembaga_filekopsuratImg');
var lembaga_filekopsuratText = document.getElementById('lembaga_filekopsurat-text');
var lembaga_filekopsurat = $('#lembaga_filekopsurat');
if (lembaga_filekopsurat.length) {
    $(lembaga_filekopsurat).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_filekopsuratFIle.length) {
                lembaga_filekopsuratFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_filekopsuratText.innerHTML = lembaga_filekopsurat.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_filekopsurat').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_filekopsuratBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_filekopsurat",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakre");
var lembaga_fileakreFIle = $('#lembaga_fileakreImg');
var lembaga_fileakreText = document.getElementById('lembaga_fileakre-text');
var lembaga_fileakre = $('#lembaga_fileakre');
if (lembaga_fileakre.length) {
    $(lembaga_fileakre).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileakreFIle.length) {
                lembaga_fileakreFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileakreText.innerHTML = lembaga_fileakre.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakre').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileakreBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakre",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});
var uploadField = document.getElementById("lembaga_fileakta");
var lembaga_fileaktaFIle = $('#lembaga_fileaktaImg');
var lembaga_fileaktaText = document.getElementById('lembaga_fileakta-text');
var lembaga_fileakta = $('#lembaga_fileakta');
if (lembaga_fileakta.length) {
    $(lembaga_fileakta).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileaktaFIle.length) {
                lembaga_fileaktaFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileaktaText.innerHTML = lembaga_fileakta.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileakta').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileaktaBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileakta",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_fileskmenkumham");
var lembaga_fileskmenkumhamFIle = $('#lembaga_fileskmenkumhamImg');
var lembaga_fileskmenkumhamText = document.getElementById('lembaga_fileskmenkumham-text');
var lembaga_fileskmenkumham = $('#lembaga_fileskmenkumham');
if (lembaga_fileskmenkumham.length) {
    $(lembaga_fileskmenkumham).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_fileskmenkumhamFIle.length) {
                lembaga_fileskmenkumhamFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_fileskmenkumhamText.innerHTML = lembaga_fileskmenkumham.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_fileskmenkumham').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_fileskmenkumhamBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_fileskmenkumham",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_filenpwp");
var lembaga_filenpwpFIle = $('#lembaga_filenpwpImg');
var lembaga_filenpwpText = document.getElementById('lembaga_filenpwp-text');
var lembaga_filenpwp = $('#lembaga_filenpwp');
if (lembaga_filenpwp.length) {
    $(lembaga_filenpwp).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_filenpwpFIle.length) {
                lembaga_filenpwpFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_filenpwpText.innerHTML = lembaga_filenpwp.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_filenpwp').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_filenpwpBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_filenpwp",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_filettdkamad");
var lembaga_filettdkamadFIle = $('#lembaga_filettdkamadImg');
var lembaga_filettdkamadText = document.getElementById('lembaga_filettdkamad-text');
var lembaga_filettdkamad = $('#lembaga_filettdkamad');
if (lembaga_filettdkamad.length) {
    $(lembaga_filettdkamad).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_filettdkamadFIle.length) {
                lembaga_filettdkamadFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_filettdkamadText.innerHTML = lembaga_filettdkamad.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_filettdkamad').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_filettdkamadBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_filettdkamad",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

var uploadField = document.getElementById("lembaga_filestempel");
var lembaga_filestempelFIle = $('#lembaga_filestempelImg');
var lembaga_filestempelText = document.getElementById('lembaga_filestempel-text');
var lembaga_filestempel = $('#lembaga_filestempel');
if (lembaga_filestempel.length) {
    $(lembaga_filestempel).on('change', function (e) {
        var reader = new FileReader(),
            files = e.target.files;
        reader.onload = function () {
            if (lembaga_filestempelFIle.length) {
                lembaga_filestempelFIle.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
        lembaga_filestempelText.innerHTML = lembaga_filestempel.val();
    });
}
$(document).ready(function () {
    $('#form-lembaga_filestempel').on('submit', function (event) {
        event.preventDefault();
        var submitButton = $('#lembaga_filestempelBtn');
        $.ajax({
            url: "Institution/M_Institution_files.php?pg=Editlembaga_filestempel",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitButton.attr('disabled', true);
                if ($(submitButton).has('.fa-spinner').length === 0) {
                    $(submitButton).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> . . . </span>');
                }
            },
            success: function (data) {
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
                    setTimeout(function () {
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
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
        })
    });
});

$(function () {
    ('use strict');
    var
        newUserForm = $('#form-add_filelembaga'),
        select = $('.select2');
    // select2
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
        newUserForm.on('submit', function (e) {
            var isValid = newUserForm.valid();
            e.preventDefault();
            if (isValid) {
                $.ajax({
                    url: 'Institution/M_Institution_add_files.php?pg=add_filelembaga',
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
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
                            setTimeout(function () {
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
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        }
                    },
                })
            }
        });
    }
});
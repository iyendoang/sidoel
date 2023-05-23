$('#form-importStudentLembaga').on('submit', function (e) {
    var nsmId = $('#lembaga_nsm_enkripsi').val();
    console.log(lembaga_nsm_enkripsi);
    e.preventDefault();
    $.ajax({
        type: 'post',
        url: 'mod_students/cruds/cruds_students.php?pg=importStudentLembaga',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $('form button').on("click", function (e) {
                e.preventDefault();
            });
            $(".btn-simpan").html(
                '<div class="spinner-border spinner-border-sm text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...'
            );
            $(".btn-batal").hide(100);
            $(".btn-simpan").attr("disabled", true);
        },
        success: function (data) {
            console.log(data)
            Swal.fire({
                title: 'Please Wait..!',
                html: 'Harap Bersabar <b>Upload File</b> dalam Proses.',
                timer: 2000,
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
                    }, 2100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then(result => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    Swal.fire({
                        title: "Good job!",
                        text: data,
                        icon: "success",
                    })
                    setTimeout(function () {
                        window.top.location = "?pg=students-institution&id=" + nsmId
                    }, 2200);
                }
            });
        }
    });
});
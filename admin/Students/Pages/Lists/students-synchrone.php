<section id="alert-colors">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <div class="demo-spacing-0">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Penting. . . !</h4>
                            <div class="alert-body">
                                Masih ada data siswa yang kosong di database SIDOEL silahkan lakukan <code>Synchrone</code> dibawah ini terlebih dahulu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Alert Colors End -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title">Synchrone Data Siswa</h4>
                <p class="card-text">
                    Harap Lakukan synchrone Terlebih Dahulu
                </p>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addNewCard">
                    Synchrone
                </button>
                <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="form-synchrone_sidoel" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                                <div class="modal-body px-sm-5 mx-50 pb-5">
                                    <h1 class="text-center mb-1" id="addNewCardTitle">Synchrone Data Siswa</h1>
                                    <p class="text-center">
                                        Dengan Ini Saya Menyatakan mengcopy data siswa dari aplikasi RDM ke Aplikasi SIDOEL
                                    </p>
                                    <div class="col-12 text-center">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-switch form-check-primary me-25">
                                                <input type="checkbox" class="form-check-input" name="synchrone_check" id="synchrone_check" onclick="myFunction()" />
                                                <label class="form-check-label" for="synchrone_check">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                            <label class="form-check-label fw-bolder" for="synchrone_check">
                                                <small>
                                                    <code>
                                                        Checklist pernyataan setuju menyalin data
                                                    </code>
                                                </small>
                                            </label>
                                        </div>
                                    </div>

                                    <?php
                                    $query = mysqli_query($koneksi, "select * from e_siswa ");
                                    $no = 0;
                                    while ($e_siswa = mysqli_fetch_array($query)) {
                                    ?>
                                        <input type='hidden' id="selector" name='pilih[]' class='form-check-input' value="<?= $e_siswa['siswa_id'] ?>" checked>

                                    <?php }
                                    ?>
                                    <br>
                                    <div style="display: none;" id="bTnsynchrone_check" class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary me-1 mt-1">Synchrone</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div>
                                    <script>
                                        function myFunction() {
                                            var synchrone_check = document.getElementById("synchrone_check");
                                            var bTnsynchrone_check = document.getElementById("bTnsynchrone_check");
                                            if (synchrone_check.checked == true) {
                                                // $("#id_pendidikan_jenjang").hide();
                                                bTnsynchrone_check.style.display = "block";
                                            } else {
                                                bTnsynchrone_check.style.display = "none";
                                            }
                                        }
                                    </script>
                                </div>
                        </div>
                    </div>
                </div>
                </form>
                <script>
                    $('#form-synchrone_sidoel').submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: 'Students/Models/M_Students.php?pg=synchrone_sidoel',
                            data: $(this).serialize(),
                            beforeSend: function() {
                                $('form button').on("click", function(e) {
                                    e.preventDefault();
                                });
                            },
                            success: function(data) {
                                if (data == "") {
                                    Swal.fire({
                                        title: 'Sedang Melakukan Synchrone..!',
                                        html: 'Harap Bersabar <b>Synchrone Data</b> dalam Proses.',
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
                                            }, 3500);
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval);
                                        }
                                    }).then(result => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            Swal.fire({
                                                title: 'Good job!',
                                                text: 'Synchrone Data Siswa Berhasil',
                                                icon: 'success',
                                                customClass: {
                                                    confirmButton: 'btn btn-primary'
                                                },
                                                buttonsStyling: false
                                            });
                                        }
                                    });
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 4500);
                                } else {
                                    toastr['error']('Tidak Ada User Terpilih', 'Edit Gagal', {
                                        showDuration: 500,
                                    });
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                }
                            },
                        });
                        return false;
                    });
                </script>
            </div>
        </div>
    </div>
</div>
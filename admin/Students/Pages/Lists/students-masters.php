<div class="content-body">
    <!-- Students Alumnus table -->
    <section id="basic-datatable">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                <h4 class="text-uppercase fw-bolder">
                                    <i data-feather="settings" class="m-50"></i>

                                    setting kartu pelajar
                                </h4>
                            </button>
                        </h2>
                        <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-lg-12 align-content-center">
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Peringatan</h4>
                                            <div class="alert-body text-center">
                                                Sesuaikan tanggal cetak kartu pelajar dengan kebutuhan anda dan Upload Photo siswa dengan ekstensi photo menggunakan .jpg <code>photo tidak akan ditampilkan jika selain .jgp</code> <b>Ketika anda mengupload file. Maka semua file lama akan di hapus jadi harap simpan file lama anda dengan baik!</b> <code>Maksimal size upload adalah 10 MB</code> harap gunakan dengan bijak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <form id="form-L_tglkartupelajar" method="post">
                                            <input type="hidden" name="lembaga_id" id="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>">
                                            <label for="formFile" class="form-label">Tgl. Kartu</label>

                                            <div class="input-group">
                                                <span class="input-group-text" id="L_tglkartupelajar">Tgl. Kartu</span>
                                                <input type="file" name="L_tglkartupelajar" class="form-control flatpickr-basic" required value="<?= $t_lembaga['L_tglkartupelajar']; ?>" />
                                                <button type="submit" class="btn btn-primary" id="button-addon2" type="button">Go</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <form name="zipForm" method="post" action="Students/Models/cruds-students-masters.php?pg=zipUploadFiles" enctype="multipart/form-data" onsubmit="return validateForm()">
                                            <label for="formFile" class="form-label">Upload Photo</label>
                                            <div class="input-group">
                                                <!-- <span class="input-group-text" id="zip_file">Upload Photo</span> -->
                                                <input type="file" name="zip_file" id="" class="form-control" />
                                                <input type="submit" id="btn_zip" name="btn_zip" class="btn btn-primary" value="Upload" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="Students/Pages/Print/students-print-masters.php" target="_blank" method="post">

                        <div class="card-header border-bottom">
                            <h4 class="card-title text-uppercase fw-bolder">data Induk Siswa</h4>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit" name="btnstudentsCardPrint" id="btnstudentsCardPrint" class="btn btn-primary"><i data-feather="printer"></i></button>
                                <button type="submit" name="btnstudentsDetailPrint" id="btnstudentsDetailPrint" class="btn btn-outline-primary"><i data-feather="instagram"></i></button>
                            </div>
                        </div>

                        <table class="studentsAlumnus-list-table table datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th><input type="checkbox" class="form-check-input checkBoxAll" /></th>
                                    <th>Nama Lengkap</th>
                                    <th>JK</th>
                                    <th>Status</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--/ Students Alumnus table -->
</div>
<script src="Students/js/students-list-masters.js"></script>
<script>
    $('.button').click(function() {
    $.ajax({
        url: "",
        context: document.body,
        success: function(s,x){

            $('html[manifest=saveappoffline.appcache]').attr('content', '');
                $(this).html(s);
        }
    }); 
});
    localStorage.clear()
</script>
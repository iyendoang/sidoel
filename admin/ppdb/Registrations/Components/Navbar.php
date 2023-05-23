<div class="row">
    <div class="col-12">
        <ul class="nav nav-pills nav-fill mb-2 studentRegist-nav-form">
            <!-- edit-student-regist -->
            <li class="nav-item">
                <a class="nav-link active" href="?pg=edit-student-regist&id=<?= enkripsi($t_ppdbregist['ppdbregist_id']) ?>">
                    <i data-feather="user" class="font-medium-3 me-50"></i>
                    <span class="fw-bold d-none d-sm-block">Aktivitas</span>
                </a>
            </li>
            <!-- edit-student-address -->
            <li class="nav-item">
                <a class="nav-link active" href="?pg=edit-student-address&id=<?= enkripsi($t_ppdbregist['ppdbregist_id']) ?>">
                    <i data-feather="zap" class="font-medium-3 me-50"></i>
                    <span class="fw-bold d-none d-sm-block">Alamat</span>
                </a>
            </li>
            <!-- edit-student-parent -->
            <li class="nav-item">
                <a class="nav-link active" href="?pg=edit-student-parent&id=<?= enkripsi($t_ppdbregist['ppdbregist_id']) ?>">
                    <i data-feather="users" class="font-medium-3 me-50"></i>
                    <span class="fw-bold d-none d-sm-block">Orangtua/Wali</span>
                </a>
            </li>
            <!-- edit-student-previous-level -->
            <li class="nav-item">
                <a class="nav-link active" href="?pg=edit-student-previous-level&id=<?= enkripsi($t_ppdbregist['ppdbregist_id']) ?>">
                    <i data-feather="home" class="font-medium-3 me-50"></i>
                    <span class="fw-bold d-none d-sm-block">Sekolah Sebelumnya</span>
                </a>
            </li>
            <!-- edit-student-upload-file -->
            <li class="nav-item">
                <a class="nav-link active" href="?pg=edit-student-upload-file&id=<?= enkripsi($t_ppdbregist['ppdbregist_id']) ?>">
                    <i data-feather="upload" class="font-medium-3 me-50"></i>
                    <span class="fw-bold d-none d-sm-block">Upload File</span>
                </a>
            </li>
        </ul>
        <script>
            var uriTabsStudents = window.location.href;
            // alert(uriTabsStudents);
            $('.studentRegist-nav-form a').each(function() {
                if (this.href === uriTabsStudents) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        </script>
    </div>
</div>
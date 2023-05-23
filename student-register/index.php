<?php
session_start();
require("../config/database.php");
require("../config/function.php");
require("../config/functions.crud.php");
if (isset($_SESSION["ppdbregist_nisn"])) {
    $t_ppdbregist = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_ppdbregist where ppdbregist_nisn='$_SESSION[ppdbregist_nisn]'"));
    $e_pimpinan = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_pimpinan"));
    $e_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_lembaga LIMIT 1"));
    $t_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_lembaga LIMIT 1"));
    $jenjang_id = mysqli_fetch_array(mysqli_query($koneksi, "select jenjang_id from t_lembaga LIMIT 1"));
    $t_jenjang = fetch($koneksi, 't_jenjang', ['jenjang_id' => $t_lembaga['jenjang_id']]);
    $e_tahunajaran = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_tahunajaran where tahunajaran_id = $t_ppdbregist[tahunajaran_id]"));
    $t_ppdbjurusan = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_ppdbjurusan where ppdbjurusan_id = $t_ppdbregist[ppdbjurusan_id]"));
    $e_semester = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_semester where semester_status = 1"));
    $years = range(1980, strtotime("%Y", time()));
?>
    <!DOCTYPE html>
    <html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->
    <?php include 'Layouts/_LinkHead.php' ?>
    <!-- END: Head-->

    <!-- BEGIN: Body-->

    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

        <!-- BEGIN: Header-->
        <?php include 'Layouts/_Headers.php' ?>
        <!-- END: Header-->

        <!-- BEGIN: Main Menu-->
        <?php include 'Layouts/_Menus.php' ?>

        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-body">
                    <div class="row">
                        <?php include 'Layouts/_Contents.php' ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        <!-- BEGIN: Footer-->
        <?php include 'Layouts/_Footers.php' ?>
        <!-- END: Footer-->

        <?php include 'Layouts/_LinkScripts.php' ?>

    </body>
    <!-- END: Body-->

    </html>
<?php
} else {
    $t_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "select * from t_lembaga LIMIT 1"));
    include "auth-login.php";
}
?>

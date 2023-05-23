<?php
require("config/database.php");
require("config/function.php");
require("config/functions.crud.php");
include 'schema/t_lembaga.php';
include 'schema/user.php';
include 'schema/t_jenjangbefore.php';
include 'schema/t_jenjang.php';
include 'schema/t_judulsurat.php';
include 'schema/t_suratkeluar.php';
include 'schema/f_add_prestasi.php';
include 'schema/f_add_kesehatan.php';
include 'schema/m_uploadfile.php';
include 'schema/t_ppdbjurusan.php';
include 'schema/t_ppdbperiode.php';
include 'schema/t_ppdbregist.php';
include 'schema/f_siswa_act.php';
$e_lembaga = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM e_lembaga a 
LEFT JOIN t_lembaga b ON a.lembaga_nsm = b.lembaga_nsm
LEFT JOIN t_jenjang c ON b.jenjang_id = c.jenjang_id
LIMIT 1"));
$e_pimpinan = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_pimpinan"));
$e_tahunajaran = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_tahunajaran where tahunajaran_status = 1"));
$e_semester = mysqli_fetch_array(mysqli_query($koneksi, "select * from e_semester where semester_status = 1"));
$years = range(1980, strtotime("%Y", time()));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="https://res.cloudinary.com/phonerefer/image/upload/v1575096088/ve0o2n85nfvgdatgqer2.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#343a40" />
    <meta name="description" content="Links To My Accounts | Developed By - Your Name" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Web Madrasah</title>
    <style>
        body {
            background-color: #faf8ef;
        }

        h5 {
            color: #343a40;
        }

        .name {
            color: #343a40;
        }

        .love {
            color: #343a40 !important;
        }

        #email {
            text-decoration: none;
            float: right;
            color: #343a40;
        }

        .footer {
            margin-top: 5% !important;
            margin-bottom: 10px;
        }

        @media (max-width: 479px) {
            .footer {
                margin-top: 35% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="media mt-5">
            <img src="../<?= $e_lembaga['lembaga_foto']; ?>" class="m-3" alt="image" width="75px" height="75px">
            <div class="media-body m-2">
                <small class="align-items-center mt-2"><?= $e_lembaga['jenjang_nama']; ?></small>
                <strong class="name">
                    <h5 class="align-items-center mt-2"><?= $e_lembaga['lembaga_nama']; ?></h5>
                </strong>
                <p>
                    <?= $e_lembaga['lembaga_provinsi']; ?>,
                    <?= $e_lembaga['lembaga_kota']; ?>,
                    <?= $e_lembaga['lembaga_kec']; ?>,
                    <?= $e_lembaga['lembaga_kel']; ?>,
                    <?= $e_lembaga['lembaga_alamat']; ?>,
                    <?= $e_lembaga['lembaga_kodepos']; ?>,

                </p>
            </div>
        </div>
        <div class="mt-4">
            <a href="student-register/auth-register.php" class="btn btn-outline-dark btn-block" role="button" target="_blank">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                Pendaftaran PPDB
            </a>
            <br>
            <a href="student-register" class="btn btn-outline-dark btn-block" role="button" target="_blank">
                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                Login PPDB
            </a>
            <br>
            <a href="../" class="btn btn-outline-dark btn-block" role="button" target="_blank">
                <i class="fa fa-registered" aria-hidden="true"></i>
                Login RDM
            </a>
            <br>

        </div>
        <!--------------------Footer---------------------------->
        <div class="footer mt-5">
            <hr />
            <h6>Made With <span class="love">♥</span> in (<?= $e_lembaga['lembaga_provinsi']; ?>), (<?= $e_lembaga['lembaga_kota']; ?>)</h6>
            <h6>
                Proudly By
                <a href="/" class="name" target="_blank"> (<strong>SIDOEL</strong> Sistem Data Operator Electronic) </a>
                <a id="email" href="#"> <i class="fa fa-envelope"> </i> </a>
            </h6>
        </div>
    </div>
</body>

</html>
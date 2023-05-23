<?php
require "../../config/database.php";
require "../../config/function.php";
require "../../config/functions.crud.php";
session_start();


if (isset($_POST["ppdbregist_nisn"]) && isset($_POST["password"])) {
    $nisn = $_POST["ppdbregist_nisn"];
    $password = $_POST["password"];

    $query = "SELECT * FROM t_ppdbregist WHERE ppdbregist_nisn = '$nisn' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION["ppdbregist_nisn"] = $nisn;
        $response = array(
            "success" => true,
            "title" => "Berhasil",
            "message" => "Tunggu beberapa saat untuk login dashboard"
        );
    } else {
        $response = array(
            "success" => false,
            "title" => "Error Login",
            "message" => "Mungkin anda salah memasukan NISN atau Password"
        );
    }
    echo json_encode($response);
}

mysqli_close($koneksi);

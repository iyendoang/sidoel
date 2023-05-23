<?php
if ($_GET['id'] <> 'bFZRbFp2Wnd2QWVNek1LVDN2alVyQT09') {
    die('Ip anda sudah tercatat disistem ini');
}
session_start();
require "../config/database.php";
require "../config/function.php";


$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$query = mysqli_query($koneksi, "select * from user where username='$username'");
$ceklogin = mysqli_num_rows($query);
$user = mysqli_fetch_array($query);
if ($ceklogin == 1) {
    if (!password_verify($password, $user['password'])) {
        echo "salah";
    } else {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['akses'] = $user['akses'];
        echo "ok";
    }
} else {
    echo "oo";
}

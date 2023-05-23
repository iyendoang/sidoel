<?php
$server   = "localhost";
$username = "root";
$password = "";
$database = "sidoel_one";
$url_siswa = "http://e.mtssafinatulhusna.sch.id/akademik/user";
$url_gtk = "http://e.mtssafinatulhusna.sch.id/akademik/gtk";

// koneksi database
$koneksi =  mysqli_connect($server, $username, $password, $database);
$connect = new PDO("mysql:host=localhost;dbname=sidoel_one", "root", "");
// cek koneksi
if (!$koneksi) {
    die('Koneksi Database Gagal : ');
}
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';

// SETTING WAKTU
date_default_timezone_set("Asia/Jakarta");
define('BASEPATH', dirname(__FILE__));

<?php

function cek_not_login()
{
    session_start();
    if (!isset($_SESSION['id_user'])) {
        echo "anda harus login";
        die();
    }
    session_start();
    if (!isset($_SESSION['ppdbregist_id'])) {
        echo "anda harus login";
        die();
    }
}

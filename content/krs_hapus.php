<?php
require_once "config/koneksi.php";
require_once __DIR__ . "/../function.php";

//validasi user
if(!isAuth()) {
    redirectTo("login.php");
}

if(empty($_POST['krs_id'])) {
    flashMessage("danger", "Invalid operation");
    back();
}

$id = htmlspecialchars($_POST['krs_id']);
$dbDestroy("krs", compact('id'));

flashMessage("success", "Berhasil menghapus Matakuliah");
back();
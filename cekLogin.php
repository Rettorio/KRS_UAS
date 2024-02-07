<?php
session_start();
require_once 'config/koneksi.php';
require_once 'function.php';

$nim = htmlspecialchars($_POST['nim']);
$password = htmlspecialchars($_POST['password']);

if(empty($nim) || empty($password)) {
    flashMessage("danger", "Nim atau Password tidak boleh kosong");
    back();
}

try {
    $cek = $con->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
    $cek->execute([$nim]);
} catch (\PDOException $th) {
    throw $th;
}

//cek mhs exist or not
if(!$cek->rowCount()) {
    flashMessage("danger", "Mahasiswa tidak ditemukan");
    back();
}
$mhs = $cek->fetch();
//validasi status mahasiswa
if($mhs['status'] === "Pasif") {
    flashMessage("warning", "Akun anda tidak aktif");
    back();
}
//password checking
if(password_verify($password, $mhs['password'])) {
    $auth = ["nim" => $nim, "nama" => $mhs['nama']];
    $_SESSION['auth'] = $auth;
    redirectTo("index.php?page=krs");
} else {
    flashMessage("warning", "Password salah");
    setOldInput("nim", $nim);
    back();
}
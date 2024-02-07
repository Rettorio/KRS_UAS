<?php
require_once "config/koneksi.php";
require_once __DIR__ . "/../function.php";

//validasi user
if(!isAuth()) {
    redirectTo("login.php");
}

if(empty($_POST['nim']) || empty($_POST['id_smt'])) {
    flashMessage("danger", "Invalid operation.");
    back();
}

$nim = htmlspecialchars($_POST['nim']);
$id_smt = htmlspecialchars($_POST['id_smt']);

//select matkul yang sudah ada di table krs sesuai semester aktif
$selectedMatkulQ = "SELECT kode_mk FROM krs WHERE nim = '$nim' AND id_smt = '$id_smt';"; 
$matkulTerpilih = array_map(fn($r) => $r["kode_mk"], $dbFetcher($selectedMatkulQ));
//filter matakuliah dari $_POST
$matkulPilihan = array_filter($_POST, function ($key) {
    return strpos($key, "matkul") !== false;
}, ARRAY_FILTER_USE_KEY);

//validasi $matkulPilihan ada atau tidak
if(empty($matkulPilihan)) {
    flashMessage("warning", "Tidak ada matakuliah yang dipilih.");
    redirectTo("?page=krs");
}

foreach ($matkulPilihan as $matkulKelas) {
    list($kode_mk, $id_kelas) = explode("-", $matkulKelas);
    //validasi apakah matkul yg dipilih sudah ada dalam daftar krs smt aktif
    if(in_array($kode_mk, $matkulTerpilih)) {
        flashMessage("warning", "Matakuliah sudah diambil!");
        back();
    }
    //insert table krs
    $dbPush("krs", compact('nim','kode_mk','id_smt','id_kelas'));
}

flashMessage("success", "Berhasil menambah Matakuliah.");
back();
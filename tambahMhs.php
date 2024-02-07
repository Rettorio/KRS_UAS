<?php
require_once "config/koneksi.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$password = $_POST['password'];
$status = $_POST['status'] ?? "Pasif";

if(empty($nim) || empty($nama) || empty($password)) {
    echo "<script>alert('data tidak boleh kosong')</script>";
    exit(0);
}

$pwHash = password_hash($password, PASSWORD_DEFAULT);
$values = array($nim,$nama,$pwHash,$status);
try {
    $query = "INSERT INTO mahasiswa VALUES(?,?,?,?);";
    $exec = $con->prepare($query);
    $exec->execute($values);
} catch (\PDOException $e) {
    throw $e;
}

echo "Berhasil<br>";
echo "Nama : $nama <br>".
     "Nim   : $nim  <br>".
     "password : $password <br>".
     "status : $status";
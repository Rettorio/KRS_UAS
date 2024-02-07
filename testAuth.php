<?php
session_start();
require_once "function.php";

@$n = $_SESSION['auth']['nama'];
$message = isAuth() ? sprintf("Selamat datang %s!", $n) : "belum login";

echo $message;
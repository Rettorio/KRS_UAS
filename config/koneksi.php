<?php
// namespace PP\config;

try {
    $con = new \PDO("mysql:host=localhost;dbname=krsuas", "root", "");
    $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $th) {
    throw $th;
}
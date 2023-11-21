<?php

$host = "localhost";
$username = "root";
$passsword = "";
$database = "test_posyandu";

$koneksi = new mysqli($host, $username, $passsword, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal : " . $koneksi->connect_error);
}
?>
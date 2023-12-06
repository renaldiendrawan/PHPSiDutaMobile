<?php
// untuk membuka localhost

$host = "localhost";
$username = "root";
$passsword = "";
$database = "posyandu11";

// untuk membuka hosting

// $username = "tifz1761_root";
// $passsword = "tifnganjuk321";
// $database = "tifz1761_posyandu";

$koneksi = new mysqli($host, $username, $passsword, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal : " . $koneksi->connect_error);
}
?>
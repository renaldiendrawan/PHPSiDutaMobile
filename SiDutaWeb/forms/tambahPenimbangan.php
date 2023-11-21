<?php
include("koneksi.php");
// Ambil data dari form
$idAnak = $_POST['id_anak']; // ID anak yang dipilih dari form
$tanggalPenimbangan = $_POST['tgl_penimbangan'];
$beratBadan = $_POST['berat_badan'];
$tinggiBadan = $_POST['tinggi_badan'];

// Query SQL untuk menambahkan data penimbangan
$sql = "INSERT INTO tbl_penimbangan (id_anak, tgl_penimbangan, berat_badan, tinggi_badan)
        VALUES ('$idAnak', '$tanggalPenimbangan', '$beratBadan', '$tinggiBadan')";

if ($koneksi->query($sql) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Data Penimbangan Berhasil Ditambah!');
    location.replace('timbang.php');
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>

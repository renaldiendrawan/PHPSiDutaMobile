<?php
include("koneksi.php");
// Ambil data dari form
$idAnak = $_POST['id_anak']; // ID anak yang dipilih dari form
$tanggalImunisasi = $_POST['tgl_imunisasi'];
$jenisImunisasi = $_POST['jenis_imunisasi'];

// Query SQL untuk menambahkan data imunisasi
$sql = "INSERT INTO tbl_imunisasi (id_anak, tgl_imunisasi, jenis_imunisasi)
        VALUES ('$idAnak', '$tanggalImunisasi', '$jenisImunisasi')";

if ($koneksi->query($sql) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Data Imunisasi Berhasil Ditambah!');
    location.replace('Imunisasi.php');
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>

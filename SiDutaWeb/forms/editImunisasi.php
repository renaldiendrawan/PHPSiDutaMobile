<?php
include("koneksi.php");

if (isset($_POST['update'])) {
    $id_imunisasi = $_POST['id_imunisasi'];
    $id_anak = $_POST['id_anak'];
    $tgl_imunisasi = $_POST['tgl_imunisasi'];
    $jenis_imunisasi = $_POST['jenis_imunisasi'];

    // Query untuk mengupdate data imunisasi
    $query = "UPDATE imunisasi SET 
    id_anak = '$id_anak', 
    tanggal_imunisasi = '$tgl_imunisasi', 
    jenis_imunisasi = '$jenis_imunisasi' 
    WHERE id_imunisasi = '$id_imunisasi'";

    if ($koneksi->query($query) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Data Imunisasi Berhasil Diedit!');
        location.replace('Imunisasi.php');
        </script>";
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
}

$koneksi->close();
?>

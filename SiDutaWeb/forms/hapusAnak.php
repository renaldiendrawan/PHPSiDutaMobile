<?php
include("koneksi.php");

if (isset($_POST['delete'])) {
    // Ambil ID anak yang akan dihapus dari input form
    $idToDelete = $_POST['idToDelete'];

    // Query DELETE untuk menghapus data anak berdasarkan ID anak
    $sql = "DELETE FROM tbl_anak WHERE id_anak = '$idToDelete'";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Data Berhasil Dihapus!');
        location.replace('anak.php');
        </script>";
    } else {
        echo "<script type='text/javascript'>
        alert('Data Balita Masih ada di Data Imunisasi dan Penimbangan');
        location.replace('anak.php');
        </script>";
    }
    
    // Tutup koneksi
    $koneksi->close();
}
?>

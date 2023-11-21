<?php
include("koneksi.php");

if (isset($_POST['delete'])) {
    // Ambil ID anak yang akan dihapus dari input form
    $idToDelete = $_POST['idToDelete'];

    // Query DELETE untuk menghapus data anak berdasarkan ID anak
    $sql = "DELETE FROM tbl_penimbangan WHERE id_penimbangan = '$idToDelete'";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Data Berhasil Dihapus!');
        location.replace('timbang.php');
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    
    // Tutup koneksi
    $koneksi->close();
}
?>

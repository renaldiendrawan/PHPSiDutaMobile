<?php
include("koneksi.php");

if (isset($_POST['Hapus'])) {
    // Ambil ID anak yang akan dihapus dari input form
    $idToDelete = $_POST['idToDelete'];

    // Query DELETE untuk menghapus data anak berdasarkan ID anak
    $sql = "DELETE FROM imunisasi WHERE id_imunisasi = '$idToDelete'";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Data Berhasil Dihapus!');
        location.replace('imunisasi.php');
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    
    // Tutup koneksi
    $koneksi->close();
}
?>

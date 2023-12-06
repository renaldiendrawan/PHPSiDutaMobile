<?php
include("koneksi.php");

if (isset($_POST['update'])) {
    $id_penimbangan = $_POST['id_penimbangan'];
    $id_anak = $_POST['id_anak'];
    $tgl_penimbangan = $_POST['tgl_penimbangan'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];

    // Query untuk mengupdate data penimbangan
    $query = "UPDATE penimbangan SET 
    id_anak = '$id_anak', 
    tgl_penimbangan = '$tgl_penimbangan', 
    berat_badan = '$berat_badan', 
    tinggi_badan = '$tinggi_badan' 
    WHERE id_penimbangan = '$id_penimbangan'";

    if ($koneksi->query($query) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Data Berhasil Diedit!');
        location.replace('timbang.php');
        </script>";
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
}

$koneksi->close();
?>

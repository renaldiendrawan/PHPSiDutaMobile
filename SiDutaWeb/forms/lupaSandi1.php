<?php
include("koneksi.php");

if (isset($_POST["submit"])) {
    $nama_kader = $_POST["nama_kader"];
    $no_telp = $_POST["no_telp"];

    // Query untuk memeriksa kader di database berdasarkan nama dan nomor telepon
    $query = "SELECT * FROM tbl_kader WHERE nama_kader = '$nama_kader' AND no_telp = '$no_telp'";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        // Kader ditemukan, Anda dapat melakukan perubahan kata sandi di sini
        // Contoh: Update kata sandi kader
        $new_password = $_POST["kata_sandi"];
        $query_update = "UPDATE tbl_kader SET kata_sandi = '$new_password' WHERE nama_kader = '$nama_kader'";
        if ($koneksi->query($query_update) === TRUE) {
            echo "<script type='text/javascript'>
        alert('Kata Sandi Berhasil Diubah!');
        location.replace('lupaSandi.php');
        </script>";
        } else {
            // echo "Error updating record: " . $koneksi->error; 
            echo "<script> alert('nomer  telepon tidak sesuai');</script>"; 
        }
    } else {
        echo "<script type='text/javascript'>
        alert('Data kader tidak ditemukan. Periksa kembali Nama Kader dan Nomor Telepon Anda!');
        location.replace('lupaSandi.php');
        </script>";
    }
}

$koneksi->close();
?>


<?php 
include("koneksi.php");
// Proses login
if (isset($_POST["submit"])) {
    $nama_kader = $_POST["nama_kader"];
    $password = $_POST["kata_sandi"];

    // Query untuk memeriksa user di database
    $query = "SELECT * FROM tbl_kader 
              WHERE nama_kader = '$nama_kader' AND kata_sandi = '$password';";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        // Login berhasil, arahkan ke halaman lain
        // echo "login berhasil"; // Ganti dengan halaman setelah login berhasil
        header("Location: index.php");
        exit();
    } else {
        // Login gagal, tampilkan pesan error
        echo "<script type='text/javascript'>
        alert('Login gagal. Periksa kembali Nama Kader dan Password Anda.');
        location.replace('login1.php');
        </script>";
        
    }
}

// Tutup koneksi database
$koneksi->close();
?>
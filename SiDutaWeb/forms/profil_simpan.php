<?php
include('koneksi.php');
include('login.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data yang akan diperbarui dari formulir
    $idKaderToUpdate = $_POST['id_kader'];
    $namaKaderToUpdate = $_POST['nama_kader'];
    $tanggalLahirToUpdate = $_POST['tgl_lahir'];
    $alamatToUpdate = $_POST['alamat'];
    $jabatanToUpdate = $_POST['jabatan'];
    $notelpToUpdate = $_POST["no_telp"];
    $tugasPokokToUpdate = $_POST['tugas_pokok'];

    // Cek apakah password baru disertakan dalam formulir
    // $newPassword = $_POST['password'];
    // $hashedNewPassword = md5($newPassword); // Assuming MD5 hashing

    // // Query SQL untuk mendapatkan kata sandi yang sudah ada di database
    // $sqlGetPassword = "SELECT kata_sandi FROM tbl_kader WHERE id_kader = $idKaderToUpdate";
    // $resultGetPassword = $koneksi->query($sqlGetPassword);

    // if ($resultGetPassword->num_rows > 0) {
    //     $rowGetPassword = $resultGetPassword->fetch_assoc();
    //     $currentPasswordInDatabase = $rowGetPassword["kata_sandi"];

        // Check if a new password is provided and matches the current password
        if (!empty($newPassword) && $currentPasswordInDatabase === $hashedNewPassword) {
            // echo "Password baru tidak boleh sama dengan password lama.";
        } else {
            // Query SQL UPDATE untuk memperbarui data kader
            $sqlUpdate = "UPDATE tbl_kader SET 
                nama_kader = '$namaKaderToUpdate',
                tgl_lahir = '$tanggalLahirToUpdate',
                alamat = '$alamatToUpdate',
                jabatan = '$jabatanToUpdate',
                tugas_pokok = '$tugasPokokToUpdate',
                no_telp = '$notelpToUpdate'";

            // Check if a new password is provided and update the query accordingly
            

            $sqlUpdate .= " WHERE id_kader = $idKaderToUpdate";

            if ($koneksi->query($sqlUpdate) === TRUE) {
                echo "Data kader berhasil diperbarui.";
            } else {
                echo "Terjadi kesalahan saat memperbarui data: " . $koneksi->error;
            }
        }
    } else {
        echo "Terjadi kesalahan saat mengambil kata sandi dari database.";
    }
// }
?>

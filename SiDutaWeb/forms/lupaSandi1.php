<?php
include("koneksi.php");

if (isset($_POST["submit"])) {
    $nama_kader = $_POST["nama_kader"];
    $no_telp = $_POST["no_telp"];
    $new_password = $_POST["kata_sandi"];
    $confirm_password = $_POST["konfirmasi_kata_sandi"];

    // Validate password confirmation
    if (empty($new_password) || empty($confirm_password)) {
        echo "<script type='text/javascript'>
            alert('Kata Sandi Baru dan Konfirmasi Kata Sandi tidak boleh kosong.');
            location.replace('lupaSandi.php');
        </script>";
        exit();
    }

    if ($new_password !== $confirm_password) {
        echo "<script type='text/javascript'>
            alert('Konfirmasi Kata Sandi tidak sesuai dengan Kata Sandi Baru.');
            location.replace('lupaSandi.php');
        </script>";
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $koneksi->prepare("SELECT * FROM tbl_kader WHERE nama_kader = ? AND no_telp = ?");
    $stmt->bind_param("ss", $nama_kader, $no_telp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Kader ditemukan, Anda dapat melakukan perubahan kata sandi di sini
        // Contoh: Update kata sandi kader dengan MD5
        $md5_password = md5($new_password); // Use a more secure hashing method if possible
        $stmt_update = $koneksi->prepare("UPDATE tbl_kader SET kata_sandi = ? WHERE nama_kader = ?");
        $stmt_update->bind_param("ss", $md5_password, $nama_kader);

        if ($stmt_update->execute()) {
            echo "<script type='text/javascript'>
                alert('Kata Sandi Berhasil Diubah!');
                location.replace('lupaSandi.php');
            </script>";
        } else {
            echo "<script type='text/javascript'>
                alert('Gagal mengubah kata sandi. Silakan coba lagi.');
                location.replace('lupaSandi.php');
            </script>";
        }
    } else {
        echo "<script type='text/javascript'>
            alert('Data kader tidak ditemukan. Periksa kembali Nama Kader dan Nomor Telepon Anda!');
            location.replace('lupaSandi.php');
        </script>";
    }

    $stmt->close();
    $stmt_update->close();
    $koneksi->close();
}
?>

<?php
include("koneksi.php");

if (isset($_POST["submit"])) {
    $nama_kader = $_POST["nama_kader"];
    $password = $_POST["kata_sandi"];

    // Use prepared statement to prevent SQL injection
    $query = "SELECT id_kader, nama_kader, kata_sandi FROM tbl_kader WHERE nama_kader = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $nama_kader);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $nama_kader_db, $md5_password_db);
        $stmt->fetch();

        // Verifying the entered password with the MD5 hashed password stored in the database
        if (md5($password) == $md5_password_db) {
            // Password verification successful, proceed with login
            session_start();
            $_SESSION['id_kader'] = $id;

            header("Location: dashboard.php");
            exit();
        } else {
            // Password verification failed, display error message
            loginError();
        }
    } else {
        // User not found, display error message
        loginError();
    }
}

// Function to display login error message and redirect
function loginError() {
    echo "<script type='text/javascript'>
    alert('Login gagal. Periksa kembali Nama Kader dan Password Anda.');
    location.replace('login1.php');
    </script>";
}

// Close the database connection
$koneksi->close();
?>

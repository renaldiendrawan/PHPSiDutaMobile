<?php
$connection = null;

try {
    // Config
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test_posyandu";

    // Connect
    $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // include('connection.php');
    // Kode untuk mengambil data dari database
    $kode = isset($_POST['kode_otp']) ? ($_POST['kode_otp']) : '';
    $password = $_POST['kata_sandi']; // 'password' harus sesuai dengan key yang dikirim dari Android
    $kata_sandi = md5($password);
    $email = isset($_POST['email']) ? ($_POST['email']) : '';

    $query = "SELECT * FROM tbl_orangtua WHERE kode_otp = :kode_otp AND email = :email";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':kode_otp', $kode);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $query = "UPDATE `tbl_orangtua` SET `kata_sandi` = :password WHERE email = :email";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':password', $kata_sandi);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $response = array(
            'status' => true,
            'message' => 'Akun Terdaftar'
        );
    } else {
        // Data tidak ditemukan
        $response = array(
            'status' => false,
            'message' => 'Akun Tidak Terdaftar'
        );
    }

    echo json_encode($response);
} catch (PDOException $e) {
    echo "Error ! " . $e->getMessage();
}
?>

<?php
$connection = null;

try {

    include('connection.php');
    require('vendor/autoload.php');
    require('phpmailer.php');

    // Kode untuk mengambil data dari database
    $email = $_POST['email'];
    $kode = mt_rand(000000, 999999);

    $query = "SELECT * FROM tbl_orangtua WHERE email = :email";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $mail = new EmailSender();
    $mail->sendEmail($email, $kode);

    if ($stmt->rowCount() > 0) {

        $query = "UPDATE `tbl_orangtua` SET `kode_otp` = :kode WHERE email = :email";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Data ditemukan
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

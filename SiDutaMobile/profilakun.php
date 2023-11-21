<?php

include "connection.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET request: Menampilkan data profil akun

    $nik_ibu = $_GET['nik_ibu']; // Anda perlu mengirimkan nik_ibu dalam permintaan GET
    $sql = "SELECT imagepath, nama_ibu, nik_ibu, tanggal_lahir, alamat, email image FROM tbl_orangtua WHERE nik_ibu = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$nik_ibu]);

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(connection::FETCH_ASSOC);
        $response = array("status" => "success", "data" => $result);
    } else {
        $response = array("status" => "error", "message" => "Data Profil Akun Tidak Ditemukan");
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST request: Mengedit data profil akun
    $contentType = $_SERVER["CONTENT_TYPE"];
    if ($contentType === "application/json") {
        $rawData = file_get_contents("php://input");
        $requestData = json_decode($rawData, true);
        if ($requestData === null && json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
            exit();
        }
        $_POST = $requestData;
    }
    $id_ibu = $_POST['id_ibu'];
    $nama_ibu = $_POST['nama_ibu'];
    $nik_ibu = $_POST['nik_ibu'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat  = $_POST['alamat'];
    $email = $_POST['email'];

    // Perbarui profil akun
    $sql = "UPDATE tbl_orangtua
    SET nama_ibu = '$nama_ibu', nik_ibu = '$nik_ibu', tanggal_lahir = '$tanggal_lahir', 
    alamat = '$alamat', email = '$email' WHERE id_ibu = '$id_ibu'";
    
    $stmt = $connection->prepare($sql);
    $stmt->execute();

    // echo $sql;

    if ($stmt->rowCount() >= 0) {
        $response = array("status" => "success", "message" => "Profil Akun Berhasil Diubah");
    } else {
        $response = array("status" => "error", "message" => "Profil Akun Gagal Diubah");
    }

} else {
    $response = array("status" => "error", "message" => "Bukan metode POST atau GET yang valid");
}

// Tutup koneksi
$connection = null;

// Tampilkan respons
echo json_encode($response);
?>

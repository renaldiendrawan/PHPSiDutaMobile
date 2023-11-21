<?php

include "connection.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET request: Menampilkan data balita

    $nama_anak = $_GET['nama_anak']; // Anda perlu mengirimkan nama_anak dalam permintaan GET
    $sql = "SELECT a.imagepath, a.nama_anak, a.tanggal_lahir_anak, a.jenis_kelamin, a.bb_lahir, a.tb_lahir, i.nama_ayah, i.nama_ibu image 
            FROM tbl_anak a
            INNER JOIN tbl_orangtua i ON a.id_ibu = i.id_ibu
            WHERE a.nama_anak = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$nama_anak]);

    if ($stmt->rowCount() > 0) {
        $results = array(); // Initialize an array to store the results

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row; // Add each row to the results array
        }
        $response = array("status" => "success", "data" => $results);
    } else {
        $response = array("status" => "error", "message" => "Data Balita Tidak Ditemukan");
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST request: Mengedit data balita
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
    
    $id_anak = $_POST['id_anak'];
    $nama_anak = $_POST['nama_anak'];
    $tanggal_lahir_anak = $_POST['tanggal_lahir_anak'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $bb_lahir = $_POST['bb_lahir'];
    $tb_lahir  = $_POST['tb_lahir'];
    $id_ibu = $_POST['id_ibu']; // Assuming you have id_ibu in your POST data

    // Perbarui profil akun
    $sql = "UPDATE tbl_anak a
    INNER JOIN tbl_orangtua i ON a.id_ibu = i.id_ibu
    SET a.nama_anak = '$nama_anak', a.tanggal_lahir_anak = '$tanggal_lahir_anak', a.jenis_kelamin = '$jenis_kelamin', 
    a.bb_lahir = '$bb_lahir', a.tb_lahir = '$tb_lahir', i.id_ibu = '$id_ibu' 
    WHERE a.id_anak = '$id_anak'";
    $stmt = $connection->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 0) {
        $response = array("status" => "success", "message" => "Data Balita Berhasil Diubah");
    } else {
        $response = array("status" => "error", "message" => "Data Balita Gagal Diubah");
    }

} else {
    $response = array("status" => "error", "message" => "Bukan metode POST atau GET yang valid");
}

// Tutup koneksi
$connection = null;

// Tampilkan respons
echo json_encode($response);
?>

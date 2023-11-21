<?php
include "connection.php";

// $nik_ibu = $_GET['nik_ibu'];

class DataBalitaResponse {
    public $success;
    public $message;
    public $data;
    public $imagepath;
}

try {

    $nama_anak = $_GET["nama_anak"];

    // Membuat koneksi PDO ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Membuat kueri SQL
    $userQuery = $pdo->prepare("SELECT imagepath FROM tbl_anak WHERE nama_anak = '$nama_anak'");
    // $userQuery->execute(array($nik_ibu));
    $userQuery->execute();

    // Menjalankan kueri SQL dengan PDO
    $json = $userQuery->fetchAll(PDO::FETCH_ASSOC);

    // Menghasilkan respons JSON
    $response = new DataBalitaResponse();
    $response->success = true;
    $response->message = "Data retrieved successfully";
    $response->imagepath = $json;

    echo json_encode($response);
} catch (PDOException $e) {
    $response = new DataBalitaResponse();
    $response->success = false;
    $response->message = "Error: " . $e->getMessage();

    echo json_encode($response);
}

// Menutup koneksi ke database
$pdo = null;
?>

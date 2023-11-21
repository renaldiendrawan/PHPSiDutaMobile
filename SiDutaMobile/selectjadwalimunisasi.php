<?php
include "connection.php";

class JadwalImunisasiResponse {
    public $success;
    public $message;
    public $data;
}

try {
    // Membuat koneksi PDO ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Membuat kueri SQL
    $query = "SELECT tanggal_posyandu, jam_posyandu, tempat_posyandu, jenis_imunisasi FROM jadwal";

    // Menjalankan kueri SQL dengan PDO
    $stmt = $pdo->query($query);

    $json = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $json[] = $row;
    }

    // Menghasilkan respons JSON
    $response = new JadwalImunisasiResponse();
    $response->success = true;
    $response->message = "Data retrieved successfully";
    $response->data = $json;

    echo json_encode($response);
} catch (PDOException $e) {
    $response = new JadwalImunisasiResponse();
    $response->success = false;
    $response->message = "Error: " . $e->getMessage();
    $response->data = null;

    echo json_encode($response);
}

// Menutup koneksi ke database
$pdo = null;
?>

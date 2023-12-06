<?php
include "connection.php";

class JadwalPenimbanganResponse
{
    public $success;
    public $message;
    public $data;
}

try {
    // Membuat koneksi PDO ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mendapatkan tanggal hari ini
    $today = date("Y-m-d");

    // Mendapatkan nik_ibu dari $_POST
    $nik_ibu = isset($_POST['nik_ibu']) ? $_POST['nik_ibu'] : '';

    // Membuat kueri SQL dengan kondisi WHERE untuk nik_ibu
    $query = "SELECT jadwal.tanggal_posyandu, MAX(jadwal.jam_posyandu) AS jam_posyandu, jadwal.tempat_posyandu 
              FROM jadwal
              INNER JOIN tbl_anak ON jadwal.id_anak = tbl_anak.id_anak
              WHERE jadwal.tanggal_posyandu >= :today AND tbl_anak.nik_ibu = :nik_ibu 
              GROUP BY jadwal.tanggal_posyandu";

    // Menyiapkan dan mengeksekusi kueri SQL dengan PDO
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":today", $today);
    $stmt->bindParam(":nik_ibu", $nik_ibu);
    $stmt->execute();

    $json = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $json[] = $row;
    }

    // Menghasilkan respons JSON
    $response = new JadwalPenimbanganResponse();
    $response->success = true;
    $response->message = "Data retrieved successfully";
    $response->data = $json;

    echo json_encode($response);

} catch (PDOException $e) {
    $response = new JadwalPenimbanganResponse();
    $response->success = false;
    $response->message = "Error: " . $e->getMessage();
    $response->data = null;

    echo json_encode($response);
}

// Menutup koneksi ke database
$pdo = null;
?>
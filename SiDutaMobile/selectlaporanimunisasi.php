<?php
include "connection.php";

// $nik_ibu = $_GET['nik_ibu'];

class LaporanImunisasiResponse {
    public $success;
    public $message;
    public $data;
}

try {

    $idAnak = $_GET["id_ibu"];

    // Membuat koneksi PDO ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Membuat kueri SQL
    $userQuery = $pdo->prepare("SELECT tbl_anak.nama_anak, imunisasi.tanggal_imunisasi, imunisasi.jenis_imunisasi
    FROM `imunisasi` 
    JOIN tbl_anak 
    ON imunisasi.id_anak = tbl_anak.id_anak 
    WHERE tbl_anak.id_ibu = $idAnak
    GROUP BY tbl_anak.id_anak
    ORDER BY tbl_anak.id_anak ASC");
    // $userQuery->execute(array($nik_ibu));
    $userQuery->execute();

    // Menjalankan kueri SQL dengan PDO
    $json = $userQuery->fetchAll(PDO::FETCH_ASSOC);

    // Menghasilkan respons JSON
    $response = new LaporanImunisasiResponse();
    $response->success = true;
    $response->message = "Data retrieved successfully";
    $response->data = $json;

    echo json_encode($response);
} catch (PDOException $e) {
    $response = new LaporanImunisasiResponse();
    $response->success = false;
    $response->message = "Error: " . $e->getMessage();
    $response->data = null;

    echo json_encode($response);
}

// Menutup koneksi ke database
$pdo = null;
?>

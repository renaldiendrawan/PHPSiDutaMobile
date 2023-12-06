<?php
include "connection.php";

class LaporanImunisasiResponse
{
    public $success;
    public $message;
    public $data;
}

try {

    $idAnak = $_POST["nik_ibu"];

    // Membuat koneksi PDO ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Membuat kueri SQL dengan menambahkan ORDER BY
    $userQuery = $pdo->prepare("SELECT tbl_anak.nama_anak, imunisasi.tanggal_imunisasi, imunisasi.jenis_imunisasi, imunisasi.id_imunisasi
    FROM `imunisasi` 
    JOIN tbl_anak 
    ON imunisasi.id_anak = tbl_anak.id_anak 
    WHERE tbl_anak.nik_ibu = $idAnak
    GROUP BY imunisasi.id_imunisasi
    ORDER BY imunisasi.tanggal_imunisasi DESC");  // Mengubah urutan tanggal menjadi terurut dari yang terbaru ke yang terlama
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

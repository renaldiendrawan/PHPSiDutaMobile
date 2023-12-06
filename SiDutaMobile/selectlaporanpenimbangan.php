<?php
include "connection.php";

class JadwalPenimbanganResponse
{
    public $success;
    public $message;
    public $data;
}

try {
    $idIbu = $_POST["nik_ibu"];

    // Membuat koneksi PDO ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Membuat kueri SQL dengan menambahkan ORDER BY
    $userQuery = $pdo->prepare("SELECT tbl_anak.nama_anak, penimbangan.tgl_penimbangan, penimbangan.berat_badan, penimbangan.tinggi_badan, penimbangan.id_penimbangan
        FROM `penimbangan` 
        JOIN tbl_anak 
        ON penimbangan.id_anak = tbl_anak.id_anak 
        WHERE tbl_anak.nik_ibu = :nik_ibu
        GROUP BY penimbangan.id_penimbangan
        ORDER BY penimbangan.tgl_penimbangan DESC");  // Mengubah urutan tanggal menjadi terurut dari yang terbaru ke yang terlama
    $userQuery->bindParam(':nik_ibu', $idIbu, PDO::PARAM_INT);
    $userQuery->execute();

    $json = array();

    while ($row = $userQuery->fetch(PDO::FETCH_ASSOC)) {
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

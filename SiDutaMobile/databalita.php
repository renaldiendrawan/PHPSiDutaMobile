<?php

include "connection.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET request: Menampilkan data balita

    $nama_anak = $_GET['nama_anak'];

    $sql = "SELECT a.imagepath, a.nama_anak, a.tanggal_lahir_anak, a.jenis_kelamin, a.bb_lahir, a.tb_lahir, i.nama_ayah, i.nama_ibu image 
            FROM tbl_anak a
            INNER JOIN tbl_orangtua i ON a.nik_ibu = i.nik_ibu
            WHERE a.nama_anak = :nama_anak";

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':nama_anak', $nama_anak);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        $response = array("status" => "success", "data" => $results);

    } else {
        $response = array("status" => "error", "message" => "Data Balita Tidak Ditemukan");
    }

} else {
    $response = array("status" => "error", "message" => "Bukan metode POST atau GET yang valid");
}

// Tutup koneksi
$connection = null;

// Tampilkan respons
echo json_encode($response);

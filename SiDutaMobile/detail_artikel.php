<?php

include "connection.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // GET request: Menampilkan data balita
    $judul_artikel = $_GET['judul_artikel']; // Anda perlu mengirimkan judul_artikel dalam permintaan GET

    $sql = "SELECT a.*, k.nama_kader, a.img_artikel AS img_path
            FROM tbl_artikel AS a
            JOIN tbl_kader AS k ON k.id_kader = a.id_kader 
            WHERE a.judul_artikel LIKE ?";

    $stmt = $connection->prepare($sql);
    $stmt->execute([$judul_artikel]);

    if ($stmt->rowCount() > 0) {
        $results = array(); // Initialize an array to store the results

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row; // Add each row to the results array
        }
        $response = array("status" => "success", "data" => $results);

    } else {
        $response = array("status" => "error", "message" => "Artikel Tidak Ditemukan");
    }

} else {
    $response = array("status" => "error", "message" => "Bukan metode POST atau GET yang valid");
}

// Tutup koneksi
$connection = null;

// Tampilkan respons
echo json_encode($response);
?>
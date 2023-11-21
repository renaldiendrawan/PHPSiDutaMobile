<?php

include "connection.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET request: Menampilkan data balita

    $idIbu = $_GET['id_ibu']; // Anda perlu mengirimkan nama_anak dalam permintaan GET
    
    $sql = "SELECT * FROM tbl_anak WHERE id_ibu = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$idIbu]);

    if ($stmt->rowCount() > 0) {
        $results = array(); // Initialize an array to store the results

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row; // Add each row to the results array
        }
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $response = array("status" => "success", "data" => $results);
    } else {
        $response = array("status" => "error", "message" => "Data Balita Tidak Ditemukan");
    }

} 
else {
    $response = array("status" => "error", "message" => "Bukan metode POST atau GET yang valid");
}

// Tutup koneksi
$connection = null;

// Tampilkan respons
echo json_encode($response);
?>

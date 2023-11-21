<?php

include "connection.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET request: Menampilkan data balita
    
    $sql = "SELECT * FROM `tbl_artikel` LIMIT 5";
    $stmt = $connection->prepare($sql);

    try {
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = array("status" => "success", "data" => $results);
        } else {
            $response = array("status" => "error", "message" => "Artikel Tidak Ditemukan");
        }
    } catch (PDOException $e) {
        $response = array("status" => "error", "message" => "Error executing query: " . $e->getMessage());
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

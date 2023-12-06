<?php

include "connection.php";

try {
    // Query SQL untuk mendapatkan nama anak tanpa duplikat
    $sql = "SELECT DISTINCT nama_anak FROM tbl_anak";

    // Menyiapkan statement
    $stmt = $connection->prepare($sql);

    // Mengeksekusi statement
    $stmt->execute();

    // Mendapatkan hasil query sebagai array asosiatif
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Memeriksa apakah query menghasilkan data
    if (count($result) > 0) {
        echo json_encode(array("status" => "success", "data" => $result));
    } else {
        echo json_encode(array("status" => "error", "message" => "Tidak ada nama anak dalam database."));
    }

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Menutup koneksi ke database
$conn = null;
?>
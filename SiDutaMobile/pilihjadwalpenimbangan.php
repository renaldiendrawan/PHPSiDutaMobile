<?php

include "connection.php";

try {
    // Query SQL untuk mendapatkan nama anak dari tabel anak tanpa duplikat
    $sql = "SELECT DISTINCT nama_anak, MAX(tanggal_posyandu) as tanggal_posyandu, MAX(jam_posyandu) as jam_posyandu, MAX(tempat_posyandu) as tempat_posyandu
            FROM tbl_anak
            JOIN jadwal ON tbl_anak.id_anak = jadwal.id_anak
            GROUP BY nama_anak";

    // Menyiapkan statement
    $stmt = $connection->prepare($sql);

    // Mengeksekusi statement
    $stmt->execute();

    // Mendapatkan hasil query sebagai array asosiatif
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Memeriksa apakah query menghasilkan data
    if (count($result) > 0) {
        echo json_encode($result);
    } else {
        echo "Tidak ada data anak dalam database.";
    }
    
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Menutup koneksi ke database
$conn = null;
?>

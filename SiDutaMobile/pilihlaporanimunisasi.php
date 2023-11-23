<?php

include "connection.php";

try {
    $nama = $_POST['nama'];
    // Query SQL untuk mendapatkan nama anak dari tabel anak
    $sql = "SELECT tanggal_imunisasi, jenis_imunisasi FROM tbl_anak INNER JOIN imunisasi ON tbl_anak.id_anak = imunisasi.id_anak WHERE BINARY nama_anak = '$nama'";

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
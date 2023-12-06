<?php

include "connection.php";

try {
    // Ambil nilai nama_anak dari parameter GET (sesuaikan dengan parameter yang dikirim dari Android)
    $selectedAnak = isset($_GET['selected_anak']) ? $_GET['selected_anak'] : null;

    // Query SQL untuk mendapatkan data penimbangan berdasarkan nama_anak tanpa duplikat
    $sql = "SELECT DISTINCT nama_anak, tgl_penimbangan, berat_badan, tinggi_badan
            FROM tbl_anak
            JOIN penimbangan ON tbl_anak.id_anak = penimbangan.id_anak";

    // Jika ada nama_anak yang dipilih, tambahkan kondisi WHERE
    if ($selectedAnak !== null) {
        $sql .= " WHERE nama_anak = :selected_anak";
    }

    // Group by id_anak agar hanya mengambil satu data terbaru untuk setiap anak
    $sql .= " GROUP BY tbl_anak.id_anak, nama_anak, tgl_penimbangan, berat_badan, tinggi_badan";

    // Menyiapkan statement
    $stmt = $connection->prepare($sql);

    // Bind parameter jika nama_anak dipilih
    if ($selectedAnak !== null) {
        $stmt->bindParam(':selected_anak', $selectedAnak, PDO::PARAM_STR);
    }

    // Mengeksekusi statement
    $stmt->execute();

    // Mendapatkan hasil query sebagai array asosiatif
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Memeriksa apakah query menghasilkan data
    if (count($result) > 0) {
        echo json_encode($result);
    } else {
        echo "Tidak ada data penimbangan untuk anak dengan nama " . $selectedAnak;
    }

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Menutup koneksi ke database
$conn = null;
?>
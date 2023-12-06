<?php
// Koneksi ke database (sesuaikan dengan koneksi Anda)
include('koneksi.php');

// Query SQL untuk mengambil data jenis kelamin
$query = "SELECT jenis_kelamin, COUNT(*) as total FROM tbl_anak GROUP BY jenis_kelamin";
$result = $koneksi->query($query);

// Inisialisasi array untuk data grafik
$jenis_kelamin = [];
$total = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jenis_kelamin[] = $row["jenis_kelamin"];
        $total[] = $row["total"];
    }
}

// Tutup koneksi database
$koneksi->close();

// Persiapkan data untuk grafik
$grafikData = [];
for ($i = 0; $i < count($jenis_kelamin); $i++) {
    $grafikData[] = [
        "jenis_kelamin" => $jenis_kelamin[$i],
        "total" => $total[$i]
    ];
}

// Keluarkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($grafikData);
?>

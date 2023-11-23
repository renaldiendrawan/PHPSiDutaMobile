<?php
include "connection.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anak = $_POST['id_anak'];
    $nama_anak = $_POST['nama_anak'];
    $tanggal_lahir_anak = $_POST['tanggal_lahir_anak'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $bb_lahir = $_POST['bb_lahir'];
    $tb_lahir = $_POST['tb_lahir'];
    $nik_ibu = $_POST['nik_ibu'];
    $nama_ayah = $_POST['nama_ayah'];

    // Perbarui profil anak
    $sqlAnak = "UPDATE tbl_anak a
    INNER JOIN tbl_orangtua i ON a.nik_ibu = i.nik_ibu
    SET a.nama_anak = :nama_anak, a.tanggal_lahir_anak = :tanggal_lahir_anak, a.jenis_kelamin = :jenis_kelamin, 
    a.bb_lahir = :bb_lahir, a.tb_lahir = :tb_lahir, i.nik_ibu = :nik_ibu 
    WHERE a.id_anak = :id_anak";

    $stmtAnak = $connection->prepare($sqlAnak);
    $stmtAnak->bindParam(':nama_anak', $nama_anak);
    $stmtAnak->bindParam(':tanggal_lahir_anak', $tanggal_lahir_anak);
    $stmtAnak->bindParam(':jenis_kelamin', $jenis_kelamin);
    $stmtAnak->bindParam(':bb_lahir', $bb_lahir);
    $stmtAnak->bindParam(':tb_lahir', $tb_lahir);
    $stmtAnak->bindParam(':nik_ibu', $nik_ibu);
    $stmtAnak->bindParam(':id_anak', $id_anak);
    $stmtAnak->execute();

    // Perbarui profil orang tua (nama_ayah)
    $sqlOrangTua = "UPDATE tbl_orangtua SET nama_ayah = :nama_ayah WHERE nik_ibu = :nik_ibu";

    $stmtOrangTua = $connection->prepare($sqlOrangTua);
    $stmtOrangTua->bindParam(':nama_ayah', $nama_ayah);
    $stmtOrangTua->bindParam(':nik_ibu', $nik_ibu);
    $stmtOrangTua->execute();

    if ($stmtAnak->rowCount() >= 0 && $stmtOrangTua->rowCount() >= 0) {
        $response = array("status" => "success", "message" => "Data Balita dan Orang Tua Berhasil Diubah");
    } else {
        $response = array("status" => "error", "message" => "Data Balita atau Orang Tua Gagal Diubah");
    }
} else {
    $response = array("status" => "error", "message" => "Bukan metode POST atau GET yang valid");
}

// Tutup koneksi
$connection = null;

// Tampilkan respons
echo json_encode($response);

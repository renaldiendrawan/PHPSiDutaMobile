<?php

include "connection.php";
header('Content-Type: application/json; charset=utf-8');

// Fungsi untuk menghapus akun dari database atau menyimpan status penghapusan (sesuai kebutuhan)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik_ibu = $_POST['nik_ibu'];

    // Implementasikan logika penghapusan akun di sini
    try {
        $query = "DELETE FROM tbl_orangtua WHERE nik_ibu = :nik_ibu";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':nik_ibu', $nik_ibu);
        $response = [];

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $response['status'] = "success";
            $response['message'] = "Akun Terhapus";
        } else {
            $response['status'] = false;
            $response['message'] = "Gagal Menghapus atau Data Tidak Ditemukan";
        }

    } catch (PDOException $e) {
        die($e->getMessage());
    }

    // Encode array menjadi JSON
    echo json_encode($response, JSON_PRETTY_PRINT);
}


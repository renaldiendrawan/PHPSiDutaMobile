<?php

include "connection.php";

// Fungsi untuk menghapus akun dari database atau menyimpan status penghapusan (sesuai kebutuhan)
function deleteAccount($userId, $pdo)
{
    // Implementasikan logika penghapusan akun di sini

    try {
        // Contoh: Query untuk menghapus akun dari tabel pengguna berdasarkan ID pengguna
        $query = "DELETE FROM tbl_orangtua WHERE id = :userId";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; // Penghapusan akun berhasil
        } else {
            return false; // Gagal menghapus akun
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

// Menangani permintaan HTTP DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Ambil ID pengguna dari parameter URL atau sesuai kebutuhan
    $userId = $_GET['user_id']; // Ganti dengan cara Anda mengambil ID pengguna

    // Periksa apakah ID pengguna valid (sesuai dengan kebutuhan)
    if (!empty($userId)) {
        // Gantilah informasi koneksi sesuai dengan koneksi yang Anda miliki
        $dsn = 'mysql:host=your_host;dbname=your_database';
        $username = 'your_username';
        $password = 'your_password';

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Panggil fungsi untuk menghapus akun
            $result = deleteAccount($userId, $pdo);

            // Berikan respons JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
        } catch (PDOException $e) {
            // Tangani kesalahan koneksi
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $e->getMessage()]);
        }
    } else {
        // ID pengguna tidak valid, berikan respons JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid user ID']);
    }
} else {
    // Metode HTTP tidak didukung, berikan respons JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Method not supported']);
}

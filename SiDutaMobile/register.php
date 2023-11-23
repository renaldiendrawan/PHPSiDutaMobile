<?php

include 'connection.php';

if ($_POST) {

    // POST DATA
    $nik_ibu = isset($_POST['nik_ibu']) ? ($_POST['nik_ibu']) : '';
    $nama_ibu = isset($_POST['nama_ibu']) ? ($_POST['nama_ibu']) : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? ($_POST['tanggal_lahir']) : '';
    $alamat = isset($_POST['alamat']) ? ($_POST['alamat']) : '';
    $email = isset($_POST['email']) ? ($_POST['email']) : '';
    $kata_sandi = isset($_POST['kata_sandi']) ? md5($_POST['kata_sandi']) : '';

    $response = [];

    // Cek nik di dalam database
    $userQuery = $connection->prepare("SELECT * FROM tbl_orangtua where nik_ibu = ?");
    $userQuery->execute(array($nik_ibu));

    // Cek nik apakah ada atau tidak
    if ($userQuery->rowCount() != 0) {
        // Beri Response
        $response['status'] = false;
        $response['message'] = "Akun Sudah Digunakan";
    } else {
        $insertAccount = 'INSERT INTO tbl_orangtua ( nik_ibu, kata_sandi, nama_ibu, tanggal_lahir, alamat, email) values (:nik_ibu, :kata_sandi, :nama_ibu, :tanggal_lahir, :alamat, :email)';
        $statement = $connection->prepare($insertAccount);

        try {
            // Eksekusi statement DB
            $statement->execute([
                ':nik_ibu' => $nik_ibu,
                ':kata_sandi' => $kata_sandi,
                ':nama_ibu' => $nama_ibu,
                ':tanggal_lahir' => $tanggal_lahir,
                ':alamat' => $alamat,
                ':email' => $email
            ]);

            // Beri response
            $response['status'] = true;
            $response['message'] = "Akun Berhasil Didaftar";
            $response['data'] = [
                'nama_ibu' => $nama_ibu
            ];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Jadikan data JSON
    echo json_encode($response, JSON_PRETTY_PRINT);

    // Print

}

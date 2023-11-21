<?php

include 'connection.php';

// if ($_POST) {
    // Data
    $nik_ibu = isset($_POST['nik_ibu']) ? ($_POST['nik_ibu']) : '';
    $kata_sandi = isset($_POST['kata_sandi']) ? md5($_POST['kata_sandi']) : '';

    $response = []; // Data Response

    // Cek nik di dalam database
    $userQuery = $connection->prepare("SELECT * FROM tbl_orangtua where nik_ibu = ?");
    $userQuery->execute(array($nik_ibu));
    $query = $userQuery->fetch();

    if ($userQuery->rowCount() == 0) {
        $response['status'] = false;
        $response['message'] = "NIK Tidak Terdaftar";
    } else {
        // Ambil kata sandi di db
        $kata_sandiDB = $query['kata_sandi'];

        if ($kata_sandi == $kata_sandiDB) {
            $response['status'] = true;
            $response['message'] = "Berhasil Masuk";
            $response['data'] = [
                'id_ibu' => $query['id_ibu'],
                'nama_ibu' => $query['nama_ibu'],
                'nik_ibu' => $query['nik_ibu'],
                'tanggal_lahir' => $query['tanggal_lahir'],
                'alamat' => $query['alamat'],
                'email' => $query['email']
            ];

        } else {
            $response['status'] = false;
            $response['message'] = "Kata Sandi Anda Salah";
        }
    }

    // Jadikan data JSON
    echo json_encode($response);
   
// }

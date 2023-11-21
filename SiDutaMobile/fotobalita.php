<?php

/**
 * Digunakan untuk mengupdate photo profile user.
 */

require "connection.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // post request
    $nama_anak = $_POST['nama_anak'];
    $photo = $_POST['imagepath'];

    // cek email exist atau tidak
    $sql = "SELECT nama_anak FROM tbl_anak WHERE nama_anak = '$nama_anak' LIMIT 1";
    $stmt = $connection->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 0) {
        // saving photo
        $photo = str_replace('data:image/png;base64,', '', $photo);
        $photo = str_replace(' ', '+', $photo);
        $data = base64_decode($photo);
        $filename = uniqid() . '.png';
        $file = 'uploadfotobalita/' . $filename;
        file_put_contents($file, $data);

        // get data user
        $sql = "UPDATE tbl_anak SET imagepath = '$filename' WHERE nama_anak = '$nama_anak'";
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        // jika foto profile berhasil diupdate
        if ($stmt->rowCount() >= 0) {
            $sql = "SELECT imagepath FROM tbl_anak WHERE nama_anak = '$nama_anak' LIMIT 1";
            $stmt = $connection->prepare($sql);
            $stmt->execute();

            $data = array(
                "imagepath" => $filename
            );

            if ($stmt->rowCount() >= 0) {
                $response = array("status" => "success", "message" => "photo profile berhasil diupdate", "imagepath" => $filename);
            } else {
                $response = array("status" => "success", "message" => "photo profile berhasil diupdate");
            }
        } else {
            $response = array("status" => "error", "message" => "photo profile gagal diupdate");
        }
    }else{
        $response = array("status"=> "error", "message"=> "Email tidak ditemukan");
    }

} else {
    $response = array("status" => "error", "message" => "method is not post");
}

// show response
echo json_encode($response);
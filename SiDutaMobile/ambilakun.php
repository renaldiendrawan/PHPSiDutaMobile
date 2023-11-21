<?php

include "connection.php";

header("Content-Type: application/json");

if (isset($_POST['nik_ibu'])) {
    $nik_ibu = $_POST['nik_ibu'];
    $sql = "SELECT nama_ibu, nik_ibu, tanggal_lahir, alamat, email FROM tbl_orangtua WHERE nik_ibu = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$nik_ibu]);

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode(["status" => true, "data" => $result]);
    } else {
        echo json_encode(["status" => false, "message" => "Data Profil Akun Tidak Ditemukan"]);
    }
} else {
    echo json_encode(["status" => false, "message" => "Parameter 'nik_ibu' is missing in the request."]);
}

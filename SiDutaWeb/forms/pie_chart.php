<?php
include("koneksi.php");
$sql = "SELECT jenis_kelamin, COUNT(*) as total FROM tbl_anak GROUP BY jenis_kelamin";
$result = $koneksi->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[]=$row;
}
$koneksi->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirimkan melalui form
    $id_anak = $_POST["id_anak"];
    $umur_anak = $_POST["umur_anak"];
    $jenis_imunisasi = $_POST["jenis_imunisasi"];
    $tanggal_imun_timbang = $_POST["tanggal_imun_timbang"];
    $tempat = $_POST["tempat"];
    $jam_posyandu = $_POST["jam_posyandu"]; // Menambahkan input jam_posyandu

    // Menyisipkan data ke dalam tabel jadwal
    $sql = "INSERT INTO jadwal (id_anak, umur_anak, jenis_imunisasi, tanggal_posyandu, tempat_posyandu, jam_posyandu) 
            VALUES ('$id_anak', '$umur_anak', '$jenis_imunisasi', '$tanggal_imun_timbang', '$tempat', '$jam_posyandu')";

    if ($koneksi->query($sql) === true) {
        echo "<script type='text/javascript'>
    alert('Jadwal Posyandu Berhasil Ditambah!');
    location.replace('jadwal.php');
    </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    $koneksi->close();
}
?>

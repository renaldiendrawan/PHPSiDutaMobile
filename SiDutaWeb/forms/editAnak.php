<?php
include("koneksi.php");

if(isset($_POST['update'])){
    $nikBalita = $_POST['nik'];
    $namaBalita = $_POST['nama'];
    $jenisKelamin = $_POST['jenis-kelamin'];
    $tanggalLahir = $_POST['tanggal-lahir'];
    $beratBadan = $_POST['bb-lahir'];
    $tinggiBadan = $_POST['tb-lahir'];
    $alamat = $_POST['alamat'];
    $namaIbu = $_POST['nama-ibu'];

    // Fetch the id_ibu based on the selected "Nama Ibu"
    $query = "SELECT id_ibu FROM tbl_ibu WHERE nama_ibu = '$namaIbu'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idIbu = $row['id_ibu'];

        // Update child data in the database, including the id_ibu
        $sql = "UPDATE tbl_anak SET 
                jenis_kelamin = '$jenisKelamin',
                tgl_lahir = '$tanggalLahir',
                bb_lahir = '$beratBadan',
                tb_lahir = '$tinggiBadan',
                alamat = '$alamat',
                id_ibu = '$idIbu'
                WHERE id_anak = '$nikBalita'";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
        alert('Data Berhasil Diedit!');
        location.replace('anak.php');
        </script>";
        } else {
            echo "Error updating data: " . $koneksi->error;
        }
    } else {
        echo "Nama Ibu tidak ditemukan dalam database.";
    }

    $koneksi->close();
}

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
    $namaOrangtua = $_POST['nama-orangtua'];

    // Pisahkan nama ibu dan nama ayah
    list($namaIbu, $namaAyah) = explode(' - ', $namaOrangtua);

    // Fetch the id_ibu based on the selected "Nama Ibu" and "Nama Ayah"
    $query = "SELECT nik_ibu FROM tbl_orangtua WHERE nama_ibu = '$namaIbu' AND nama_ayah = '$namaAyah'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idIbu = $row['nik_ibu'];

        // Update child data in the database, including the id_ibu
        $sql = "UPDATE tbl_anak SET 
                nama_anak = '$namaBalita',
                jenis_kelamin = '$jenisKelamin',
                tanggal_lahir_anak = '$tanggalLahir',
                bb_lahir = '$beratBadan',
                tb_lahir = '$tinggiBadan',
                alamat = '$alamat',
                nik_ibu = '$idIbu'
                WHERE id_anak = '$nikBalita'";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
        alert('Data Berhasil Diedit!');
        location.replace('anak.php');
        </script>";
        } else {
            echo "<script type='text/javascript'>
        alert('". $sql . "<br>" . $koneksi->error."'); </script>";
        }
    } else {
        echo "<script type='text/javascript'>
        alert('Nama ibu dan/atau nama ayah tidak ditemukan dalam database.');
        location.replace('anak.php');
        </script>";
    }

    $koneksi->close();
}
?>

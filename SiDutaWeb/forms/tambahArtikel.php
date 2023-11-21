<?php
// Sisipkan file koneksi.php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Periksa apakah kunci-kunci yang dibutuhkan telah diatur
    if (isset($_POST['judul_artikel']) && isset($_POST['isi_artikel']) && isset($_POST['id_kader']) && isset($_POST['tgl_dibuat']) && isset($_FILES['img_artikel'])) {
        $judul = $_POST['judul_artikel'];
        $isi = $_POST['isi_artikel'];
        $id_kader = $_POST['id_kader'];
        $tanggal_dibuat = $_POST['tgl_dibuat'];
        $gambar = $_FILES['img_artikel']['name'];

        // Periksa apakah ada kesalahan dalam pengiriman gambar
        if ($_FILES['img_artikel']['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'berkas/';  // Ganti dengan direktori penyimpanan gambar Anda
            $targetFile = $targetDir . $gambar;
            move_uploaded_file($_FILES['img_artikel']['tmp_name'], $targetFile);

            // Siapkan pernyataan SQL untuk memasukkan data ke dalam tabel
            $sql = "INSERT INTO tbl_artikel (judul_artikel, isi_artikel, id_kader, tgl_dibuat, img_artikel) 
                    VALUES ('$judul', '$isi', '$id_kader', '$tanggal_dibuat', '$gambar')";

            // Eksekusi pernyataan SQL
            if ($koneksi->query($sql) === TRUE) {
                echo "<script type='text/javascript'>
                    alert('Data Berhasil Ditambah!');
                    location.replace('artikel.php');
                </script>";
            } else {
                echo "Terjadi kesalahan: " . $koneksi->error;
            }
        } else {
            echo "<script type='text/javascript'>
                    alert('Maaf, terdapat kesalahan saat mengunggah gambar.');
                    location.replace('artikel.php');
                </script>";
        }
    } else {
        echo "<script type='text/javascript'>
        alert('Maaf, terdapat kesalahan saat mengunggah gambar.');
        location.replace('artikel.php');
            </script>";
    }
}

// Tutup koneksi basis data
$koneksi->close();

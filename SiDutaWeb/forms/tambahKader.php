<?php
// Sisipkan file koneksi.php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Periksa apakah kunci-kunci yang dibutuhkan telah diatur
    if (isset($_POST['id_kader']) && isset($_POST['nama_kader']) && isset($_POST['tgl_lahir']) && isset($_POST['alamat']) && isset($_POST['jabatan']) && isset($_POST['tugas_pokok']) && isset($_FILES['img_kader'])) {
        $id_kader = $_POST['id_kader'];
        $nama_kader = $_POST['nama_kader'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $jabatan = $_POST['jabatan'];
        $tugas_pokok = $_POST['tugas_pokok'];
        $gambar = $_FILES['img_kader']['name'];

        // Periksa apakah ada kesalahan dalam pengiriman gambar
        if ($_FILES['img_kader']['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'berkas/team/';  // Ganti dengan direktori penyimpanan gambar Anda
            $targetFile = $targetDir . $gambar;
            move_uploaded_file($_FILES['img_kader']['tmp_name'], $targetFile);

            // Siapkan pernyataan SQL untuk memasukkan data ke dalam tabel
            $sql = "INSERT INTO tbl_kader (id_kader, nama_kader, tgl_lahir, alamat, jabatan, tugas_pokok, img_kader) 
                    VALUES ('$id_kader', '$nama_kader', '$tgl_lahir', '$alamat', '$jabatan', '$tugas_pokok', '$gambar')";

            // Eksekusi pernyataan SQL
            if ($koneksi->query($sql) === TRUE) {
                echo "<script type='text/javascript'>
                    alert('Data Kader Berhasil Ditambah!');
                    location.replace('kader.php');
                </script>";
            } else {
                echo "Terjadi kesalahan: " . $koneksi->error;
            }
        } else {
            echo "Maaf, terdapat kesalahan saat mengunggah gambar.";
        }
    } else {
        echo "Data kader tidak lengkap. Pastikan Anda mengisi semua field.";
    }
}

// Tutup koneksi basis data
$koneksi->close();
?>

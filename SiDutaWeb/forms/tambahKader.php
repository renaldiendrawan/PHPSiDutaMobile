<?php
// Sisipkan file koneksi.php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Periksa apakah kunci-kunci yang dibutuhkan telah diatur
    if (isset($_POST['nama_kader']) && isset($_POST['tgl_lahir']) && isset($_POST['alamat']) && isset($_POST['jabatan']) && isset($_POST['tugas_pokok']) && isset($_POST['no_telp']) && isset($_POST['kata_sandi']) && isset($_FILES['img_kader'])) {
        $nama_kader = $_POST['nama_kader'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $jabatan = $_POST['jabatan'];
        $tugas_pokok = $_POST['tugas_pokok'];
        $no_telp = $_POST['no_telp'];
        $password = md5($_POST['kata_sandi']);
        $gambar = $_FILES['img_kader']['name'];

        // Periksa apakah ada kesalahan dalam pengiriman gambar
        if ($_FILES['img_kader']['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'berkas/team/';  // Ganti dengan direktori penyimpanan gambar Anda
            $targetFile = $targetDir . $gambar;
            move_uploaded_file($_FILES['img_kader']['tmp_name'], $targetFile);

            // Siapkan pernyataan SQL untuk memasukkan data ke dalam tabel
            $sql = "INSERT INTO tbl_kader (nama_kader, tgl_lahir, alamat, jabatan, tugas_pokok, no_telp, kata_sandi, img_kader) 
        VALUES ('$nama_kader', '$tgl_lahir', '$alamat', '$jabatan', '$tugas_pokok', '$no_telp', '$password', '$gambar')";

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

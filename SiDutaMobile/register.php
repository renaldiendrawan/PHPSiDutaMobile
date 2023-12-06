<?php
include 'connection.php';

if ($_POST) {
    // POST DATA
    $nik_ibu = isset($_POST['nik_ibu']) ? ($_POST['nik_ibu']) : '';
    $nama_ibu = isset($_POST['nama_ibu']) ? ($_POST['nama_ibu']) : '';
    $nama_ayah = isset($_POST['nama_ayah']) ? ($_POST['nama_ayah']) : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? ($_POST['tanggal_lahir']) : '';
    $alamat = isset($_POST['alamat']) ? ($_POST['alamat']) : '';
    $email = isset($_POST['email']) ? ($_POST['email']) : '';
    $kata_sandi = isset($_POST['kata_sandi']) ? $_POST['kata_sandi'] : '';

    $response = [];

    // Cek panjang NIK
    if (strlen($alamat) > 100) {
        // Beri Response jika alamat melebihi 100 karakter
        $response['status'] = false;
        $response['message'] = "Alamat tidak boleh lebih dari 100 karakter";
    } else {
        // Cek nik di dalam database
        $userQuery = $connection->prepare("SELECT * FROM tbl_orangtua WHERE nik_ibu = ?");
        $userQuery->execute(array($nik_ibu));

        // Cek nik apakah ada atau tidak
        if ($userQuery->rowCount() != 0) {
            // Beri Response
            $response['status'] = false;
            $response['message'] = "Akun Sudah Digunakan";
        } else {
            // Cek email di dalam database
            $emailQuery = $connection->prepare("SELECT * FROM tbl_orangtua WHERE email = ?");
            $emailQuery->execute(array($email));

            // Cek email apakah sudah terdaftar
            if ($emailQuery->rowCount() != 0) {
                // Beri Response jika email sudah terdaftar
                $response['status'] = false;
                $response['message'] = "Email sudah terdaftar";
            } else {
                // Validasi kata sandi (minimal 8 karakter, hanya huruf dan angka)
                if (!preg_match('/^[A-Za-z\d]{8,}$/', $kata_sandi)) {
                    $response['status'] = false;
                    $response['message'] = "Kata Sandi harus terdiri dari huruf dan angka, minimal 8 karakter";
                } else {
                    // Gunakan password_hash untuk mengenkripsi kata sandi
                    $hashed_password = password_hash($kata_sandi, PASSWORD_DEFAULT);

                    $insertAccount = 'INSERT INTO tbl_orangtua (nik_ibu, kata_sandi, nama_ibu, nama_ayah, tanggal_lahir, alamat, email) VALUES (:nik_ibu, :kata_sandi, :nama_ibu, :nama_ayah, :tanggal_lahir, :alamat, :email)';
                    $statement = $connection->prepare($insertAccount);

                    try {
                        // Eksekusi statement DB
                        $statement->execute([
                            ':nik_ibu' => $nik_ibu,
                            ':nama_ibu' => $nama_ibu,
                            ':nama_ayah' => $nama_ayah,
                            ':tanggal_lahir' => $tanggal_lahir,
                            ':alamat' => $alamat,
                            ':email' => $email,
                            ':kata_sandi' => $hashed_password,
                        ]);

                        // echo $insertAccount;

                        // Beri response
                        $response['status'] = true;
                        $response['message'] = "Berhasil Daftar";
                        $response['data'] = [
                            'nama_ibu' => $nama_ibu
                        ];
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
            }
        }
    }

    // Jadikan data JSON
    echo json_encode($response, JSON_PRETTY_PRINT);
}
?>
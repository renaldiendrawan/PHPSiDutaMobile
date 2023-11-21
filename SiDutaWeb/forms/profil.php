<?php
include("koneksi.php");

// Query SQL untuk mengambil data dari tabel kader
$sql = "SELECT id_kader, nama_kader, tgl_lahir, alamat, jabatan, tugas_pokok, kata_sandi FROM tbl_kader";

$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Mendeklarasikan variabel dengan nilai yang diambil dari database
        $id = $row["id_kader"];
        $nama = $row["nama_kader"];
        $tanggal = $row["tgl_lahir"];
        $alamat = $row["alamat"];
        $jabatan = $row["jabatan"];
        $tugas = $row["tugas_pokok"];
        $passsword = $row["kata_sandi"];
    }
} else {
    echo "Tidak ada data kader yang ditemukan.";
}

// include('koneksi.php');
// include('login.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data yang akan diperbarui dari formulir
    $idKaderToUpdate = $_POST['id_kader'];
    $namaKaderToUpdate = $_POST['nama_kader'];
    $tanggalLahirToUpdate = $_POST['tgl_lahir'];
    $alamatToUpdate = $_POST['alamat'];
    $jabatanToUpdate = $_POST['jabatan'];
    $tugasPokokToUpdate = $_POST['tugas_pokok'];
    $passswordToUpdate = $_POST['password'];

    // Query SQL UPDATE untuk memperbarui data kader
    $sqlUpdate = "UPDATE tbl_kader SET 
                                        nama_kader = '$namaKaderToUpdate',
                                        tgl_lahir = '$tanggalLahirToUpdate',
                                        alamat = '$alamatToUpdate',
                                        jabatan = '$jabatanToUpdate',
                                        tugas_pokok = '$tugasPokokToUpdate',
                                        kata_sandi = '$passswordToUpdate'
                                        WHERE id_kader = $idKaderToUpdate";

    if ($koneksi->query($sqlUpdate) === TRUE) {
        // echo "Data kader berhasil diperbarui.";
        // header('location : profil.php');
        echo '<script>
                                        alert(" Data Berhasil Diperbaharui");
                                        window.location.href = "profil.php";
                                        </script>';
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . $koneksi->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profil - SiDuta</title>
    <link rel="icon" type="image/png" href="siduta.png"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="coba123.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="crud.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="crud.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body style="height: 100%; width: 100%;">
    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar -->
        <?php include 'navbar.php'; ?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Profil Akun</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                    <div class="card mb-4">

                    </div>
                    <div class="card mb-4">
                        <div class="card-header">Profil Akun</div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="id_kader">ID Kader</label>
                                        <input class="form-control" id="id_kader" type="text" placeholder="Nik anda" value="<?php echo $id; ?>" name="id_kader" readonly name="id_kader">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="nama_kader">Nama Kader</label>
                                        <input class="form-control" id="nama_kader" type="text" placeholder="Nama anda" value="<?php echo $nama; ?>" name="nama_kader">
                                    </div>
                                </div>
                                 <!-- Form Row        -->
                                 <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="tgl_lahir">Tanggal Lahir</label>
                                        <input class="form-control" id="tgl_lahir" type="text" placeholder="Tanggal lahir anda" value="<?php echo $tanggal; ?>" name="tgl_lahir">
                                    </div>
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="alamat">Alamat</label>
                                        <input class="form-control" id="alamat" type="text" placeholder="Alamat anda" value="<?php echo $alamat; ?>" name="alamat">
                                    </div>
                                </div>
                                <!-- Form Row        -->
                                <div class="row gx-3 mb-3">

                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="jabatan">Jabatan</label>
                                        <input class="form-control" id="jabatan" type="text" placeholder="Jabatan anda" value="<?php echo $jabatan; ?>" name="jabatan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="password">password</label>
                                        <input class="form-control" id="password" type="text" placeholder="password anda" value="<?php echo $passsword; ?>" name="password">
                                    </div>
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="tugas_pokok">Tugas pokok</label>
                                    <input class="form-control" id="tugas_pokok" type="text" placeholder="Tugas anda" value="<?php echo $tugas; ?>" name="tugas_pokok">
                                </div>

                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                </div>
                                <!-- Simpan button-->
                                <button class="btn btn-primary" type="submit" style="margin-left: 45%; width: 10%; height: 40px; border-radius: 5px; font-size: 15px;">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="tabel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="tabel2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="dashboard.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Store the ID of the child to delete when the "Hapus" button is clicked
            $('.delete').click(function() {
                var idToDelete = $(this).data('id');
                $('#idToDelete').val(idToDelete); // Set the ID in the hidden input field
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>
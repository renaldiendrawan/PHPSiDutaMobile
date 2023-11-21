<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" href="siduta.png" />
    <title>Data Kader - SiDuta</title>
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

<body style="height: max-content;">
    <div class="wrapper d-flex align-items-stretch">
        <!-- navbar -->
        <?php include 'navbar.php'; ?>
        <!-- end navbar  -->
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Kader Posyandu</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Kader Posyandu</li>
                    </ol>
                    <div class="card mb-4">
                    <div class="card-header" style="font-size: 18px;">
                            <i class="fas fa-table me-1" style="margin-top: 8px;"></i>
                            Data Kader
                            <style>
                                .material-icons {
                                    font-size: 18px;
                                    vertical-align: middle;
                                }
                            </style>
                            <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#addEmployeeModal"><i class="material-icons">&#xE147;</i>
                                Tambah Data
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NIK Kader</th>
                                        <th>Nama Kader</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Jabatan</th>
                                        <th>Tugas Pokok</th>
                                        <th>Foto Kader</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NIK Kader</th>
                                        <th>Nama Kader</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Jabatan</th>
                                        <th>Tugas Pokok</th>
                                        <th>Foto Kader</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <!-- Tambahkan baris berikut ke dalam tabel tbody untuk menampilkan data kader -->
                                    <?php
                                    include("koneksi.php");
                                    // Query SQL untuk mengambil data kader
                                    $sql = "SELECT * FROM tbl_kader";

                                    $result = $koneksi->query($sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id_kader = $row['id_kader'];
                                            $nama_kader = $row['nama_kader'];
                                            $tgl_lahir = $row['tgl_lahir'];
                                            $alamat = $row['alamat'];
                                            $jabatan = $row['jabatan'];
                                            $tugas_pokok = $row['tugas_pokok'];
                                            $img_kader = $row['img_kader'];

                                            echo '<tr>';
                                            echo '<td>' . $id_kader . '</td>';
                                            echo '<td>' . $nama_kader . '</td>';
                                            echo '<td>' . $tgl_lahir . '</td>';
                                            echo '<td>' . $alamat . '</td>';
                                            echo '<td>' . $jabatan . '</td>';
                                            echo '<td>' . $tugas_pokok . '</td>';
                                            echo '<td><img src="berkas/team/' . $img_kader . '" alt="Foto Kader" width="50" height="50"></td>';
                                            echo '<td>';
                                            echo '<a href="#editEmployeeModal-' . $id_kader . '" class="edit" data-toggle="modal" data-target="#editEmployeeModal-' . $id_kader . '"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
                                            echo '<a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-id="' . $id_kader . '"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                                            echo '</td>';
                                            echo '</tr>';
                                            // Tambahkan modal edit untuk setiap baris data
                                            echo "<div id='editEmployeeModal-" . $row["id_kader"] . "' class='modal fade'>
                              <div class='modal-dialog'>
                                <div class='modal-content'>
                                  <form id='edit-kader-form-" . $row["id_kader"] . "' action='editKader.php' method='POST'>
                                  <div class='modal-header'>
                                  <h4 class='modal-title'>Edit Data Kader Posyandu</h4>
                                  <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                              </div>
                              <div class='modal-body'>
                                  <div class='form-group'>
                                      <label for='nik-" . $row["id_kader"] . "'>NIK Kader</label>
                                      <input type='text' class='form-control' id='nik-" . $row["id_kader"] . "' name='nik' value='" . $row["id_kader"] . "' required>
                                  </div>
                                  <div class='form-group'>
                                      <label for='nama-" . $row["id_kader"] . "'>Nama Kader</label>
                                      <input type='text' class='form-control' id='nama-" . $row["id_kader"] . "' name='nama' value='" . $row["nama_kader"] . "' required>
                                  </div>
                                  <div class='form-group'>
                                      <label for='tanggal-lahir-" . $row["id_kader"] . "'>Tanggal Lahir</label>
                                      <input type='date' class='form-control' id='tanggal-lahir-" . $row["id_kader"] . "' name='tanggal-lahir' value='" . $row["tgl_lahir"] . "' required>
                                  </div>
                                  <div class='form-group'>
                                      <label for='alamat-" . $row["id_kader"] . "'>Alamat</label>
                                      <input type='text' class='form-control' id='alamat-" . $row["id_kader"] . "' name='alamat' value='" . $row["alamat"] . "' required>
                                  </div>
                                  <div class='form-group'>
                                      <label for='jabatan-" . $row["id_kader"] . "'>Jabatan</label>
                                      <input type='text' class='form-control' id='jabatan-" . $row["id_kader"] . "' name='jabatan' value='" . $row["jabatan"] . "' required>
                                  </div>
                                  <div class='form-group'>
                                      <label for='tugas-pokok-" . $row["id_kader"] . "'>Tugas Pokok</label>
                                      <input type='text' class='form-control' id='tugas-pokok-" . $row["id_kader"] . "' name='tugas-pokok' value='" . $row["tugas_pokok"] . "' required>
                                  </div>
                              </div>
                              <div class='modal-footer'>
                                  <input type='button' class='btn btn-default' data-dismiss='modal' value='Batal'>
                                  <input type='submit' class='btn btn-info' value='Simpan' name='update'>
                              </div>
                              </form>
                              </div>
                              </div>
                              </div>";
                                        }
                                    } else {
                                        echo "Tidak ada data kader Posyandu.";
                                    }
                                    $koneksi->close();
                                    ?>
                                    <!-- Tambahkan data kader lainnya di sini dengan format yang sama -->
                                </tbody>
                            </table>
                            <!-- Tambah Modal HTML -->
                            <div id="addEmployeeModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="tambah-kader-form" method="post" action="tambahKader.php" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Data Kader Posyandu</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nik">NIK Kader</label>
                                                    <input type="text" id="id_kader" name="id_kader" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">Nama Kader</label>
                                                    <input type="text" id="nama_kader" name="nama_kader" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal-lahir">Tanggal Lahir</label>
                                                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" id="alamat" name="alamat" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jabatan">Jabatan</label>
                                                    <input type="text" id="jabatan" name="jabatan" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tugas-pokok">Tugas Pokok</label>
                                                    <input type="text" id="tugas_pokok" name="tugas_pokok" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="img-kader">Foto Kader</label>
                                                    <input type="file" id="img_kader" name="img_kader" class="form-control" accept="image/*" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                                                <input type="submit" class="btn btn-success" value="Tambah" name="submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal HTML -->
                            <div id="deleteEmployeeModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="hapusKader.php" method="POST">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data Kader Posyandu</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                <p class="text-warning"><small>Tindakan ini tidak bisa dibatalkan</small></p>
                                                <input type="hidden" name="idToDelete" id="idToDelete">
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                <input type="submit" class="btn btn-danger" value="Delete" name="delete">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
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
    <script>
        $(document).ready(function() {
            // Store the ID of the child to delete when the "Hapus" button is clicked
            $('.delete').click(function() {
                var idToDelete = $(this).data('id');
                $('#idToDelete').val(idToDelete); // Set the ID in the hidden input field
            });
        });
    </script>
</body>

</html>
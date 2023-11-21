<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" href="siduta.png" />
    <title>Artikel - SiDuta</title>
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

<body style="height: max-content; width: 100%;" >
    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar -->
        <?php include 'navbar.php'; ?>
        <div id="content" class="p-4 p-md-5 pt-5"">
            <main>
                <div class="container-fluid px-4" >
                    <h1 class="mt-4">Artikel</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Artikel</li>
                    </ol>
                    <div class="card mb-4">
                    </div>
                    <div class="card mb-4">
                        <div class="card-header" style="font-size: 18px;">
                            <i class="fas fa-table me-1" style="margin-top: 8px;"></i>
                            Artikel
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
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Nama Kader</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Nama Kader</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    // Sisipkan file koneksi.php
                                    include('koneksi.php');

                                    // Query untuk mengambil data dari tabel tbl_artikel
                                    $query = "SELECT tbl_artikel.*, tbl_kader.nama_kader
                                FROM tbl_artikel
                                INNER JOIN tbl_kader ON tbl_artikel.id_kader = tbl_kader.id_kader";

                                    $result = mysqli_query($koneksi, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id_artikel = $row['id_artikel'];
                                            $judul = $row['judul_artikel'];
                                            $deskripsi = $row['isi_artikel'];
                                            $gambar = $row['img_artikel'];
                                            $tanggal_dibuat = $row['tgl_dibuat'];
                                            $nama_kader = $row['nama_kader'];

                                            echo '<tr>';
                                            echo '<td><img src="berkas/' . $gambar . '" alt="' . $judul . '" style="max-width: 125px; max-height: 125px;"></td>';
                                            echo '<td>' . $judul . '</td>';
                                            echo '<td>' . substr($deskripsi, 0, 100) . '...</td>';
                                            echo '<td>' . $tanggal_dibuat . '</td>';
                                            echo '<td>' . $nama_kader . '</td>';
                                            echo '<td>';
                                            echo '<a href="#viewArticleModal-' . $id_artikel . '" class="edit" data-toggle="modal" data-target="#viewArticleModal-' . $id_artikel . '" data-id="' . $id_artikel . '"><i class="material-icons" data-toggle="tooltip" title="View">&#xE8FF;</i></a>';
                                            echo '<a href="#deleteArticleModal" class="delete" data-toggle="modal" data-id="' . $id_artikel . '"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                                            echo '</td>';
                                            echo '</tr>';
                                            echo "<div id='viewArticleModal-" . $row["id_artikel"] . "' class='modal fade'>
                              <div class='modal-dialog'>
                                  <div class='modal-content'>
                                      <div class='modal-header'>
                                          <h4 class='modal-title'>Detail Artikel</h4>
                                          <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                      </div>
                                      <div class='modal-body'>
                                          <div class='text-center'>
                                              <p><b>" . $row["judul_artikel"] . "</b></p>
                                              <p style='font-size: 80%;' >Dibuat Oleh: " . $nama_kader . " (" . $tanggal_dibuat . ")</p>
                                          </div>
                                          <div class='text-center'>
                                              <img src='berkas/" . $row["img_artikel"] . "' alt='Gambar Artikel' style='max-width: 100%; height: auto;'>
                                          </div>
                                          <div class='text-justify'>
                                              <p>" . nl2br($row["isi_artikel"]) . "</p>
                                          </div>
                                      </div>
                                      <div class='modal-footer'>
                                          <button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>
                                      </div>
                                  </div>
                              </div>
                          </div>";
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">Tidak ada data artikel.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Tambah Modal HTML -->
                            <div id="addEmployeeModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="addArticleForm" action="tambahArtikel.php" method="POST" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Artikel</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="judul_artikel">Judul</label>
                                                    <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" required style="border-color: black;">
                                                </div>
                                                <div class="form-group">
                                                    <label for="isi_artikel">Deskripsi</label>
                                                    <textarea class="form-control" id="isi_artikel" name="isi_artikel" required style="border-color: black;"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_kader">Nama Kader</label>
                                                    <select class="form-control" id="id_kader" name="id_kader" required style="border-color: black;">
                                                        <?php
                                                        // Sisipkan file koneksi.php
                                                        include('koneksi.php');

                                                        // Query untuk mengambil data nama kader dari tabel tbl_kader
                                                        $query = "SELECT id_kader, nama_kader FROM tbl_kader";
                                                        $result = mysqli_query($koneksi, $query);

                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $row["id_kader"] . '">' . $row["nama_kader"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgl_dibuat">Tanggal Dibuat</label>
                                                    <input type="date" class="form-control" id="tgl_dibuat" name="tgl_dibuat" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="img_artikel">Gambar</label>
                                                    <input type="file" class="form-control" id="img_artikel" name="img_artikel" required>
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
                            <div id="deleteArticleModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="hapusArtikel.php" method="POST">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Artikel</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small" style="color: black; font-size: 110%;">Apakah Anda yakin ingin menghapus Artikel ini?</p>
                                                <p class="small" style="color: black; font-size: 110%;"><small>Tindakan ini tidak bisa dibatalkan</small></p>
                                                <input type="hidden" name="idToDelete" id="idToDelete">
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                                                <input type="submit" class="btn btn-danger" value="Delete" name="delete">
                                            </div>
                                        </form>
                                    </div>
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
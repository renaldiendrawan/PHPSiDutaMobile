<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" href="siduta.png" />
    <title>Data Imunisasi - SiDuta</title>
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
                    <h1 class="mt-4">Data Imunisasi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Imunisasi</li>
                    </ol>
                    <div class="card mb-4">

                    </div>
                    <div class="card mb-4">
                        <div class="card-header" style="font-size: 18px;">
                            <i class="fas fa-table me-1" style="margin-top: 8px;"></i>
                            Data Balita
                            <style>
                                .material-icons {
                                    font-size: 18px;
                                    vertical-align: middle;
                                }
                            </style>
                            <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#addImunisasiModal"><i class="material-icons">&#xE147;</i>
                                Tambah Data
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NIK Anak</th>
                                        <th>Nama Anak</th>
                                        <th>Tanggal Imunisasi</th>
                                        <th>Jenis Imunisasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NIK Anak</th>
                                        <th>Nama Anak</th>
                                        <th>Tanggal Imunisasi</th>
                                        <th>Jenis Imunisasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include("koneksi.php");
                                    // Query SQL dengan INNER JOIN untuk mengambil data imunisasi anak
                                    $sql = "SELECT tbl_imunisasi.*, tbl_anak.nama_anak 
            FROM tbl_imunisasi
            INNER JOIN tbl_anak ON tbl_imunisasi.id_anak = tbl_anak.id_anak";

                                    $result = $koneksi->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<th>" . $row["id_anak"] . "</th>";
                                            echo "<th>" . $row["nama_anak"] . "</th>";
                                            echo "<th>" . $row["tgl_imunisasi"] . "</th>";
                                            echo "<th>" . $row["jenis_imunisasi"] . "</th>";
                                            echo "<th>
              <a href='#editImunisasiModal-" . $row["id_imunisasi"] . "' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
              <a href='#deleteImunisasiModal' class='delete' data-toggle='modal' data-id='" . $row["id_imunisasi"] . "'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
            </th>";
                                            echo "</tr>";
                                            echo "<div id='editImunisasiModal-" . $row["id_imunisasi"] . "' class='modal fade'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <form id='edit-imunisasi-form-" . $row["id_imunisasi"] . "' action='editImunisasi.php' method='POST'>
                    <div class='modal-header'>
                      <h4 class='modal-title'>Edit Data Imunisasi</h4>
                      <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    </div>
                    <div class='modal-body'>
                      <div class='form-group'>
                      <input type='hidden' name='id_imunisasi' value='" . $row["id_imunisasi"] . "'>
                        <label for='id_anak-" . $row["id_imunisasi"] . "'>Pilih Anak</label>
                        <select id='id_anak-" . $row["id_imunisasi"] . "' name='id_anak' class='form-control' required>
                            <option value='" . $row['id_anak'] . "'>" . $row['nama_anak'] . "</option>
                        </select>
                      </div>
                      <div class='form-group'>
                        <label for='tgl_imunisasi-" . $row["id_imunisasi"] . "'>Tanggal Imunisasi</label>
                        <input type='date' class='form-control' id='tgl_imunisasi-" . $row["id_imunisasi"] . "' name='tgl_imunisasi' value='" . $row["tgl_imunisasi"] . "' required>
                      </div>
                      <div class='form-group'>
                        <label for='jenis_imunisasi-" . $row["id_imunisasi"] . "'>Jenis Imunisasi</label>
                        <input type='text' class='form-control' id='jenis_imunisasi-" . $row["id_imunisasi"] . "' name='jenis_imunisasi' value='" . $row["jenis_imunisasi"] . "' required>
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
                                        echo "Tidak ada data imunisasi.";
                                    }

                                    // Tutup koneksi
                                    $koneksi->close();
                                    ?>
                                </tbody>
                            </table>
                            <!-- Tambah Modal HTML untuk Imunisasi -->
                            <div class="modal fade" id="addImunisasiModal" tabindex="-1" role="dialog" aria-labelledby="addImunisasiModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form id="tambah-imunisasi-form" method="post" action="tambahImunisasi.php">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Data Imunisasi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="id_anak">Pilih Anak</label>
                                                    <select id="id_anak" name="id_anak" class="form-control" required>
                                                        <?php
                                                        include("koneksi.php");
                                                        $sql = "SELECT id_anak, nama_anak FROM tbl_anak";
                                                        $result = $koneksi->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id_anak'] . "'>" . $row['nama_anak'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgl_imunisasi">Tanggal Imunisasi</label>
                                                    <input type="date" id="tgl_imunisasi" name="tgl_imunisasi" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_imunisasi" style="font-size: 15px;">Jenis Imunisasi</label>
                                                    <select id="jenis_imunisasi" name="jenis_imunisasi" style="font-size: 13px;" class="form-control" required>
                                                        <!-- Options will be dynamically added here using JavaScript -->
                                                    </select>
                                                </div>

                                                <script>
                                                    // Get the select element
                                                    var jenisImunisasiSelect = document.getElementById("jenis_imunisasi");

                                                    // Array of options
                                                    var options = [
                                                        'BCG (0 bulan)',
                                                        'Hepatitis B 1 (0 bulan)',
                                                        'Hepatitis B 2 (1 bulan)',
                                                        'Polio 1 (2 bulan)',
                                                        'DPT-HB-Hib 1 (2 bulan)',
                                                        'PCV 1 (2 bulan)',
                                                        'Rotavirus 1 (2 bulan)',
                                                        'Polio 2 (4 bulan)',
                                                        'DPT-HB-Hib 2 (4 bulan)',
                                                        'PCV 2 (4 bulan)',
                                                        'Rotavirus 2 (4 bulan)',
                                                        'Hepatitis B 3 (6 bulan)',
                                                        'Polio 3 (6 bulan)',
                                                        'DPT-HB-Hib 3 (6 bulan)',
                                                        'PCV 3 (6 bulan)',
                                                        'Campak (9 bulan)',
                                                        'Gondok (9 bulan)',
                                                        'Rubella (9 bulan)'
                                                    ];

                                                    // Populate the select element with options
                                                    for (var i = 0; i < options.length; i++) {
                                                        var option = document.createElement("option");
                                                        option.text = options[i];
                                                        jenisImunisasiSelect.add(option);
                                                    }
                                                </script>

                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal" style="background-color: red; color: white;">
                                                <input type="submit" class="btn btn-success" value="Tambah Data">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal HTML -->
                            <div id="deleteImunisasiModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="hapusImunisasi.php" method="POST">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data Imunisasi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small" style="color: black; font-size: 110%;">Apakah Anda yakin ingin menghapus data ini?</p>
                                                <p class="small" style="color: black; font-size: 130%;"><small>Tindakan ini tidak bisa dibatalkan</small></p>
                                                <input type="hidden" name="idToDelete" id="idToDelete">
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal" style="background-color: blue; color: white;">
                                                <input type="submit" class="btn btn-danger" value="Hapus" name="delete">
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
</body>

</html>
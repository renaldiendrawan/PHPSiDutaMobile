<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Balita</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="crud.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="crud.js"></script>
</head>
<body>
    <link rel="stylesheet" href="crud.css">
    <style>
        /* Styling Sidebar */
        
        .sidebar {
            height: 100%;
            width: 310px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #408CFF;
            padding-top: 20px;
        }
        
        .sidebar a {
            padding: 15px 25px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }
        
        .sidebar a:hover {
            background-color: #3876BF;
        }
        
        /* Styling Content */
        .content {
            margin-left: 270px;
            padding: 20px;
        }
    </style>
</head>
<body>
    

<div class="sidebar">
    <a class="dashboard" href="dashboard.html" style="font-size : 15px">
                 
        Dashboard
    </a>
    <a class="balita" href="crudAnak.php" style="font-size : 15px">
        >
        Data Balita
    </a>
    <a class="imunisasi" href="imunisasi.html" style="font-size : 15px">
        
        Data Imunisasi
    </a>
    <a class="penimbangan" href="penimbangan.html" style="font-size : 15px">
        
        Data Penimbangan
    </a>
    <a class="profil" href="profil.html" style="font-size : 15px">
        
        Profil
    </a>
    <a class="artikel" href="artikel.html" style="font-size : 15px">
        
        Artikel
    </a>

</div>

    <div id="content">
    <div class="container">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-6">
              <h2>Data Balita</h2>
            </div>
            <div class="col-sm-6">
              <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Data</span></a>
              <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Menggunakan Nama Balita">
                <span class="input-group-btn">
                  <button class="btn btn-info" id="searchButton"><i class="material-icons">&#xE8B6;</i> <span></span></button>
                </span>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>NIK Anak</th>
              <th>Nama Anak</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>Berat Badan</th>
              <th>Tinggi Badan</th>
              <th>Alamat</th>
              <th>Nama Ibu</th>
              <th>Aksi</th> <!-- Tambahkan kolom Actions di sini -->
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>
              <style>
                  /* CSS untuk tombol Edit dan Hapus berdampingan */
                  th a.edit,
                  th a.delete {
                    display: inline-block;
                    margin-right: 10px;
                    text-decoration: none;
                  }
                </style><style>
                  /* CSS untuk tombol Edit dan Hapus berdampingan */
                  th a.edit,
                  th a.delete {
                    display: inline-block;
                    margin-right: 10px;
                    text-decoration: none;
                  }
                </style>
                <!-- Tambahkan baris berikut ke dalam tabel tbody untuk menampilkan data -->
                <?php
                include("koneksi.php");
                // Query SQL dengan INNER JOIN
                $sql = "SELECT tbl_anak.*, tbl_ibu.nama_ibu 
                FROM tbl_anak
                INNER JOIN tbl_ibu ON tbl_anak.id_ibu = tbl_ibu.id_ibu";

                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    // Tampilkan data anak dan nama ibu di dalam tabel
                    echo "<tr>";
                    echo "<th>" . $row["id_anak"] . "</th>";
                    echo "<th>" . $row["nama_anak"] . "</th>";
                    echo "<th>" . $row["jenis_kelamin"] . "</th>";
                    echo "<th>" . $row["tgl_lahir"] . "</th>";
                    echo "<th>" . $row["bb_lahir"] . "</th>";
                    echo "<th>" . $row["tb_lahir"] . "</th>";
                    echo "<th>" . $row["alamat"] . "</th>";
                    echo "<th>" . $row["nama_ibu"] . "</th>"; // Kolom nama ibu
                    echo "<th>
          <a href='#editEmployeeModal-" . $row["id_anak"] . "' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
          <a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='" . $row["id_anak"] . "'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
        </th>";
                    echo "</tr>";
                    // Tambahkan modal edit untuk setiap baris data
                    echo "<div id='editEmployeeModal-" . $row["id_anak"] . "' class='modal fade'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <form id='edit-anak-form-" . $row["id_anak"] . "' action='editAnak.php' method='POST'>
            <div class='modal-header'>
              <h4 class='modal-title'>Edit Data Balita</h4>
              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </div>
            <div class='modal-body'>
              <div class='form-group'>
                <label for='nik-" . $row["id_anak"] . "'>NIK Balita</label>
                <input type='number' class='form-control' id='nik-" . $row["id_anak"] . "' name='nik' value='" . $row["id_anak"] . "' required>
              </div>
              <div class='form-group'>
                <label for='nama-" . $row["id_anak"] . "'>Nama Balita</label>
                <input type='text' class='form-control' id='nama-" . $row["id_anak"] . "' name='nama' value='" . $row["nama_anak"] . "' required>
              </div>
              <div class='form-group'>
                <label for='jenis-kelamin-" . $row["id_anak"] . "'>Jenis Kelamin</label>
                <select id='jenis-kelamin-" . $row["id_anak"] . "' name='jenis-kelamin' class='form-control' required>
                <option value='Laki-Laki' " . ($row["jenis_kelamin"] == 'Laki-Laki' ? 'selected' : '') . ">Laki-Laki</option>
                <option value='Perempuan' " . ($row["jenis_kelamin"] == 'Perempuan' ? 'selected' : '') . ">Perempuan</option>
                </select>
              </div>
              <div class='form-group'>
                <label for='tanggal-lahir-" . $row["id_anak"] . "'>Tanggal Lahir</label>
                <input type='date' class='form-control' id='tanggal-lahir-" . $row["id_anak"] . "' name='tanggal-lahir' value='" . $row["tgl_lahir"] . "' required>
              </div>
              <div class='form-group'>
                <label for='bb-lahir-" . $row["id_anak"] . "'>Berat Badan</label>
                <input type='number' class='form-control' id='bb-lahir-" . $row["id_anak"] . "' name='bb-lahir' value='" . $row["bb_lahir"] . "' required>
              </div>
              <div class='form-group'>
                <label for='tb-lahir-" . $row["id_anak"] . "'>Tinggi Badan</label>
                <input type='number' class='form-control' id='tb-lahir-" . $row["id_anak"] . "' name='tb-lahir' value='" . $row["tb_lahir"] . "' required>
              </div>
              <div class='form-group'>
                <label for='alamat-" . $row["id_anak"] . "'>Alamat</label>
                <input type='text' class='form-control' id='alamat-" . $row["id_anak"] . "' name='alamat' value='" . $row["alamat"] . "' required>
              </div>
              <div class='form-group'>
                <label for='nama-ibu-" . $row["id_anak"] . "'>Nama Ibu</label>
                <input type='text' class='form-control' id='nama-ibu-" . $row["id_anak"] . "' name='nama-ibu' value='" . $row["nama_ibu"] . "' required>
              </div>
            </div>
            <div class='modal-footer'>
              <input type='button' class='btn btn-default' data-dismiss='modal' value='Cancel'>
              <input type='submit' class='btn btn-info' value='Save' name='update'>
            </div>
          </form>
        </div>
      </div>
    </div>";
                  }
                } else {
                  echo "Tidak ada data anak.";
                }

                // Tutup koneksi
                $koneksi->close();
                ?>
              </th>
            </tr>
            <!-- Tambahkan data anak lainnya di sini dengan format yang sama -->
          </tbody>
        </table>
        <div class="clearfix">
          <div class="hint-text">
            Showing <b id="visible-entries">5</b> out of <b id="total-entries">25</b> entries
          </div>
          <ul class="pagination">
            <li class="page-item disabled"><a href="#">Previous</a></li>
            <li class="page-item active"><a href="#" class="page-link">1</a></li>
            <li class="page-item"><a href="#" class="page-link">2</a></li>
            <li class="page-item"><a href="#" class="page-link">3</a></li>
            <li class="page-item"><a href="#" class="page-link">4</a></li>
            <li class="page-item"><a href="#" class="page-link">5</a></li>
            <li class="page-item"><a href="#" class="page-link">Next</a></li>
          </ul>
        </div>

        <!-- Tambah Modal HTML -->
        <div id="addEmployeeModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="tambah-anak-form" method="post" action="tambahAnak.php">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data Balita</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nik">NIK Balita </label>
                    <input type="number" id="nik" name="nik" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Balita</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="jenis-kelamin">Jenis Kelamin</label>
                    <select id="jenis-kelamin" name="jenis-kelamin" class="form-control" required>
                      <option value="laki-laki">Laki-laki</option>
                      <option value="perempuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="tanggal-lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal-lahir" name="tanggal-lahir" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="bb-lahir">Berat Badan</label>
                    <input type="number" id="bb-lahir" name="bb-lahir" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="tb-lahir">Tinggi Badan</label>
                    <input type="number" id="tb-lahir" name="tb-lahir" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="nama-ibu">Nama Ibu</label>
                    <input type="text" id="nama-ibu" name="nama-ibu" class="form-control" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                  <input type="submit" class="btn btn-success" value="Tambah">
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Edit Data HTML -->
        <div id="editEmployeeModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <?php
              include("koneksi.php");
              // Query SQL dengan INNER JOIN
              $sql = mysqli_query($koneksi, "SELECT tbl_anak.*, tbl_ibu.nama_ibu 
      FROM tbl_anak
      INNER JOIN tbl_ibu ON tbl_anak.id_ibu = tbl_ibu.id_ibu");
              // Loop untuk mengambil data anak
              while ($data = mysqli_fetch_array($sql)) {
              ?>
                <form id="edit-anak-form-<?php echo $data['id_anak']; ?>" action="editAnak.php" method="POST">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Data Balita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="nik-<?php echo $data['id_anak']; ?>">NIK Balita</label>
                      <input type="number" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="form-group">
                      <label for="nama-<?php echo $data['id_anak']; ?>">Nama Balita</label>
                      <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                      <label for="jenis-kelamin">Jenis Kelamin</label>
                      <select id="jenis-kelamin" name="jenis-kelamin" class="form-control" required>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tanggal-lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" id="tanggal-lahir" name="tanggal-lahir" required>
                    </div>
                    <div class="form-group">
                      <label for="bb-lahir">Berat Badan</label>
                      <input type="number" class="form-control" id="bb-lahir" name="bb-lahir" required>
                    </div>
                    <div class="form-group">
                      <label for="tb-lahir">Tinggi Badan</label>
                      <input type="number" class="form-control" id="tb-lahir" name="tb-lahir" required>
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="form-group">
                      <label for="nama-ibu">Nama Ibu</label>
                      <input type="text" class="form-control" id="nama-ibu" name="nama-ibu" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save" name="update">
                  </div>
                </form>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteEmployeeModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="hapusAnak.php" method="POST">
                <div class="modal-header">
                  <h4 class="modal-title">Hapus Data Balita</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                  <p>Apakah Anda yakin ingin menghapus data ini?</p>
                  <p class="text-warning"><small>Tindakan ini tidak bisa dibatalkan</small></p>
                  <!-- This is where you should place the hidden input field -->
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

        <script>
          $(document).ready(function() {
            // Fungsi saat tombol "Cari" ditekan
            $('#searchButton').on('click', function() {
              var searchTerm = $('#searchInput').val(); // Dapatkan kata kunci pencarian
              if (searchTerm != '') {
                $.ajax({
                  type: 'POST',
                  url: 'cariAnak.php',
                  data: {
                    search: 1,
                    searchTerm: searchTerm
                  },
                  success: function(response) {
                    $('#searchInput').val(''); // Kosongkan kolom pencarian
                    $('tbody').html(response); // Tampilkan hasil pencarian di tabel
                  }
                });
              }
            });
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

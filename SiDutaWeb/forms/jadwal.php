<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" href="siduta.png" />
    <title>Jadwal - SiDuta</title>
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
                    <h1 class="mt-4">Jadwal Posyandu</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jadwal Posyandu </li>
                    </ol>
                    <div class="card mb-4">

                    </div>
                    <div class="card mb-4">
                        <div class="card-header" style="font-size: 18px;">
                            <i class="fas fa-table me-1" style="margin-top: 8px;"></i>
                            Jadwal Posyandu
                            <style>
                                .material-icons {
                                    font-size: 18px;
                                    vertical-align: middle;
                                }
                            </style>
                            <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#addJadwalModal"><i class="material-icons">&#xE147;</i>
                                Tambah Data
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NIK Anak</th>
                                        <th>Nama Anak</th>
                                        <th>Jenis Imunisasi</th>
                                        <th>Tanggal Posyandu</th>
                                        <th>Jam Posyandu</th>
                                        <th>Tempat Posyandu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NIK Anak</th>
                                        <th>Nama Anak</th>
                                        <th>Jenis Imunisasi</th>
                                        <th>Tanggal Posyandu</th>
                                        <th>Jam Posyandu</th>
                                        <th>Tempat Posyandu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <!-- Tambahkan baris berikut ke dalam tabel tbody untuk menampilkan data jadwal imunisasi -->
                                    <?php
                                    include("koneksi.php");
                                    $sql = "SELECT tbl_jadwal.*, tbl_anak.nama_anak 
        FROM tbl_jadwal
        INNER JOIN tbl_anak ON tbl_jadwal.id_anak = tbl_anak.id_anak";

                                    $result = $koneksi->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id_anak"] . "</td>";
                                            echo "<td>" . $row["nama_anak"] . "</td>";
                                            echo "<td>" . $row["jenis_imunisasi"] . "</td>";
                                            echo "<td>" . $row["tanggal_imun_timbang"] . "</td>";
                                            echo "<td>" . $row["jam_posyandu"] . "</td>";
                                            echo "<td>" . $row["tempat"] . "</td>";
                                            echo "<td>
              <a href='#viewJadwalModal-" . $row["id_jadwal"] . "' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title=View'>&#xE8FF;</i></a>
              <a href='#deleteJadwalModal' class='delete' data-toggle='modal' data-id='" . $row["id_jadwal"] . "'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
            </td>";
                                            echo "</tr>";
                                            echo "<div id='viewJadwalModal-" . $row["id_jadwal"] . "' class='modal fade'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h4 class='modal-title'>Detail Jadwal Imunisasi</h4>
                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <p><strong>Nama Anak:</strong></p>
                                                        <p id='nama-anak-" . $row["id_jadwal"] . "'>" . $row["nama_anak"] . "</p>
                                                        <p><strong>Umur Anak:</strong></p>
                                                        <p id='umur-anak-" . $row["id_jadwal"] . "'>" . $row["umur_anak"] . "</p>
                                                        <p><strong>Jenis Imunisasi:</strong></p>
                                                        <p id='jenis-imunisasi-" . $row["id_jadwal"] . "'>" . $row["jenis_imunisasi"] . "</p>
                                                        <p><strong>Tanggal Posyandu:</strong></p>
                                                        <p id='tanggal-imunisasi-" . $row["id_jadwal"] . "'>" . $row["tanggal_imun_timbang"] . "</p>
                                                        <p><strong>Jam Posyandu:</strong></p>
                                                        <p id='jam_posyandu-" . $row["id_jadwal"] . "'>" . $row["jam_posyandu"] . "</p>
                                                        <p><strong>Tempat Posyandu:</strong></p>
                                                        <p id='tempat-" . $row["id_jadwal"] . "'>" . $row["tempat"] . "</p>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                        }
                                    } else {
                                        echo "Tidak ada data jadwal imunisasi.";
                                    }

                                    // Tutup koneksi
                                    $koneksi->close();
                                    ?>
                                </tbody>
                            </table>
                            <!-- Tambah Modal HTML untuk menambah jadwal -->
                            <div id="addJadwalModal" class="modal fade">
                                <style>
                                    .form-control {
                                        
                                        display: block;
                                        width: 100%;
                                        height: calc(1.5em + 0.75rem + 2px);
                                        padding: 0.375rem 0.75rem;
                                        font-size: 1rem;
                                        font-weight: 400;
                                        line-height: 1.5;
                                        background-color: #fff;
                                        background-clip: padding-box;
                                        border: 2px solid;
                                        border-color: black;
                                        border-radius: 0.25rem;
                                        -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
                                        transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
                                        -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                                        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                                        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
                                    }
                                </style>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="tambah-jadwal-form" method="post" action="tambahJadwal.php">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Jadwal Imunisasi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="id_anak" style="font-size: 15px;">Pilih Anak</label>
                                                    <select id="id_anak" name="id_anak" style="font-size: 13px;" class="form-control" required>
                                                        <?php
                                                        include("koneksi.php");
                                                        $sql = "SELECT id_anak, nama_anak, tgl_lahir FROM tbl_anak";
                                                        $result = $koneksi->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            // Hitung umur anak dalam bulan
                                                            $tgl_lahir = new DateTime($row['tgl_lahir']);
                                                            $today = new DateTime();
                                                            $umur = $today->diff($tgl_lahir);
                                                            $umur_bulan = ($umur->y * 12) + $umur->m;

                                                            echo "<option value='" . $row['id_anak'] . "'>" . $row['nama_anak'] . " (Umur: " . $umur_bulan . " bulan)</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="umur_anak" style="font-size: 15px;">Umur Bayi (bulan)</label>
                                                    <select id="umur_anak" name="umur_anak" style="font-size: 13px;" class="form-control" required>
                                                        <option value="0">0 bulan</option>
                                                        <option value="1">1 bulan</option>
                                                        <option value="2">2 bulan</option>
                                                        <option value="4">4 bulan</option>
                                                        <option value="6">6 bulan</option>
                                                        <option value="9">9 bulan</option>
                                                        <!-- Tambahkan opsi lain sesuai dengan umur bayi -->
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_imunisasi"  style="font-size: 15px;">Jenis Imunisasi</label>
                                                    <select id="jenis_imunisasi" name="jenis_imunisasi" style="font-size: 13px;" class="form-control" required>
                                                        <!-- Pilihan vaksin akan diisi secara dinamis menggunakan JavaScript -->
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_imun_timbang" style="font-size: 15px;">Tanggal Imunisasi dan Penimbangan</label>
                                                    <input type="date" id="tanggal_imun_timbang" name="tanggal_imun_timbang" style="font-size: 13px;" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tempat" style="font-size: 15px;">Tempat Posyandu</label>
                                                    <input type="text" id="tempat" name="tempat" style="font-size: 13px;"  class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jam_posyandu" style="font-size: 15px;">Jam Posyandu</label>
                                                    <input type="text" id="jam_posyandu" name="jam_posyandu" style="font-size: 13px;" class="form-control" required value="09:00">
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
                            <!-- Delete Modal HTML -->
                            <div id="deleteJadwalModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="hapusJadwal.php" method="POST">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Jadwal</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small" style="color: black; font-size: 110%;">Apakah Anda yakin ingin menghapus data ini?</p>
                                                <p class="small" style="color: black; font-size: 110%;"><small>Tindakan ini tidak bisa dibatalkan</small></p>
                                                <input type="hidden" name="idToDelete" id="idToDelete">
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" style="background-color: blue; color: white;">
                                                <input type="submit" class="btn btn-danger" value="Delete" name="delete" style="background-color: red;">
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
        document.addEventListener("DOMContentLoaded", function() {
            const vaksinUmur = [{
                    nama: 'BCG (0 bulan)',
                    umur: 0
                },
                {
                    nama: 'Hepatitis B 1 (0 bulan)',
                    umur: 0
                },
                {
                    nama: 'Hepatitis B 2 (1 bulan)',
                    umur: 1
                },
                {
                    nama: 'Polio 1 (2 bulan)',
                    umur: 2
                },
                {
                    nama: 'DPT-HB-Hib 1 (2 bulan)',
                    umur: 2
                },
                {
                    nama: 'PCV 1 (2 bulan)',
                    umur: 2
                },
                {
                    nama: 'Rotavirus 1 (2 bulan)',
                    umur: 2
                },
                {
                    nama: 'Polio 2 (4 bulan)',
                    umur: 4
                },
                {
                    nama: 'DPT-HB-Hib 2 (4 bulan)',
                    umur: 4
                },
                {
                    nama: 'PCV 2 (4 bulan)',
                    umur: 4
                },
                {
                    nama: 'Rotavirus 2 (4 bulan)',
                    umur: 4
                },
                {
                    nama: 'Hepatitis B 3 (6 bulan)',
                    umur: 6
                },
                {
                    nama: 'Polio 3 (6 bulan)',
                    umur: 6
                },
                {
                    nama: 'DPT-HB-Hib 3 (6 bulan)',
                    umur: 6
                },
                {
                    nama: 'PCV 3 (6 bulan)',
                    umur: 6
                },
                {
                    nama: 'Campak (9 bulan)',
                    umur: 9
                },
                {
                    nama: 'Gondok (9 bulan)',
                    umur: 9
                },
                {
                    nama: 'Rubella (9 bulan)',
                    umur: 9
                }
            ];

            function populateVaksinDropdown(selectedUmur) {
                const vaksinDropdown = document.getElementById('jenis_imunisasi');
                vaksinDropdown.innerHTML = '';

                vaksinUmur.forEach((vaksin) => {
                    if (vaksin.umur <= selectedUmur) {
                        const option = document.createElement('option');
                        option.value = vaksin.nama;
                        option.textContent = vaksin.nama;
                        vaksinDropdown.appendChild(option);
                    }
                });
            }

            const umurDropdown = document.getElementById('umur_anak');
            const vaksinDropdown = document.getElementById('jenis_imunisasi');

            umurDropdown.addEventListener('change', (e) => {
                const selectedUmur = parseInt(e.target.value, 10);
                populateVaksinDropdown(selectedUmur);

                // Secara otomatis memilih vaksin sesuai dengan umur bayi jika tersedia
                vaksinDropdown.value = vaksinUmur.find((vaksin) => vaksin.umur <= selectedUmur)?.nama || '';
            });
        });
    </script>

</body>

</html>
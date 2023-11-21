<!doctype html>
<html lang="en">

<head>
	<link rel="icon" type="image/png" href="siduta.png" />
	<title>Dashboard - SiDuta</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="all.min.css" rel="stylesheet" type="text/css">
	<link href="dashboard.css" rel="stylesheet">
	<link href="coba123.css" rel="stylesheet">
	<link href="crud.css" rel="stylesheet">
	<!-- <script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script> -->
</head>

<body style="height: max-content;">
	<div class="wrapper d-flex align-items-stretch">
		<!-- navbar -->
		<?php include 'navbar.php'; ?>
		<!-- end navbar  -->
		<!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5">
			<main>
				<div class="dashboard-container">
					<h1>Dashboard</h1>
					<div class="header-content">
						<div class="welcome-description">
							<style>
								.welcome-description {
									/* Lebar sesuai dengan yang tersisa dalam baris */
									flex-grow: 1;
									/* Memberikan background pada teks "Selamat Datang" */
									background-color: #0205a1;
									color: whitesmoke;
									border-radius: 5px;
									padding: 20px;
									/* Mengatur margin kanan agar terpisah dari gambar */
									position: relative;
								}
							</style>
							<p class="welcome-text-large" style="text-align: center;">Selamat Datang di SiDuta!</p>
							<p class="welcome-text-small" style="text-align: justify; ">Aplikasi SiDuta adalah sebuah aplikasi yang dirancang untuk membantu pengelolaan dan pemantauan kegiatan posyandu. Posyandu merupakan pusat kesehatan masyarakat yang bertujuan untuk memberikan pelayanan kesehatan dasar kepada masyarakat,Terutama ibu dan anak.</p>
						</div>
						<div class="welcome-image">
							<img src="Rectangle 38.png" alt="Selamat Datang " ">
					</div>
				</div>
				<?php
				include('koneksi.php');
				// Query SQL untuk mengambil data yang diperlukan dari database
				$query = "SELECT COUNT(*) AS total_balita FROM tbl_anak";
				$result = $koneksi->query($query);

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$total_balita = $row["total_balita"];
				}
				// Query SQL untuk mengambil total balita laki-laki
				$queryLakiLaki = "SELECT COUNT(*) AS total_laki_laki FROM tbl_anak WHERE jenis_kelamin = 'Laki-Laki'";
				$resultLakiLaki = $koneksi->query($queryLakiLaki);

				if ($resultLakiLaki->num_rows > 0) {
					$rowLakiLaki = $resultLakiLaki->fetch_assoc();
					$total_laki_laki = $rowLakiLaki["total_laki_laki"];
				}

				// Query SQL untuk mengambil total balita perempuan
				$queryPerempuan = "SELECT COUNT(*) AS total_perempuan FROM tbl_anak WHERE jenis_kelamin = 'Perempuan'";
				$resultPerempuan = $koneksi->query($queryPerempuan);

				if ($resultPerempuan->num_rows > 0) {
					$rowPerempuan = $resultPerempuan->fetch_assoc();
					$total_perempuan = $rowPerempuan["total_perempuan"];
				}
				// Query SQL untuk mengambil total penimbangan
				$queryPenimbangan = "SELECT COUNT(*) AS total_penimbangan FROM penimbangan";
				$resultPenimbangan = $koneksi->query($queryPenimbangan);

				if ($resultPenimbangan->num_rows > 0) {
					$rowPenimbangan = $resultPenimbangan->fetch_assoc();
					$total_penimbangan = $rowPenimbangan["total_penimbangan"];
				}

				// Query SQL untuk mengambil total imunisasi
				$queryImunisasi = "SELECT COUNT(*) AS total_imunisasi FROM imunisasi";
				$resultImunisasi = $koneksi->query($queryImunisasi);

				if ($resultImunisasi->num_rows > 0) {
					$rowImunisasi = $resultImunisasi->fetch_assoc();
					$total_imunisasi = $rowImunisasi["total_imunisasi"];
				}


				// Tutup koneksi database
				$koneksi->close();
				?>
				<!-- Content Row -->
				<div class=" row">

							<!-- Earnings (Monthly) Card Example -->
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card border-left-primary shadow h-100 py-2" style="width: 105%;">
									<div class="card-body" style="text-align: left;">
										<div class="row no-gutters align-items-left">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
													Total Balita</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_balita; ?></div>
											</div>
											<div class="col-auto">
												<img src="ikon2jpg.jpg" alt="Calendar Icon" class="icon" style="width: 32px; height: 32px;">
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card border-left-success shadow h-100 py-2" style="width: 105%;">
									<div class="card-body" style="text-align: left;">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
													Total Balita Laki-Laki</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_laki_laki; ?></div>
											</div>
											<div class="col-auto">
												<img src="ikon3.jpg" alt="Calendar Icon" class="icon" style="width: 32px; height: 32px;">
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card border-left-success shadow h-100 py-2" style="width: 105%;">
									<div class="card-body" style="text-align: left;">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
													Total Balita Perempuan</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_perempuan; ?></div>
											</div>
											<div class="col-auto">
												<img src="ikon1jpg.jpg" alt="Calendar Icon" class="icon" style="width: 32px; height: 32px;">
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Earnings (Monthly) Card Example -->
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card border-left-info shadow h-100 py-2" style="width: 105%;">
									<div class="card-body" style="text-align: left;">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Penimbangan
												</div>
												<div class="row no-gutters align-items-center">
													<div class="col-auto">
														<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_penimbangan; ?></div>
													</div>
												</div>
											</div>
											<div class="col-auto">
												<img src="penimbangan.jpg" alt="Calendar Icon" class="icon" style="width: 32px; height: 32px;">
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Pending Requests Card Example -->
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card border-left-warning shadow h-100 py-2" style="width: 105%;">
									<div class="card-body" style="text-align: left;">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
													Total Imunisasi</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_imunisasi; ?></div>
											</div>
											<div class="col-auto">
												<img src="imun.jpg" alt="Calendar Icon" class="icon" style="width: 32px; height: 32px;">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">

							<!-- Area Chart -->
							<div class="col-xl-8 col-lg-7">
								<div class="card shadow mb-4" style="width: 750px;">
									<!-- Card Header - Dropdown -->
									<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">Tabel Data Balita</h6>
										<div class="dropdown no-arrow">
											<img src="ikon2jpg.jpg" alt="Calendar Icon" class="icon" style="width: 18px; height: 18px;">
										</div>
									</div>
									<style>
										/* Custom table styles */
										table {
											width: 100%;
											border-collapse: collapse;
										}

										table th,
										table td {
											padding: 10px;
											text-align: left;
										}

										table thead {
											background-color: #007BFF;
											/* Header background color */
											color: #fff;
											/* Header text color */
										}

										table th {
											font-weight: bold;
										}

										table tbody tr:nth-child(odd) {
											background-color: #f2f2f2;
											/* Odd row background color */
										}

										table tbody tr:hover {
											background-color: #cce6ff;
											/* Hovered row background color */
										}

										table tbody tr td {
											border: 1px solid #ddd;
											/* Table cell border */
										}
									</style>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table">
												<thead>
													<tr>
														<th>NIK Anak</th>
														<th>Nama Anak</th>
														<th>Jenis Kelamin</th>
														<th>Tanggal Lahir</th>
														<th>Berat Badan</th>
														<th>Tinggi Badan</th>
														<th>Alamat</th>
														<th>Nama Ayah</th>
														<th>Nama Ibu</th>
													</tr>
												</thead>
												<tbody>
											</table>
											<!-- Wrap the table body in a separate div for scrolling -->
											<div style="max-height: 300px; overflow-y: auto;">
												<table class="table">
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
															echo "<th>" . $row["tanggal_lahir_anak"] . "</th>";
															echo "<th>" . $row["bb_lahir"] . "</th>";
															echo "<th>" . $row["tb_lahir"] . "</th>";
															echo "<th>" . $row["alamat"] . "</th>";
															echo "<th>" . $row["nama_ayah"] . "</th>";
															echo "<th>" . $row["nama_ibu"] . "</th>"; // Kolom nama ibu
															echo "</tr>";
														}
													} else {
														echo "Tidak ada data anak.";
													}

													// Tutup koneksi
													$koneksi->close();
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Bar Chart -->
							<div class="col-xl-4 col-lg-5">
								<div class="card shadow mb-4 " style="height: 95%;">
									<!-- Card Header - Dropdown -->
									<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">Grafik Balita</h6>
										<div class="dropdown no-arrow">
											<img src="ikon2jpg.jpg" alt="Calendar Icon" class="icon" style="width: 18px; height: 18px;">
										</div>
									</div>
									<!-- Card Body -->
									<?php
									include('koneksi.php');
									// Query SQL untuk mengambil data jenis kelamin
									$query = "SELECT jenis_kelamin, COUNT(*) as total FROM tbl_anak GROUP BY jenis_kelamin";
									$result = $koneksi->query($query);

									// Inisialisasi array untuk data grafik
									$jenis_kelamin = [];
									$total = [];

									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$jenis_kelamin[] = $row["jenis_kelamin"];
											$total[] = $row["total"];
										}
									}

									// Tutup koneksi database
									$koneksi->close();
									?>

									<div class="card-body">
										<div class="chart-bar pt-4 pb-2" style="margin-top: 75px;">
											<canvas id="myBarChart" width="480%" height="245%"></canvas>
										</div>
										<script>
											// Simpan data yang diambil dari server (sesuaikan dengan bagian ini)
											fetch('bar_chart.php')
												.then(response => response.json())
												.then(data => {
													var labels = data.map(item => item.jenis_kelamin);
													var values = data.map(item => item.total);

													var barChartData = {
														labels: labels,
														datasets: [{
															label: 'Grafik Jenis Kelamin',
															backgroundColor: ['blue', 'pink'], // Warna untuk Laki-Laki dan Perempuan
															data: values
														}]
													};

													// Konfigurasi grafik
													var options = {
														responsive: true,
														legend: {
															display: false
														},
														scales: {
															xAxes: [{
																barPercentage: 0.8, // Mengatur lebar batang (sesuaikan dengan kebutuhan Anda)
																ticks: {
																	beginAtZero: true // Mulai dari 0
																}
															}]
														}
													};

													var ctx = document.getElementById('myBarChart').getContext('2d');
													var myBarChart = new Chart(ctx, {
														type: 'horizontalBar', // Menggunakan tipe horizontal bar chart
														data: barChartData,
														options: options
													});
												})
												.catch(error => console.error('Error fetching data:', error));
										</script>
									</div>
								</div>
							</div>
			</main>
		</div>
	</div>
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
	<!-- Page level plugins -->
	<script src="Chart.min.js"></script>
	<script>
		console.log("Total Laki-Laki: <?php echo $total_laki_laki; ?>");
		console.log("Total Perempuan: <?php echo $total_perempuan; ?>");
	</script>
</body>

</html>
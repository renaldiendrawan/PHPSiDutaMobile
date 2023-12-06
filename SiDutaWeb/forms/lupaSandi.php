<!DOCTYPE html>
<html lang="en">

<head>
	<title>Lupa Kata Sandi - SIDuta</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="siduta.png" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<style>
				.container-login100 {
					width: 100%;
					min-height: 100vh;
					display: -webkit-box;
					display: -webkit-flex;
					display: -moz-box;
					display: -ms-flexbox;
					display: flex;
					flex-wrap: wrap;
					justify-content: center;
					align-items: center;
					padding: 15px;
					background: #0205a1;
				}

				/* Added styles for back button */
				.back-button {
					position: absolute;
					top: 20px;
					left: 20px;
					color: #fff;
					cursor: pointer;
					font-size: 20px;
				}
			</style>
			<a class="back-button" href="login1.php">
				<div class="circle-icon">
					<i class="fa fa-arrow-left"></i>
				</div>
			</a>

			<style>
				/* Tambahkan gaya untuk lingkaran dan ikon */
				.circle-icon {
					display: inline-block;
					width: 40px;
					height: 40px;
					background-color: #fff;
					/* Warna latar belakang lingkaran */
					border-radius: 50%;
					/* Agar bentuknya menjadi lingkaran */
					text-align: center;
					line-height: 40px;
					box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
					/* Efek bayangan */
				}

				.circle-icon i {
					color: #000;
					/* Warna ikon */
					font-size: 20px;
				}

				/* Gaya tambahan jika diperlukan */
				.back-button {
					text-decoration: none;
				}
			</style>

			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="sarjono.png" alt="IMG" style="margin-left: 10%; width: 100%; height: 95%; margin-top: -20%;">
				</div>
				<form name="loginForm" class="login100-form validate-form" action="lupaSandi1.php" method="POST" onsubmit="return validateForm()">
					<span class="login100-form-title" style="margin-top: -20%;">
						Lupa Kata Sandi
					</span>
					<div class="wrap-input100 validate-input" data-validate="">
						<input class="input100" type="text" name="nama_kader" placeholder="Nama Kader">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="number" name="no_telp" placeholder="nomor telepon">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="kata_sandi" placeholder="Kata Sandi Baru">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="konfirmasi_kata_sandi" id="konfirmasi_kata_sandi" placeholder="Konfirmasi Kata Sandi">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="submit" id="submit">
							Konfirmasi
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script>
		function validateForm() {
			var newPassword = document.getElementById('kata_sandi').value;
			var confirmPassword = document.getElementById('konfirmasi_kata_sandi').value;

			// Check if the new password and confirmation match
			if (newPassword !== confirmPassword) {
				alert('Konfirmasi Kata Sandi tidak sesuai dengan Kata Sandi Baru.');
				return false;
			}

			// Your other form validation logic can go here

			// If all validations pass, submit the form
			return true;
		}
	</script>
</body>

</html>
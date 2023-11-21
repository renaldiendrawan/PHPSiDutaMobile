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
			</style>
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="sarjono.png" alt="IMG" style="margin-left: 10%; width: 100%; height: 80%; margin-top: -10%;">
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
						<input class="input100" type="password" name="kata_sandi" placeholder="Konfirmasi Kata Sandi">
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
					<div class="text-center p-t-12">
						<a class="txt2" href="login1.php" style="font-size: 15px;">
							Kembali
						</a>
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
</body>

</html>
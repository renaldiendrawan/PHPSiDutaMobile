<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav id="sidebar" style="background-color: #0205a1; transition: all; width: 100%;">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn" style="background-color: #337CCF; border-color: #337CCF;">
                <i class="fa fa-bars mt-2" style="color: white; font-size: 15px;"></i>
                <span class="sr-only" style="background-color: #0205a1;">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4 pt-5" style="background-color: #0205a1;">
            <img src="siduta.png" alt="logo" style="margin-left: 70px;">
            <h1><a href="dashboard.php" class="logo" style=" font-size: 13px; color: #62C7C3; ">sistem informasi posyandu balita</a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="dashboard.php"><span class="fa fa-dashboard mr-3"></span>Dashboard</a>
                </li>
                <li>
                    <a href="anak.php"><span class="fa fa-baby mr-3"></span>Data Anak</a>
                </li>
                <li>
                    <a href="imunisasi.php"><span class="fa fa-syringe mr-3"></span>Data Imunisasi</a>
                </li>
                <li>
                    <a href="timbang.php"><span class="fa fa-balance-scale mr-3"></span>Data Penimbangan</a>
                </li>
                <li>
                    <a href="kader.php"><span class="fa fa-users mr-3"></span>Data Kader</a>
                </li>
                <li>
                    <a href="jadwal.php"><span class="fa fa-calendar mr-3"></span>Jadwal</a>
                </li>
                <li>
                    <a href="artikel.php"><span class="fa fa-newspaper mr-3"></span>Artikel</a>
                </li>
                <li>
                    <a href="profil.php"><span class="fa fa-user mr-3"></span>Profil Kader</a>
                <li>
                    <a href="login1.php" onclick="return confirmLogout()"><span class="fa fa-sign-out mr-3"></span> Keluar</a>
                </li>
            </ul>
            <script>
                function confirmLogout() {
                    var confirmLogout = confirm("Apakah Anda yakin ingin keluar?");
                    if (confirmLogout) {
                        window.location.href = "login1.php";
                    } else {
                        // If user clicks "Cancel", do nothing
                        return false;
                    }
                }
            </script>

            </li>
            </ul>
        </div>
    </nav>
</body>

</html>
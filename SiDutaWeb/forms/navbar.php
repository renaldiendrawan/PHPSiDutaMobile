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
            <img src="siduta.png" alt="logo" style="margin-left: 30%;">
            <h1><a href="index.php" class="logo" style="margin-left: 45px; font-size: 30px">SiDuta</a></h1>
            <ul class="list-unstyled components mb-5">
                <li>
               <a href="index.php">   Dashboard</a>
                </li>
                <li class="active" >
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >Tabel Data</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="anak.php" > Data Balita</a>
                        </li>
                        <li>
                            <a href="timbang.php">Data Penimbangan</a>
                        </li>
                        <li>
                            <a href="imunisasi.php">Data Imunisasi</a>
                        </li>
                        <li>
                         <a href="kader.php"> Data Kader</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="jadwal.php">    Jadwal</a>
                </li>
                <li>
                    <a href="artikel.php">  Artikel</a>
                </li>
                <li>
                    <a href="profil.php">    Profil</a>
                </li>
                <li>
                    <form id="logoutForm" action="login1.php" method="post">
                        <input type="submit" value="Keluar" style="background-color: red; height: 40px; margin-left: 10%; width: 80%; margin-top: 20%; border-radius: 10px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; border-color: red; cursor: pointer; color: white;">
                    </form>
                    <script>
                        document.getElementById("logoutForm").onsubmit = function() {
                            return confirm("Apakah Anda yakin ingin keluar?");
                        };
                    </script>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>

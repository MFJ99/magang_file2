<?php 
session_start();

if (!isset($_SESSION["username"])) {
	echo "Anda harus login dulu <br><a href='index.php'>Klik disini</a>";
	exit;
}

$id_user=$_SESSION["id_login"];
$username=$_SESSION["username"];
$nama=$_SESSION["nama"];
?>
<?php
//memasukkan file config.php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Page | PT. Adidaya Bima Perkasa</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Admin Page </div>
      <div class="list-group list-group-flush">
      <a href="utama.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="abs_tampil.php" class="list-group-item list-group-item-action bg-light">Absensi</a>
        <a href="peg_index.php" class="list-group-item list-group-item-action bg-light">Pegawai</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Artikel</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">User</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Tombol</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, <?php echo $nama; ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

	  <div class="container" style="margin-top:20px">
      <?php include('config.php');

      $id = $_GET['id'];
      $query = mysqli_query($koneksi, "SELECT * FROM presensi WHERE id = $id");
      $data = mysqli_fetch_array($query);
        ?>
      <h1 class="mt-4">Detail Presensi : <?php echo $data['nama'] ?></h1>
      <table border="0">
        <tr>
            <td size="90">Nama</td>
            <td>: <?php echo $data['nama']?></td>
        </tr>
        <tr>
            <td>Waktu Presensi</td>
            <td>: <?php echo $data['waktu']?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>: <?php echo $data['status']?>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>: <?php echo $data['ket']?></td>
        </tr>
        <tr>
            <td>Lokasi Presensi</td>
            <td>: <?php echo $data['lokasi']?></td>
        </tr>       
        <tr>
            <td>Foto</td>
            <td>: <img src="upload/<?php echo $data['foto'] ?>" width="500px" height="500px"></td>
        </tr>

        <tr height="40">
            <td></td>
            <td>   <a href="abs_tampil.php" class="badge badge-info">Kembali</a></td>
        </tr>
    </table>



      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>

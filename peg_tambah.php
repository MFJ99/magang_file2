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

<?php include('config.php'); ?>
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
		<h2>Input Pegawai</h2>
		
		<hr>
		
		<?php
		if(isset($_POST['submit'])){
			$nama			= $_POST['nama'];
			$jabatan	= $_POST['jabatan'];
			$status		= $_POST['status'];
			
			$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($koneksi));
			
			if(mysqli_num_rows($cek) == 0){
				$sql = mysqli_query($koneksi, "INSERT INTO user(nama, jabatan, status) VALUES('$nama', '$jabatan', '$status')") or die(mysqli_error($koneksi));
				
				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="tambah.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, sudah terdaftar.</div>';
			}
		}
		?>
		
		<form action="tambah.php" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA PEGAWAI</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" size="4" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JABATAN</label>
				<div class="col-sm-10">
					<input type="text" name="jabatan" class="form-control" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="status" value="Aktif" required>
						<label class="form-check-label">Aktif</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="status" value="Cuti" required>
						<label class="form-check-label">Cuti</label>
					</div>
				</div>
			</div>

			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
				</div>
			</div>
		</form>
		
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
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
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
	<link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/jquery.dataTables.css" rel="stylesheet" media="screen">
	<link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link href="css/simple-sidebar.css" rel="stylesheet">

  </head>

  <body>
  
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
  
  <div class="container-fluid" style="margin-top:20px">
        <h1 class="mt-4">Data Absensi</h1>
<div class="table-responsive">
 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
 				<thead class="thead-dark">
					<tr>
						<th>NO</th>
						<th>Nama</th>
						<th>Waktu</th>
						<th>Status</th>
						<th>Keterangan</th>
            <th>Opsi</th>
            
						
					</tr>
				</thead>

				
				<tbody>
				<?php
				include "config.php";
				$view=mysqli_query($koneksi,"select * from presensi");
				$no=1;
				while($data=mysqli_fetch_assoc($view)){
				
          echo '
          <tr>
            <td>'.$no.'</td>
            <td>'.$data['nama'].'</td>
            <td>'.$data['waktu'].'</td>
            <td>'.$data['status'].'</td>
            <td>'.$data['ket'].'</td>
            <td>
              
              <a href="abs_delete.php?id='.$data['id'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
              <a href="abs_detail.php?id='.$data['id'].'" class="badge badge-info">Detail</a>
            
              </td>
          </tr>
          ';
          $no++;
        }
				?>
				</tbody>
				
 </table>
</div>
</div>

	 <script src="assets/js/jquery.js"></script>
	  <script src="assets/js/jquery.dataTables.js"></script>
	  <script src="assets/js/jquery.dataTables.min.js"></script>
	  
	  <script>
	  $(document).ready(function() {
    $('#example').DataTable();
} );
	  </script>
	
	<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  </body>
</html>


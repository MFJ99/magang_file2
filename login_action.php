<?php
session_start();

include "config.php";

$username = $_POST["username"];
$p = md5($_POST["password"]);

$sql = "select * from login where username='".$username."' and password='".$p."' limit 1";
$hasil = mysqli_query ($koneksi,$sql);
$jumlah = mysqli_num_rows($hasil);


	if ($jumlah>0) {
		$row = mysqli_fetch_assoc($hasil);
		$_SESSION["id_login"]=$row["id_login"];
		$_SESSION["username"]=$row["username"];
		$_SESSION["nama"]=$row["nama"];
	

		header("Location:utama.php");
		
	}else {
		echo "Username atau password salah <br><a href='index.php'>Kembali</a>";
	}
?>
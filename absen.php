<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>PT. Adidaya Bima Perkasa | Admin Page</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
	integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
	<style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#"><img src="img/logo-adidaya.png" height="50px" width="120px">PT. Adidaya Bima Perkasa | Presensi Kehadiran</a>
			<!--
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
						<a class="nav-link" href="#">##</a>
					</li>
				</ul>
			</div> 
			-->
		</div>
	</nav>
	
	<div class="container" style="margin-top:20px">
		<h2>Presensi Pegawai</h2>
		
		<hr>
		
		<?php
		if(isset($_POST['submit'])){
			$nama		= $_POST['nama'];
			$status		= $_POST['status'];
            $ket		= $_POST['ket']; 
			$img = $_POST['image'];
        $folderPath = "upload/";
  
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
    
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
    
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

			$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($koneksi));
			
			if(mysqli_num_rows($cek) == 0){

				$sql = mysqli_query($koneksi, "INSERT INTO presensi(nama, status, ket, foto) VALUES('$nama', '$status', '$ket','$fileName')") or die(mysqli_error($koneksi));
				
				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="absen.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses absen data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, tidak ada nama.</div>';
			}
		}else if (isset($_POST['submit'])){
            $cari = $_POST['nt'];
            $query = mysqli_query($koneksi, "SELECT * FROM presensi WHERE nama LIKE '%$cari%'") or die(mysqli_error($koneksi));
            
            while ($r = mysqli_fetch_assoc($query)){
              echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$r['nama'].'</td>
							<td>'.$r['waktu'].'</td>
							<td>'.$r['status'].'</td>
              <td>'.$r['ket'].'</td>
							<td>
								
								<a href="abs_delete.php?id='.$data['id'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
                <a href="abs_detail.php?id='.$data['id'].'" class="badge badge-info">Detail</a>
							
                </td>
						</tr>
						';
						$no++;
					}}
		?>	

	    <form action="absen.php" method="post">
		<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA PEGAWAI</label>
				<div class="col-sm-10">
                <input class="form-control" id="search" type="text" name="nama"/>

				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">STATUS</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="status" value="Datang" required>
						<label class="form-check-label">Datang</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="status" value="Pulang" required>
						<label class="form-check-label">Pulang</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="status" value="Izin" required>
						<label class="form-check-label">Izin</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Keterangan</label>
				<div class="col-sm-10">
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Mohon dibaca!</label>
    					<textarea class="form-control" rows="3" name="ket" placeholder="Jika anda memilih izin, jelaskan alasan anda disini! Jika tidak maka tidak perlu mengisi bagian ini"></textarea>
  					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Foto</label>
				<div class="col-sm-10">
					<div class="form-group">
					<div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>
        </div>

  					</div>
				</div>
			</div>
			
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="PRESENSI SEKARANG">
				</div>
			</div>
		</form>
		
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script language="JavaScript">
    Webcam.set({
        width: 390,
        height: 290,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#search").autocomplete({
			source: 'search.php',
			minLength: 0,
		});
	});
</script>
</html>
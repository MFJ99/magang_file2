<?php
	require_once 'config.php';
 
	$search = $_GET['term'];
 
	$query = $conn->query("SELECT * FROM 'user' WHERE 'nama' LIKE '%$search%' ORDER BY 'nama' ASC") or die(mysqli_connect_errno());
 
	$list = array();
	$rows = $query->num_rows;
 
	if($rows > 0){
		while($fetch = $query->fetch_assoc()){
			$data['value'] = $fetch['nama']; 
			array_push($list, $data);
		}
	}
 
	echo json_encode($list);
?>
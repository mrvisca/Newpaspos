<?php
include '../../settings/database.php';
$id = $_POST['id_parameter'];
$meja = $_POST['nama_meja'];
$kapasitas = $_POST['kapasitas'];
$brand = $_POST['brand'];
$status = $_POST['status'];
$query= "UPDATE reservasi SET meja='".$meja."', kapasitas='".$kapasitas."', id_brand='".$brand."', status_reservasi='".$status."' WHERE id='".$id."' ";
$prepare = $koneksi->prepare($query);
if($prepare->execute()) {
	echo"OK";	
} else {
	echo"FAIL";
}
?>
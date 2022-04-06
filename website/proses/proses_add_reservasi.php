<?php
include '../../settings/database.php';
$meja = $_POST['nama_meja'];
$kapasitas = $_POST['kapasitas'];
$brand = $_POST['brand'];
$status = $_POST['status'];
$query= "INSERT INTO reservasi (meja, kapasitas, id_brand, status_reservasi) VALUES ('".$meja."','".$kapasitas."','".$brand."','".$status."')";
$prepare = $koneksi->prepare($query);
if($prepare->execute()) {
	echo"OK";
} else {
	echo"FAIL";
}
?>
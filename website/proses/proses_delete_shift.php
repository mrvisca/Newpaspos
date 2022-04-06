<?php
include '../../settings/database.php';
$id = $_GET['id'];
$query = $koneksi->prepare("DELETE FROM shift_pegawai WHERE id='".$id."'");
if($query->execute()) {
	echo"OK";
} else {
	echo"FAIL";
}

?>
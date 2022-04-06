<?php
include '../../settings/database.php';
$id = $_GET['id'];
$query = $koneksi->prepare("DELETE FROM reservasi WHERE id='".$id."'");
if($query->execute()) {
	echo"OK";
} else {
	echo"FAIL";
}

?>
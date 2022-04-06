<?php
include '../../settings/database.php';
$id = $_GET['id'];
$query = $koneksi->prepare("DELETE FROM webconfig WHERE id='".$id."'");
$query->execute();
echo"OK";
?>
<?php
include '../../settings/database.php';
$id = $_POST['id_parameter'];
$brand = $_POST['brand'];
$namaWeb = $_POST['nama_web'];
$domain = $_POST['domain'];
$expired = $_POST['expired'];
$note = $_POST['note'];
$query= "UPDATE webconfig SET id_brand='".$brand."', namaweb='".$namaWeb."', domain='".$domain."', masa_aktif='".$expired."', note='".$note."' WHERE id='".$id."' ";
$prepare = $koneksi->prepare($query);
$prepare->execute();
echo"OK";	
?>
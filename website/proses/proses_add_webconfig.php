<?php
include '../../settings/database.php';
$brand = $_POST['brand'];
$namaWeb = $_POST['nama_web'];
$domain = $_POST['domain'];
$expired = $_POST['expired'];
$note = $_POST['note'];
$query= "INSERT INTO webconfig (id_brand, namaweb, domain, masa_aktif, note) VALUES ('".$brand."', '".$namaWeb."', '".$domain."', '".$expired."', '".$note."')";
$prepare = $koneksi->prepare($query);
$prepare->execute();
echo"OK";
?>
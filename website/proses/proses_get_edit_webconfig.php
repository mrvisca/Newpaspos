<?php
$id = $_GET['id'];
include '../../settings/database.php';
$query = mysqli_query($koneksi, "SELECT 
    webconfig.id, 
    webconfig.id_brand, 
    webconfig.namaweb, 
    webconfig.domain,
    webconfig.masa_aktif,
    webconfig.note
    FROM webconfig
    WHERE webconfig.id = '".$id."'
");
$result = mysqli_fetch_assoc($query);
echo json_encode($result);
?>
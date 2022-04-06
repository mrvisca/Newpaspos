<?php
$id = $_GET['id'];
include '../../settings/database.php';
$query = mysqli_query($koneksi, "SELECT 
    reservasi.id, 
    reservasi.meja, 
    reservasi.kapasitas, 
    reservasi.id_brand,
    reservasi.status_reservasi,
    brand.nama
        FROM reservasi
        LEFT JOIN brand ON brand.id = reservasi.id_brand
    WHERE reservasi.id = '".$id."'
");
$result = mysqli_fetch_assoc($query);
echo json_encode($result);
?>
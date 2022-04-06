<?php
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
");
$result['data'] = [];
while($row = mysqli_fetch_assoc($query)) {
    $data = [];
    $data['id'] = $row['id'];
    $data['meja'] = $row['meja'];
    $data['kapasitas'] = $row['kapasitas'];
    $data['brand'] = $row['nama'];
    $data['status'] = $row['status_reservasi'] == '1' ? 'Tersedia' : 'Sudah Tidak Tersedia';
    array_push($result['data'], $data);
}
echo json_encode($result);
?>
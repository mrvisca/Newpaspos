<?php
include '../../settings/database.php';
$query = mysqli_query($koneksi, "SELECT 
    webconfig.id, 
    webconfig.id_brand,
    webconfig.namaweb, 
    webconfig.domain, 
    webconfig.masa_aktif,
    webconfig.note,
    brand.nama
        FROM webconfig
        LEFT JOIN brand ON brand.id = webconfig.id_brand
");
$result['data'] = [];
while($row = mysqli_fetch_assoc($query)) {
    $data = [];
    $data['id'] = $row['id'];
    $data['brand'] = $row['nama'];
    $data['namaweb'] = $row['namaweb'];
    $data['domain'] = $row['domain'];
    $data['expired'] = $row['masa_aktif'];
    $data['note'] = $row['note'];
    array_push($result['data'], $data);
}
echo json_encode($result);
?>
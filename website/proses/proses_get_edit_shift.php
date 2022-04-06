<?php
$id = $_GET['id'];
include '../../settings/database.php';
$query = mysqli_query($koneksi, "SELECT 
    shift_pegawai.id, 
    shift_pegawai.shift, 
    shift_pegawai.start_shift, 
    shift_pegawai.end_shift,
    shift_pegawai.awal_presensi,
    shift_pegawai.akhir_presensi,
    shift_pegawai.id_brand,
    shift_pegawai.id_branch,
    brand.id as id_brand,
    brand.nama as user,
    branch.id as id_branch,
    branch.nama as cabang
        FROM shift_pegawai
        LEFT JOIN brand ON brand.id = shift_pegawai.id_brand
        LEFT JOIN branch ON branch.id = shift_pegawai.id_branch
        WHERE shift_pegawai.id = $id
");
$result = mysqli_fetch_assoc($query);
echo json_encode($result);
?>
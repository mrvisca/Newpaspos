<?php
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
    brand.nama as user,
    branch.nama as cabang
        FROM shift_pegawai
        LEFT JOIN brand ON brand.id = shift_pegawai.id_brand
        LEFT JOIN branch ON branch.id = shift_pegawai.id_branch
");
$result['data'] = [];
while($row = mysqli_fetch_assoc($query)) {
    $data = [];
    $data['id'] = $row['id'];
    $data['shift'] = $row['shift'];
    $data['start_shift'] = $row['start_shift'];
    $data['end_shift'] = $row['end_shift'];
    $data['awal_presensi'] = $row['awal_presensi'];
    $data['akhir_presensi'] = $row['akhir_presensi'];
    $data['cabang'] = $row['cabang'];
    $data['user'] = $row['user'];
    array_push($result['data'], $data);
}
echo json_encode($result);
?>
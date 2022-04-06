<?php
include '../../settings/database.php';
$shift = $_POST['nama_shift'];
$startShift = $_POST['start_shift'];
$endShift = $_POST['end_shift'];
$startPresensi = $_POST['start_presensi'];
$endPresensi = $_POST['end_presensi'];
$branch = $_POST['branch'];
$brand = $_POST['brand'];
$query= "INSERT INTO shift_pegawai (shift, start_shift, end_shift, awal_presensi, akhir_presensi, id_brand, id_branch) VALUES ('".$shift."','".$startShift."','".$endShift."','".$startPresensi."','".$endPresensi."','".$branch."','".$brand."')";
$prepare = $koneksi->prepare($query);
if($prepare->execute()) {
	echo"OK";
} else {
	echo"FAIL";
}

?>
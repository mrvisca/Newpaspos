<?php
include '../../settings/database.php';
$id = $_POST['id_parameter'];
$shift = $_POST['nama_shift'];
$startShift = $_POST['start_shift'];
$endShift = $_POST['end_shift'];
$startPresensi = $_POST['start_presensi'];
$endPresensi = $_POST['end_presensi'];
$branch = $_POST['branch'];
$brand = $_POST['brand'];
$query= "UPDATE shift_pegawai SET shift='".$shift."', start_shift='".$startShift."', end_shift='".$endShift."', awal_presensi='".$startPresensi."', akhir_presensi='".$endPresensi."', id_brand='".$brand."', id_branch='".$branch."' WHERE id='".$id."' ";
$prepare = $koneksi->prepare($query);
if($prepare->execute()) {
	echo"OK";	
} else {
	echo"FAIL";
}

?>
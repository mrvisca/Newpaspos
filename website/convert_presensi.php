<?php
    session_start();
    include '../settings/database.php';
    $id_brand=$_SESSION['id_brand'];

    // Select Data Cabang
    $query_presensi = mysqli_query($koneksi, "SELECT * FROM presensi WHERE id_brand='".$id_brand."'");
    if(mysqli_num_rows($query_presensi)){
        $responsistem = array();
        $responsistem['data'] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_presensi)){

            // Get nama Pegawai
            $query_pegawai = "SELECT nama FROM employee WHERE id='".$row['id_pegawai']."'";
            $data_pegawai = $koneksi2->prepare($query_pegawai);
            $data_pegawai->execute();
            $data_pegawai->bind_result($nama_pegawai);
            while($data_pegawai->fetch()){
            }

            // Get nama Shift
            $query_shift = "SELECT shift FROM shift_pegawai WHERE id='".$row['id_shift']."'";
            $data_shift = $koneksi2->prepare($query_shift);
            $data_shift->execute();
            $data_shift->bind_result($nama_shift);
            while($data_shift->fetch()){
            }

            if($row['jam_presensi']>=$row['batas_presensi']){
                $status = "Terlambat";
            }else{
                $status = "Tepat Waktu";
            }

            if($row['toleransi']!=0){
                $verifikasi = "Disetujui";
            }else{
                $verifikasi = "Tidak Disetujui";
            }

            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['id_pegawai'] = $row['id_pegawai'];
            $data['nama_pegawai'] = $nama_pegawai;
            $data['id_shift'] = $row['id_shift'];
            $data['nama_shift'] = $nama_shift;
            $data['tanggal'] = $row['tanggal'];
            $data['jam_presensi'] = $row['jam_presensi'];
            $data['batas_presensi'] = $row['batas_presensi'];
            $data['status_kehadiran'] = $row['status_kehadiran'];
            $data['status'] = $status;
            $data['toleransi'] = $row['toleransi'];
            $data['verifikasi'] = $verifikasi;
            $data['id_brand'] = $row['id_brand'];
            $data['id_branch'] = $row['id_branch'];
            array_push($responsistem["data"], $data);
        }
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/presensi.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_presensi.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
?>
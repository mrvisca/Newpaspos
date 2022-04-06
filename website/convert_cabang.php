<?php
    session_start();
    include '../settings/database.php';
    $id_brand=$_SESSION['id_brand'];
    $today = date('Y-m-d');

    // Select Data Cabang
    $query_cabang = mysqli_query($koneksi, "SELECT * FROM branch WHERE id_brand='".$id_brand."' AND aktif_akun>='".$today."'");
    if(mysqli_num_rows($query_cabang)){
        $responsistem = array();
        $responsistem['data'] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_cabang)){
            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['id_brand'] = $row['id_brand'];
            $data['nama'] = $row['nama'];
            $data['nowa'] = $row['nowa'];
            $data['alamat'] = $row['alamat'];
            $data['kota'] = $row['kota'];
            $data['provinsi'] = $row['provinsi'];
            $data['pembuatan'] = $row['pembuatan'];
            $data['aktif_akun'] = $row['aktif_akun'];
            $data['presentase'] = $row['presentase'];
            array_push($responsistem["data"], $data);
        }
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/cabang.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_cabang.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
?>
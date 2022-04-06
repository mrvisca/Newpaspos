<?php
    session_start();
    include '../settings/database.php';
    $id_brand=$_SESSION['id_brand'];

    // Select Data Cabang
    $query_stock = mysqli_query($koneksi, "SELECT * FROM daftar_stock WHERE id_brand='".$id_brand."'");
    if(mysqli_num_rows($query_stock)){
        $responsistem = array();
        $responsistem['data'] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_stock)){
            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['id_brand'] = $row['id_brand'];
            $data['nama'] = $row['nama'];
            $data['unit'] = $row['unit'];
            $data['harga_ingredient'] = $row['harga_ingredient'];
            $data['harga_unit'] = $row['harga_unit'];
            $data['id_supplier'] = $row['id_supplier'];
            $data['ket'] = $row['ket'];
            array_push($responsistem["data"], $data);
        }
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/stock.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_stock.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
?>
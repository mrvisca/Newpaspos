<?php
    session_start();
    include '../settings/database.php';
    $id_brand = $_SESSION['id_brand'];

    // Select Data Cabang
    $query_supplier = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_brand='".$id_brand."'");
    if(mysqli_num_rows($query_supplier)){
        $responsistem = array();
        $responsistem['data'] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_supplier)){

            $query_stock = "SELECT nama FROM daftar_stock WHERE id='".$row['id_daftar_stock']."'";
            $stock_data = $koneksi->prepare($query_stock);
            $stock_data->execute();
            $stock_data->bind_result($nama_stock);
            while($stock_data->fetch()){
            }

            if($row['id_daftar_stock']==0){
                $nama_stock = "Custom Product";
            }

            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['id_brand'] = $row['id_brand'];
            $data['institusi'] = $row['institusi'];
            $data['nama'] = $row['nama'];
            $data['alamat'] = $row['alamat'];
            $data['notlp'] = $row['notlp'];
            $data['email'] = $row['email'];
            $data['id_daftar_stock'] = $row['id_daftar_stock'];
            $data['nama_barang'] = $nama_stock;
            $data['harga_penawaran'] = $row['harga_penawaran'];
            $data['keterangan'] = $row['keterangan'];
            array_push($responsistem["data"], $data);
        }
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/supplier.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_supplier.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
?>
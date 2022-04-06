<?php
    session_start();
    include '../settings/database.php';
    $id_brand = $_SESSION['id_brand'];

    // Select Data Cabang
    $query_stock_cabang = mysqli_query($koneksi, "SELECT * FROM stock_branch WHERE id_brand='".$id_brand."'");
    if(mysqli_num_rows($query_stock_cabang)){
        $responsistem = array();
        $responsistem['data'] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_stock_cabang)){

            $query_branch = "SELECT nama FROM branch WHERE id='".$row['id_branch']."'";
            $branch_data = $koneksi->prepare($query_branch);
            $branch_data->execute();
            $branch_data->bind_result($nama_branch);
            while($branch_data->fetch()){
            }

            $query_daftar_stock = "SELECT nama FROM daftar_stock WHERE id='".$row['id_daftar_stock']."'";
            $dstock_data = $koneksi->prepare($query_daftar_stock);
            $dstock_data->execute();
            $dstock_data->bind_result($nama_dstock);
            while($dstock_data->fetch()){
            }

            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['id_brand'] = $row['id_brand'];
            $data['id_branch'] = $row['id_branch'];
            $data['nama_branch'] = $nama_branch;
            $data['id_daftar_stock'] = $row['id_daftar_stock'];
            $data['nama_stock'] = $nama_dstock;
            $data['stock_jumlah'] = $row['stock_jumlah'];
            $data['unit'] = $row['unit'];
            $data['tanggal'] = $row['tanggal'];
            array_push($responsistem["data"], $data);
        }
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/stock_cabang.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_stock_cabang.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
?>
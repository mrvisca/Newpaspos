<?php
    session_start();
    include '../settings/database.php';
    $id_brand = $_SESSION['id_brand'];

    //Get ID Branch
    $query_branch = "SELECT id FROM branch WHERE id_brand='".$id_brand."'";
    $branch_data = $koneksi->prepare($query_branch);
    $branch_data->execute();
    $branch_data->bind_result($id_branch);
    while($branch_data->fetch()){
    }

    // Select Data Cabang
    $query_supplier = mysqli_query($koneksi, "SELECT * FROM update_stock WHERE id_branch='".$id_branch."'");
    if(mysqli_num_rows($query_supplier)){
        $responsistem = array();
        $responsistem['data'] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_supplier)){

            $query_nstock = "SELECT nama FROM daftar_stock WHERE id='".$row['id_daftar_stock']."'";
            $nstock_data = $koneksi2->prepare($query_nstock);
            $nstock_data->execute();
            $nstock_data->bind_result($nama_barang);
            while($nstock_data->fetch()){
            }

            $query_nbranch = "SELECT nama FROM branch WHERE id='".$row['id_branch']."'";
            $nbranch_data = $koneksi2->prepare($query_nbranch);
            $nbranch_data->execute();
            $nbranch_data->bind_result($nama_branch);
            while($nbranch_data->fetch()){
            }

            $query_nemployee = "SELECT nama FROM employee WHERE id='".$row['id_employee']."'";
            $nemployee_data = $koneksi2->prepare($query_nemployee);
            $nemployee_data->execute();
            $nemployee_data->bind_result($nama_pegawai);
            while($nemployee_data->fetch()){
            }

            if($nama_pegawai==0){
                $nama_pegawai = "OWNER";
            }

            $query_nitem = "SELECT nama FROM item WHERE id='".$row['id_item']."'";
            $nitem_data = $koneksi2->prepare($query_nitem);
            $nitem_data->execute();
            $nitem_data->bind_result($nama_item);
            while($nitem_data->fetch()){
            }

            if($nama_item==""){
                $nama_item = "Tidak ada dalam list produk";
            }

            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['tanggal'] = $row['tanggal'];
            $data['jumlah'] = $row['jumlah'];
            $data['ket'] = $row['ket'];
            $data['id_daftar_stock'] = $row['id_daftar_stock'];
            $data['nama_barang'] = $nama_barang;
            $data['id_branch'] = $row['id_branch'];
            $data['nama_cabang'] = $nama_branch;
            $data['id_employee'] = $row['id_employee'];
            $data['nama_pegawai'] = $nama_pegawai;
            $data['id_item'] = $row['id_item'];
            $data['nama_item'] = $nama_item;
            array_push($responsistem["data"], $data);
        }
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/stocklog.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_stocklog.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
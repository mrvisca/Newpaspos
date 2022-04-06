<?php
    session_start();
    include '../settings/database.php';
    $id_brand = $_SESSION['id_brand'];

    // Select Data Cabang
    $query_faktur = mysqli_query($koneksi, "SELECT * FROM faktur WHERE id_brand='".$id_brand."'");
    if(mysqli_num_rows($query_faktur)){
        $responsistem = array();
        $responsistem['data'] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_faktur)){
            // Get data Branch
            $query_name_branch = "SELECT nama FROM branch WHERE id='".$row['id_branch']."'";
            $data_name_branch = $koneksi->prepare($query_name_branch);
            $data_name_branch->execute();
            $data_name_branch->bind_result($nama_branch);
            while($data_name_branch->fetch()){
            }

            // Get data employee
            $query_name_employee = "SELECT nama FROM employee WHERE id='".$row['id_employee']."'";
            $data_name = $koneksi->prepare($query_name_employee);
            $data_name->execute();
            $data_name->bind_result($nama_pegawai);
            while($data_name->fetch()){
            }

            // Get data supplier
            $query_name_supplier = "SELECT nama FROM supplier WHERE id='".$row['id_supplier']."'";
            $data_name_supplier = $koneksi->prepare($query_name_supplier);
            $data_name_supplier->execute();
            $data_name_supplier->bind_result($nama_supplier);
            while($data_name_supplier->fetch()){
            }

            // Get data id rekening
            $query_name_rekening = "SELECT nama FROM rek_pembayaran WHERE id='".$row['id_rekening']."'";
            $data_name_rekening = $koneksi->prepare($query_name_rekening);
            $data_name_rekening->execute();
            $data_name_rekening->bind_result($nama_rekening);
            while($data_name_rekening->fetch()){
            }

            // Jenis Pembayaran
            if($row['jenis_pembayaran']=="0"){
                $jenis_bayar = "Tunai";
            }elseif($row['jenis_pembayaran']=="1"){
                $jenis_bayar = "Kredit";
            }elseif($row['jenis_pembayaran']=="2"){
                $jenis_bayar = "Down Payment (DP)";
            }else{
                $jenis_bayar = "Cash On Delivery (COD)";
            }

            if($row['sisa_pembayaran']==0){
                $status = "LUNAS";
            }else{
                $status = "BELUM LUNAS";
            }

            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['nofak'] = $row['nofak'];
            $data['tglfak'] = $row['tglfak'];
            $data['id_brand'] = $row['id_brand'];
            $data['id_branch'] = $row['id_branch'];
            $data['nama_branch'] = $nama_branch;
            $data['id_employee'] = $row['id_employee'];
            $data['nama_pegawai'] = $nama_pegawai; // ditambahkan
            $data['id_supplier'] = $row['id_supplier'];
            $data['nama_supplier'] = $nama_supplier;
            $data['total'] = $row['total'];
            $data['pembayaran'] = $row['pembayaran'];
            $data['sisa_pembayaran'] = $row['sisa_pembayaran'];
            $data['id_rekening'] = $row['id_rekening'];
            $data['nama_rekening'] = $nama_rekening;
            $data['jenis_pembayaran'] = $row['jenis_pembayaran'];
            $data['jenis_bayar'] = $jenis_bayar;
            $data['tanggal_dari'] = $row['tanggal_dari'];
            $data['tanggal_sampai'] = $row['tanggal_sampai'];
            $data['catatan'] = $row['catatan'];
            $data['status_transaksi'] = $status;
            array_push($responsistem["data"], $data);
        }
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/faktur.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_faktur.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
?>
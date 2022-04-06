<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    </head>
    <body>
        <?php
            date_default_timezone_set("Asia/Jakarta");
            include '../../settings/database.php';
            session_start();

            // Faktur Info
            $nofak = $_POST['nofak'];
            $tglfak = $_POST['tglfak'];
            $id_brand = $_POST['id_brand'];
            $id_branch = $_POST['id_branch'];
            $id_pegawai = $_POST['id_pegawai'];

            // Supplier Info
            $id_supplier = $_POST['id_supplier'];

            // Faktur Item
            $id_daftar_stock = $_POST['id_daftar_stock'];
            $jumlah = $_POST['jumlah'];
            $harga_satuan = $_POST['harga_satuan'];
            $nama_stock = $_POST['nama_stock'];
            $total_harga = $_POST['total_harga'];

            // Metode Pembayaran
            $total = $_POST['tot_pem'];
            $pembayaran = $_POST['jum_pembayaran'];
            $sisa_pembayaran = $_POST['sisa_pembayaran'];
            $id_rekening = $_POST['pembayaran'];
            $jenis_pembayaran = $_POST['jenis_pembayaran'];
            $tanggal_dari = $_POST['tanggal_dari'];
            $tanggal_sampai = $_POST['tanggal_sampai'];
            $catatan = $_POST['catatan'];

            $jam_tr = date('H:i');
            $tanggal_transaksi = $tglfak." ".$jam_tr;

            $keterangan = "Pembelian Stock Faktur ".$nofak;

            // Query Insert data to faktur table
            $query_insert_faktur = "INSERT INTO faktur (nofak,tglfak,id_brand,id_branch,id_employee,id_supplier,total,pembayaran,sisa_pembayaran,id_rekening,jenis_pembayaran,tanggal_dari,tanggal_sampai,catatan) VALUES ('".$nofak."','".$tanggal_transaksi."','".$id_brand."','".$id_branch."','".$id_pegawai."','".$id_supplier."','".$total."','".$pembayaran."','".$sisa_pembayaran."','".$id_rekening."','".$jenis_pembayaran."','".$tanggal_dari."','".$tanggal_sampai."','".$catatan."')";
            $data_insert = $koneksi->prepare($query_insert_faktur);
            if($data_insert->execute()){
                foreach($id_daftar_stock as $index => $ids)
                {
                    // echo $ids." - ".$nama_stock[$index]." - ".$jumlah[$index]." - ".$harga_satuan[$index].'<br/>';

                    // Query Insert to faktur_item table
                    $query_insert_faktur_item = "INSERT INTO faktur_item (id_daftar_stock,nama,jumlah_stock,harga_item,harga_item_total,id_faktur) VALUES ('".$ids."','".$nama_stock[$index]."','".$jumlah[$index]."','".$harga_satuan[$index]."','".$total_harga[$index]."','".$nofak."')";
                    $faktur_item_insert = $koneksi2->prepare($query_insert_faktur_item);
                    $faktur_item_insert->execute();

                    // Query Insert Update Stock
                    $query_update_stock = "INSERT INTO update_stock (tanggal,jumlah,ket,id_daftar_stock,id_branch,id_employee,id_item) VALUES ('".$tanggal_transaksi."','".$jumlah[$index]."','".$keterangan."','".$ids."','".$id_branch."','".$id_pegawai."','0')";
                    $update_stock = $koneksi2->prepare($query_update_stock);
                    $update_stock->execute();

                    // Query get stock gudang
                    $query_stock_branch = "SELECT id,stock_jumlah,unit FROM stock_branch WHERE id_daftar_stock='".$ids."'";
                    $stock_branch = $koneksi2->prepare($query_stock_branch);
                    $stock_branch->execute();
                    $stock_branch->bind_result($id_stock_db,$stock_jumlah_awal,$unit_stock);
                    while($stock_branch->fetch()){
                    }

                    if($ids==$id_stock_db){
                        $hasil_akhir = $stock_jumlah_awal+$jumlah[$index];
                    }else{
                        echo 'Terjadi kesalahan saat input data, Silahkan hubungi admin IT paspos';
                    }

                    if($unit_stock=="ONS"){
                        $stock_gudang = $hasil_akhir*500;
                    }

                    // Query Update stock_branch
                    $query_update_sbranch = "UPDATE stock_branch SET stock_jumlah='".$stock_gudang."' WHERE id_daftar_stock='".$ids."'";
                    $update_sbranch = $koneksi2->prepare($query_update_sbranch);
                    if($update_sbranch->execute()){
                        echo '  <script>
                                swal({
                                    title: "Pembuatan Faktur Berhasil",
                                    text: "Pembuatan Faktur Pembelian berhasil dilakukan",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(function(){
                                    window.location.href = "../convert_faktur.php";
                                });
                            </script>';
                    }else{
                        echo '  <script>
                                swal({
                                    title: "Pembuatan Faktur Gagal",
                                    text: "Pembuatan Faktur Pembelian Gagal dilakukan, terjadi kesalahan saat input data",
                                    type: "error",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(function(){
                                    window.location.href = "../faktur.php";
                                });
                            </script>';
                    }
                    // $id_faktur_item = $faktur_item_insert->insert_id;
                }
            }
        ?>
    </body>
</html>
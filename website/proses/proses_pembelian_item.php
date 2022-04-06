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
            session_start();
            date_default_timezone_set("Asia/Jakarta");
            include '../../settings/database.php';

            $id_brand = $_SESSION['id_brand'];

            // Post Array
            $id_item = $_POST['id_item'];
            $id_branch_item = $_POST['id_branch_item'];
            $nama_item = $_POST['nama_item'];
            $jml_item = $_POST['jml_item'];
            $harga_item = $_POST['harga_item'];
            $id_katagori = $_POST['id_katagori'];
            $harga_beli = $_POST['harga_beli'];

            $potongan = $_POST['potongan'];
            $diskon = $_POST['diskon'];
            $pajak = $_POST['pajak'];
            $pembulatan = $_POST['pembulatan'];
            $dibayarkan = $_POST['dibayarkan'];
            $sisa_pembayaran = $_POST['sisa_pembayaran'];
            $rek_pembayaran = $_POST['rek_pembayaran'];
            $judul = $_POST['judul'];
            $telpon = $_POST['telpon'];
            $catatan = $_POST['catatan'];
            $id_pegawai = $_POST['id_pegawai'];
            $id_meja = $_POST['id_meja'];
            $id_branch_pesanan = $_POST['id_branch_pembelian'];
            $btn_submit = $_POST['submit'];

            $status_pembayaran = 0;
            $waktu_update = date('Y-m-d H:i:s');
            $pelayanan = 0;

            // merubah menjadi array
            $id_item_arr = explode(",",$id_item);
            $id_branch_item_arr = explode(",",$id_branch_item);
            $nama_item_arr = explode(",",$nama_item);
            $jml_item_arr = explode(",",$jml_item);
            $harga_item_arr = explode(",",$harga_item);
            $id_katagori_arr = explode(",",$id_katagori);
            $harga_beli_arr = explode(",",$harga_beli);

            if($dibayarkan>=$pembulatan){
                $status_pembayaran = 1;
            }else{
                $hasil = $pembulatan-$dibayarkan;
                $sisa_pembayaran = $hasil;
                if($sisa_pembayaran==0){
                    $status_pembayaran = 1;
                }else{
                    $status_pembayaran = 0;
                }
            }

            if($btn_submit=="bayar"){
                $query_pesanan = "INSERT INTO pesanan (tanggal,tanggal_bayar,diskon,potongan,pajak,status_pesanan,id_brand,id_branch,pelayanan,catatan,judul,pembulatan,dibayarkan,id_rek_pembayaran,hpp,kasir,telepon,id_meja) VALUES ('".$waktu_update."','".$waktu_update."','".$diskon."','".$potongan."','".$pajak."','".$status_pembayaran."','".$id_brand."','".$id_branch_pesanan."','".$pelayanan."','".$catatan."','".$judul."','".$pembulatan."','".$dibayarkan."','".$rek_pembayaran."','0','".$id_pegawai."','".$telpon."','".$id_meja."')";
                $simpan_pesanan = $koneksi->prepare($query_pesanan);
                $simpan_pesanan->execute();
                $id_pesanan = $simpan_pesanan->insert_id;

                if($id_meja!=0){
                    $query_update_meja = "UPDATE reservasi SET status_reservasi='0' WHERE id='".$id_meja."'";
                    $update_reservasi = $koneksi->prepare($query_update_meja);
                    $update_reservasi->execute();
                }

                for($i=0;$i<sizeof($id_item_arr);$i++){
                    $id_item_db = $id_item_arr[$i];
                    $id_branch_db = $id_branch_item_arr[$i];
                    $nama_item_db = $nama_item_arr[$i];
                    $jml_item_db = $jml_item_arr[$i];
                    $harga_item_db = $harga_item_arr[$i];
                    $id_katagori_db = $id_katagori_arr[$i];
                    $harga_beli_db = $harga_beli_arr[$i];

                    $total[$i] = $jml_item_arr[$i]*$harga_item_arr[$i];

                    // echo $id_item_db." ".$id_branch_db." ".$nama_item_db." ".$jml_item_db." ".$harga_item_db."<br/>";

                    if($id_item_db!="" || $id_item_db!=0){
                        $query_penjualan = "INSERT INTO penjualan (id_item,tanggal,harga_satuan,jml_beli,total,id_branch,id_brand,nama_item,id_katagori,id_pesanan,pelayanan,harga_beli,kasir) VALUES ('".$id_item_db."','".$waktu_update."','".$harga_item_db."','".$jml_item_db."','".$total[$i]."','".$id_branch_db."','".$_SESSION['id_brand']."','".$nama_item_db."','".$id_katagori_db."','".$id_pesanan."','".$pelayanan."','".$harga_beli_db."','".$id_pegawai."')";
                        $data_penjualan = $koneksi2->prepare($query_penjualan);
                        $data_penjualan->execute();

                        echo    '<script>
                                    swal({
                                        title: "Transaksi Pembelian Berhasil",
                                        text: "Transaksi berhasil, jangan lupa layani pesanan yang tersedia",
                                        type: "success",
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../kasir.php";
                                    });
                                </script>';
                    }
                }
            }

            if($btn_submit=="simpan"){
                $query_pesanan = "INSERT INTO pesanan (tanggal,tanggal_bayar,diskon,potongan,pajak,status_pesanan,id_brand,id_branch,pelayanan,catatan,judul,pembulatan,dibayarkan,id_rek_pembayaran,hpp,kasir,telepon,id_meja) VALUES ('".$waktu_update."','".$waktu_update."','".$diskon."','".$potongan."','".$pajak."','".$status_pembayaran."','".$id_brand."','".$id_branch_pesanan."','".$pelayanan."','".$catatan."','".$judul."','".$pembulatan."','".$dibayarkan."','".$rek_pembayaran."','0','".$id_pegawai."','".$telpon."','".$id_meja."')";
                $simpan_pesanan = $koneksi->prepare($query_pesanan);
                $simpan_pesanan->execute();
                $id_pesanan = $simpan_pesanan->insert_id;

                if($id_meja!=0){
                    $query_update_meja = "UPDATE reservasi SET status_reservasi='0' WHERE id='".$id_meja."'";
                    $update_reservasi = $koneksi->prepare($query_update_meja);
                    $update_reservasi->execute();
                }

                for($i=0;$i<sizeof($id_item_arr);$i++){
                    $id_item_db = $id_item_arr[$i];
                    $id_branch_db = $id_branch_item_arr[$i];
                    $nama_item_db = $nama_item_arr[$i];
                    $jml_item_db = $jml_item_arr[$i];
                    $harga_item_db = $harga_item_arr[$i];
                    $id_katagori_db = $id_katagori_arr[$i];
                    $harga_beli_db = $harga_beli_arr[$i];

                    $total[$i] = $jml_item_arr[$i]*$harga_item_arr[$i];

                    // echo $id_item_db." ".$id_branch_db." ".$nama_item_db." ".$jml_item_db." ".$harga_item_db."<br/>";

                    if($id_item_db!="" || $id_item_db!=0){
                        $query_penjualan = "INSERT INTO penjualan (id_item,tanggal,harga_satuan,jml_beli,total,id_branch,id_brand,nama_item,id_katagori,id_pesanan,pelayanan,harga_beli,kasir) VALUES ('".$id_item_db."','".$waktu_update."','".$harga_item_db."','".$jml_item_db."','".$total[$i]."','".$id_branch_db."','".$_SESSION['id_brand']."','".$nama_item_db."','".$id_katagori_db."','".$id_pesanan."','".$pelayanan."','".$harga_beli_db."','".$id_pegawai."')";
                        $data_penjualan = $koneksi2->prepare($query_penjualan);
                        $data_penjualan->execute();

                        echo    '<script>
                                    swal({
                                        title: "Transaksi Pembelian Berhasil",
                                        text: "Transaksi berhasil, jangan lupa layani pesanan yang tersedia",
                                        type: "success",
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../kasir.php";
                                    });
                                </script>';
                    }
                }
            }
        ?>
    </body>
</html>
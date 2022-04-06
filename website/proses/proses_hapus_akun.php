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

            $id_brand = $_POST['id_brand'];

            // Get id_branch
            $query_branch = "SELECT id FROM branch WHERE id_brand='".$id_brand."'";
            $branch_data = $koneksi->prepare($query_branch);
            $branch_data->execute();
            $branch_data->bind_result($id_branch);
            while($branch_data->fetch()){
            }
            
            // Memanggil id item untuk kebutuhan hapus data
            $query_item = "SELECT id FROM item WHERE id_brand='".$id_brand."'";
            $items = $koneksi->prepare($query_item);
            $items->execute();
            $items->bind_result($id_item);
            while($items->fetch()){
            }

            // Hapus data inti
            $delete_brand = "DELETE FROM brand WHERE id='".$id_brand."'";
            $brands = $koneksi->prepare($delete_brand);
            $brands->execute();

            $delete_branch = "DELETE FROM branch WHERE id_brand='".$id_brand."'";
            $branchs = $koneksi->prepare($delete_branch);
            $branchs->execute();

            $delete_katagori_transaksi = "DELETE FROM katagori_transaksi WHERE id_brand='".$id_brand."'";
            $katagori_trans = $koneksi->prepare($delete_katagori_transaksi);
            $katagori_trans->execute();

            $delete_rek_pembayaran = "DELETE FROM rek_pembayaran WHERE id_brand='".$id_brand."'";
            $rek_pembayaran = $koneksi->prepare($delete_rek_pembayaran);
            $rek_pembayaran->execute();

            $delete_web_config = "DELETE FROM web_config WHERE id_brand='".$id_brand."'";
            $web_config = $koneksi->prepare($delete_web_config);
            $web_config->execute();

            // Hapus data lainnya
            $delete_daftar_stock = "DELETE FROM daftar_stock WHERE id_brand='".$id_brand."'";
            $daftar_stock = $koneksi->prepare($delete_daftar_stock);
            $daftar_stock->execute();

            $delete_employee = "DELETE FROM employee WHERE id_brand='".$id_brand."'";
            $employees = $koneksi->prepare($delete_employee);
            $employees->execute();

            $delete_fitur_akses = "DELETE FROM fitur_akses WHERE id_branch='".$id_branch."'";
            $fitur_akses = $koneksi->prepare($delete_fitur_akses);
            $fitur_akses->execute();

            $delete_ingredient = "DELETE FROM ingredient WHERE id_item='".$id_item."'";
            $ingredients = $koneksi->prepare($delete_ingredient);
            $ingredients->execute();

            $delete_item = "DELETE FROM item WHERE id_brand='".$id_brand."'";
            $hapus_item = $koneksi->prepare($delete_item);
            $hapus_item->execute();

            $delete_item_branch = "DELETE FROM item_branch WHERE id_branch='".$id_branch."'";
            $hapus_item_branch = $koneksi->prepare($delete_item_branch);
            $hapus_item_branch->execute();

            $delete_kasir = "DELETE FROM kasir WHERE id_brand='".$id_brand."'";
            $hapus_kasir = $koneksi->prepare($delete_kasir);
            $hapus_kasir->execute();

            $delete_katagori_product = "DELETE FROM katagori WHERE id_brand='".$id_brand."'";
            $katagori_product = $koneksi->prepare($delete_katagori_product);
            $katagori_product->execute();

            $delete_penjualan = "DELETE FROM penjualan WHERE id_brand='".$id_brand."'";
            $hapus_penjualan = $koneksi->prepare($delete_penjualan);
            $hapus_penjualan->execute();

            $delete_pesanan = "DELETE FROM pesanan WHERE id_brand='".$id_brand."'";
            $hapus_pesanan = $koneksi->prepare($delete_pesanan);
            $hapus_pesanan->execute();

            $delete_presensi = "DELETE FROM presensi WHERE id_brand='".$id_brand."'";
            $hapus_presensi = $koneksi->prepare($delete_presensi);
            $hapus_presensi->execute();

            $delete_reservasi = "DELETE FROM reservasi WHERE id_brand='".$id_brand."'";
            $hapus_reservasi = $koneksi->prepare($delete_reservasi);
            $hapus_reservasi->execute();

            $delete_setting_kasir = "DELETE FROM setting_kasir WHERE id_brand='".$id_brand."'";
            $hapus_setting_kasir = $koneksi->prepare($delete_setting_kasir);
            $hapus_setting_kasir->execute();

            $delete_shift_pegawai = "DELETE FROM shift_pegawai WHERE id_brand='".$id_brand."'";
            $hapus_shift_pegawai = $koneksi->prepare($delete_shift_pegawai);
            $hapus_shift_pegawai->execute();

            $delete_sumin = "DELETE FROM sumin WHERE id_brand='".$id_brand."'";
            $hapus_sumin = $koneksi->prepare($delete_sumin);
            $hapus_sumin->execute();

            $delete_transaksi = "DELETE FROM transaksi WHERE id_brand='".$id_brand."'";
            $hapus_transaksi = $koneksi->prepare($delete_transaksi);
            $hapus_transaksi->execute();

            $delete_update_stock = "DELETE FROM update_stock WHERE id_branch='".$id_branch."' AND id_item='".$id_item."'";
            $hapus_update_stock = $koneksi->prepare($delete_update_stock);
            $hapus_update_stock->execute();

            echo '  <script>
                            swal({
                                title: "Hapus Akun Berhasil",
                                text: "Hapus Akun Berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../convert_akun.php";
                            });
                        </script>';
        ?>
    </body>
</html>
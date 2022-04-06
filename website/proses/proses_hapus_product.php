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

            $id = $_GET['id'];

            $cek_ibranch = 0;
            // Cek Query item branch
            $query_ibranch = "SELECT id FROM item_branch WHERE id_item='".$id."'";
            $ibranch_data = $koneksi->prepare($query_ibranch);
            $ibranch_data->execute();
            $ibranch_data->bind_result($id_ibranch);
            while($ibranch_data->fetch()){
                $cek_ibranch=1;break;
            }

            if($ibranch_data==1){
                $query_delete_ibranch = "DELETE FROM item_branch WHERE id_item='".$id."'";
                $delete_ibranch = $koneksi->prepare($query_delete_ibranch);
                $delete_ibranch->execute();
            }

            $cek_ingredient = 0;
            // Cek query ingredient
            $query_ingredient = "SELECT id FROM ingredient WHERE id_item='".$id."'";
            $ingredient_cek = $koneksi->prepare($query_ingredient);
            $ingredient_cek->execute();
            $ingredient_cek->bind_result($id_ingredient);
            while($ingredient_cek->fetch()){
                $cek_ingredient = 1;break;
            }

            if($cek_ingredient==1){
                $query_delete_ingredient = "DELETE FROM ingredient WHERE id_item='".$id."'";
                $delete_ingredient = $koneksi->prepare($query_delete_ingredient);
                $delete_ingredient->execute();
            }

            $cek_update_stock = 0;
            // Cek query update_stock
            $query_update_stock = "SELECT id FROM update_stock WHERE id_item='".$id."'";
            $update_stock_data = $koneksi->prepare($query_update_stock);
            $update_stock_data->execute();
            $update_stock_data->bind_result($id_update_stock);
            while($update_stock_data->fetch()){
                $cek_update_stock = 1;break;
            }

            if($cek_update_stock==1){
                $query_delete_update_stock = "DELETE FROM update_stock WHERE id_item='".$id."'";
                $delete_update_stock = $koneksi->prepare($query_delete_update_stock);
                $delete_update_stock->execute();
            }
            
            $query_delete_product = "DELETE FROM item WHERE id='".$id."'";
            $supplier_data = $koneksi->prepare($query_delete_supplier);
            if($supplier_data->execute())
            {
                echo '  <script>
                            swal({
                                title: "Hapus Data Produk Berhasil",
                                text: "Hapus data Produk berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../daftar_produk.php";
                            });
                        </script>';
            }else{
                echo '  <script>
                            swal({
                                title: "Hapus Data Produk Gagal",
                                text: "Hapus data Produk gagal, ada kesalahan dalam hapus data",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../daftar_produk.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>
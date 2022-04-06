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

            // Get data from post form
            $id_item = $_POST['id_item'];
            $id_daftar_stock = $_POST['id_daftar_stock'];
            $jumlah = $_POST['jumlah'];

            foreach($id_daftar_stock as $index => $ids)
            {
                // echo $ids." - ".$id_item." - ".$jumlah[$index].'<br/>';

                // Query Insert to faktur_item table
                $query_insert_ingredient = "INSERT INTO ingredient (id_item,id_daftar_stock,jumlah) VALUES ('".$id_item."','".$ids."','".$jumlah[$index]."')";
                $ingredient_data = $koneksi->prepare($query_insert_ingredient);
                if($ingredient_data->execute()){
                    echo '  <script>
                                swal({
                                    title: "Pembuatan Ingredient Berhasil",
                                    text: "Pembuatan Ingredient Produk berhasil dilakukan",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(function(){
                                    window.location.href = "../ingredient.php?id='.$id_item.'";
                                });
                            </script>';
                }else{
                    echo '  <script>
                                swal({
                                    title: "Pembuatan Ingredient Gagal",
                                    text: "Pembuatan Ingredint Produk Gagal dilakukan, terjadi kesalahan saat input data",
                                    type: "error",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(function(){
                                    window.location.href = "../ingredient.php?id='.$id_item.'";
                                });
                            </script>';
                }
            }
        ?>
    </body>
</html>
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

            $id_ingredient = $_POST['id_ingredient'];
            $id_daftar_stock = $_POST['id_daftar_stock'];
            $jumlah = $_POST['jumlah'];
            $id_item = $_POST['id_item'];
            
            $query_update_ingredient = "UPDATE ingredient SET id_daftar_stock='".$id_daftar_stock."',jumlah='".$jumlah."' WHERE id='".$id_ingredient."'";
            $ing_data = $koneksi->prepare($query_update_ingredient);
            if($ing_data->execute())
            {
                echo '  <script>
                            swal({
                                title: "Update Data Ingredient Berhasil",
                                text: "Update data ingredient berhasil dilakukan",
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
                                title: "Update Data Ingredient Gagal",
                                text: "Update data ingredient gagal, ada kesalahan dalam penginputan",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../ingredient.php?id='.$id_item.'";
                            });
                        </script>';
            }
        ?>
    </body>
</html>
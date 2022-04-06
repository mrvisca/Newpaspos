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
            $id_item = $_GET['id_item'];
            
            $query_delete_ingredient = "DELETE FROM ingredient WHERE id='".$id."'";
            $ingredient_delete = $koneksi->prepare($query_delete_ingredient);
            if($ingredient_delete->execute())
            {
                echo '  <script>
                            swal({
                                title: "Hapus Data Ingredient Berhasil",
                                text: "Hapus data ingredient berhasil dilakukan",
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
                                title: "Hapus Data Gagal",
                                text: "Hapus data ingredient, ada kesalahan dalam hapus data",
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
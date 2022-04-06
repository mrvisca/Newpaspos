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

            $id_item = $_POST['id_item'];
            $id_branch = $_POST['id_branch'];
            $id_brand = $_POST['id_brand'];

            // Cek apakah produk sudah ada
            $cek = 0;
            $query_cek_data = "SELECT id FROM item_branch WHERE id_item = '".$id_item."' AND id_branch='".$id_branch."'";
            $cek_data = $koneksi->prepare($query_cek_data);
            $cek_data->execute();
            $cek_data->bind_result($id_ibranch);
            while($cek_data->fetch()){
                $cek = 1;break;
            }

            // Cek apakah produk bisa ditambahkan atau tidak?
            if($id_branch!=0 && $cek!=1){
                $query_insert_ibranch = "INSERT INTO item_branch (id_item,id_brand,id_branch) VALUES ('".$id_item."','".$id_brand."','".$id_branch."')";
                $insert_ibranch = $koneksi->prepare($query_insert_ibranch);
                if($insert_ibranch->execute()){
                    echo    '<script>
                                swal({
                                    title: "Penambahan Item Branch Berhasil",
                                    text: "Penambahan data item branch berhasil dilakukan",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(function(){
                                    window.location.href = "../cabang_product.php";
                                });
                            </script>';
                }
            }else{
                echo '  <script>
                            swal({
                                title: "Penambahan Item Branch Gagal",
                                text: "Penambahan itembranch gagal, Kuota Branch Sudah Habis",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../cabang_product.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>
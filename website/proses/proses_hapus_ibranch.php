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

            $id_item = $_GET['id'];

            // Get Id_branch
            $query_cek_branch = "SELECT id_branch FROM item_branch WHERE id_item = '".$id_item."'";
            $cek_branch = $koneksi->prepare($query_cek_branch);
            $cek_branch->execute();
            $cek_branch->bind_result($id_branch);
            while($cek_branch->fetch()){
            }

            if($id_branch!=0){
                // delete data ibranch
                $query_delete_ibranch = "DELETE FROM item_branch WHERE id_item='".$id_item."'";
                $delete_ibranch = $koneksi2->prepare($query_delete_ibranch);
                if($delete_ibranch->execute()){
                    echo    '<script>
                                swal({
                                    title: "Hapus Data Item Branch Berhasil",
                                    text: "Hapus data item branch berhasil dilakukan",
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
                                title: "Hapus Data Gagal",
                                text: "Hapus data item branch gagal, silahkan hubungi mimin untuk menghapus dari database",
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
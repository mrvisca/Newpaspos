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

            $id_stock = $_POST['id'];
            $stock_jumlah = $_POST['stock_jumlah'];
            $tanggal = $_POST['tanggal'];
            $id_branch = $_POST['id_branch'];
            $keterangan = "Update stock cabang manual";
            
            $query_update_setting = "UPDATE stock_branch SET stock_jumlah='".$stock_jumlah."',tanggal='".$tanggal."' WHERE id='".$id_branch."'";
            $settings = $koneksi->prepare($query_update_setting);
            if($settings->execute())
            {
                $query_insert_update = "INSERT INTO update_stock (tanggal,jumlah,keterangan,id_daftar_stock,id_branch,id_employee,id_item) VALUES ('".$tanggal."','".$stock_jumlah."','".$keterangan."','".$id_stock."','".$id_branch."','0','0')";
                $inser_update = $koneksi2->prepare($query_insert_update);
                $inser_update->execute();

                echo '  <script>
                            swal({
                                title: "Update Data Berhasil",
                                text: "Update data stock cabang berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../convert_cabang.php";
                            });
                        </script>';
            }else{
                echo '  <script>
                            swal({
                                title: "Update Data Gagal",
                                text: "Update data stock cabang gagal, ada kesalahan dalam penginputan",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../daftar_cabang.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>
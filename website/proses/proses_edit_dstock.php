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

            $id = $_POST['id'];
            $id_brand = $_POST['id_brand'];
            $nama = $_POST['nama'];
            $unit = $_POST['unit'];
            $harga_ingredient = $_POST['harga_ingredient'];
            $harga_unit = $_POST['harga_unit'];
            $id_supplier = $_POST['id_supplier'];
            $ket = $_POST['ket'];

            $harga_bahan = str_replace("Rp. ", "", str_replace(".", "", str_replace(",", ".", $harga_ingredient)));
            $harga_satuan = str_replace("Rp. ", "", str_replace(".", "", str_replace(",", ".", $harga_unit)));

            $query_update_stock = "UPDATE daftar_stock SET id_brand='".$id_brand."',nama='".$nama."',unit='".$unit."',harga_ingredient='".$harga_bahan."',harga_unit='".$harga_satuan."',id_supplier='".$id_supplier."',ket='".$ket."' WHERE id='".$id_brand."'";
            $daftar_stock = $koneksi->prepare($query_update_stock);
            if($daftar_stock->execute()){
                echo '  <script>
                            swal({
                                title: "Update Data Berhasil",
                                text: "Update data daftar stock berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../convert_stock.php";
                            });
                        </script>';
            }else{
                echo '  <script>
                            swal({
                                title: "Update Data Gagal",
                                text: "Update data daftar stock gagal, Kuota Branch Sudah Habis",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../daftar_stock.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>
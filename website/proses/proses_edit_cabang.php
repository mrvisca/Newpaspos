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
            $id_branch = $_POST['id_branch'];
            $nama = $_POST['nama'];
            $nowa = $_POST['nowa'];
            $alamat = $_POST['alamat'];
            $kota = $_POST['kota'];
            $provinsi = $_POST['provinsi'];
            $presentase = $_POST['presentase'];
            
            $query_update_cabang = "UPDATE branch SET nama='".$nama."',nowa='".$nowa."',alamat='".$alamat."',kota='".$kota."',provinsi='".$provinsi."',presentase='".$presentase."' WHERE id='".$id_branch."' AND id_brand='".$id_brand."'";
            $cabang = $koneksi->prepare($query_update_cabang);
            if($cabang->execute())
            {
                echo '  <script>
                            swal({
                                title: "Update Data Berhasil",
                                text: "Update data branch berhasil dilakukan",
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
                                text: "Update data branch gagal, ada kesalahan dalam penginputan",
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
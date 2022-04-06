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
            $nama = $_POST['nama'];
            $nowa = $_POST['nowa'];
            $alamat = $_POST['alamat'];
            $kota = $_POST['kota'];
            $provinsi = $_POST['provinsi'];
            $presentase = $_POST['presentase'];

             // Cek Row Branch
            $query_branch_row = mysqli_query($koneksi,"SELECT * FROM branch WHERE id_brand='".$id_brand."'");
            $branch_row = mysqli_num_rows($query_branch_row);

            // Kuota Branch
            $query_maxbranch = "SELECT maxbranch FROM brand WHERE id='".$id_brand."'";
            $kuota_maxbranch = $koneksi->prepare($query_maxbranch);
            $kuota_maxbranch->execute();
            $kuota_maxbranch->bind_result($maxbranch);
            while($kuota_maxbranch->fetch()){
            }
            
            if($branch_row <= $maxbranch){
                $query_insert_cabang = "INSERT INTO branch (id_brand,nama,nowa,alamat,kota,provinsi,presentase) VALUES ('".$id_brand."','".$nama."','".$nowa."','".$alamat."','".$kota."','".$provinsi."','".$presentase."')";
                $cabang = $koneksi->prepare($query_update_cabang);
                $cabang->execute();

                echo '  <script>
                            swal({
                                title: "Pembuatan Data Berhasil",
                                text: "Pembuatan data branch berhasil dilakukan",
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
                                title: "Pembuatan Data Gagal",
                                text: "Pembuatan data branch gagal, Kuota Branch Sudah Habis",
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
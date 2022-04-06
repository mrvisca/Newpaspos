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
            include '../../settings/database.php';

            $id_brand = $_POST['id_brand'];
            $nama = $_POST['nama'];
            $username = $_POST['user'];
            $password = $_POST['pass'];
            $pwhash = password_hash(md5($password),PASSWORD_DEFAULT);
            $nohp = $_POST['nohp'];
            $email = $_POST['email'];
            $alamat = $_POST['alamat'];
            $kota = $_POST['kota'];
            $provinsi = $_POST['provinsi'];
            
            $query_update_brand = "UPDATE brand SET nama='".$nama."',user='".$username."',pass='".$pwhash."',nohp='".$nohp."',email='".$email."',alamat='".$alamat."',kota='".$kota."',provinsi='".$provinsi."' WHERE id='".$id_brand."'";
            $brand = $koneksi->prepare($query_update_brand);
            if($brand->execute())
            {
                echo '  <script>
                            swal({
                                title: "Update Data Berhasil",
                                text: "Update data akun pengguna berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../pengguna.php";
                            });
                        </script>';
            }else{
                echo '  <script>
                            swal({
                                title: "Update Data Gagal",
                                text: "Update data akun pengguna gagal, ada kesalahan dalam penginputan",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../pengguna.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>
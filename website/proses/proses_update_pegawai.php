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
            $id_pegawai = $_POST['id_pegawai'];
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $id_branch = $_POST['id_branch'];
            $nama = $_POST['nama'];
            $email = $_POST['email'];

            // Update data ke table item
            $query_update_pegawai = "UPDATE employee SET user='".$user."',pass='".$pass."',id_branch='".$id_branch."',nama='".$nama."',email='".$email."' WHERE id='".$id_pegawai."'";
            $data_pegawai = $koneksi->prepare($query_update_pegawai);
            if($data_pegawai->execute()){
                echo    '<script>
                            swal({
                                title: "Tambah Data Pegawai Berhasil",
                                text: "Tambah Data Pegawai berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../convert_pegawai.php";
                            });
                        </script>';
            }else{
                echo    '<script>
                            swal({
                                title: "Tambah Data Pegawai Gagal",
                                text: "Tambah Data Pegawai Gagal dilakukan",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../daftar_pegawai.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>
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

            $id_branch = $_POST['id_branch'];
            $aktif_akun = $_POST['aktif_akun'];
            $tanggal_buat = date_create($aktif_akun);
            $tanggal_simpan = date_format($tanggal_buat,"Y-m-d");
            
            $query_update_setting = "UPDATE brand SET aktif_akun='".$tanggal_simpan."' WHERE id='".$id_branch."'";
            $settings = $koneksi->prepare($query_update_setting);
            if($settings->execute())
            {
                echo '  <script>
                            swal({
                                title: "Update Data Berhasil",
                                text: "Update data masa aktif cabang berhasil dilakukan",
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
                                text: "Update data masa aktif gagal, ada kesalahan dalam penginputan",
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